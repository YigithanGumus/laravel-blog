<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            KATEGORİLER
        </div>
        <ul class="list-group">
            @foreach ($categories as $category)
            <li class="list-group-item d-flex justify-content-between align-items-center  @if(Request::segment(2)==$category->slug) active @endif">
                <a  @if(Request::segment(2)!=$category->slug) href="{{ route('category', $category->slug) }}" @endif>{{ $category->name }}</a>
                <span class="badge badge-primary badge-pill"
                    style="background-color: rgb(114, 110, 110);border-radius:30px;">{{ $category->articleCount() }}</span>
            </li>
            @endforeach
        </ul>
    </div>
</div>
