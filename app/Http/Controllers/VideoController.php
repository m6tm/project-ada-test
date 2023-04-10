<?php

namespace App\Http\Controllers;

use App\Http\Requests\Video\CreateVideoPost;
use App\Http\Requests\Video\CreateVideoRequest;
use App\Http\Requests\Video\SearchVideoRequest;
use App\Models\Video;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class VideoController extends Controller
{

    public function create(CreateVideoRequest $request)
    {
        $post = new Video;
        $post->title = request('title');
        $post->description = request('description');
        $post->link = request('link');

        if ($post->save()) {
            return response()->json([
                'code' => 200,
                'response' => 'success'
            ]);
        }

        return response()->json([
            'code' => 400,
            'response' => 'Error occured on saving video'
        ], 400);
    }

    public function videos(int $currentPage = 1, int $videoPerPage = 10, SearchVideoRequest $request)
    {
        $search = request()->input('search') ?? '';

        $videos = Video::where('description', 'like', "%$search%")
            ->whereOr('title', 'like', "%$search%")
            ->paginate($videoPerPage, ['*'], 'posts', $currentPage);

        return response()->json([
            'code' => 200,
            'posts' => $videos
        ]);
    }
}
