<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($categories as $category)
                    <li class="list-group-item">{{ $category->name }}</li>
                @endforeach
            </ul>

        </div>
    </div>
</div>