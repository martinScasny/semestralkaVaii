@extends('layouts.app')

@section('content')
    <div class="pt-5 minVH">
        <div class="row col-10 offset-1 justify-content-center">
            @foreach($consts as $const)
                <div class="col-3 p-0 kontajner imageClick">
                    <img src="{{ url('/storage/' . $const->image) }}" class="w-100 h-100 imageConst" alt="image">
                    <div class="imgOverlay">
                        <div class="textInImg w-100 h-100">{{ $const->name }}</div>
                    </div>
                </div>


            @endforeach
        </div>
        <h3 class="starsText text-center p-3 m-2"></h3>
        <div class="col-6 offset-3 appendDiv"></div>
    </div>
@endsection
