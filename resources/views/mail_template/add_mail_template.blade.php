@extends('../templates/layout')

@section('content')
    <main class="container">
        <h1 class="mt-5 mb-5 display-6">
            <a href="/MailTemplate/MailTemplates" role="button" class="btn btn-light">
                <i class="bi bi-arrow-left"></i>
            </a>
            Добавить шаблон письма
        </h1>
        <form method="post" action="{{ route('addMailTemplate') }}" class="mb-3">
            {{ csrf_field() }}
            <div class="mb-3">
                <label for="inputText" class="form-label">Текст</label>
                <input name="text" type="text" class="form-control" id="inputText" aria-describedby="textHelp" required>
                <div id="textHelp" class="form-text">Обязательное поле</div>
            </div>
            <div class="form-check form-switch" aria-describedby="isActionHelp">
                <input name="is_action_mail" class="form-check-input" type="checkbox" id="isActionCheck" checked>
                <label class="form-check-label" for="isActionCheck">Сделать текстом для акций</label>
            </div>
            <div class="form-check form-switch" aria-describedby="isEditableHelp">
                <input name="is_editable" class="form-check-input" type="checkbox" id="isEditableCheck" checked>
                <label class="form-check-label" for="isEditableCheck">Разрешить редактирование после создания</label>
            </div>
            <div class="form-check form-switch" aria-describedby="isPinnedHelp">
                <input name="is_pinned" class="form-check-input" type="checkbox" id="isPinnedCheck">
                <label class="form-check-label" for="isPinnedCheck">Добавить в избранное</label>
            </div>
            <div class="form-check form-switch mb-3" aria-describedby="isArchivalHelp">
                <input name="is_archival" class="form-check-input" type="checkbox" id="isArchivalCheck">
                <label class="form-check-label" for="isArchivalCheck">Добавить в архивное</label>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-plus-square-dotted mr-3"></i>
                Добавить шаблон
            </button>
        </form>
    </main>
@endsection
