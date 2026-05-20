@extends('layouts.app')

@section('content')
<div class="page-header">
    <h3 class="page-title"> Manajemen Wilayah </h3>
</div>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-primary">
                    <i class="mdi mdi-map-marker-radius"></i> Data Wilayah Indonesia
                </h4>
                <p class="card-description"> Pilih wilayah secara bertahap </p>
                <hr>

                <div class="form-group mb-4">
                    <label for="provinsi">Provinsi</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-white">
                                <i class="mdi mdi-city"></i>
                            </span>
                        </div>
                        <select id="provinsi" class="form-control form-control-lg">
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="kota">Kota/Kabupaten</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-info text-white">
                                <i class="mdi mdi-home-modern"></i>
                            </span>
                        </div>
                        <select id="kota" class="form-control form-control-lg">
                            <option value="">Pilih Kota</option>
                        </select>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="kecamatan">Kecamatan</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-warning text-white">
                                <i class="mdi mdi-store"></i>
                            </span>
                        </div>
                        <select id="kecamatan" class="form-control form-control-lg">
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="kelurahan">Kelurahan/Desa</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-success text-white">
                                <i class="mdi mdi-account-group"></i>
                            </span>
                        </div>
                        <select id="kelurahan" class="form-control form-control-lg">
                            <option value="">Pilih Kelurahan</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
$(document).ready(function() {
    
    axios.get('/modul5/get-provinsi')
        .then(function (response) {
            let data = response.data;
            data.forEach(function(item) {
                $('#provinsi').append(`<option value="${item.id}">${item.name}</option>`);
            });
        })
        .catch(function (error) {
            console.error("Gagal memuat data provinsi:", error);
        });

    
    $('#provinsi').change(function() {
        let id = $(this).val();
        
        $('#kota').html('<option value="">Pilih Kota</option>');
        $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
        $('#kelurahan').html('<option value="">Pilih Kelurahan</option>');

        if (id !== '') {
            axios.get('/modul5/get-kota/' + id)
                .then(function (response) {
                    response.data.forEach(function(item) {
                        $('#kota').append(`<option value="${item.id}">${item.name}</option>`);
                    });
                })
                .catch(error => console.error("Error load kota:", error));
        }
    });


    $('#kota').change(function() {
        let id = $(this).val();
        
        $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
        $('#kelurahan').html('<option value="">Pilih Kelurahan</option>');

        if (id !== '') { 
            axios.get('/modul5/get-kecamatan/' + id)
                .then(function (response) {
                    response.data.forEach(function(item) {
                        $('#kecamatan').append(`<option value="${item.id}">${item.name}</option>`);
                    });
                })
                .catch(error => console.error("Error load kecamatan:", error));
        }
    });

    
    $('#kecamatan').change(function() {
        let id = $(this).val();
        
        $('#kelurahan').html('<option value="">Pilih Kelurahan</option>');

        if (id !== '') {
            axios.get('/modul5/get-kelurahan/' + id)
                .then(function (response) {
                    response.data.forEach(function(item) {
                        $('#kelurahan').append(`<option value="${item.id}">${item.name}</option>`);
                    });
                })
                .catch(error => console.error("Error load kelurahan:", error));
        }
    });

});
</script>
@endsection