<?php

namespace App\Http\Controllers;

use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Models\News;
use Inertia\Inertia;
use Inertia\Response;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $newsList = News::with('category', 'tags')->get();
        return Inertia::render('Home', [
            'newsList' => $newsList,
        ]);
    }

    public function details(News $news): Response
    {
        $news = News::with(['category', 'tags'])->findOrFail($news->id);
        return Inertia::render('News/Details',
            [
                'news' => $news,
            ]
        );
    }

    public function search($search)
    {
        $results = News::with(['category', 'tags'])
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('content', 'LIKE', "%{$search}%")
            ->whereHas('category', function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%");
            })->get();

        return Inertia::render('News/Search', [
            'results' => $results,
            'search' => $search
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        //
    }
}
