@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Quotes <a href="{{ route('quotes.create') }}" class="btn btn-success float-right">Add quote</a></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table>
                        <tbody>
                            @foreach ($quotes as $quote)
                                <tr>
                                    <td class="col-md-8">{{ $quote->text }}</td>
                                    <td class="col-md-2">
                                        <a href="{{ route('quotes.edit', $quote->id) }}" class="btn btn-warning" role="button">Edit </a>
                                    </td>
                                    <td class="col-md-2">
                                        <form method="POST" action="{{ route('quotes.destroy', $quote->id) }}" class="form-inline" style="display: inline; ">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row justify-content-center">{{ $quotes->links() }}</div>
        </div>
    </div>
</div>
@endsection
