<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;

class PageController extends Controller
{

    // creo la funzione index per visualizzare tutti i miei progetti dentro l'api
    public function index(){
        // usando with gli passo tutte le entità in relazione type è al singolare perche ha una relazione one-to-many mentre technologies al prurale perché ha una relazione many-to-many
        $projects = Project::orderBy('id', 'desc')->with('type', 'technologies')->get();

        //ritorno un file json con il risultato della richiesta e l'array con tutti i progetti
        return response()->json([
            'status' => 200,
            'result' => $projects
        ]);
    }

    public function technologies(){
        $technologies = Technology::all();
        return response()->json($technologies);
    }

}
