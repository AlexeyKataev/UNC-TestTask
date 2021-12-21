@extends('templates/layout')

@section('content')
<main class="container">
	<h1 class="mt-5 mb-5 display-6">Вход</h1>
	<form method="post" action="{{ route('accountLogin') }}" class="mb-3">
        {{ csrf_field() }}
        <div class="mb-3">
			<label for="inputEmail" class="form-label">Email</label>
			<input name="email" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" required>
			<div id="emailHelp" class="form-text">Обязательное поле</div>
		</div>
		<div class="mb-3">
			<label for="inputPassword" class="form-label">Пароль</label>
			<input name="password" type="password" class="form-control" id="inputPassword" aria-describedby="passwordHelp" required>
			<div id="passwordHelp" class="form-text">Обязательное поле</div>
		</div>
		<button type="submit" class="btn btn-primary">Войти</button>
	</form>
	<a href="/Account/Register" class="link-primary">У меня ещё нет учётной записи	</a>
</main>
@endsection
