@extends('back.layouts.master')
@section('title', 'Kategoriler Sayfası')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.category.create') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Kategori Adı</label>
                            <input type="text" class="form-control" name="category" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tüm Kategoriler</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kategori Adı</th>
                                    <th>Makale Sayısı</th>
                                    <th>Durum</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>

                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        <td>{{ $category->articleCount() }}</td>
                                        <td>
                                            <input class="switch" category-id="{{ $category->id }}" type="checkbox"
                                                data-on="Aktif" data-off="Pasif" data-onstyle="success"
                                                data-offstyle="danger" @if ($category->status == 1) checked @endif
                                                data-toggle="toggle">
                                        </td>
                                        <td>
                                            <a category-id="{{ $category->id }}" class="btn btn-sm btn-primary edit-click"
                                                title="Kategoriyi Düzenle"><i class="fa fa-edit text-white"></i></a>
                                            <a category-id="{{ $category->id }}"
                                                category-count="{{ $category->articleCount() }}"
                                                category-name="{{ $category->name }}"
                                                class="btn btn-sm btn-danger remove-click" title="Kategoriyi Sil"><i
                                                    class="fa fa-times text-white"></i></a>
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
    <div class="modal fade" id="editModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kategoriyi Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.category.update') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Kategori Adı:</label>
                            <input type="text" id="category" class="form-control" name="category">
                            <input type="hidden" name="id" id="category_id">
                        </div>
                        <div class="form-group">
                            <label>Kategori Slug</label>
                            <input type="text" id="slug" class="form-control" name="slug">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-success">Kaydet</button>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kategoriyi Sil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="body" class="modal-body">
                    <div id="articleAlert" class="alert alert-danger"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                    <form action="{{ route('admin.category.delete') }}">
                        @csrf
                        <input type="hidden" name="id" id="deleteId">
                        <button id="deleteButton" type="submit" class="btn btn-success">Sil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function() {
            $('.remove-click').click(function() {
                id = $(this)[0].getAttribute('category-id');
                count = $(this)[0].getAttribute('category-count');
                name = $(this)[0].getAttribute('category-name');
                if (id == 1) {
                    $('#articleAlert').html(name +
                        'Genel kategorisi sabit kategoridir. Silinen diğer kategoriler ait makaleler buraya eklenecektir.'
                    );
                    $('#body').show();
                    $('$deleteButton').hide();
                    $('#deleteModal').modal();
                    return;
                }

                $('#deleteButton').show();
                $('#deleteId').val(id);
                $('#articleAlert').html('');
                $('#body').hide();
                if (count > 0) {
                    $('#articleAlert').html('Bu kategoriye ait ' + count +
                        ' makale bulunmaktadır. Silmek istediğinize emin misiniz ?');
                    $('#body').show();
                }
                $('#deleteModal').modal();
            });

            $('.edit-click').click(function() {
                id = $(this)[0].getAttribute('category-id');
                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.category.getdata') }}',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        console.log(data);
                        $('#category').val(data.name);
                        $('#slug').val(data.slug);
                        $('#category_id').val(data.id);
                        $('#editModal').modal();
                    }
                });
            });

            $('.switch').change(function() {
                id = $(this)[0].getAttribute('category-id');
                statu = $(this).prop('checked');
                $.get("{{ route('admin.category.switch') }}", {
                    id: id,
                    statu: statu
                }, function(data, status) {});
            })
        })
    </script>
@endsection
