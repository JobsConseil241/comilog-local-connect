<?php

namespace App\Http\Controllers\Pme;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        return view('pme.news.index', [
            'news' => News::published()->latest('published_at')->paginate(10),
        ]);
    }

    public function show(News $news): View
    {
        abort_unless($news->published_at && $news->published_at->isPast(), 404);

        return view('pme.news.show', ['article' => $news]);
    }
}
