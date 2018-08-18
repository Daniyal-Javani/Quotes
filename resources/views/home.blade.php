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
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
<style type="text/css">
    .fa-heart:hover {
        font-weight: 900;
    }
    .fa-heart {
        color: blue;
    }
</style>
@endsection

@section('scripts')
<script type="text/javascript">
    $( document ).ready(function() {
        $('a[id^="like_"]').on('click', function() {
            var a_tag = $(this);
            $.getJSON( "{{ route('quotes.like', '') }}/" + a_tag.attr('id').slice(5), function( data ) {
                if (data.status == 'success') {
                    var font_weight = a_tag.children().css("font-weight");
                    if (font_weight == 900) {
                        a_tag.children().css("font-weight", "100");
                        var count = a_tag.next().text();
                        a_tag.next().text(--count);
                    } else {
                        a_tag.children().css("font-weight", "900");
                        var count = a_tag.next().text();
                        a_tag.next().text(++count);
                    }
                }
            });

            return false;
         });
    });
</script>
@endsection