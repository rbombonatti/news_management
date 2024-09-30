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
        $newsList = News::with([
            'category' => function ($query) {
                $query->withTrashed();
            },
            'tags' => function ($query) {
                $query->withTrashed();
            },
        ])->get();

        return Inertia::render('Home/Home', [
            'newsList' => $newsList,
        ]);
    }

    public function details(News $news): Response
    {
        $news = News::with([
            'category' => function ($query) {
                $query->withTrashed();
            },
            'tags' => function ($query) {
                $query->withTrashed();
            },
        ])->findOrFail($news->id);
        return Inertia::render('Home/Details',
            [
                'news' => $news,
            ]
        );
    }

    public function search($search)
    {
        $results = News::with(['category:id,title', 'tags:id,slug'])
            ->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('category', function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('tags', function ($query) use ($search) {
                $query->where('slug', 'LIKE', "%{$search}%");
            })
            ->get();
        return Inertia::render('Home/Search', [
            'results' => $results,
            'search' => $search
        ]);
    }

}
