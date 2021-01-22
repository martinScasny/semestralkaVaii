@extends('layouts.app')
@section('content')

    <div class="header">
        <div class="stromy" id="bg">
            <div class="container col-7" id="napis"><p class="align-content-center">Constellary.</p></div>
        </div>
    </div>
    <div class="apiContainer">
        <div class="container pb-5 col-12 blackbar" id="blackbar">
            <div class="pt-5 pb-5 row col-6 offset-3 apiNightSky">
                <iframe
                        src="https://virtualsky.lco.global/embed/index.html?longitude=-119.86286000000001&latitude=34.4326&projection=stereo&constellations=true&showstarlabels=true&ecliptic=true&magnitude=4&live=true&az=357"
                        ></iframe>
            </div>
        </div>
    </div>

    <div class="container col-12 firstPost p-5">
        <h1 class="text-center col-8 offset-2 pb-5" style="font-size: 2vw; font-family: 'Roboto', sans-serif;">Nam laoreet neque sed arcu lacinia auctor. Integer condimentum justo eget turpis vehicula gravida. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut tempus ex gravida consectetur convallis. Quisque vestibulum ipsum ligula, vitae consequat orci auctor sit amet. Phasellus posuere dui neque, sed ornare arcu dictum eleifend. Phasellus arcu diam, hendrerit a faucibus vel, condimentum ut lectus.</h1>
    </div>
    <div class="pt-5 pb-5 text-center" style="background-color: white"><a href="#top"><i class="fas fa-arrow-circle-up" id="backToTop"></i></a></div>

@endsection
