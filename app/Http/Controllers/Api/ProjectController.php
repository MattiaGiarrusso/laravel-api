<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index () {

        $projects = Project::with('type','technologies')->get();

        return response()->json([
            'success'=> true,
            'results'=> $projects,
        ]);
    }

    public function show ($slug) {

        $project = Project::where('slug', "=", $slug)->with('type','technologies')->first();

        if($project){
            $data = [
                'success'=> true,
                'project'=> $project
            ];
        } else {
            $data = [
                'success' => false,
                'error' => 'Progetto non trovato'
            ];
        };

        return response()->json($data);
    }
}
