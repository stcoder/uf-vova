<p>На текущее время: {{ date('d.m.Y H:i') }}, было офрмлено заявок: {{ $orders->count() }}</p>

@foreach($orders as $order)
<p>Номер заявки: {{ $order->id }}<br/>
Дата создания: {{ date('d.m.Y H:i', strtotime($order->created_at)) }}<br/>
Имя: {{ $order->name }}<br/>
Возраст: {{ $order->age }}<br/>
Телефон: {{ $order->phone }}<br/>
Вопрос: {{ $order->question }}<br/></p>

<p>==============================</p>

@endforeach