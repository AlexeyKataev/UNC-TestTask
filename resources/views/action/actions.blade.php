@extends('../templates/layout')

@section('content')
    <main class="container">
        <h1 class="mt-5 mb-5 display-6">Акции</h1>
        <div class="row">
            <div class="col-sm-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Активные акции</h5>
                        <p class="card-text mb-0">Публично доступные: {{ $activePublicActionsCount }}</p>
                        <p class="card-text">Персональные: {{ $activePrivateActionsCount }}</p>
                        <a href="/Action/AddAction" class="btn btn-primary">
                            <i class="bi bi-plus-square-dotted mr-3"></i>
                            Добавить акцию
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">История акций</h5>
                        <p class="card-text mb-0">Завершённые акции: {{ $stoppedActionsCount }}</p>
                        <p class="card-text">Публичные / персональные: {{ $stoppedPublicActionsCount }} / {{ $stoppedPrivateActionsCount }}</p>
                        <a href="#" class="btn btn-outline-primary">
                            <i class="bi bi-card-list"></i>
                            Перейти к истории акций
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="mt-3 mb-3">Активные на сегодняшний день</h3>
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
                <th class="justify-content-center" style="min-width: 70px; max-width: 70px;"></th>
            </tr>
            </thead>
            <tbody>
                @if(count($actions) == 0)
                    <tr>
                        <td colspan="10" class="text-center">Нет активных акций</td>
                    </tr>
                @else
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
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownAdminButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownAdminButton">
                                        <li><a class="dropdown-item" href="/Action/EditAction/{{ @$action->id }}">Изменить</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </main>
@endsection
