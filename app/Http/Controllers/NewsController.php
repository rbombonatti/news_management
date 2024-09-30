<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class NewsController extends Controller
{

    public function index(Request $request)
    {
        $news = News::with([
            'category' => function ($query) {
                $query->withTrashed()->select('id', 'title'); // Inclui as categorias soft-deleted
            },
            'tags:id,slug'
        ]);

        $search = $request->get('search');

        if ($search !== null) {
            $news->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('category', function ($query) use ($search) {
                $query->withTrashed()->where('title', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('tags', function ($query) use ($search) {
                $query->withTrashed()->where('slug', 'LIKE', "%{$search}%");
            });
        }

        $newsList = $news->paginate(4);

        return Inertia::render('News/Index', [
            'newsList' => $newsList,
            'request' => $request,
        ]);
    }


    public function create(): Response
    {
        $categories = Category::all();
        $tags = Tag::all();
        return Inertia::render('News/Create', ['categories' => $categories, 'tags' => $tags]);
    }

    public function store(NewsRequest $request): RedirectResponse
    {
        $news = News::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        $news->tags()->attach($request->input('tags'));
        return redirect('/news');
    }

    public function show(News $news): Response
    {
        $news = News::with(['category', 'tags'])->findOrFail($news->id)
            ->orWhereHas('category', function ($query) {
                $query->withTrashed();
            })
            ->orWhereHas('tags', function ($query) {
                $query->withTrashed();
            });

        return Inertia::render('News/Show', ['news' => $news]);
    }

    public function edit(News $news)
    {
        $news = News::with('category', 'tags')->findOrFail($news->id);
        $categories = Category::all();
        $tags = Tag::all();

        return Inertia::render('News/Edit',
            [
                'news' => $news,
                'categories' => $categories,
                'tags' => $tags,
                'newsTags' => $news->tags->pluck('id')->toArray(),
            ]);
    }

    public function update(NewsRequest $request, News $news): RedirectResponse
    {
        $news->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        $news->tags()->sync($request->input('tags'));
        return redirect('/news');
    }

    public function destroy(News $news): void
    {
        $news->delete();
    }
}
