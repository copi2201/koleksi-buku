@extends('layouts.app')

@section('content')
<div class="content-wrapper">

<div class="page-header">
<h3 class="page-title">Select & Select2</h3>
</div>

<div class="row">

<div class="col-md-6 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<h4 class="card-title">Select 1</h4>

<div class="form-group">
<label>Tambah Kota</label>
<input type="text" id="inputKota1" class="form-control" placeholder="contoh: malang">
</div>

<button id="btnTambahKota1" class="btn btn-gradient-primary mb-3">
Tambah Kota
</button>

<div class="form-group">
<label>Pilih Kota</label>
<select id="selectKota1" class="form-control">
</select>
</div>

<p>Kota Terpilih :
<span id="hasilKota1" class="text-info font-weight-bold"></span>
</p>

</div>
</div>
</div>


<div class="col-md-6 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<h4 class="card-title">Select2</h4>

<div class="form-group">
<label>Tambah Kota</label>
<input type="text" id="inputKota2" class="form-control" placeholder="contoh: surabaya">
</div>

<button id="btnTambahKota2" class="btn btn-gradient-primary mb-3">
Tambah Kota
</button>

<div class="form-group">
<label>Pilih Kota</label>
<select id="selectKota2" class="form-control" style="width:100%">
</select>
</select>
</select>
</div>

<p>Kota Terpilih :
<span id="hasilKota2" class="text-info font-weight-bold"></span>
</p>

</div>
</div>
</div>

</div>
</div>
@endsection


@push('scripts')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

$(document).ready(function(){


$('#selectKota2').select2();



$('#btnTambahKota1').click(function(){

let kota = $('#inputKota1').val().trim();

if(kota !== ''){
$('#selectKota1').append('<option value="'+kota+'">'+kota+'</option>');
$('#inputKota1').val('');
}

});



$('#selectKota1').change(function(){
$('#hasilKota1').text($(this).val());
});




$('#btnTambahKota2').click(function(){

let kota = $('#inputKota2').val().trim();

if(kota !== ''){

let option = new Option(kota,kota,false,false);
$('#selectKota2').append(option).trigger('change.select2');

$('#inputKota2').val('');

}

});


$('#selectKota2').change(function(){
$('#hasilKota2').text($(this).val());
});

});

</script>

@endpush