@extends('../templates/layout')

@section('content')
    <main class="container">
        <h1 class="mt-5 mb-5 display-6">
            <a href="/Mailing/Mailings" role="button" class="btn btn-light">
                <i class="bi bi-arrow-left"></i>
            </a>
            Завершённые email-рассылки
        </h1>
        <h3 class="mt-3 mb-3">Все прошедшие рассылки</h3>
        <table class="table table-sm table-bordered">
            <thead class="table-light">
            <tr>
                <th>Id</th>
                <th>Шаблон письма</th>
                <th>Запланировал</th>
                <th>Акция</th>
                <th>Охват</th>
                <th>Сформированы ли письма</th>
                <th>Старт рассылки</th>
                <th>Завершение рассылки</th>
                <th>Дата создан.</th>
                <th>Дата изменен.</th>
                <th style="min-width: 70px; max-width: 70px;"></th>
            </tr>
            </thead>
            <tbody>
            @if(count($mailings) == 0)
                <tr>
                    <td colspan="11" class="text-center">Нет запланированных рассылок</td>
                </tr>
            @else
                @foreach($mailings as $mail)
                    <tr>
                        <th>{{ @$mail->id }}</th>
                        <td>{{ @$mail->mail_template->text }}</td>
                        <td>{{ @$mail->user_creator->second_name }} {{ @$mail->user_creator->first_name }} </td>
                        <td>
                            @if($mail->action_id == null)
                                Без акции
                            @else
                                {{ @$mail->action->title }}
                            @endif
                        </td>
                        <td>
                            @if($mail->user_category_id == 1)
                                [Кат. A] {{ @$mail->user_reach }} пользователей
                            @elseif($mail->user_category_id == 2)
                                [Кат. B] {{ @$mail->user_reach }} пользователей
                            @elseif($mail->user_category_id == 3)
                                [Кат. C] {{ @$mail->user_reach }} пользователей
                            @endif
                        </td>
                        <td>
                            @if($mail->queue_email_formed)
                                <p class="text-success">Очередь на рассылку сформирована</p>
                            @else
                                <p class="text-danger">Очередь на рассылку не сформирована</p>
                            @endif
                        </td>
                        <td>{{ @$mail->date_planned_start_send }}</td>
                        <td>{{ @$mail->date_planned_end_send }}</td>
                        <td>{{ @$mail->created_at }}</td>
                        <td>{{ @$mail->updated_at }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownAdminButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownAdminButton">
                                    <li><a class="dropdown-item text-light bg-danger" href="/Account/Activity/{{ @$mail->id }}">Удалить</a></li>
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
