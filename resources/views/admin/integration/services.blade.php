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
                @elseif (Session::get('flash_message') === 'vk-board-topic-integrated')
                    Вы успешно подключили отзывы.
                @elseif (Session::get('flash_message') === 'vk-board-topic-off')
                    Вы отключили отзывы.
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
                        <li class="list-group-item">Постов <span class="badge">{{ $group['posts_count'] }}</span></li>
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
    @if (isset($user['id']) && $user['id'] && isset($group['id']) && $group['id'])
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Отзывы</h3>
                </div>
                <div class="panel-body">
                    @if (isset($review['id']) && $review['id'])
                        Отзывы подключены
                        <div class="small">подключен {{ $review['integrated-date']->formatLocalized('%d %B %Yг.') }}</div>
                        @if (isset($review['updated-date']))
                            <div class="small">обновлен {{ $review['updated-date']->formatLocalized('%d %B %Yг. в %H:%I') }}</div>
                        @endif
                    @else
                        Подключите топик из обсуждения в котором содержатся отзывы.
                    @endif
                </div>
                @if (isset($review['id']) && $review['id'])
                    <ul class="list-group">
                        <li class="list-group-item">Отзывов <span class="badge">{{ $review['reviews_count'] }}</span></li>
                    </ul>
                @endif
                <div class="panel-footer">
                    @if (isset($review['id']) && $review['id'])
                        <a href="{{ route('admin.integration.board-topic-off') }}" class="btn btn-danger">Отключить</a>
                    @else
                        <a href="{{ route('admin.integration.board-topic') }}" class="btn btn-primary">Подключить</a>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>