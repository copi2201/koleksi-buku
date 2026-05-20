<h1>Tambah Menu</h1>

<form method="POST" action="{{ auth()->user()->role === 'admin' ? route('modul6.menu.store') : route('vendor.menu.store') }}">
    @csrf

    <label>Vendor</label><br>
    <select name="vendor_id">
        @foreach($vendors as $vendor)
            <option value="{{ $vendor->id }}">{{ $vendor->nama_vendor }}</option>
        @endforeach
    </select>

    <br><br>

    <label>Nama Menu</label><br>
    <input type="text" name="nama_menu">

    <br><br>

    <label>Harga</label><br>
    <input type="number" name="harga">

    <br><br>

    <button type="submit">Simpan</button>
    <a href="{{ route('vendor.menu.index') }}">Kembali</a>
</form>