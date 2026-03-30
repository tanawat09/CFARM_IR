<?php

namespace App\Http\Controllers;

use App\Services\NewsService;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct(protected NewsService $newsService) {}

    public function index(Request $request)
    {
        $categories = NewsCategory::all();
        $categoryId = $request->query('category');
        $news = $categoryId
            ? $this->newsService->getByCategory($categoryId)
            : $this->newsService->getPublishedNews(12);

        return view('public.news.index', compact('news', 'categories', 'categoryId'));
    }

    public function show(string $slug)
    {
        $news = $this->newsService->getBySlug($slug);
        $related = $this->newsService->getLatestNews(3);

        return view('public.news.show', compact('news', 'related'));
    }
}
