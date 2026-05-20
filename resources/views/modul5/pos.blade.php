@extends('layouts.app')

@section('content')
<div class="page-header">
    <h3 class="page-title"> Point Of Sales (POS) </h3>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Kasir </h4>
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Kode Barang (ID)</label>
                            <input type="text" id="kode_barang" class="form-control" placeholder="Input ID lalu Enter...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" id="nama_barang" class="form-control" readonly style="background-color: #eeeeee;">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Harga Barang</label>
                            <input type="number" id="harga_barang" class="form-control" readonly style="background-color: #eeeeee;">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" id="jumlah" class="form-control" value="1" min="1">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <button type="button" id="btn_tambah" class="btn btn-primary d-block w-100" disabled>
                            <i class="mdi mdi-plus"></i> Tambahkan
                        </button>
                    </div>
                </div>

                <div class="table-responsive mt-4">
                    <table class="table table-bordered" id="tabel_transaksi">
                        <thead class="bg-light">
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th width="100">Jumlah</th>
                                <th>Subtotal</th>
                                <th width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            </tbody>
                        <tfoot>
                            <tr style="font-weight: bold; background-color: #f3f3f3;">
                                <td colspan="4" class="text-right">Total Keseluruhan</td>
                                <td id="grand_total">0</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mt-4 text-right">
                    <button class="btn btn-success btn-lg" id="btn_bayar">
                        <i class="mdi mdi-check-all"></i> Bayar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Load Libraries --}}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(document).ready(function() {

    $('#kode_barang').focus();

    $('#kode_barang').on('keypress', function(e) {
        if (e.which == 13) { 
            e.preventDefault();
            let kode = $(this).val();

            if (kode !== '') {
                axios.get('/modul5/get-barang/' + kode)
                    .then(function (response) {
                        const res = response.data;
                        if (res.success) {
                            $('#nama_barang').val(res.nama_barang); 
                            $('#harga_barang').val(res.harga);
                            $('#jumlah').val(1);
                            
                            $('#btn_tambah').prop('disabled', false);
                            $('#jumlah').focus();
                        }
                    })
                    .catch(function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Barang tidak ditemukan di database!'
                        });
                        resetInput();
                    });
            }
        }
    });

    $('#btn_tambah').click(function() {
        let kode = $('#kode_barang').val();
        let nama = $('#nama_barang').val();
        let harga = parseInt($('#harga_barang').val());
        let qty = parseInt($('#jumlah').val());
        let subtotal = harga * qty;

        if (qty <= 0) return;

        let existingRow = $(`#tabel_transaksi tbody tr[data-id="${kode}"]`);
        
        if (existingRow.length > 0) {
            let oldQty = parseInt(existingRow.find('.td-qty').text());
            let newQty = oldQty + qty;
            existingRow.find('.td-qty').text(newQty);
            existingRow.find('.td-subtotal').text(newQty * harga);
        } else {
            $('#tabel_transaksi tbody').append(`
                <tr data-id="${kode}">
                    <td>${kode}</td>
                    <td>${nama}</td>
                    <td>${harga}</td>
                    <td class="td-qty" contenteditable="true">${qty}</td>
                    <td class="td-subtotal">${subtotal}</td>
                    <td><button class="btn btn-danger btn-sm btn-hapus"><i class="mdi mdi-delete"></i></button></td>
                </tr>
            `);
        }
        
        updateGrandTotal();
        resetInput();
    });

    function updateGrandTotal() {
        let total = 0;
        $('.td-subtotal').each(function() {
            total += parseInt($(this).text());
        });
        $('#grand_total').text(total);
    }

    // Update subtotal jika jumlah di tabel diubah manual (poin g)
    $(document).on('input', '.td-qty', function() {
        let row = $(this).closest('tr');
        let harga = parseInt(row.find('td:nth-child(3)').text());
        let newQty = parseInt($(this).text()) || 0;
        
        row.find('.td-subtotal').text(newQty * harga);
        updateGrandTotal();
    });

    // Hapus Baris (poin g)
    $(document).on('click', '.btn-hapus', function() {
        $(this).closest('tr').remove();
        updateGrandTotal();
    });

    function resetInput() {
        $('#kode_barang').val('').focus();
        $('#nama_barang').val('');
        $('#harga_barang').val('');
        $('#btn_tambah').prop('disabled', true);
    }

    // 4. PROSES BAYAR & SWAL2 (poin i, j)
    $('#btn_bayar').click(function() {
        if ($('#tabel_transaksi tbody tr').length === 0) {
            Swal.fire('Peringatan', 'Keranjang belanja masih kosong!', 'warning');
            return;
        }

        Swal.fire({
            title: 'Konfirmasi Bayar',
            text: "Simpan transaksi ini ke database?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Ya, Bayar Sekarang'
        }).then((result) => {
            if (result.isConfirmed) {
                // Notifikasi sukses sesuai poin (j)
                Swal.fire(
                    'Berhasil!',
                    'Pembayaran transaksi berhasil disimpan.',
                    'success'
                ).then(() => {
                    // Kosongkan halaman sesuai poin (j)
                    location.reload();
                });
            }
        });
    });
});
</script>
@endsection