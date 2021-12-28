@extends('../templates/layout')

@section('content')
    <main class="container">
        <h1 class="mt-5 mb-5 display-6">Email-рассылки</h1>
        <div class="row">
            <div class="col-sm-6">
                <div class="card mb-3">
                    <div class="card-body">
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
                        <a href="/Mailing/HistoryMailings" class="btn btn-outline-primary">
                            <i class="bi bi-card-list"></i>
                            Перейти к истории рассылок
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="mt-3 mb-3">Запланированно</h3>
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
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </main>
@endsection
