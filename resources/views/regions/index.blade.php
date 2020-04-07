<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Medical Booking</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/regions_style.css')}}">
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="col-6 navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/"><b>На главную</b> <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <ul class=" navbar-nav ml-auto">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Поиск клиники"
                       aria-label="Search">
                <div>
                    <button type="submit" class="btn btn-primary">Поиск</button>
                </div>
            </form>
        </ul>

        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"><b><font color="black"> {{ __('Войти') }}</font></b></a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}"><b><font color="black">{{ __('Регистрация') }}</font></b></a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <b>{{ Auth::user()->name }}</b>  <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Выйти') }}
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


<form action="{{ route('regions.store') }}"method="post" enctype="multipart/form-data">
    @csrf

   {{-- <div class="col-2">
        <label>Регион_uz</label>
        <input name="name_uz"  rows="2" type="text"class="form-control" >
    </div>

    <div class="col-2">
        <label>Регион_RU</label>
        <input name="name_ru"  rows="2" type="text"class="form-control"  >
    </div>

        <input type="submit" value="Дальше" class="btn btn-primary">
        <br><br>
    --}}

    <div class="col-md-12" >
        <div class="card card" >
            <div class="card-header">
                <h3 class="card-title"><p align="center">Поиск</p></h3>
            </div>

            <form role="form">
                <div class="card card-group" >
                <div class="col-sm-2">
                    <!-- select -->
                    <div class="form-group">
                        <label>Регионы</label>
                        <select class="form-control">
                            <option>Ташкентская область</option>
                            <option>Самаркандская область</option>
                            <option>Андижанская область</option>
                            <option>Бухарская область</option>
                            <option>Хивинская область</option>
                        </select>

                    </div>
                </div>
                <div class="col-sm-2">
                    <!-- select -->
                    <div class="form-group">
                        <label>Города</label>
                        <select class="form-control">
                            <option>Ташкент</option>
                            <option>Самарканд</option>
                            <option>Андижан</option>
                            <option>Бухара</option>
                            <option>Хива</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <!-- select -->
                    <div class="form-group">
                        <label>Районы</label>
                        <select class="form-control">
                            <option>Чиланзарский</option>
                            <option>Мирабадский</option>
                            <option>Учтепинский</option>
                            <option>Алмазарский</option>
                            <option>Яшнабадский</option>
                        </select>
                    </div>
                </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Поиск</button>
                </div>
            </form>

        </div>
    </div>

</form>

</body>
</html>
