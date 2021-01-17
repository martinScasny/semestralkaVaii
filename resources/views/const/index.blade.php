@extends('layouts.app')

@section('content')
    <div class="mt-5 row col-10 offset-1 justify-content-center">
    @foreach($consts as $const)
        <div class="col-3 p-0 kontajner" id="imageClick">
            <img src="{{ url('/storage/' . $const->image) }}" class="w-100 h-100 imageConst">
            <div class="imgOverlay">
                <div class="textInImg w-100 h-100">{{ $const->name }}</div>
            </div>
        </div>


    @endforeach
    </div>
    <div class="col-8 offset-2 appendDiv"></div>
@endsection
