@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Yeni Kullanıcı Kaydı') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Adınız Soyadınız') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Eposta Adresi') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tc_kimlik_no"
                                    class="col-md-4 col-form-label text-md-end">{{ __('T.C. Kimlik Numarası') }}</label>

                                <div class="col-md-6">
                                    <input id="tc_kimlik_no" type="text"
                                        class="form-control @error('tc_kimlik_no') is-invalid @enderror" name="tc_kimlik_no"
                                        value="{{ old('tc_kimlik_no') }}" required autocomplete="email">

                                    @error('tc_kimlik_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="sirket_adi"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Şirket') }}</label>
                                <div class="col-md-6">
                                    <input id="sirket_adi" type="text"
                                        class="form-control @error('sirket_adi') is-invalid @enderror" name="sirket_adi"
                                        value="{{ old('sirket_adi') }}" required autocomplete="sirket_adi">

                                    @error('sirket_adi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="tc_kimlik_no"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Vergi Kimlik Numarası') }}</label>
                                <div class="col-md-6">
                                    <input id="vergi_kimlik_no" type="text"
                                        class="form-control @error('vergi_kimlik_no') is-invalid @enderror"
                                        name="vergi_kimlik_no" value="{{ old('vergi_kimlik_no') }}" required
                                        autocomplete="email">

                                    @error('vergi_kimlik_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="telefon"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Telefon Numarası') }}</label>
                                <div class="col-md-6">
                                    <input id="telefon" type="tel"
                                        class="form-control @error('telefon') is-invalid @enderror" name="telefon"
                                        value="{{ old('telefon') }}" required autocomplete="email">

                                    @error('telefon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="faks"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Faks Numarası') }}</label>
                                <div class="col-md-6">
                                    <input id="faks" type="tel"
                                        class="form-control @error('faks') is-invalid @enderror" name="faks"
                                        value="{{ old('faks') }}" required autocomplete="email">

                                    @error('faks')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="adres"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Adres') }}</label>
                                <div class="col-md-6">
                                    <input id="adres" type="text"
                                        class="form-control @error('adres') is-invalid @enderror" name="adres"
                                        value="{{ old('adres') }}" required autocomplete="adres">

                                    @error('adres')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Parola') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Parola (Tekrar)') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Yeni Kullanıcı Oluştur') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
