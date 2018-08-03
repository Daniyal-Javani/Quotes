@extends('admin.layouts.app')

@section('content')
<div class="col-sm-12">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Categories</strong>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                              <tr><th>Name</th><th></th><th></th></tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="clickable" data-toggle="collapse" id="row{{ $category->id }}" data-target=".row{{ $category->id }}">
                                    <td class="col-md-8">{{ $category->name }}</td>
                                    <td class="col-md-2"><a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">Edit</a></td>
                                    <td class="col-md-2">
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" class="form-inline" style="display: inline; ">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @foreach($category->subcategories as $subcategory)
                                        <tr class="collapse row{{ $subcategory->parent_id }}">
                                            <td class="col-md-8">- {{ $subcategory->name }}</td>
                                            <td class="col-md-2"><a href="{{ route('admin.categories.edit', $subcategory->id) }}" class="btn btn-warning">Edit</a></td>
                                            <td class="col-md-2">
                                                <form method="POST" action="{{ route('admin.categories.destroy', $subcategory->id) }}" class="form-inline" style="display: inline; ">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                      </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('options')
    <li class="active"><a href="{{ route('admin.categories.create') }}">Add</a></li>
@endsection