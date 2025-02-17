<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Guest; // Asegúrate de importar tu modelo

class InvitationController extends Controller
{
    public function generateInvitations()
    {
        $guests = Guest::all(); // Obtiene todos los invitados

        $pdf = Pdf::loadView('invitations.template', compact('guests'));

        return $pdf->stream('invitaciones.pdf'); // Puedes usar ->download('archivo.pdf') si prefieres descargarlo
    }
}
