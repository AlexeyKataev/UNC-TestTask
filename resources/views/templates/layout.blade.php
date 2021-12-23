<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <title></title>
</head>
<body>
	<header class="shadow">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">
					  <a class="navbar-brand" href="/">Some Service</a>
				</div>
                @if (\Illuminate\Support\Facades\Auth::check() &&
                \Illuminate\Support\Facades\Auth::user()->user_role_id == 1)
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownAdminButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Администрирование
                    </button>
                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownAdminButton">
                        <li><a class="dropdown-item" href="/Account/Accounts">Управление пользователями</a></li>
                        <li><a class="dropdown-item" href="/Action/Actions">Управление акциями</a></li>
                        <li><a class="dropdown-item" href="/Mailing/Mailings">Управление email-рассылками</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Separated link</a></li>
                    </ul>
                </div>
                @endif
				<ul class="navbar-nav ml-0">
                    @if (\Illuminate\Support\Facades\Auth::check())
                        <li class="nav-item">
                            <a class="nav-link active text-nowrap" aria-current="page" href="/Account/Logout">Выйти</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link active text-nowrap" aria-current="page" href="/Account/Register">Регистрация / авторизация</a>
                        </li>
                    @endif

				</ul>
		  </nav>
	</header>
    @yield('content')
	<footer class="container pt-5 pb-5">
	</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
