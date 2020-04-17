<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #d6dee1">
    <div class="collapse navbar-collapse" id="navbarSupportedContent"  >
        <ul class="col-6 navbar-nav ">
            <li class="nav-item active">
                <a class="nav-link" href="/"><b><font color="black">Home</font></b> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active offset-2 ">
                <a class="nav-link" href=""><b><font color="black">Создать</font></b>  <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <form class="form-inline ml-5" action="">
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="search..."
                   aria-label="Search">
            <button class="btn btn-primary my-2 my-sm-0" type="submit"><b><font color="black">Search</font></b> </button>
        </form>
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
@guest
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}"><b><font color="black"> {{ ('LOGIN') }}</font></b></a>
    </li>
    @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}"><b><font color="black">{{ ('REGISTER') }}</font></b></a>
        </li>
    @endif
@else
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <b> <font color="white"> {{ Auth::user()->name }}</font></b>  <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('LOG OUT') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
    @endguest
    </ul>
    </div>
    </nav>

    <div class ="container table">
        <table>
            <thead>
                <th>clinic</th>
                <th>doctor</th>
                <th>type</th>
                <th>even days</th>
                <th>odd days</th>
                <th>interval</th>
                <th>ПН</th>
                <th>ВТ</th>
                <th>СР</th>
                <th>ЧТ</th>
                <th>ПТ</th>
                <th>СБ</th>
                <th>ВС</th>
                <th>интервал</th>
                <th>Выходные </th>
            </thead>
            <tbody>
            @foreach($times as $time)
                <th>{{$time->clinic_id}}</th>
                <th>{{$time->doctor_id}}</th>
                <th>{{$time->scheduleType}}</th>
                <th>{{$time->even_start}}-{{$time->even_end}}}</th>
                <th>{{$time->odd_start}}-{{$time->odd_end}}}</th>
                <th>{{$time->interval}}</th>
                <th>{{$time->monday_start}}-{{$time->monday_end}}}</th>
                <th>{{$time->tuesday_start}}-{{$time->tuesday_end}}}</th>
                <th>{{$time->wednesday_start}}-{{$time->wednesday_end}}}</th>
                <th>{{$time->thursday_start}}-{{$time->thursday_end}}}</th>
                <th>{{$time->friday_start}}-{{$time->friday_end}}}</th>
                <th>{{$time->saturday_start}}-{{$time->saturday_end}}}</th>
                <th>{{$time->sunday_start}}-{{$time->sunday_end}}}</th>
                <th>{{$time->interval}}</th>
                <th>{{$time->day_off_start}}-{{$time->day_off_end}}}</th>
                @endforeach
            </tbody>
        </table>
    </div>


</body>
</html>
