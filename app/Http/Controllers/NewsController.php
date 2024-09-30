<?php

namespace App\Http\Controllers;

use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
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
        $search = $request->input('search');
        $news = News::withRelations()->search($search);
        $newsList = $news->paginate(4);

        return Inertia::render('News/Index', [
            'newsList' => $newsList,
            'request' => $request,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('News/Create', [
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    public function store(StoreNewsRequest $request): RedirectResponse
    {
        $news = News::create($request->validated());
        $news->tags()->attach($request->input('tags'));
        return redirect('/news');
    }

    public function show(News $news): Response
    {
        return Inertia::render('News/Show', [
            'news' => $news->load('category', 'tags')
        ]);
    }

    public function edit(News $news): Response
    {
        return Inertia::render('News/Edit', [
            'news' => $news->load('category', 'tags'),
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'newsTags' => $news->tags->pluck('id')->toArray(),
        ]);
    }

    public function update(UpdateNewsRequest $request, News $news): RedirectResponse
    {
        $news->update($request->validated());

        $news->tags()->sync($request->input('tags'));
        return redirect('/news');
    }

    public function destroy(News $news): RedirectResponse
    {
        $news->delete();
        return redirect('/news');
    }
}
