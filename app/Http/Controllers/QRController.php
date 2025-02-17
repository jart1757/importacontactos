<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function generateQR()
    {
           // Cambia el enlace a la URL pública de Ngrok
           $link = 'https://8f40-131-0-197-253.ngrok-free.app/auth/google'; // Tu URL de Ngrok

        $qr = QrCode::size(200)->generate($link);

        return view('qr', compact('qr'));
    }
}