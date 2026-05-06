<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\JsonResponse;

class NewsController extends Controller
{
    /**
     * Get the 10 latest news items by published_at.
     */
    public function latest(): JsonResponse
    {
        $news = News::orderBy('published_at', 'desc')
            ->take(10)
            ->get(['uuid', 'title', 'published_at', 'created_at']);

        return response()->json($news);
    }
}
