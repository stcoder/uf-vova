<div class="row">
    @if (Session::has('flash_message'))
        <div class="col-md-12">
            <div class="alert alert-{{ Session::get('flash_type') }}">
                @if (Session::get('flash_message') === 'vk-user-integrated')
                    Вы успешно подключили пользователя в систему.
                @elseif (Session::get('flash_message') === 'vk-user-off')
                    Вы отключили пользователя от системы.
                @elseif (Session::get('flash_message') === 'vk-group-integrated')
                    Вы успешно подключили группу.
                @elseif (Session::get('flash_message') === 'vk-group-off')
                    Вы отключили группу.
                @endif
            </div>
        </div>
    @endif
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Пользователь</h3>
            </div>
            <div class="panel-body">
                @if (isset($user['id']) && $user['id'])
                    <div class="media">
                        <div class="media-left pull-left">
                            <img class="media-object" src="{{ $user['avatar'] }}" alt="{{ $user['username'] }}">
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $user['username'] }}</h4>
                            <div class="small">подключен {{ $user['integrated-date']->formatLocalized('%d %B %Yг.') }}</div>
                        </div>
                    </div>
                @else
                    Интегрируйте сервис Вконтакте для получения материалов.
                @endif
            </div>
            <div class="panel-footer">
                @if (isset($user['id']) && $user['id'])
                    <a href="{{ route('admin.integration.vkontakte-off') }}" class="btn btn-danger">Отключить</a>
                @else
                    <a href="{{ route('admin.integration.vkontakte') }}" class="btn btn-primary">Подключить</a>
                @endif
            </div>
        </div>
    </div>
    @if (isset($user['id']) && $user['id'])
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Группа</h3>
                </div>
                <div class="panel-body">
                    @if (isset($group['id']) && $group['id'])
                        <div class="media">
                            <div class="media-left pull-left">
                                <img src="{{ $group['photo'] }}" alt="{{ $group['name'] }}" class="media-object">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{ $group['name'] }}</h4>
                                <div class="small">подключен {{ $group['integrated-date']->formatLocalized('%d %B %Yг.') }}</div>
                                @if (isset($group['updated-date']))
                                    <div class="small">обновлен {{ $group['updated-date']->formatLocalized('%d %B %Yг. в %H:%I') }}</div>
                                @endif
                            </div>
                        </div>
                    @else
                        Подключите группу из которой будут загружаться материалы.
                    @endif
                </div>
                @if (isset($group['id']) && $group['id'])
                    <ul class="list-group">
                        <li class="list-group-item">Участников <span class="badge">{{ $group['count']['members'] }}</span></li>
                        <li class="list-group-item">Фотографий <span class="badge">{{ $group['count']['photos'] }}</span></li>
                        <li class="list-group-item">Альбомов <span class="badge">{{ $group['count']['albums'] }}</span></li>
                        <li class="list-group-item">Топиков <span class="badge">{{ $group['count']['topics'] }}</span></li>
                        <li class="list-group-item">Видео <span class="badge">{{ $group['count']['videos'] }}</span></li>
                        <li class="list-group-item">Музыка <span class="badge">{{ $group['count']['audios'] }}</span></li>
                        <li class="list-group-item">Документы <span class="badge">{{ $group['count']['docs'] }}</span></li>
                    </ul>
                @endif
                <div class="panel-footer">
                    @if (isset($group['id']) && $group['id'])
                        <a href="{{ route('admin.integration.group-off') }}" class="btn btn-danger">Отключить</a>
                    @else
                        <a href="{{ route('admin.integration.group') }}" class="btn btn-primary">Подключить</a>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>