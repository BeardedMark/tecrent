@php
    $title = 'Подтверждение почты';
@endphp

@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="row justify-content-center">
        <div class="col col-3">
            <div class="frame fib fib-col fib-21">
                <div class="fib fib-col fib-8">
                    <p class="font-size-4 font-bold">{{ $title }}</p>
                    <p class="font-size-6">Ваш адрес электронной почты требует подтверждения. Пожалуйста, проверьте свою электронную почту на наличие ссылки для подтверждения.</p>
                </div>


                {{-- @if (session('verified'))
                    <p>Your email has been successfully verified. You can now use your account.</p>
                @else
                    <p>Your email address requires verification. Please check your email for a verification link.</p>
                @endif

                @if (session('resent'))
                    <p>A verification link has been sent to your email address.</p>
                @endif --}}


                <form class="fib fib-col fib-13" method="GET" action="{{ route('verification.resend') }}">
                    @csrf
                    <button class="action hover action-bold hover-second" type="submit">Выслать повторно</button>
                </form>
            </div>
        </div>
    </div>
@endsection
