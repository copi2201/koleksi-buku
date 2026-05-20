@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Data Barang (HTML Table)</h3>

    <div class="card mb-4">
        <div class="card-body">
            <form id="formBarang">
                <div class="row">
                    <div class="col-md-5">
                        <label>Nama Barang</label>
                        <input type="text" id="nama" class="form-control" required>
                    </div>
                    <div class="col-md-5">
                        <label>Harga Barang</label>
                        <input type="number" id="harga" class="form-control" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" id="btnTambah" class="btn btn-primary w-100">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table id="tableBarang" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5>Edit/Hapus Barang</h5></div>
            <div class="modal-body">
                <form id="formEdit">
                    <div class="mb-3">
                        <label>ID Barang</label>
                        <input type="text" id="editId" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Nama Barang</label>
                        <input type="text" id="editNama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Harga Barang</label>
                        <input type="number" id="editHarga" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnHapus" class="btn btn-danger">Hapus</button>
                <button type="button" id="btnUbah" class="btn btn-success">Ubah</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    let currentId = 1;
    let selectedRow = null;

   
    $('#btnTambah').click(function() {
        const form = document.getElementById('formBarang');
        if(!form.checkValidity()) { form.reportValidity(); return; }

        const btn = $(this);
        btn.html('<span class="spinner-border spinner-border-sm"></span>').prop('disabled', true);

        setTimeout(() => {
            let row = `<tr data-id="${currentId}">
                <td>${currentId++}</td>
                <td>${$('#nama').val()}</td>
                <td>${$('#harga').val()}</td>
            </tr>`;
            $('#tableBarang tbody').append(row);
            form.reset();
            btn.html('Tambah').prop('disabled', false);
        }, 800);
    });

    $('#tableBarang tbody').on('click', 'tr', function() {
        selectedRow = $(this);
        $('#editId').val(selectedRow.find('td:eq(0)').text());
        $('#editNama').val(selectedRow.find('td:eq(1)').text());
        $('#editHarga').val(selectedRow.find('td:eq(2)').text());
        $('#modalEdit').modal('show');
    });

    $('#btnUbah').click(function() {
        const form = document.getElementById('formEdit');
        if(!form.checkValidity()) { form.reportValidity(); return; }

        $(this).html('<span class="spinner-border spinner-border-sm"></span>').prop('disabled', true);
        
        setTimeout(() => {
            selectedRow.find('td:eq(1)').text($('#editNama').val());
            selectedRow.find('td:eq(2)').text($('#editHarga').val());
            $('#modalEdit').modal('hide');
            $('#btnUbah').html('Ubah').prop('disabled', false);
        }, 800);
    });

    $('#btnHapus').click(function() {
        $(this).html('<span class="spinner-border spinner-border-sm"></span>').prop('disabled', true);
        setTimeout(() => {
            selectedRow.remove();
            $('#modalEdit').modal('hide');
            $('#btnHapus').html('Hapus').prop('disabled', false);
        }, 800);
    });
</script>

<style>
    #tableBarang tbody tr { cursor: pointer; }
</style>
@endsection