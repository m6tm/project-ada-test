<?php

namespace App\Http\Controllers;

use App\Http\Requests\Like\ToggleLikesRequest;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{

    public function toggle_likes(ToggleLikesRequest $request)
    {
        $poste = "Post::class";
        $model = null;
        try {
            $model = ('App\\Models\\' . str_replace('::class', '', request('model')))::find(1)::find(request('id'));
        } catch (\Exception $err) {
            return response()->json([
                'code' => 421,
                'response' => ['Not date found']
            ], 421);
        }

        if (is_null(request('model'))) return response()->json([
            'code' => 421,
            'response' => ['Not model type found']
        ], 421);

        $like = Like::where('model_type', request('model'))
            ->where('model_id', request('id'))
            ->first();

        if (!$like) {
            $like = new Like;
            $like->user_id = auth()->user()->id;
            $like->model_type = request('model');
            $like->model_id = request('id');
            $like->save();
        } else {
            $like->delete();
        }

        return response()->json([
            'code' => 200,
            'response' => 'success'
        ]);
    }
}
