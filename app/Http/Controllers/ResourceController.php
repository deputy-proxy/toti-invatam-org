<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        $resources = Resource::where('active', true)
            ->when($request->type, fn ($q, $t) => $q->where('resource_type', $t))
            ->when($request->audience, fn ($q, $a) => $q->where('audience', $a))
            ->latest('published_at')
            ->paginate(12)->withQueryString();
        return view('pages.resources.index', compact('resources'));
    }

    public function show(Resource $resource)
    {
        abort_unless($resource->active, 404);
        return view('pages.resources.show', compact('resource'));
    }
}
