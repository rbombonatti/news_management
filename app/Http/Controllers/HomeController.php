<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $newsList = News::withRelations()->get();

        return Inertia::render('Home/Home', [
            'newsList' => $newsList,
        ]);
    }

    public function details(News $news): Response
    {
        return Inertia::render('Home/Details', [
            'news' => $news->load('category:id,title', 'tags:id,slug'),
        ]);
    }

    public function search(Request $request): Response
    {
        $search = $request->input('search');
        $results = News::withRelations()->search($search)->get();

        return Inertia::render('Home/Search', [
            'results' => $results,
            'search' => $search
        ]);
    }

}
