<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\Comment;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(){
        return view('image.create');
    }
    public function save(Request $request){
        $validate = $this->validate($request, [
            'descripcion' => 'required',
            'imagen' => 'required|image'
        ]);

        $image_path = $request->file('imagen');
        $description = $request->input('descripcion');

        $user = Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;

        if ($image_path) {
            $image_name = 'IMG-'.time().'.'.$image_path->getClientOriginalExtension();

            Storage::disk('images')->put($image_name, File::get($image_path));
            $image->image = $image_name;
        }
        $image->save();
        return redirect()->route('home')->with(['message' => 'La foto se ha subido correctamente']);
    }
    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id){
        $image = Image::find($id);

        return view('image.detail', [
            'image' => $image
        ]);
    }

    public function edit($id){
        $user = Auth::user();
        $image = Image::find($id);

        if ($user && $image && $image->user->id == $user->id) {
            return view('image.edit', [
                'image' => $image
            ]);
        }
    }

    public function update(Request $request){
        $validate = $this->validate($request, [
            'descripcion' => 'required',
            'imagen' => 'image'
        ]);

        $image_id = $request->input('image_id');
        $image_path = $request->file('imagen');
        $description = $request->input('descripcion');

        $image = Image::find($image_id);
        $image->description = $description;

        if ($image_path) {
            $image_name = 'IMG-'.time().'.'.$image_path->getClientOriginalExtension();

            Storage::disk('images')->put($image_name, File::get($image_path));
            $image->image = $image_name;
        }
        $image->update();
        return redirect()->route('image.detail', ['id' => $image_id])->with(['message' => 'Imagen editada correctamente']);
    }
    public function delete($id){
        $user = Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        if ($user && $image && $image->user->id == $user->id) {
            if ($comments && count($comments) >= 1) {
                foreach($comments as $comment){
                    $comment->delete();
                }
            }
            if ($likes && count($likes) >= 1) {
                foreach($likes as $like){
                    $like->delete();
                }
            }
            Storage::disk('images')->delete($image->image);
            $image->delete();

            $message = array('message' => 'Imagen eliminada correctamente');
        }else{
            $message = array('message' => 'Error al eliminar la imagen');
        }
        return redirect()->route('home')->with($message);
    }
}
