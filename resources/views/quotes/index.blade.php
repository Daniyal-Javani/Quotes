@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Quotes <a href="{{ route('quotes.create') }}" class="btn btn-success float-right">Add quote</a></div>
            </div>
            @foreach ($quotes as $quote)
            <div class="card">
                <div class="card-body">
                    <p class="card-text">{{ $quote->text }}</p>
                    <a href="{{ route('quotes.edit', $quote->id) }}" class="btn btn-warning float-right" role="button">Edit
                    </a>
                    <form method="POST" action="{{ route('quotes.update', $quote->id) }}" class="form-inline" style="display: inline; ">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger float-right">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
            <div class="row justify-content-center">{{ $quotes->links() }}</div>
    </div>
</div>
@endsection
