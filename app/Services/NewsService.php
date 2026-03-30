<?php

namespace App\Services;

use App\Models\News;

class NewsService
{
    public function getPublishedNews($perPage = 10)
    {
        return News::published()
            ->with(['category', 'tags', 'author'])
            ->orderBy('published_at', 'desc')
            ->paginate($perPage);
    }

    public function getBySlug(string $slug)
    {
        return News::published()
            ->with(['category', 'tags', 'author'])
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function getLatestNews($limit = 5)
    {
        return News::published()
            ->with('category')
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getByCategory($categoryId, $perPage = 10)
    {
        return News::published()
            ->where('category_id', $categoryId)
            ->with(['category', 'tags'])
            ->orderBy('published_at', 'desc')
            ->paginate($perPage);
    }

    public function store(array $data)
    {
        $news = News::create($data);
        if (isset($data['tags'])) {
            $news->tags()->sync($data['tags']);
        }
        return $news;
    }

    public function update(News $news, array $data)
    {
        $news->update($data);
        if (isset($data['tags'])) {
            $news->tags()->sync($data['tags']);
        }
        return $news;
    }

    public function delete(News $news)
    {
        $news->tags()->detach();
        return $news->delete();
    }
}
