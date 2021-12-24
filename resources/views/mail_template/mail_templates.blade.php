@extends('../templates/layout')

@section('content')
    <main class="container">
        <h1 class="mt-5 mb-5 display-6">
            Шаблоны писем
        </h1>
        <div class="row">
            <div class="col-sm-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Шаблоны</h5>
                        <p class="card-text mb-0">Активные: {{ @$activeMailsCount }}</p>
                        <p class="card-text">Архивные: {{ @$stoppedMailsCount }}</p>
                        <a href="/MailTemplate/AddMailTemplate" class="btn btn-primary">
                            <i class="bi bi-plus-square-dotted mr-3"></i>
                            Добавить шаблон
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="mt-3 mb-3">Добавленные шаблоны</h3>
        <table class="table table-sm table-bordered">
            <thead class="table-light">
            <tr>
                <th>Id</th>
                <th>Текст</th>
                <th>Для акций</th>
                <th>Изменяемое</th>
                <th>Закреплённое</th>
                <th>Архивное</th>
                <th>Дата создан.</th>
                <th>Дата изменен.</th>
                <th class="justify-content-center" style="min-width: 70px; max-width: 70px;"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($mailTemplates as $mail)
                <tr>
                    <th>{{ @$mail->id }}</th>
                    <td>
                        @if($mail->is_archival)
                            <p class="text-black-50">
                                {{ @$mail->text }}
                            </p>
                        @else
                            {{ @$mail->text }}
                        @endif
                    </td>
                    <td>
                        @if($mail->is_action_mail)
                            <p class="text-success">Да</p>
                        @else
                            <p class="text-danger">Нет</p>
                        @endif
                    </td>
                    <td>
                        @if($mail->is_editable)
                            <p class="text-success">Да</p>
                        @else
                            <p class="text-danger">Нет</p>
                        @endif
                    </td>
                    <td>
                        @if($mail->is_pinned)
                            <p class="text-success">Да</p>
                        @else
                            <p class="text-danger">Нет</p>
                        @endif
                    </td>
                    <td>
                        @if($mail->	is_archival)
                            <p class="text-success">Да</p>
                        @else
                            <p class="text-danger">Нет</p>
                        @endif
                    </td>
                    <td>
                        {{ @$mail->created_at }}
                    </td>
                    <td>
                        {{ @$mail->updated_at }}
                    </td>
                    <td>
                        @if($mail->is_editable)
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownAdminButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownAdminButton">
                                    <li><a class="dropdown-item" href="/MailTemplate/EditMailTemplate/{{ @$mail->id }}">Изменить</a></li>
                                </ul>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </main>
@endsection
