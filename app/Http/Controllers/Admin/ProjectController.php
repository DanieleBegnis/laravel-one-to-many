<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'name' => 'required|max:250|min:10',
                'client_name' => 'required',
                'summary' => 'required|max:5000|min:10',
                'project_thumbnail' => 'nullable|image',
                'type_id' => 'nullable|exists:types,id'
            ],
            [
                'name.required' => 'Inserisci un titolo per il tuo progetto',
                'name.max' => 'Il titolo può essere al massimo di 250 caratteri',
                'name.min' => 'Il titolo può essere al minimo di 10 caratteri',
                'summary.required' => 'Inserisci una descrizione per il tuo fumetto',
                'summary.max' => 'la descrizione può essere al massimo di 5000 caratteri',
                'summary.min' => 'la descrizione può essere al minimo di 10 caratteri',
                'client_name.required' => 'Inserisci il nome del tuo cliente'
            ]
        );

        $formdata = $request->all();

        if($request->hasFile('project_thumbnail')) {
            $img_path= Storage::disk('public')->put('projects_thumbs', $formdata['project_thumbnail']);
        }

        $newProject = new Project();
        $newProject->type_id = $formdata['type_id'];
        $newProject->name = $formdata['name'];
        $newProject->client_name = $formdata['client_name'];
        $newProject->summary = $formdata['summary'];
        $newProject->slug = Str::slug($newProject->name, '-');
        $newProject->project_thumbnail = $img_path;
        $newProject->save();


        return redirect()->route('admin.projects.show', ['project' => $newProject->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $formdata = $request->all();

        if($request->hasFile('project_thumbnail')) {
            $img_path= Storage::disk('public')->put('projects_thumbs', $formdata['project_thumbnail']);
            $formdata['project_thumbnail'] = $img_path;
        }

        $project = Project::findOrFail($id);
        $project->type_id = $formdata['type_id'];
        $project->name = $formdata['name'];
        $project->client_name = $formdata['client_name'];
        $project->summary = $formdata['summary'];
        $project->slug = Str::slug($project->name, '-');
        $project->project_thumbnail = $img_path;
        $project->save();

        return redirect()->route('admin.projects.show', ['project' => $project->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
