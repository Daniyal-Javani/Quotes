@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create quote</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('quotes.update', $quote->id) }}" aria-label="{{ __('Create quote') }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="text" class="col-sm-4 col-form-label text-md-right">{{ __('Text') }}</label>

                            <div class="col-md-6">
                                <textarea id="text" class="form-control{{ $errors->has('text') ? ' is-invalid' : '' }}" name="text"required autofocus>{{ old('text', $quote->text) }}</textarea>

                                @if ($errors->has('text'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('text') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="author" class="col-sm-4 col-form-label text-md-right">{{ __('Author') }}</label>

                            <div class="col-md-6">
                                <input id="author" class="form-control{{ $errors->has('author') ? ' is-invalid' : '' }}" name="author" value="{{ old('author', $quote->author->name) }}" required>

                                @if ($errors->has('author'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('author') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-sm-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select id="category" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" name="category" value="{{ old('category', $quote->category()->first()->parent()->first()->id) }}" required>
                                    <option value="0">Select a Category</option>
                                    @foreach($categories as $category)
                                        @if (old('category', $quote->category()->first()->parent()->first()->id) == $category->id)
                                              <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('category'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subcategory" class="col-sm-4 col-form-label text-md-right">{{ __('Subcategory') }}</label>

                            <div class="col-md-6">

                                <select id="subcategory" class="form-control{{ $errors->has('Subcategory') ? ' is-invalid' : '' }}" name="subcategory" value="{{ old('subcategory', $quote->category()->first()->id) }}" required>
                                    <option value="0">Select a Sub Category</option>
                                </select>

                                @if ($errors->has('subcategory'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subcategory') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
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

@section('scripts')
    <script>
        var options = '';
        if ($("select#category").val() == 0) {
            options += '<option value="0">Select a Category</option>';
            $("select#subcategory").html(options);
        } else {
            $.getJSON("{{ route('categories.subcategories', '') }}/" + "{{ old('category', $quote->category()->first()->parent()->first()->id) }}", function(j){
                for (var i = 0; i < j.length; i++) {
                    var oldSubcategory = {{ old('subcategory', 0) }};
                    if (j[i].id == oldSubcategory) {
                        options += '<option selected value="' + j[i].id + '">' + j[i].name + '</option>';
                    } else {
                        options += '<option value="' + j[i].id + '">' + j[i].name + '</option>';
                    }
                }
                $("select#subcategory").html(options);
            });
        }
        $(function(){
            $("select#category").change(function(){
                var options = '';
                if ($(this).val() == 0) {
                    options += '<option value="0">Select a Category</option>';
                    $("select#subcategory").html(options);
                } else {
                    $.getJSON("{{ route('categories.subcategories', '') }}/" + $(this).val(), function(j){
                          for (var i = 0; i < j.length; i++) {
                            {{ old('subcategory') }}
                            options += '<option value="' + j[i].id + '">' + j[i].name + '</option>';
                          }
                          $("select#subcategory").html(options);
                    })
                }
            })
        })
    </script>
@endsection