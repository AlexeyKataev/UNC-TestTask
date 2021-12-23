@extends('../templates/layout')

@section('content')
    <main class="container">
        <h1 class="mt-5 mb-5 display-6">Акции</h1>
        <div class="row">
            <div class="col-sm-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Активные акции</h5>
                        <p class="card-text mb-0">Публично доступные: $count</p>
                        <p class="card-text">Персональные: $count</p>
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
                        <p class="card-text mb-0">За всё время проведено акций: 10</p>
                        <p class="card-text">Публичные / персональные: 7 / 3</p>
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
                <th class="justify-content-center" style="min-width: 50px;"></th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </main>
@endsection
