
@extends('layouts.app')
@section('title', $data['title'])
@section('description', $data['description'])
@section('keywords', $data['keywords'])

@section('content')
    @foreach ($data['sections'] as $section)
        @component('components.section', $section)
        @endcomponent
    @endforeach

    <section id="requisites">
        <div class="container">
            <div class="fib-section">
                <div class="row">
                    <div class="col">
                        <div class="fib fib-col fib-gap-8 fib-center font-center">
                            <h2 class="font-size-2 font-bold">Реквизиты</h2>
                            <p class="font-size-5">Для помощи в рабочих вопросах</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center align-items-center gy-4">
                    <div class="col col-12 col-lg-6 order-2 order-lg-1">
                        <div class="fib fib-col fib-gap-13">
                            <div>
                                @component('components.paramitem', ['title' => 'Наименование', 'value' => 'ИП Синельщиков Марк Романович'])
                                @endcomponent
                                @component('components.paramitem', ['title' => 'ИНН', 'value' => '220421489755'])
                                @endcomponent
                                @component('components.paramitem', ['title' => 'ОГРН', 'value' => '323220200119280'])
                                @endcomponent
                                @component('components.paramitem', ['title' => 'ОКПО', 'value' => '2028602007'])
                                @endcomponent
                            </div>

                            <div>
                                @component('components.paramitem', [
                                    'title' => 'Юридический адрес',
                                    'value' => '659300, Алтайский край, г Бийск, ул Ильи Мухачева',
                                ])
                                @endcomponent
                                @component('components.paramitem', [
                                    'title' => 'Фактический адрес',
                                    'value' => '630126, Новосибирская обл, г Новосибирск, ул Выборная',
                                ])
                                @endcomponent
                            </div>

                            <div>
                                @component('components.paramitem', ['title' => 'Банк', 'value' => 'СИБИРСКИЙ БАНК ПАО СБЕРБАНК'])
                                @endcomponent
                                @component('components.paramitem', ['title' => 'БИК', 'value' => '045004641'])
                                @endcomponent
                                @component('components.paramitem', ['title' => 'Расч. счет', 'value' => '40802810944050146649'])
                                @endcomponent
                                @component('components.paramitem', ['title' => 'Корр. счет', 'value' => '30101810500000000641'])
                                @endcomponent
                            </div>
                        </div>
                    </div>

                    <div class="col col-12 col-lg-6 order-1 order-lg-2">
                        <div class="fib fib-col fib-gap-13 fib-center font-center pos-h-100">
                            <img class="" style="border-radius: 100%"
                                src="https://sun4-18.userapi.com/s/v1/if2/cvRR31KTU1mNje8Sljm_hX8jh71Cl9ib-qbp_MqJf7WYY2xKvEgVib7RjUoCWne3U2ERKg_eG8bHuaGu7mB8v_j3.jpg?quality=95&crop=0,0,800,800&as=50x50,100x100,200x200,400x400&ava=1&u=331o_BWUP1E8S4G-B8CyKHXDg-iExfDyF3F5ntyy_Ac&cs=200x200"
                                alt="">

                            <div>
                                <p class="font-size-4">Руководитель проекта</p>
                                <p class="font-size-3 emoji color-accent">Синельщиков Марк Романович</p>
                                <p class="font-size-6">Написать сообщение в мессенджере</p>
                            </div>

                            <div class="fib fib-row fib-gap-13 fib-center font-center">
                                <a href="{{ route('chat.whatsapp') }}" target="_blink"
                                    class="fib-button hover-main">WhatsApp</a>

                                <a href="{{ route('chat.telegram') }}" target="_blink"
                                    class="fib-button hover-main">Telegram</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
