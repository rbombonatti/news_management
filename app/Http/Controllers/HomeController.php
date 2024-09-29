<?php

namespace App\Http\Controllers;

use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Models\News;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
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

}
