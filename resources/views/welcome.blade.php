@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Latest quotes</h2>
            @foreach($quotes as $quote)
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">{{ $quote->text }}</p>
                        <a href="#" id="like_{{ $quote->id }}">
                            @if ($quote->liked == true)
                                <i style="font-weight: 900" class="far fa-heart"></i>
                            @else
                                <i style="font-weight: 100" class="far fa-heart"></i>
                            @endif
                        </a><span style="margin-left: 5px;">{{ $quote->likesCount }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection