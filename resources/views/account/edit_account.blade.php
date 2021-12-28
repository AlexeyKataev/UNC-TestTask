@extends('../templates/layout')

@section('content')
    <main class="container">
        <h1 class="mt-5 mb-5 display-6">
            <a href="/Account/Accounts" role="button" class="btn btn-light">
                <i class="bi bi-arrow-left"></i>
            </a>
            Изменить пользователя: Id {{ @$user->id }}, Ф.И.О. {{ @$user->second_name }} {{ @$user->first_name }} {{ @$user->middle_name }}
        </h1>
        <form method="post" action="{{ route('editAccount') }}" class="mb-3">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <input name="id" type="hidden" value="{{ @$user->id }}"/>
            <div class="mb-3">
                <label for="inputUserRole" class="form-label">Роль</label>
                <select name="user_role_id" class="form-select" id="inputUserRole" aria-describedby="userRoleHelp">
                    @foreach($userRoles as $role)
                        @if($user->user_role_id == $role->id)
                            <option value="{{ $role->id  }}" selected>
                                {{ $role->name }}
                            </option>
                        @else
                            <option value="{{ $role->id  }}">
                                {{ $role->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
                <div id="userRoleHelp" class="form-text">Обязательное поле</div>
            </div>
            <div class="mb-3">
                <label for="inputToken" class="form-label">Ключ доступа к API</label>
                @if($user->api_access_token == null)
                    <input name="api_access_token" type="text" class="form-control mb-1" id="inputToken" aria-describedby="tokenHelp" value="Нет ключа доступа" disabled>
                @else
                    <input name="api_access_token" type="text" class="form-control mb-1" id="inputToken" aria-describedby="tokenHelp" value="{{ @$user->api_access_token }}" disabled>
                @endif
                <a role="button" class="btn btn-light btn-sm" role="button" data-bs-toggle="modal" data-bs-target="#addKeyAPIModal">Сгенерировать ключ</a>
                <a role="button" class="btn btn-light btn-sm" role="button" data-bs-toggle="modal" data-bs-target="#removeKeyAPIModal">Деактивировать ключ</a>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-plus-square-dotted mr-3"></i>
                Изменить пользователя
            </button>
        </form>
        <div class="modal fade" id="addKeyAPIModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="{{ route('addKeyAPI') }}" class="modal-content">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <input type="hidden" name="id" value="{{ @$user->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Сгенерировать ключ доступа к API</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Если для данного пользователя ранее уже был сгенерирован ключ, он будет заменён на новый
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-success">Сгенерировать</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="removeKeyAPIModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="{{ route('removeKeyAPI') }}" class="modal-content">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <input type="hidden" name="id" value="{{ @$user->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Деактивировать ключ доступа к API</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Данную операцию в дальнейшем невозможно отменить
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-danger">Деактивировать</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
