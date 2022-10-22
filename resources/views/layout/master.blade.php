


@inject('navBuilder', 'App\Services\Navigation\NavBuilder')

<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">
</head>
<body>
<form action="{{ route('DemoController.switchLang')}}" method="post" id="formSwitch" style="display: none">
    @csrf
    <input type="hidden" name="language" value="any">
</form>

<div class="appHero">
    <div class="title">
        NavBuilder <small>Navigation Links made Easy</small>
    </div>
</div>

@section('navBar')
    {!! $navBuilder->render() !!}
@show


<div class="container appContent">
@yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

@yield('scripts')


<script>
    window.onload = ()=>{
        document.querySelectorAll('.js_event').forEach((choice)=>{
            choice.addEventListener('click',(e)=>{
                e.preventDefault();

                console.log( e.target.dataset.language);

                document.querySelector('input[name="language"]').value = e.target.dataset.language;
                document.querySelector('#formSwitch').submit() ;
            },false)
        })
    }
</script>
</body>
</html>
