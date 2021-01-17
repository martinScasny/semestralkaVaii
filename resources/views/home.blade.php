@extends('layouts.app')
@section('content')
    @php
   // $post = DB::table('posts')->orderBy('created_at', 'DESC')->get();
    //$firstPost = $post->first();
    @endphp
    <div class="stromy">
        <div class="container col-7" id="napis"><p class="align-content-center">Constellary.</p></div>
    </div>
    <div class="container pb-5 col-12 blackbar">
        <div class="pt-5 pb-5 row col-6 offset-3 apiNightSky">
            <iframe width="1000" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://virtualsky.lco.global/embed/index.html?longitude=-119.86286000000001&latitude=34.4326&projection=stereo&constellations=true&showstarlabels=true&ecliptic=true&magnitude=4&live=true&az=357" allowTransparency="true"></iframe>
        </div>
    </div>
    <div class="container col-12 firstPost">
        <button class="btn darkColor col-2 offset-5" id="btnRandomImage">GENERUJ</button>

        <div id="randomImage"></div>
    </div>

@endsection
