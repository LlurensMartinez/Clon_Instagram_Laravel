<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request)
    {
        // Validacion
        $validate = $this->validate($request,[
            'image_id' => 'int | required',
            'content' => 'string | required'
        ]);

        //Recoger datos
        $user = Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        // Asignar valoras a mi nuevo Objeto
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        //Guardar en la DB
        $comment->save();

        //Redireccion
        return redirect()->route('image.detail', ['id' => $image_id])
                         ->with([
                            'message' => 'Has publicado tu cometario correctamente!'
                         ]);


    }

    public function delete($id)
    {
        //Conseguir datos del usuario logeuado
        $user = Auth::user();

        //Conseguir datos y el bojeto del comentario
        $comment = Comment::find($id);

        //Comprobar si soy el dueño del comentario o de la publicacion
        if($user && ($comment->user_id == $user->id) || $comment->image->user_id === $user->id){
            $comment->delete();
            return redirect()->route('image.detail', ['id' => $comment->image->id])
                            ->with([
                            'message' => 'Comentario eliminado correctamente'
                            ]);
        }else{
            return redirect()->route('image.detail', ['id' => $comment->image->id])
                            ->with([
                            'message' => 'EL COMENTARIO NO SE HA ELIMINADO!'
                            ]);
        }
    }
}
