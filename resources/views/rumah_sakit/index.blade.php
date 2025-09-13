@extends('app')

@section('content')
<div class="container">
    @if (session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <h5>Data Rumah Sakit</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('rumah-sakit.create') }}" class="btn btn-primary mb-3">Tambah Rumah Sakit</a>
            <table class="table table-striped table-hover" id="rumahSakitTable">
                <thead>
                    <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama Rumah Sakit</th>
                    <th scope="col">Alamat Rumah Sakit</th>
                    <th scope="col">No. Telepon</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rumah_sakit as $index => $r)
                    <tr id="row-{{ $r->id_rumah_sakit }}">
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $r->nama_rumah_sakit }}</td>
                        <td>{{ $r->alamat_rumah_sakit }}</td>
                        <td>{{ $r->no_telp }}</td>
                        <td>
                            <a href="{{ route('rumah-sakit.edit', $r->id_rumah_sakit) }}" class="btn btn-sm btn-warning">Edit</a>
                            <button class="btn btn-danger btn-sm deleteBtn" data-id="{{ $r->id_rumah_sakit }}" data-nama="{{ $r->nama_rumah_sakit }}">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data <strong id="namaRumahSakit"></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete" data-bs-dismiss="modal">Hapus</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(function(){
    let deleteId = null;
    $(document).on('click', '.deleteBtn', function(){
        deleteId = $(this).data('id');
        let nama = $(this).data('nama');
        $("#namaRumahSakit").text(nama);
        var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        myModal.show();
    });

    $("#confirmDelete").click(function(){
        if(deleteId){
            $.ajax({
                url: "/rumah-sakit/"+deleteId,
                type: "DELETE",
                data: {_token: "{{ csrf_token() }}"},
                success: function(){
                    $("#row-"+deleteId).remove();
                    $("#rumahSakitTable tbody tr").each(function(index){
                        $(this).find('th').text(index + 1);
                    });
                    deleteId = null;
                    var myModalEl = document.getElementById('deleteModal');
                    var modal = bootstrap.Modal.getInstance(myModalEl);
                    modal.hide();
                },
                error: function(xhr){
                    $('<div class="alert alert-danger">'+xhr.responseJSON.message+'</div>')
                        .prependTo('.container')
                        .delay(3000).fadeOut();
                }
            });
        }
    });
});
</script>
@endsection
