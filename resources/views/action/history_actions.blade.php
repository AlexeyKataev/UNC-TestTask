@extends('../templates/layout')

@section('content')
    <main class="container">
        <h1 class="mt-5 mb-5 display-6">
            <a href="/Action/Actions" role="button" class="btn btn-light">
                <i class="bi bi-arrow-left"></i>
            </a>
            История акций
        </h1>
        <h3 class="mt-3 mb-3">Завершённые акции</h3>
        <table class="table table-sm table-bordered">
            <thead class="table-light">
            <tr>
                <th>Id</th>
                <th>Заголовок</th>
                <th>Описание</th>
                <th>Добавил</th>
                <th>Старт</th>
                <th>Стоп</th>
                <th>Персональная</th>
                <th>Дата создан.</th>
                <th>Дата изменен.</th>
            </tr>
            </thead>
            <tbody>
                @foreach($actions as $action)
                    <tr>
                        <th>{{ @$action->id }}</th>
                        <td>{{ @$action->title }}</td>
                        <td>{{ @$action->description }}</td>
                        <td>{{ @$action->user_creator->second_name }} {{ @$action->user_creator->first_name }}</td>
                        <td>{{ @$action->date_start }}</td>
                        <td>{{ @$action->date_end }}</td>
                        <td>
                            @if($action->is_private)
                                <p class="text-success">Да</p>
                            @else
                                <p class="text-danger">Нет</p>
                            @endif
                        </td>
                        <td>{{ @$action->created_at }}</td>
                        <td>{{ @$action->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection
