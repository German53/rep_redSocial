@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Imagenes favoritas</h2>
            <hr>
            @foreach($likes as $like)
                <div class="card pub_image">
                    @include('includes.image', ['image'=>$like->image])
                </div>
            @endforeach

            <div class="clearfix"></div>
            {{ $likes->render() }}
        </div>
    </div>
</div>
@endsection