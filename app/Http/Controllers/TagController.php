<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TagController extends Controller
{
    public function index(Request $request): Response
    {
        $search = $request->get('search');
        $tags = Tag::when($search, function ($query, $search) {
            $query->where('slug', 'like', '%' . $search . '%');
        })->paginate(4);

        return Inertia::render('Tag/Index',
            [
                'tags' => $tags,
                'request' => $request
            ]);
    }

    public function create(): Response
    {
        return Inertia::render('Tag/Create');
    }

    public function store(StoreTagRequest $request): RedirectResponse
    {
        Tag::create($request->validated());
        return redirect()->route('tags.index');
    }

    public function show(Tag $tag): Response
    {
        return Inertia::render('Tag/Show', ['tag' => $tag]);
    }

    public function edit(Tag $tag): Response
    {
        return Inertia::render('Tag/Edit', ['tag' => $tag]);
    }

    public function update(UpdateTagRequest $request, Tag $tag): RedirectResponse
    {
        $tag->update($request->validated());
        return redirect()->route('tags.index');
    }

    public function destroy(Tag $tag): void
    {
        $tag->delete();
    }
}
