@if ($errors->any())
    <div class="alert alert-error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ $menu->exists ? route('menus.update', $menu) : route('menus.store') }}"
      method="POST" enctype="multipart/form-data" class="form-box">
    @csrf
    @if ($menu->exists)
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="kategori">Kategori</label>
        <input type="text" name="kategori" id="kategori" placeholder="Contoh: Coffee"
               value="{{ old('kategori', $menu->kategori) }}">
    </div>

    <div class="form-group">
        <label for="nama_item">Nama Item</label>
        <input type="text" name="nama_item" id="nama_item" placeholder="Contoh: Cafe Latte"
               value="{{ old('nama_item', $menu->nama_item) }}">
    </div>

    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" rows="4"
                  placeholder="Deskripsi singkat menu">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
    </div>

    <div class="form-group">
        <label for="harga">Harga (Rp)</label>
        <input type="number" name="harga" id="harga" min="0" placeholder="25000"
               value="{{ old('harga', $menu->harga) }}">
    </div>

    <div class="form-group">
        <label for="halal">Halal</label>
        @php $halal = (int) old('halal', $menu->exists ? $menu->halal : 1); @endphp
        <select name="halal" id="halal">
            <option value="1" @selected($halal === 1)>Ya</option>
            <option value="0" @selected($halal === 0)>Tidak</option>
        </select>
    </div>

    <div class="form-group">
        <label for="alergen">Alergen (opsional)</label>
        <input type="text" name="alergen" id="alergen" placeholder="Contoh: Susu"
               value="{{ old('alergen', $menu->alergen) }}">
    </div>

    <div class="form-group">
        <label for="foto">Foto (opsional)</label>

        @if ($menu->foto)
            <p>Foto saat ini:</p>
            <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama_item }}" class="thumb"
                 style="width:160px;height:110px;margin-bottom:10px">
        @endif

        <input type="file" name="foto" id="foto" accept="image/*" onchange="previewImage(event)">
        @if ($menu->exists)
            <small>Kosongkan jika tidak ingin mengganti foto.</small>
        @endif
        <img id="preview" alt="Preview" style="display:none;width:160px;height:110px;object-fit:cover;margin-top:10px">
    </div>

    <div class="actions">
        <a href="{{ route('menus.index') }}" class="btn btn-light">Kembali</a>
        <button type="submit" class="btn">{{ $menu->exists ? 'Update' : 'Simpan' }}</button>
    </div>
</form>

<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const file = event.target.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>