@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="row justify-content-center container-users">
        <div class="col-md-8">
            <div class="box-profile">
                <div class="profile-user mb-2">
                    @if($user->image)
                        <div class="container-avatar" style="float: left;">
                            <img src="{{ route('user.avatar', ['filename'=>$user->image]) }}" alt="" class="avatar">
                        </div>
                    @endif

                    <div class="user-info">
                        <div class="user-fullname">
                            <h3>{{'@'.$user->nick}}</h3>
                            <h3>{{$user->name.' '.$user->surname}}</h3>
                        </div>
                        @if(Auth::user()->id == $user->id)
                            <div>
                                <a href="{{ route('config') }}" type="button" class="btn btn-dark btn-sm" style="float: right; margin-right: 15px;">
                                    Editar Perfil
                                </a>
                            </div>
                        @endif
                        <p>{{'Se unio: '.\FormatTime::LongTimeFilter($user->created_at)}}</p>
                        
                    </div>
                    <div class="clearfix"></div>
                    
                </div>
                <hr>
                <div class="card pub_image">
                    @foreach($user->images as $image)
                        @include('includes.image', ['image' => $image])
                        <div>
                            @if(Auth::user() && Auth::user()->id == $image->user->id)
                                <div class="actions" style="float: right; margin-right: 10%">
                                    <a href="{{ route('image.edit', ['id'=>$image->id]) }}" class="btn btn-primary btn-sm mb-2" style="margin-right: 8px;">Editar</a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Eliminar
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estas seguro?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-danger">Eliminar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="caja-principal" style="margin-left: 10%; margin-right: 10%;">
                            <span>Comentarios ({{count($image->comments)}})</span>
                            @foreach($image->comments as $comment)
                                <div style="border: 1px solid rgb(183, 182, 182); border-radius: 8px; padding: 0 5px 5px 5px; margin-bottom: 4px;">
                                    <div class="comment mt-1">
                                        <a href="{{ route('profile', ['id' => $comment->user->id]) }}" class="nickname">{{'@'.$comment->user->nick}}</a>
                                        <span class="nickname date">{{' | '.\FormatTime::LongTimeFilter($comment->created_at)}}</span>
                                    </div>
                                    <p style="margin: 0 13px 0 13px;">{{$comment->content}}
                                        @if(Auth::check() && $comment->user->id == Auth::user()->id || $comment->image->user->id == Auth::user()->id)
                                            <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" style="float: right;">Eliminar</a>
                                        @endif
                                    </p>
                                </div>
                            @endforeach
                            <form action="{{ route('comment.save') }}" method="POST" class="mt-1">
                                @csrf

                                <input type="hidden" name="image_id" value="{{$image->id}}">
                                <p>
                                    <textarea name="content" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" placeholder="Escribe un comentario..."></textarea>
                                    @if($errors->has('content'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                    @endif
                                </p>
                                <button type="submit" class="btn btn-success mb-2">Enviar</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection