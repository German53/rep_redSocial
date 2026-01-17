@extends('layouts.app')
@section('content')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar imagen</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('image.update') }}" enctype="multipart/form-data" style="width: 90%; margin: 0 auto 0 auto;">
                        @csrf

                        <input type="hidden" name="image_id" value="{{ $image->id }}">

                        <div class="row mb-3">
                            <label for="imagen" class="col-md-4 col-form-label text-md-end">Imagen</label>
                            
                                @if($image->image)
                                    <div class="pub_image">
                                        <img src="{{ route('image.file', ['filename' => $image->image]) }}" style="max-width: 56%; height: auto; margin: 0 22% 0 22%;">
                                    </div>
                                @endif

                            <div class="col-md-6" style="width: 60%; margin: 0 20% 0 20%;">
                                <input id="imagen" type="file" class="form-control @error('name') is-invalid @enderror" name="imagen" value="{{ old('imagen') }}" required autocomplete="imagen" autofocus>

                                @error('imagen')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="descripcion" class="col-md-4 col-form-label text-md-end">Descripcion</label>

                            <div class="col-md-6">
                                <textarea id="descripcion" type="file" class="form-control @error('name') is-invalid @enderror" name="descripcion" value="{{ $image->description }}" required autocomplete="descripcion" autofocus></textarea>

                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Subir imagen
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection