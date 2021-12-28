@extends('../templates/layout')

@section('content')
    <main class="container">
        <h1 class="mt-5 mb-5 display-6">
            <a href="/Account/Accounts" role="button" class="btn btn-light">
                <i class="bi bi-arrow-left"></i>
            </a>
            Активность пользователя: Id {{ @$user->id }}, Ф.И.О. {{ @$user->second_name }} {{ @$user->first_name }} {{ @$user->middle_name }}
        </h1>
        <table class="table table-sm table-bordered">
            <thead class="table-light">
            <tr>
                <th>Id</th>
                <th>Дата авторизации</th>
                <th>Устройство</th>
            </tr>
            </thead>
            <tbody>
            @foreach($loginSources as $loginSource)
                <tr>
                    <th>{{ @$loginSource->id }}</th>
                    <td>{{ @$loginSource->tms }}</td>
                    <td>{{ @$loginSource->source }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </main>
@endsection
