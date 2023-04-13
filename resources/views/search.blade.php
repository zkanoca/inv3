@extends('layouts.app')

@section('content')
    @include('partials._search_form')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                {{  $response }}
            </div>
        </div>
    </div>
@endsection