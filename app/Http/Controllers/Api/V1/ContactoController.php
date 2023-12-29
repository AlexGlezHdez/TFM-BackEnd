<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function enviarMensaje (Request $request) {
        $para = 'info@tfm-clubmolamola.es';
        $título = $request->get('asunto');

        $mensaje = $request->get('mensaje');

        // Para enviar un correo HTML, debe establecerse la cabecera Content-type
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Cabeceras adicionales
        $cabeceras .= 'From: '.$request->get('nombre').' <'.$request->get('email').'>' . "\r\n";
        // Enviarlo
        return mail($para, $título, $mensaje, $cabeceras);
    }
}
