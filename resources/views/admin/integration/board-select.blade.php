<p>Всего топиков обсуждений: {{ $count }}</p>

@foreach($topics as $topic)
    <h4>{{ $topic['title'] }}</h4>
    <p>{{ $topic['first_comment'] }}</p>
    <a href="{{ route('admin.integration.board-topic-set', ['topic_id' => $topic['tid']]) }}">Подключить</a>
    <hr>
    <br>
@endforeach