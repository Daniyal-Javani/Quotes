@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Category</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.categories.update', $selected_category->id) }}" aria-label="{{ __('Edit Category') }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="parent_id" class="col-sm-4 col-form-label text-md-right">{{ __('Parent Category') }}</label>

                            <div class="col-md-6">
                                <select id="parent_id" class="form-control{{ $errors->has('parent_id') ? ' is-invalid' : '' }}" name="parent_id" value="{{ old('parent_id', $selected_category->parent_id) }}">
                                    <option value="0" selected>No parent</option>
                                    @foreach($categories as $category)
                                        @if (old('category', $selected_category->parent_id) == $category->id)
                                              <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('parent_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('parent_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"required autofocus value="{{ old('name', $selected_category->name) }}">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
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