<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function config(){
        return view('user.config');
    }
    public function update(Request $request){
        $user = Auth::user();
        $id = $user->id;

        $validate = $this->Validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|max:255|unique:users,email,'.$id,
        ]);

        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        $image = $request->file('imagen_crop');
        if ($image) {
            Storage::disk('users')->delete($user->image);
            $image_name = 'IMG-'.time().'.'.$image->getClientOriginalExtension();

            Storage::disk('users')->put($image_name, File::get($image));
            $user->image = $image_name;
        }

        $user->update();

        return redirect()->route('config')->with(['message'=>'Usuario actualizado correctamente']);
    }
    public function getImage($filename){
        //$file = Auth::user()->image;
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
    public function index($search = null){
        if (!empty($search)) {
            $users = User::where('nick', 'LIKE', '%'.$search.'%')->orWhere('name', 'LIKE', '%'.$search.'%')->orWhere('surname', 'LIKE', '%'.$search.'%')->orderBy('id', 'desc')->paginate(8);
        }else {
            $users = User::orderBy('id', 'desc')->paginate(8);
        }

        if(empty($users)){
            return redirect()->route('user.index')->with(['message'=>'No hay usuarios para mostrar']);
        }else{
            return view('user.index', [
                'users' => $users
            ]);
        }
    }
    public function profile($id){
        $user = User::find($id);

        return view('user.profile', [
            'user' => $user
        ]);
    }
}
