@extends('../templates/layout')

@section('content')
    <main class="container">
        <h1 class="mt-5 mb-5 display-6">Email-рассылки</h1>

        <div class="row">
            <div class="col-sm-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Запланировано</h5>
                        <p class="card-text mb-0">На сегодня запланировано рассылок: 1</p>
                        <p class="card-text">Будет охвачено пользователей: 114</p>
                        <a href="/Mailing/AddMailing" class="btn btn-primary">
                            <i class="bi bi-plus-square-dotted mr-3"></i>
                            Добавить рассылку
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">История рассылок</h5>
                        <p class="card-text mb-0">За всё время проведено рассылок: 10</p>
                        <p class="card-text">Было охвачено пользователей: 1239</p>
                        <a href="#" class="btn btn-outline-primary">
                            <i class="bi bi-card-list"></i>
                            Перейти к истории рассылок
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="mt-3 mb-3">Запланированно на сегодня</h3>
        <table class="table table-sm table-bordered">
            <thead class="table-light">
            <tr>
                <th>Id</th>
                <th>Шаблон письма</th>
                <th>Запланировал</th>
                <th>Акция</th>
                <th>Охват</th>
                <th>Сформированы ли письма</th>
                <th>Дата создан.</th>
                <th>Дата изменен.</th>
                <th class="justify-content-center" style="min-width: 50px;"></th>
            </tr>
            </thead>
            <tbody>
                @if(count($mailings) == 0)
                    <tr>
                        <td colspan="9" class="text-center">Нет запланированных рассылок</td>

                    </tr>
                @else
                    <tr>
                        <th></th>
                        <td>Нет запланированных рассылок</td>
                        <td class="pagination justify-content-center">
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownAdminButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownAdminButton">
                                    <li><a class="dropdown-item" href="/Account/Accounts">Изменить</a></li>
                                    <li><a class="dropdown-item" href="/Account/Activity/{{ @$user->id }}">История активности</a></li>
                                    <li><a class="dropdown-item" href="/Action/Actions">Заблокировать</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-light bg-danger" href="#">Удалить</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </main>
@endsection
