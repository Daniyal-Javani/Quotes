@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('quotes.My Interests') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('interests.store') }}" aria-label="{{ __('quotes.Add interest') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="category" class="col-sm-4 col-form-label text-md-right">{{ __('quotes.Category') }}</label>

                                <div class="col-md-6">
                                    <select id="category" class="form-control" name="category" required>
                                        <option value="">{{ __('quotes.Select a Category') }}</option>
                                        @foreach($categories as $category)
                                            @if (old('category') == $category->id)
                                                  <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                            @else
                                                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="subcategory" class="col-sm-4 col-form-label text-md-right">{{ __('quotes.Subcategory') }}</label>

                                <div class="col-md-6">

                                    <select id="subcategory" class="form-control{{ $errors->has('subcategory') ? ' is-invalid' : '' }}" name="subcategory" value="{{ old('subcategory') }}" required>
                                        <option value="">{{ __('quotes.Select a Category') }}</option>
                                    </select>

                                    @if ($errors->has('subcategory'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('subcategory') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary float-right">
                                        {{ __('quotes.Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <table>
                        <tbody>
                            @foreach ($interests as $interest)
                                <tr>
                                    <td class="col-md-8">{{ $interest->name }}</td>
                                    <td class="col-md-2">
                                        <form method="POST" action="{{ route('interests.destroy', $interest->id) }}" class="form-inline" style="display: inline; ">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">
                                                {{ __('quotes.Delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
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