@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Eposta Adresini Doğrula') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Yeni bir doğrulama bağlantısı eposta adresinize gönderildi.') }}
                        </div>
                    @endif

                    {{ __('Devam etmeden önce, eposta adresinize gönderilen doğrulama bağlantısını içeren mesajı kontrol ediniz.') }}
                    {{ __('Eposta almadıysanız') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('yeni bir tane gönderilmesi için buraya tıklayın') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
