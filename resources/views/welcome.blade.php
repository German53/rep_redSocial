<!DOCTYPE html>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card pub_image">
                <div style="float: left;">
                    <div class="comments mt-3">
                        <h4>Inicia sesión para ver el contenido de la pagina, <a href="{{ route('login') }}">aqui!</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection