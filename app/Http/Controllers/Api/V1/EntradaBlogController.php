<?php

namespace App\Http\Controllers\API\V1;

use App\Models\EntradaBlog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EntradaBlogController extends Controller
{
    public function index()
    {
        return EntradaBlog::all();
    }


    public function show(EntradaBlog $entradaBlog)
    {
        return $entradaBlog;
    }
}
