<?php

/*
 * Describe you custom displays, columns and form items here.
 *
 *		Display::register('customDisplay', '\Foo\Bar\MyCustomDisplay');
 *
 *		Column::register('customColumn', '\Foo\Bar\MyCustomColumn');
 *
 * 		FormItem::register('customElement', \Foo\Bar\MyCustomElement::class);
 *
 */

Column::register('published', \App\Columns\Published::class);
Column::register('sended', \App\Columns\Sended::class);