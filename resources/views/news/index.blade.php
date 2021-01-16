@extends('layouts.app')

@section('content')
    <div class="container mt-5 minVH">
        <div class="pt-4">
            <div class="row justify-content-center ">
                <div class="col-4 text-center">
                    <h1 class="login">Novinky</h1>
                </div>
            </div>
                @auth
                @if(\Illuminate\Support\Facades\Auth::user()->name == 'admin')
                    <div class="container col-2 offset-10">
                        <a href="{{ route('news.create') }}" class="btn bg-dark login">Nový príspevok</a>
                    </div>
                @endif
                @endauth


            @foreach($posts as $post)
                <div class="col-md-12 pt-5 pb-1">
                    <img src="{{ url('/storage/' . $post->image) }}" class="roundedCustom col-md-12">
                </div>
                <div class="col-md-12 pb-1">
                    <h1 class="login text-left">{{ $post->title }}</h1>
                </div>
                <div class="col-md-12 pb-3">
                    <h5 class="text-date text-left">{{ date("F j, Y, g:i a",strtotime($post->updated_at)) }}</h5>
                </div>
                <div class="col-md-12 pb-1">
                    <p class="login">{{ $post->text }}</p>
                </div>
                @auth
                    @if(\Illuminate\Support\Facades\Auth::user()->name == 'admin')
                        <div class="row pb-5 justify-content-center">
                            <div class="col-sm-1">
                                <a href="{{ route('news.edit',$post->id) }}"><i class="fas fa-edit login iconFa"></i></a>
                            </div>
                            <div class="col-sm-1">
                                <a href="{{ route('news.delete',$post->id) }}"><i class="far fa-minus-square login iconFa"></i></a>
                            </div>
                        </div>
                    @endif
                @endauth
                        <div class="row divider col-md-8  offset-md-2"></div>

            @endforeach

        </div>
    </div>

@endsection
