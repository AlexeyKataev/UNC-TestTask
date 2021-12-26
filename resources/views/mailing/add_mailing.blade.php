@extends('../templates/layout')

@section('content')
<main class="container">
    <h1 class="mt-5 mb-5 display-6">
        <a href="/Mailing/Mailings" role="button" class="btn btn-light">
            <i class="bi bi-arrow-left"></i>
        </a>
        Добавить email-рассылку
    </h1>
    <form method="post" action="{{ route('addMailing') }}" class="mb-3" onload="datePlannedSend()">
        {{ csrf_field() }}
        <div class="mb-3">
            <label for="inputUserCategory" class="form-label">
                Категория пользователей
            </label>
            <select name="user_category_id" class="form-select" id="inputUserCategory" aria-describedby="userCategoryHelp">
                <!---<option value="0">Не указано</option>--->
                <option value="1">Категория A - Не было авторизаций последние 30 календарных дней</option>
                <option value="2">Категория B - Было 2 авторизации за последние 30 календарных дней</option>
                <option value="3">Категория C - Была 1 авторизация за последние 30 календарных дней и не было авторизации во время акции X (указать ниже)</option>
            </select>
            <div id="userCategoryHelp" class="form-text mb-1">Обязательное поле</div>
        </div>
        <div class="mb-3">
            <label for="inputAction" class="form-label">
                Акция
            </label>
            <select name="action_id" class="form-select" id="inputAction" aria-describedby="actionHelp">
                <option value="0">Не указано</option>
                @foreach($actions as $action)
                    <option value="{{ $action->id  }}">
                        @if($action->is_private)
                            [Персональная]
                        @endif
                        "{{ @$action->title }}". {{ @$action->description }}
                    </option>
                @endforeach
            </select>
            <div id="actionHelp" class="form-text mb-1">Обязательное поле при категориях B и C</div>
            <a href="/Action/AddAction" role="button" class="btn btn-light btn-sm">Добавить акцию</a>
            <a href="/Action/Actions" role="button" class="btn btn-light btn-sm">Список акций</a>
        </div>
        <div class="mb-3">
            <label for="inputWithoutAction" class="form-label">
                Акция, во время которой пользователь был неактивен
            </label>
            <select name="without_action_id" class="form-select" id="inputWithoutAction" aria-describedby="withoutActionHelp">
                <option value="0">Не указано</option>
                @foreach($actions as $action)
                    <option value="{{ $action->id  }}">
                        @if($action->is_private)
                            [Персональная]
                        @endif
                        "{{ @$action->title }}". {{ @$action->description }}
                    </option>
                @endforeach
            </select>
            <div id="withoutActionHelp" class="form-text">Обязательное поле при категории C</div>
        </div>
        <div class="mb-3">
            <label for="inputTemplate" class="form-label">
                Шаблон письма
            </label>
            <select name="mail_template_id" class="form-select" id="inputTemplate" aria-describedby="templateHelp">
                @foreach($mailTemplates as $mail)
                    <option value="{{ $mail->id  }}">
                        @if($mail->is_action_mail)
                            [Акция]
                        @endif
                        @if($mail->is_pinned)
                            [Закреплено]
                        @endif
                        {{ $mail->text }}
                    </option>
                @endforeach
            </select>
            <div id="templateHelp" class="form-text mb-1">Обязательное поле</div>
            <a href="/" role="button" class="btn btn-light btn-sm">Добавить шаблон</a>
            <a href="/" role="button" class="btn btn-light btn-sm">Список шаблонов</a>
        </div>
        <div class="mb-3">
            <label for="inputDateStart" class="form-label">Планируемая дата начала рассылки</label>
            <input name="date_planned_start_send" class="form-control" id="inputDateStart" type="datetime-local" aria-describedby="dateStartHelp">
            <div id="dateStartHelp" class="form-text">Обязательное поле. Указанные часы и минуты будут проигнорированы</div>
        </div>
        <div class="mb-3">
            <label for="inputDateEnd" class="form-label">Планируемая дата завершения рассылки</label>
            <input name="date_planned_end_send" class="form-control" id="inputDateEnd" type="datetime-local" aria-describedby="dateEndHelp">
            <div id="dateEndHelp" class="form-text">Обязательное поле. Указанные часы и минуты будут проигнорированы</div>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-plus-square-dotted mr-3"></i>
            Добавить рассылку
        </button>
        <script>
            datePlannedSend();
            function datePlannedSend() {
                let start = new Date();
                start.setDate(start.getDate() + 1);

                let end = new Date();
                end.setDate(end.getDate() + 2);

                start.setMinutes(start.getMinutes() - start.getTimezoneOffset());
                end.setMinutes(end.getMinutes() - end.getTimezoneOffset());

                document.getElementById('inputDateStart').value = start.toISOString().slice(0, -8);
                document.getElementById('inputDateEnd').value = end.toISOString().slice(0, -8);
            }
        </script>
    </form>
</main>
@endsection
