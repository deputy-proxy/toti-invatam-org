<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::published()->with('category')
            ->when($request->category, fn ($q, $c) => $q->whereHas('category', fn ($q) => $q->where('slug', $c)))
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->when($request->county, fn ($q, $c) => $q->where('county', $c))
            ->latest('published_at')
            ->paginate(12)->withQueryString();

        $categories = ProjectCategory::where('active', true)->orderBy('name')->get();

        return view('pages.projects.index', compact('projects','categories'));
    }

    public function show(Project $project)
    {
        abort_unless($project->published_at, 404);
        $project->load(['category','partners','educators','beneficiaries','impactMetrics']);
        $related = Project::published()->where('id', '!=', $project->id)
            ->where('project_category_id', $project->project_category_id)
            ->take(3)->get();
        return view('pages.projects.show', compact('project','related'));
    }
}
