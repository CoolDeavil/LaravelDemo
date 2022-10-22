

@php
    $urlDecode = function($label){
      return urldecode($label)  ;
    };
    $isArray = function($link){
      return is_array($link)  ;
    };
@endphp
<li class="nav-item dropdown {{$active}}">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{$urlDecode($label)}}
    </a>
    <div class="dropdown-menu " aria-labelledby="navbarDropdown">
        @foreach ($dropLinks as $link)

            @if($isArray($link))
            <a class="dropdown-item {{$link['active']}}" href="{{$link['route']}}"><i class="fas {{$link['icon']}}"></i> {{$urlDecode($link['label'])}}</a>
            @else
                <div class="dropdown-divider"></div>
            @endif

        @endforeach
    </div>
</li>