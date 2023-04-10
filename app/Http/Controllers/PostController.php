<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreatePostRequest;
use App\Models\Like;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function create(CreatePostRequest $request)
    {
        $slug = Str::slug(request('title')) . '-' . substr(strtoupper(sha1((string) time())), 0, 18);
        $image_name = substr(strtoupper(sha1((string) time())), 0, 18) . '_' . request()->file('image')->getClientOriginalName();
        request()->file('image')->move('post_files', $image_name);

        $post = new Post;
        $post->title = request('title');
        $post->slug = $slug;
        $post->image = $image_name;
        
        if ($post->save()) {
            return response()->json([
                'code' => 200,
                'response' => 'success'
            ]);
        }

        return response()->json([
            'code' => 400,
            'response' => 'Error occured on saving post'
        ], 400);
    }

    public function posts(int $currentPage = 1, int $postPerPage = 10)
    {
        $posts = Video::paginate($postPerPage, ['*'], 'posts', $currentPage);

        return response()->json([
            'code' => 200,
            'posts' => $posts
        ]);
    }
}
