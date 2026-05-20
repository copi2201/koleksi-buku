<h1>Edit Menu</h1>

<form action="{{ route('vendor.menu.update', $menu->id) }}" method="POST">
    @csrf

    <label>Vendor</label><br>
    <select name="vendor_id">
        @foreach($vendors as $vendor)
            <option value="{{ $vendor->id }}" {{ $menu->vendor_id == $vendor->id ? 'selected' : '' }}>
                {{ $vendor->nama_vendor }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Nama Menu</label><br>
    <input type="text" name="nama_menu" value="{{ $menu->nama_menu }}">

    <br><br>

    <label>Harga</label><br>
    <input type="number" name="harga" value="{{ $menu->harga }}">

    <br><br>

    <button type="submit">Update</button>
    <a href="{{ route('vendor.menu.index') }}">Kembali</a>
</form> 