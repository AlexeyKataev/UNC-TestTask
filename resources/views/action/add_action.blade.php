@extends('../templates/layout')

@section('content')
    <main class="container">
        <h1 class="mt-5 mb-5 display-6">
            <a href="/Action/Actions" role="button" class="btn btn-light">
                <i class="bi bi-arrow-left"></i>
            </a>
            Добавить акцию
        </h1>
        <form method="post" action="{{ route('addAction') }}" class="mb-3" onload="datePlannedSend()">
            {{ csrf_field() }}
            <div class="mb-3">
                <label for="inputTitle" class="form-label">Заголовок</label>
                <input name="title" type="text" class="form-control" id="inputTitle" aria-describedby="titleHelp" required>
                <div id="titleHelp" class="form-text">Обязательное поле</div>
            </div>
            <div class="mb-3">
                <label for="inputDescription" class="form-label">Описание</label>
                <input name="description" type="text" class="form-control" id="inputDescription" aria-describedby="descriptionHelp" required>
            </div>
            <div class="mb-3">
                <div class="form-check form-switch" aria-describedby="isPrivateHelp">
                    <input name="is_private" class="form-check-input" type="checkbox" id="isPrivateCheck" checked>
                    <label class="form-check-label" for="isPrivateCheck">Персональная акция</label>
                </div>
                <div id="isPrivateHelp" class="form-text">Персональная акция доступна только пользователям соответствующей категории, получившим письмо в рамках массовой рассылки</div>
            </div>
            <div class="mb-3">
                <label for="inputDateStart" class="form-label">Дата старта</label>
                <input name="date_start" class="form-control" id="inputDateStart" type="datetime-local" aria-describedby="dateStartHelp">
                <div id="dateStartHelp" class="form-text">Обязательное поле. Указанные часы и минуты будут проигнорированы</div>
            </div>
            <div class="mb-3">
                <label for="inputDateEnd" class="form-label">Дата окончания</label>
                <input name="date_end" class="form-control" id="inputDateEnd" type="datetime-local" aria-describedby="dateEndHelp">
                <div id="dateEndHelp" class="form-text">Обязательное поле. Указанные часы и минуты будут проигнорированы</div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-plus-square-dotted mr-3"></i>
                Добавить акцию
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
