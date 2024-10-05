<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class PageController extends Controller
{

    // creo la funzione index per visualizzare tutti i miei progetti dentro l'api
    public function index(){
        // usando with gli passo tutte le entità in relazione type è al singolare perche ha una relazione one-to-many mentre technologies al prurale perché ha una relazione many-to-many
        $projects = Project::orderBy('id', 'desc')->with('type', 'technologies')->get();
        

        if($projects){
            $status = 200;
            // ciclo ogni progetto per gestire il path dell'immagine ad ogni singolo progetto
            foreach($projects as $project){
                 // gestisco il path dell'immagine che non voglio che sia null nei progetti senza immagine
            if($project->image_path){
                //se il path è presente lo compilo con asset e aggiungo storage per completare il path che verrà restituito
                $project->image_path = asset('storage/' . $project->image_path);
            }else{
                // altrimenti gli passo l'immagine base
                $project->image_path = '/img/placehold image.jpeg';
                // per non avere un valore null imposto un nome base per il campo img_original_name
                $project->img_original_name = 'no image';
            }
            // se non è specificato il tipo l'api restituisce no type invece che null
            if(!$project->type_id){
                $project->type_id = 'no type';
            }
            }
        }else{
            $status = 404;
        }

        //ritorno un file json con il risultato della richiesta e l'array con tutti i progetti
        return response()->json(compact('status', 'projects'));
    }


    // funzione che mi restituisce la lista di tutte le tecnologie
    public function technologies(){
        $technologies = Technology::all();
        // aggiungo la condizione per lo stato della richiesta se ci sono risultati è 200 altrimenti 404
        if($technologies->isEmpty()){
            $status = 404;
        } else{
            $status = 200;
        }

        return response()->json(compact('status', 'technologies'));
    }
    // funzione che mi restituisce la lista con tutti i tipi
    public function types(){
        $types = Type::all();
        // aggiungo la condizione per lo stato della richiesta se ci sono risultati è 200 altrimenti 404
        if($types->isEmpty()){
            $status = 404;
        } else{
            $status = 200;
        }
        return response()->json(compact('status', 'types'));
    }

    // creo una funzione che mi restituisce il progetto selezionato con il tipo e le tecnologie tutto questo attraverso lo slug
    public function projectSlug($slug){
        // cerca il progetto con lo slugche viene passato e gli passo anche i tipi e le tecnologie che ha quel singolo progetto
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();

        // eseguo un controllo se il progetto scelto esiste
        if($project){
            //se esiste la variabile status sarà 200 (la richiesta è stata eseguita con successo) e allora eseguo il controllo sull'immagine
            $status = 200;
            // gestisco il path dell'immagine che non voglio che sia null nei progetti senza immagine
            if($project->image_path){
                //se il path è presente lo compilo con asset e il tutto il path
                $project->image_path = asset('storage/' . $project->image_path);
            }else{
                // altrimenti gli passo l'immagine base
                $project->image_path = '/img/placehold image.jpeg';
                // per non avere un valore null imposto un nome base per il campo img_original_name 
                $project->img_original_name = 'no image';
            }
        }else{
            // se il progetto non esiste allora lo status sarà 404 (La risorsa richiesta non è stata trovata)
            $status = 404;
        }

        // ritorno sempre un file json con tutto il progetto e lo status della richiesta con compact
       return response()->json(compact('project', 'status'));
    }

    // creo una funzione che mi restituisce tutti i progetti in base al tipo
    public function projectsType($type){
        // restituisce tutti i progetti dove il type_id è uguale al $type che viene passato
        $projectType = Project::where('type_id',  $type)->with('type', 'technologies')->get();
        // controllo che i project type esistano
        // if($projectType->isEmpty()){
        //     return response()->json([
        //         'message' => 'data not fount, error 404',
        //     ]);
        // }

        // controllo che i project type esistano
        if($projectType->isEmpty()){
            $status= 404;
        } else{
            $status = 200;   

            //se lo status è 200 quindi ci sono progetti li ciclo con un for eache e faccio un controllo sull'immagine
            foreach($projectType as $project){
                if($project->image_path){
                    $project->image_path = asset('storage/' . $project->image_path);
                } else{
                    $project->image_path = '/img/placehold image.jpeg';
                    $project->img_original_name = 'no image';
                }
            }
        }



        return response()->json(compact('status', 'projectType'));
      }

    // creo una funzione che mi restituisce tutti i progetti in base al tipo
    public function projectTechnologies($technology){
        // restituisce tutti i progetti dove il type_id è uguale al $type che viene passato
        $technologies = Technology::find($technology);

        // controllo che $technologies esista
        if(!$technologies){
            $status = 404;
        }else{
            $status = 200;
            // recupero tutti i progetti legati che hanno la teconologia inserita
            $projects = $technologies->projects()->with('type', 'technologies')->get();

            foreach($projects as $project){
                if($project->image_path){
                    $project->image_path = asset('storage/' . $project->image_path);
                }else{
                    $project->image_path = '/img/placehold image.jpeg';
                    $project->img_original_name = 'no img';
                }
            }
        }

        return response()->json(compact('status', 'projects'));
      }

}
