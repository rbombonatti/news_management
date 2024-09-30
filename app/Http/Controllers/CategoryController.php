<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(Request $request): Response
    {
        $categories = Category::query();
        if ($request->get('search') !== null) {
            $categories->where('title', 'like', '%' . $request->get('search') . '%');
        }
        $categories = $categories->paginate(4);
        return Inertia::render('Category/Index',
            [
                'categories' => $categories,
                'request' => $request
            ]);
    }

    public function create(): Response
    {
        return Inertia::render('Category/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'string|required',
        ]);

        Category::create([
            'title' => $request->title
        ]);
        return redirect()->route('categories.index');
    }

    public function show(Category $category): Response
    {
        return Inertia::render('Category/Show',
            [
                'category' => $category
            ]);
    }

    public function edit(Category $category): Response
    {
        return Inertia::render('Category/Edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $request->validate([
            'title' => 'string|required',
        ]);

        $category->update([
            'title' => $request->title
        ]);

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category): void
    {
        $category->delete();
    }
}
