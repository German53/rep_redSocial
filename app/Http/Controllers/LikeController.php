<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like($imagen_id){
        $user = Auth::user();
        
        $isset_like = Like::where('user_id', $user->id)->where('image_id', $imagen_id)->count();

        if ($isset_like == 0) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$imagen_id;
            
            $like->save();

            return response()->json([
                'like' => $like
            ]);
        }
    }
    public function dislike($imagen_id){
        $user = Auth::user();

        $like = Like::where('user_id', $user->id)->where('image_id', $imagen_id)->first();
        if ($like) {
            $like->delete();
            return response()->json([
                'like' => $like,
                'message' => 'dislike'
            ]);
        }
    }

    public function index(){
        $user = Auth::user();
        $likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(5);

        return view('like.index', [
            'likes' => $likes
        ]);
    }
}
