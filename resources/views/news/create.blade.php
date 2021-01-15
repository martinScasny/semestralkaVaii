@extends('layouts.app')

@section('content')
    <div class="container mt-5 addPost">
        <form action="{{ route('news.createPost') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1 class="login">Pridať nový príspevok</h1>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label login">Titulok príspevku</label>

                        <input id="title" type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               name="title" value="{{ old('title') }}" autocomplete="title" autofocus>

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-md-4 col-form-label login">Text</label>

                        <input id="text" type="text"
                               class="form-control @error('text') is-invalid @enderror"
                               name="text" value="{{ old('text') }}" autocomplete="text" autofocus>

                        @error('text')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="row">
                        <label for="image" class="col-md-4 col-form-label login">Obrázok</label>

                        <input type="file" class="form-control-file" id="image" name="image">

                        @error('image')
                                <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="row pt-4">
                        <button type="submit" class="btn bg-dark login">Pridať príspevok</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
