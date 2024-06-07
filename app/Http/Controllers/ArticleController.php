<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleFormRequest;
use App\Models\WebsiteArticle;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(WebsiteArticle::class, 'article');
    }

    public function index()
    {
        return view('articles.index', [
            'articles' => WebsiteArticle::query()
                ->orderByDesc('id')
                ->with('user:id,username')
                ->paginate(15),
        ]);
    }

    public function create()
    {
        return view('articles.create', [
            'images' => File::allFiles(public_path(setting('article_images_path'))),
        ]);
    }

    public function store(ArticleFormRequest $request)
    {
        $previousArticle = WebsiteArticle::query()->select('id')->orderByDesc('id')->first();
        $slug = Str::slug($request->input('title'));
        $slug = $previousArticle ? sprintf('%s-%s', $previousArticle->id + 1, $slug) : sprintf('%s-%s', 1, $slug);

        $request->user()->articles()->create([
            'slug' => $slug,
            'title' => $request->input('title'),
            'short_story' => $request->input('short_story'),
            'full_story' => Purifier::clean($request->input('full_story')),
            'image' => sprintf('%s/%s', setting('article_images_path'), $request->input('image')),
        ]);

        return to_route('articles.index')->with('success', 'The article has been posted!');
    }

    public function edit(WebsiteArticle $article)
    {
        return view('articles.edit', [
            'article' => $article,
            'images' => File::allFiles(public_path(setting('article_images_path'))),
        ]);
    }

    public function update(ArticleFormRequest $request, WebsiteArticle $article)
    {
       $article->update([
            'title' => $request->input('title'),
            'short_story' => $request->input('short_story'),
            'full_story' => Purifier::clean($request->input('full_story')),
            'image' => sprintf('%s/%s', setting('article_images_path'), $request->input('image')),
        ]);

        return to_route('articles.index')->with('success', 'The article has been updated!');
    }

    public function destroy(WebsiteArticle $article)
    {
        $article->delete();

        return redirect()->back()->with('success', __('The article has been deleted!'));
    }
}
