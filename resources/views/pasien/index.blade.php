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
            <h5>Data Pasien</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('pasien.create') }}" class="btn btn-primary mb-3">Tambah Pasien</a>
            <div class="mb-3">
                <label>Filter Rumah Sakit</label>
                <select id="filterRS" class="form-select">
                <option value="">-- Semua --</option>
                @foreach($rumah_sakit as $rs)
                    <option value="{{ $rs->id_rumah_sakit }}">{{ $rs->nama_rumah_sakit }}</option>
                @endforeach
                </select>
            </div>
            <table class="table table-striped table-hover" id="pasienTable">
                <thead>
                    <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama Pasien</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No. Telepon</th>
                    <th scope="col">Rumah Sakit</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pasien as $index => $p)
                    <tr id="row-{{ $p->id_pasien }}">
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $p->nama_pasien }}</td>
                        <td>{{ $p->alamat_pasien }}</td>
                        <td>{{ $p->no_telp }}</td>
                        <td>{{ $p->rumah_sakit->nama_rumah_sakit }}</td>
                        <td>
                            <a href="{{ route('pasien.edit', $p->id_pasien) }}" class="btn btn-sm btn-warning">Edit</a>
                            <button class="btn btn-danger btn-sm deleteBtn" data-id="{{ $p->id_pasien }}" data-nama="{{ $p->nama_pasien }}">Delete</button>
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
                        Apakah Anda yakin ingin menghapus pasien <strong id="namaPasien"></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
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
  // Ajax Delete
    $(document).on('click', '.deleteBtn', function(){
        deleteId = $(this).data('id');
        let nama = $(this).data('nama');
        $("#namaPasien").text(nama);
        var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        myModal.show();
    });

    $("#confirmDelete").click(function(){
        if(deleteId){
            $.ajax({
                url: "/pasien/"+deleteId,
                type: "DELETE",
                data: {_token: "{{ csrf_token() }}"},
                success: function(){
                    $("#row-"+deleteId).remove();
                    $("#pasienTable tbody tr").each(function(index){
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

    $("#filterRS").change(function(){
    var id_rumah_sakit = $(this).val();
    $.get("/pasien/filter/" + (id_rumah_sakit ? id_rumah_sakit : ''), function(data){
      var tbody = $("#pasienTable tbody");
      tbody.empty();
      $.each(data, function(i,v){
        tbody.append(`<tr id="row-${v.id_pasien}">
          <th scope="row">${i+1}</th>
          <td>${v.nama_pasien}</td>
          <td>${v.alamat_pasien}</td>
          <td>${v.no_telp}</td>
          <td>${v.rumah_sakit.nama_rumah_sakit}</td>
          <td>
            <a href="/pasien/${v.id_pasien}/edit" class="btn btn-sm btn-warning">Edit</a>
            <button class="btn btn-danger btn-sm deleteBtn" data-id="${v.id_pasien}">Delete</button>
          </td>
        </tr>`);
      });
    });
  });
});
</script>
@endsection
