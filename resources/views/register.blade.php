@extends('templates/layout')

@section('content')
<main class="container">
	<h1 class="mt-5 mb-5 display-6">Регистрация</h1>
	<form method="post" action="{{ route('accountRegister') }}" class="mb-3">
        {{ csrf_field() }}
        <div class="mb-3">
			<label for="inputSecondName" class="form-label">Фамилия</label>
			<input name="second_name" type="text" class="form-control" id="inputSecondName">
		</div>
		<div class="mb-3">
			<label for="inputFirstName" class="form-label">Имя</label>
			<input name="first_name" type="text" class="form-control" id="inputFirstName" aria-describedby="firstNameHelp" required>
			<div id="firstNameHelp" class="form-text">Обязательное поле</div>
		</div>
		<div class="mb-3">
			<label for="inputMiddleName" class="form-label">Отчество</label>
			<input name="middle_name" type="text" class="form-control" id="inputMiddleName">
		</div>
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
		<div class="mb-3">
			<label for="inputPasswordConfirmation" class="form-label">Повторите пароль</label required>
			<input name="password_confirmation" type="password" class="form-control" id="inputPasswordConfirmation" aria-describedby="passwordConfirmationHelp">
			<div id="passwordConfirmationHelp" class="form-text">Обязательное поле</div>
		</div>
		<div class="mb-3 form-check">
			<input name="consent_to_the_processing_of_personal_data" type="checkbox" class="form-check-input" id="inputPdBoolean">
			<label class="form-check-label" for="inputPdBoolean">Даю согласие на обработку персональных данных.</label>
		</div>
		<button type="submit" class="btn btn-primary">Отправить</button>
	</form>
	<a href="/Account/Login" class="link-primary">У меня уже есть учётная запись</a>
</main>
@endsection
