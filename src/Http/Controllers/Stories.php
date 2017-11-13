<?php

namespace Specter\Http\Controllers;

use Specter\Models;

class Stories extends Controller
{
    /**
     * Home channel
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $posts = Models\Post::published()
            ->with(['author', 'tags'])
            ->orderBy('published_at', 'desc')
            ->get()
            ;

        return view('home', ['posts' => paginate($posts)]);
    }

    /**
     * Single story (post or page)
     *
     * @return \Illuminate\Http\Response
     */
    public function single(Models\Story $story)
    {
        return view('single', ['story' => $story]);
    }

    /**
     * Tag channel
     *
     * @return \Illuminate\Http\Response
     */
    public function tag(Models\Tag $tag)
    {
        return view('tag', ['tag' => $tag]);
    }

    /**
     * RSS feed
     *
     * @return \Illuminate\Http\Response
     */
    public function rss()
    {
        $posts = Models\Post::published()
            ->with(['author', 'tags'])
            ->orderBy('published_at', 'desc')
            ->limit(config('specter.per_page'))
            ->get()
            ;

        return response()
            ->view('rss', ['posts' => $posts])
            ->header('Content-Type', 'text/xml');
    }
}
