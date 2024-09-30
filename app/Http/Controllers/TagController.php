<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TagController extends Controller
{
    public function index(Request $request): Response
    {
        $tags = Tag::query();
        if ($request->get('search') !== null) {
            $tags->where('slug', 'like', '%' . $request->get('search') . '%');
        }
        $tags = $tags->paginate(4);
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

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'slug' => 'string|required',
        ]);

        Tag::create([
            'slug' => $request->slug
        ]);
        return redirect()->route('tags.index');
    }

    public function show(Tag $tag): Response
    {
        return Inertia::render('Tag/Show',
            [
                'tag' => $tag
            ]);
    }

    public function edit(Tag $tag): Response
    {
        return Inertia::render('Tag/Edit', [
            'tag' => $tag
        ]);
    }

    public function update(Request $request, Tag $tag): RedirectResponse
    {
        $request->validate([
            'slug' => 'string|required',
        ]);

        $tag->update([
            'slug' => $request->slug
        ]);

        return redirect()->route('tags.index');
    }

    public function destroy(Tag $tag): void
    {
        $tag->delete();
    }
}
