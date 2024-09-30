<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class PageController extends Controller
{

    // creo la funzione index per visualizzare tutti i miei progetti dentro l'api
    public function index(){
        $projects = Project::orderBy('id', 'desc')->with('type')->get();

        //ritorno un file json con il risultato della richiesta e l'array con tutti i progetti
        return response()->json([
            'status' => 200,
            'result' => $projects
        ]);
    }
}
