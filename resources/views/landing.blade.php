@extends('layout.master')

@section('title', 'NavBuilder')

@section('sidebar')
    @parent
@endsection

@section('content')

    @php
    $cards = [
        'images/code-snapshot-admin.png',
        'images/code-snapshot-config.png',
        'images/code-snapshot-drop-down.png',
        'images/code-snapshot-blade.png',
        'images/code-snapshot-links-param.png',
        'images/code-snapshot-includes.png',
        'images/code-snapshot-links.png'
    ];
    $getRandomCard = function() use($cards){
        return $cards[rand(0,5)];
    };
        @endphp
    <div style="height: 30px"></div>

    <div class="row">
        <div class="col-12">
            <i class="fas fa-road"></i>URI: <strong>{{request()->path()}}</strong>
        </div>
    </div>
    <div style="height: 50px"></div>
{{--    <div class="row">--}}
{{--        <div class="col-12">--}}
{{--            <div class="card">--}}
{{--                <img class="card-img-top" src="{{asset($getRandomCard())}}" alt="Card image cap">--}}
{{--                <div class="card-body">--}}
{{--                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


    <div style="height: 50px"></div>
{{--<h3>Web Root</h3>--}}


{{--<img src="./adminRoutes.png" alt="" style="width: 600px">--}}
@endsection

@section('scripts')
@endsection
