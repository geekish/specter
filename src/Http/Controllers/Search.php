<?php

namespace Specter\Http\Controllers;

use Illuminate\Http\Request;
use Specter\Models\Post;

class Search extends Controller
{
    /**
     * Redirect POST request to GET /search/{query}
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect(Request $request)
    {
        $query = $request->input('q');

        return redirect()
            ->route('search.results', $query);
    }

    /**
     * Retrieve and show search results
     *
     * @param  string $query Search Query
     * @return \Illuminate\Http\Response
     */

    public function results(string $query)
    {
        $posts = Post::search($query)
            ->where('status', 'published')
            ->where('visibility', 'public')
            ->get();

        return view('search', [
            'query' => $query,
            'posts' => paginate($posts, 5),
        ]);
    }
}
