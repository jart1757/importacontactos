<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Contact;
use Google\Client;
use Google\Service\PeopleService;

class GoogleAuthController extends Controller
{
    /**
     * Redirige al usuario a Google para la autenticación.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/contacts.readonly'])
            ->redirect();
    }

    /**
     * Maneja la respuesta de Google después de la autenticación y obtiene los contactos.
     */
    public function handleGoogleCallback()
    {
        // Obtener el usuario autenticado
        $user = Socialite::driver('google')->user();
        $token = $user->token;
    
        // Inicializar el cliente de Google
        $client = new Client();
        $client->setAccessToken($token);
    
        // Crear el servicio de People API
        $service = new PeopleService($client);
    
        // Inicializamos el array para almacenar los contactos
        $connections = [];
        $nextPageToken = null;
    
        // Paginación para obtener todos los contactos
        do {
            // Hacemos la solicitud para obtener los contactos
            $response = $service->people_connections->listPeopleConnections('people/me', [
                'pageSize' => 100, // Máximo de contactos por solicitud
                'personFields' => 'names,emailAddresses,phoneNumbers',
                'pageToken' => $nextPageToken,
            ]);
    
            // Verificamos si hay contactos y los agregamos al array
            if ($response->getConnections()) {
                $connections = array_merge($connections, $response->getConnections());
            }
    
            // Obtenemos el token de la siguiente página
            $nextPageToken = $response->getNextPageToken();
    
        } while ($nextPageToken); // Continuamos hasta que no haya más páginas
    
        // Limpiar contactos anteriores en la base de datos
        Contact::truncate();  // Esto elimina todos los registros en la tabla 'contacts'
    
        // Guardar o actualizar todos los contactos obtenidos
        foreach ($connections as $person) {
            // Obtener el nombre del contacto
            $name = ($person->getNames() && isset($person->getNames()[0])) 
                ? $person->getNames()[0]->getDisplayName() 
                : 'No Name';
    
            // Obtener el email del contacto
            $email = ($person->getEmailAddresses() && isset($person->getEmailAddresses()[0])) 
                ? $person->getEmailAddresses()[0]->getValue() 
                : null;
    
            // Obtener el teléfono del contacto
            $phone = ($person->getPhoneNumbers() && isset($person->getPhoneNumbers()[0])) 
                ? $person->getPhoneNumbers()[0]->getValue() 
                : null;
    
            // Actualizar o crear el contacto en la base de datos
            Contact::updateOrCreate(
                ['email' => $email], // Condición para verificar si el contacto ya existe
                ['name' => $name, 'phone' => $phone] // Campos a actualizar o crear
            );
        }
    
        // Redirigir a la lista de contactos
        return redirect()->route('contacts.list');
    }
    

    /**
     * Muestra la lista de contactos almacenados en la base de datos.
     */
    public function listContacts()
    {
        $contacts = Contact::orderBy('name', 'asc')->paginate(100); 
        return view('contacts.index', compact('contacts'));
    }
}
