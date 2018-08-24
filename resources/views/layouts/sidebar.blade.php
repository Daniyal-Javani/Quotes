<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($categories as $category)
                    <li class="list-group-item"><a href="{{ route('categories.quotesByName', $category->name) }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>

        </div>
    </div>
</div>