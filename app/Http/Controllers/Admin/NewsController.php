<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsTag;
use App\Services\NewsService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function __construct(protected NewsService $newsService) {}

    public function index()
    {
        $news = News::with(['category', 'tags'])->latest()->paginate(15);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = NewsCategory::all();
        $tags = NewsTag::all();
        return view('admin.news.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_th' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'content_th' => 'nullable|string',
            'content_en' => 'nullable|string',
            'category_id' => 'required|exists:news_categories,id',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $validated['slug'] = Str::slug($validated['title_en'] ?: $validated['title_th']);
        $validated['user_id'] = auth()->id();
        $validated['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('news_images', 'public');
        }

        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $this->newsService->store($validated);

        return redirect()->route('admin.news.index')->with('success', 'News created successfully.');
    }

    public function edit(News $news)
    {
        $categories = NewsCategory::all();
        $tags = NewsTag::all();
        return view('admin.news.edit', compact('news', 'categories', 'tags'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title_th' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'content_th' => 'nullable|string',
            'content_en' => 'nullable|string',
            'category_id' => 'required|exists:news_categories,id',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        
        if ($request->hasFile('image')) {
            if ($news->image_path) {
                Storage::disk('public')->delete($news->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('news_images', 'public');
        }

        $this->newsService->update($news, $validated);

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully.');
    }

    public function destroy(News $news)
    {
        if ($news->image_path) {
            Storage::disk('public')->delete($news->image_path);
        }
        $this->newsService->delete($news);
        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully.');
    }
}
