<?php

namespace App\Http\Controllers\Admin;

use App\functions\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projectCount = Project::count('id');

        $projects = Project::orderBy('id', 'desc')->paginate(10);
        
        if($request->search){
            $projects = Project::where('name', 'LIKE', "%{$request->search}%")->orderBy('id')->paginate(10);
        }

        return view('admin.projects.index', compact('projects','projectCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
    

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {

        // prendo tutti i dati che ricevo dal form
        $data = $request->all();
       //creo un nuovo progetto
       $newProject = new Project();
       // controllo sull'immagine che deve essere caricata se esiste nelli dati inviati quindi se è in data allora fai tutte le altre azioni
        if(array_key_exists('image_path', $data)){
            // salvo la chiave nello storage
            $image_path = Storage::put('uploads', $data['image_path']);
            // recupero il nome originale dell'immagine
            $original_name = $request->file('image_path')->getClientOriginalName();
            // aggiungo i valori a data 
            $data['image_path'] = $image_path; 
            $data['img_original_name'] = $original_name; 
        }

       // genero lo slug con il titolo che è stato mandato nel form
       $data['slug'] = Helper::generateSlug($data['name'], Project::class);

       // fillo il nuovo progetto con tutti i dati ricevuti e laravel assegnerà automaticamente i valori provenienti dall'array $data agli attributi del modello che sono presenti in $fillable
       $newProject->fill($data);
       // salvo il nuovo progetto
       $newProject->save();

       // creo una condizione dove solo se esiste technologies in data allora fai l' attach altrimenti non fai nulla. In questo modo posso creare progetti anche senza inserire le tecnologie usate
       if(array_key_exists('technologies', $data)){
           $newProject->technologies()->attach($data['technologies']);
       } 
       
        // reindirizzo alla pagina index dove c'è l'elenco di tutti i progetti
        return redirect()->route('admin.projects.show', $newProject->id)->with('success', 'Il progetto è stato creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {

        $types = Type::all();
        $technologies = Technology::all();


        return view('admin.projects.edit', compact('types', 'technologies', 'project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProjectRequest $request, Project $project)
    {
        $data = $request->all();

        if($data['name'] === $project->name){
            $data['slug'] = $project->slug;
        } else{
            $data['slug'] = Helper::generateSlug($data['name'], Project::class);
        }

        // controllo sull'immagine che deve essere caricata se esiste nelli dati inviati quindi se è in data allora fai tutte le altre azioni
        if(array_key_exists('image_path', $data)){
            // salvo la chiave nello storage
            $image_path = Storage::put('uploads', $data['image_path']);
            // recupero il nome originale dell'immagine
            $original_name = $request->file('image_path')->getClientOriginalName();
            // aggiungo i valori a data 
            $data['image_path'] = $image_path; 
            $data['img_original_name'] = $original_name; 
        }

        $project->update($data);
        // aggiungo una condizione per dove se durante la modifica rimuovo tutte le tecnologie non viene visualizzato errore ma toglie tutte le tecnologie con il detach()
        if(array_key_exists('technologies', $data)){
            $project->technologies()->sync($data['technologies']);
        } else{
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project->id)->with('success', 'Il progetto è stato modificato con successo!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Il proggetto è stato eliminato con successo!');
    }
}
