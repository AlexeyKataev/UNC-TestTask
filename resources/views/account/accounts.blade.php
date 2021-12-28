@extends('../templates/layout')

@section('content')
    <main class="container">
        <h1 class="mt-5 mb-5 display-6">Пользователи</h1>
        <table class="table table-sm table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Id</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Группа</th>
                    <th>Email</th>
                    <th>Дата регистр.</th>
                    <th>Дата изменен.</th>
                    <th class="justify-content-center" style="min-width: 70px; max-width: 70px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th>{{ @$user->id }}</th>
                        <td>{{ @$user->second_name }}</td>
                        <td>{{ @$user->first_name }}</td>
                        <td>{{ @$user->middle_name }}</td>
                        <td>{{ @$user->user_role->name }}</td>
                        <td>{{ @$user->email }}</td>
                        <td>{{ @$user->created_at }}</td>
                        <td>{{ @$user->updated_at }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownAdminButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownAdminButton">
                                    <li><a class="dropdown-item" href="/Account/EditAccount/{{ @$user->id }}">Изменить</a></li>
                                    <li><a class="dropdown-item" href="/Account/Activity/{{ @$user->id }}">История активности</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection
