<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleFormRequest;
use App\Models\WebsiteArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

// TODO: Refactor permission checks into policies
class WebsiteArticlesController extends Controller
{
    public function index()
    {
        return view('articles.index', [
            'articles' => WebsiteArticle::query()
                ->orderByDesc('id')
                ->with('user:id,username')
                ->paginate(10),
        ]);
    }

    public function create()
    {
        if (! hasPermission(Auth::user(), 'write_article')) {
            return redirect()->back()->withErrors(__('You do not have permission to do this.'));
        }

        return view('articles.create', [
            'images' => File::allFiles(public_path(setting('article_images_path'))),
        ]);
    }

    public function store(ArticleFormRequest $request)
    {
        if (! hasPermission(Auth::user(), 'write_article')) {
            return redirect()->back()->withErrors(__('You do not have permission to do this.'));
        }

        $request->validated();

        $request->user()->articles()->create([
            'slug' => sprintf('%s-%s', Str::slug($request->input('title')), time()),
            'title' => $request->input('title'),
            'short_story' => $request->input('short_story'),
            'full_story' => $request->input('full_story'),
            'image' => sprintf('%s/%s', setting('article_images_path'), $request->input('image')),
        ]);

        return redirect()->route('articles.index')->with('success', 'The article has been posted!');
    }

    public function edit(WebsiteArticle $article)
    {
        if (! hasPermission(Auth::user(), 'edit_article')) {
            return redirect()->back()->withErrors(__('You do not have permission to do this.'));
        }

        return view('articles.edit', [
            'article' => $article,
            'images' => File::allFiles(public_path(setting('article_images_path'))),
        ]);
    }

    public function update(ArticleFormRequest $request, WebsiteArticle $article)
    {
        if (! hasPermission(Auth::user(), 'edit_article')) {
            return redirect()->back()->withErrors(__('You do not have permission to do this.'));
        }

        $request->validated();

       $article->update([
            'title' => $request->input('title'),
            'short_story' => $request->input('short_story'),
            'full_story' => $request->input('full_story'),
            'image' => sprintf('%s/%s', setting('article_images_path'), $request->input('image')),
        ]);

        return redirect()->route('articles.index')->with('success', 'The article has been updated!');
    }

    public function destroy(WebsiteArticle $article)
    {
        if (! hasPermission(Auth::user(), 'delete_article')) {
            return redirect()->back()->withErrors(__('You do not have permission to do this.'));
        }

        $article->delete();

        return redirect()->back()->with('success', __('The article has been deleted!'));
    }
}