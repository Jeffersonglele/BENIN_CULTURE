<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Langue;

class LangueController extends Controller
{
    public function index() {
        // Récupère toutes les langues
        $langues = Langue::all()->map(function($langue) {
            return [
                'code' => $langue->code_langue,
                'nom' => $langue->nom_langue,
                'description' => $langue->description,
            ];
        });

        return view('front.langue', ['langues' => $langues]);
    }
}
