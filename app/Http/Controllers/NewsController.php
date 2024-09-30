<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NewsController extends Controller
{

    public function index(Request $request)
    {
        $news = News::with(['category:id,title,slug', 'tags:id,slug']);
        $search = $request->get('search');
        if ($search !== null) {
            $news->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('content', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('category', function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('slug', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('tags', function ($query) use ($search) {
                $query->where('slug', 'LIKE', "%{$search}%");
            });
        }

        $newsList = $news->paginate(4);
        return Inertia::render('News/Index', [
            'newsList' => $newsList,
            'request' => $request,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(News $news)
    {
        //
    }

    public function edit(News $news)
    {
        //
    }

    public function update(Request $request, News $news)
    {
        //
    }

    public function destroy(News $news)
    {
        //
    }
}
