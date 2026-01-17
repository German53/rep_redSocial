@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.message')
            @foreach($images as $image)
                <div class="card pub_image">
                    @include('includes.image', ['image'=>$image])
                    <div style="float: left;">
                        <div class="comments">
                            <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="btn btn-sm btn-warning btn-comments">Comentarios ({{count($image->comments)}})</a>
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $images->render() }}
        </div>
    </div>
</div>
@endsection
