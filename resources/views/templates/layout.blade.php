<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title></title>
</head>
<body>
	<header class="shadow">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">
					  <a class="navbar-brand" href="/">Some Service</a>
				</div>
				<ul class="navbar-nav ml-0">
					<li class="nav-item">
						<a class="nav-link active text-nowrap" aria-current="page" href="/Account/Register">Регистрация / авторизация</a>
					</li>
				</ul>
		  </nav>
	</header>
    @yield('content')
	<footer class="container pt-5 pb-5">
		2021
	</footer>
</body>
</html>
