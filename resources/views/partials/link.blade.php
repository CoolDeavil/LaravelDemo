



@php
$urlDecode = function($label){
  return urldecode($label)  ;
};
@endphp
<li class="nav-item {{$active}}">
    <a class="nav-link" href="{{$route}}">{{$urlDecode($label)}} <i class="fas {{$icon}}"></i></a>
</li>

