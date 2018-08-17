@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Home</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card">
                        <h5 class="card-header">Quotes of your favourite categories</h5>
                    </div>
                    @foreach($quotes as $quote)
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">{{ $quote->text }}</p>
                                <a href="#"><i class="far fa-heart"></i></a><span style="margin-left: 5px;">0</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
<style type="text/css">
    .fa-heart:hover {
        font-weight: 900;
    }
</style>
@endsection