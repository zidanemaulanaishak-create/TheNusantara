@extends('layouts.admin')
@section('title', ($edit ? 'Edit' : 'Tambah') . ' Informasi - The Nusantara')
@section('content')
<style>
    .ki-form-page {
        max-width: 720px;
        margin: 0 auto;
        padding: 1.5rem 0;
    }

    .ki-back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 16px;
        font-weight: 500;
        color: #58290D;
        text-decoration: none;
        margin-bottom: 1.5rem;
        transition: opacity .2s;
    }

    .ki-back-link:hover { opacity: .7; }

    .ki-form-header { margin-bottom: 1.5rem; }

    .ki-form-header h1 {
        font-size: 20px;
        font-weight: 500;
        color: #3d1b08;
        margin-bottom: 3px;
    }

    .ki-form-header p {
        font-size: 16px;
        color: #58290d9f;
    }

    .ki-card {
        background: #fefefe;
        border-radius: 14px;
        border: 1.5px solid #58290D;
        padding: 32px 36px;
        margin-bottom: 14px;
    }

    .ki-section-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        color: #58290D;
        margin-bottom: 20px;
    }

    .ki-section-label::after {
        content: '';
        flex: 1;
        height: 0.5px;
        background: #58290D;
    }

    .ki-form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }

    .ki-field { margin-bottom: 22px; }
    .ki-field:last-child { margin-bottom: 0; }

    .ki-field label {
        display: block;
        font-size: 16px;
        font-weight: 500;
        color: #58290D;
        margin-bottom: 6px;
    }

    .ki-req { color: #58290D; }

    .ki-field input[type=text],
    .ki-field select,
    .ki-field textarea {
        width: 100%;
        padding: 0 0 10px 0;
        border: none;
        border-bottom: 1.5px solid #58290D;
        border-radius: 0;
        font-size: 14px;
        color: #58290D;
        background: transparent;
        outline: none;
        transition: border-color .2s;
        font-family: inherit;
        resize: none;
    }

    .ki-field input[type=text]:focus,
    .ki-field select:focus,
    .ki-field textarea:focus {
        border-bottom-color: #58290D;
    }

    .ki-field input[type=text]::placeholder,
    .ki-field textarea::placeholder {
        color: #58290da9;
    }

    .ki-field select {
        appearance: none;
        -webkit-appearance: none;
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2358290D' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 4px center;
    }

    .ki-char-count {
        font-size: 11px;
        color: #58290D;
        text-align: right;
        margin-top: 3px;
    }

    .ki-hint {
        font-size: 11px;
        color: #58290D;
        margin-top: 2px;
    }

    .ki-upload-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .ki-upload-slot {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .ki-slot-label {
        font-size: 14px;
        font-weight: 500;
        color: #58290D;
    }

    .ki-slot-label span {
        color: #58290D;
        border-radius: 4px;
        padding: 1px 5px;
        font-size: 14px;
    }

    .ki-preview-box {
        width: 100%;
        height: 140px;
        border-radius: 8px;
        background: #fffaf5;
        border: 0.5px dashed #58290D;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #58290da9;
        overflow: hidden;
        transition: border-color .2s;
    }

    .ki-preview-box:hover { border-color: #58290D; }

    .ki-preview-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .ki-preview-box.contain img {
        object-fit: contain;
        padding: 8px;
    }

    .ki-upload-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        padding: 6px 0;
        border: none;
        border-bottom: 1.5px solid #58290D;
        background: transparent;
        color: #58290D;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: border-color .2s;
        font-family: inherit;
        width: 100%;
    }

    .ki-upload-btn:hover { border-bottom-color: #58290D; }

    .ki-caption-inp {
        width: 100%;
        padding: 5px 0;
        border: none;
        border-bottom: 1px solid #58290D;
        font-size: 13px;
        color: #58290D;
        background: transparent;
        outline: none;
        font-family: inherit;
    }

    .ki-caption-inp::placeholder { color: #58290da9; }
    .ki-caption-inp:focus { border-bottom-color: #58290D; }

    .ki-hapus-check {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: #c0392b;
        margin-top: 2px;
    }

    .ki-hapus-check input { width: auto; }

    .ki-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 8px;
    }

    .ki-btn-save {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 28px;
        background: #58290D;
        color: #fefefe;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        font-family: inherit;
        transition: background .2s;
    }

    .ki-btn-save:hover { background: #3d1b08; }

    .ki-btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 18px;
        background: transparent;
        color: #58290D;
        border: 0.5px solid #58290D;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        font-family: inherit;
        text-decoration: none;
        transition: all .2s;
    }

    .ki-btn-cancel:hover {
        border-color: #3a1a08;
        background-color: #58290d4f;
        color: #58290D;
    }

    @media (max-width: 600px) {
        .ki-card { padding: 20px 16px; }
        .ki-form-row { grid-template-columns: 1fr; }
        .ki-upload-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="main-content ki-form-page">

    <a href="{{ route('admin.informasi.index') }}" class="ki-back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke daftar
    </a>

    <div class="ki-form-header">
        <h1>{{ $edit ? 'Edit informasi' : 'Tambah informasi' }}</h1>
        <p>{!! $edit
            ? 'Ubah data: <strong>' . e($editData['judul']) . '</strong>'
            : 'Isi formulir di bawah untuk menambahkan informasi permainan baru.' !!}</p>
    </div>

    <form method="POST" action="{{ $edit ? route('admin.informasi.update', $editData['id']) : route('admin.informasi.store') }}"
        enctype="multipart/form-data">
        @csrf
        @if($edit)
            @method('PUT')
        @endif

        <!-- INFO DASAR -->
        <div class="ki-card">
            <div class="ki-section-label"><i class="fas fa-clipboard-list"></i> Informasi dasar</div>
            <div class="ki-form-row">
                <div class="ki-field">
                    <label>Judul permainan <span class="ki-req">*</span></label>
                    <input type="text" name="judul"
                        value="{{ $edit ? $editData['judul'] : '' }}"
                        placeholder="Masukkan judul permainan..." required>
                </div>
                <div class="ki-field">
                    <label>Pulau <span class="ki-req">*</span></label>
                    <select name="pulau" required>
                        <option value="">Pilih pulau...</option>
                        @foreach($pulauOptions as $p)
                            <option value="{{ $p['nama'] }}" {{ ($edit && $editData['pulau'] == $p['nama']) ? 'selected' : '' }}>
                                {{ $p['nama'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- KONTEN -->
        <div class="ki-card">
            <div class="ki-section-label"><i class="fas fa-align-left"></i> Konten</div>

            <div class="ki-field">
                <label>Pengertian <span class="ki-req">*</span></label>
                <textarea name="pengertian" rows="2"
                    placeholder="Tulis pengertian permainan..."
                    oninput="kiCnt(this,'cnt-pengertian');kiAuto(this)"
                    required>{{ $edit ? ($editData['pengertian'] ?? '') : '' }}</textarea>
                <div class="ki-char-count" id="cnt-pengertian">
                    {{ $edit ? mb_strlen($editData['pengertian'] ?? '') : 0 }} karakter
                </div>
            </div>

            <div class="ki-field">
                <label>Cara bermain <span class="ki-req">*</span></label>
                <textarea name="cara_bermain" rows="2"
                    placeholder="Tulis cara bermain..."
                    oninput="kiCnt(this,'cnt-cara');kiAuto(this)"
                    required>{{ $edit ? ($editData['cara_bermain'] ?? '') : '' }}</textarea>
                <div class="ki-char-count" id="cnt-cara">
                    {{ $edit ? mb_strlen($editData['cara_bermain'] ?? '') : 0 }} karakter
                </div>
            </div>

            <div class="ki-form-row">
                <div class="ki-field">
                    <label>Filosofi</label>
                    <textarea name="filosofi" rows="2"
                        placeholder="Tulis filosofi permainan..."
                        oninput="kiCnt(this,'cnt-fil');kiAuto(this)">{{ $edit ? ($editData['filosofi'] ?? '') : '' }}</textarea>
                    <div class="ki-char-count" id="cnt-fil">
                        {{ $edit ? mb_strlen($editData['filosofi'] ?? '') : 0 }} karakter
                    </div>
                </div>
                <div class="ki-field">
                    <label>Asal usul</label>
                    <textarea name="asal_usul" rows="2"
                        placeholder="Tulis asal usul permainan..."
                        oninput="kiCnt(this,'cnt-asal');kiAuto(this)">{{ $edit ? ($editData['asal_usul'] ?? '') : '' }}</textarea>
                    <div class="ki-char-count" id="cnt-asal">
                        {{ $edit ? mb_strlen($editData['asal_usul'] ?? '') : 0 }} karakter
                    </div>
                </div>
            </div>

            <div class="ki-field">
                <label>Keterangan singkat</label>
                <textarea name="keterangan" rows="2"
                    placeholder="Keterangan yang ditampilkan di kartu..."
                    oninput="kiCnt(this,'cnt-ket');kiAuto(this)">{{ $edit ? ($editData['keterangan'] ?? '') : '' }}</textarea>
                <div class="ki-char-count" id="cnt-ket">
                    {{ $edit ? mb_strlen($editData['keterangan'] ?? '') : 0 }} karakter
                </div>
            </div>
        </div>

        <!-- GAMBAR -->
        <div class="ki-card">
            <div class="ki-section-label"><i class="fas fa-image"></i> Gambar</div>
            <p style="font-size:12px;color:#9c7355;margin-bottom:16px">
                Gambar utama wajib diisi saat tambah data. Maks. 3 MB per gambar (JPG, PNG, GIF).
            </p>
            <div class="ki-upload-grid">

                <!-- Utama -->
                <div class="ki-upload-slot">
                    <div class="ki-slot-label">Utama <span>wajib</span></div>
                    <div class="ki-preview-box" id="prev-gambar">
                        @if($edit && !empty($editData['gambar']))
                            <img src="{{ asset('storage/foto/'.$editData['gambar']) }}" alt="preview">
                        @else
                            <i class="fas fa-image" style="font-size:26px;opacity:.4"></i>
                        @endif
                    </div>
                    <label class="ki-upload-btn">
                        <i class="fas fa-upload" style="font-size:11px"></i> Pilih foto
                        <input type="file" name="gambar" accept="image/*"
                            style="display:none"
                            {{ (!$edit) ? 'required' : '' }}
                            onchange="kiPrev(this,'prev-gambar')">
                    </label>
                    @if($edit)
                        <span class="ki-hint">Kosongkan jika tidak ingin mengganti.</span>
                    @endif
                </div>

                <!-- Tambahan 1 -->
                <div class="ki-upload-slot">
                    <div class="ki-slot-label">Tambahan 1</div>
                    <div class="ki-preview-box" id="prev-gambar2">
                        @if($edit && !empty($editData['gambar2']))
                            <img src="{{ asset('storage/foto/'.$editData['gambar2']) }}" alt="preview">
                        @else
                            <i class="fas fa-plus" style="font-size:22px;opacity:.35"></i>
                        @endif
                    </div>
                    <label class="ki-upload-btn">
                        <i class="fas fa-upload" style="font-size:11px"></i> Pilih foto
                        <input type="file" name="gambar2" accept="image/*"
                            style="display:none" onchange="kiPrev(this,'prev-gambar2')">
                    </label>
                    @if($edit && !empty($editData['gambar2']))
                        <label class="ki-hapus-check">
                            <input type="checkbox" name="hapus_gambar2"> Hapus gambar ini
                        </label>
                    @endif
                    <input class="ki-caption-inp" type="text" name="caption2"
                        placeholder="Caption..."
                        value="{{ $edit ? ($editData['caption2'] ?? '') : '' }}">
                </div>

                <!-- Tambahan 2 -->
                <div class="ki-upload-slot">
                    <div class="ki-slot-label">Tambahan 2</div>
                    <div class="ki-preview-box" id="prev-gambar3">
                        @if($edit && !empty($editData['gambar3']))
                            <img src="{{ asset('storage/foto/'.$editData['gambar3']) }}" alt="preview">
                        @else
                            <i class="fas fa-plus" style="font-size:22px;opacity:.35"></i>
                        @endif
                    </div>
                    <label class="ki-upload-btn">
                        <i class="fas fa-upload" style="font-size:11px"></i> Pilih foto
                        <input type="file" name="gambar3" accept="image/*"
                            style="display:none" onchange="kiPrev(this,'prev-gambar3')">
                    </label>
                    @if($edit && !empty($editData['gambar3']))
                        <label class="ki-hapus-check">
                            <input type="checkbox" name="hapus_gambar3"> Hapus gambar ini
                        </label>
                    @endif
                    <input class="ki-caption-inp" type="text" name="caption3"
                        placeholder="Caption..."
                        value="{{ $edit ? ($editData['caption3'] ?? '') : '' }}">
                </div>

                <!-- Tambahan 3 -->
                <div class="ki-upload-slot">
                    <div class="ki-slot-label">Tambahan 3</div>
                    <div class="ki-preview-box" id="prev-gambar4">
                        @if($edit && !empty($editData['gambar4']))
                            <img src="{{ asset('storage/foto/'.$editData['gambar4']) }}" alt="preview">
                        @else
                            <i class="fas fa-plus" style="font-size:22px;opacity:.35"></i>
                        @endif
                    </div>
                    <label class="ki-upload-btn">
                        <i class="fas fa-upload" style="font-size:11px"></i> Pilih foto
                        <input type="file" name="gambar4" accept="image/*"
                            style="display:none" onchange="kiPrev(this,'prev-gambar4')">
                    </label>
                    @if($edit && !empty($editData['gambar4']))
                        <label class="ki-hapus-check">
                            <input type="checkbox" name="hapus_gambar4"> Hapus gambar ini
                        </label>
                    @endif
                    <input class="ki-caption-inp" type="text" name="caption4"
                        placeholder="Caption..."
                        value="{{ $edit ? ($editData['caption4'] ?? '') : '' }}">
                </div>

            </div>
        </div>

        <!-- AKSI -->
        <div class="ki-actions">
            <a href="{{ route('admin.informasi.index') }}" class="ki-btn-cancel">
                <i class="fas fa-times"></i> Batal
            </a>
            <button type="submit" name="{{ $edit ? 'update' : 'tambah' }}" class="ki-btn-save">
                <i class="fas fa-save"></i> {{ $edit ? 'Simpan perubahan' : 'Tambah data' }}
            </button>
        </div>

    </form>
</div>

@push('scripts')
<script>
    function kiPrev(input, id) {
        if (!input.files || !input.files[0]) return;
        const box = document.getElementById(id);
        box.innerHTML = '';
        const img = document.createElement('img');
        img.src = URL.createObjectURL(input.files[0]);
        box.appendChild(img);
    }
    function kiCnt(el, id) {
        document.getElementById(id).textContent = el.value.length + ' karakter';
    }
    function kiAuto(el) {
        el.style.height = 'auto';
        el.style.height = el.scrollHeight + 'px';
    }

    // Init auto-height untuk mode edit
    document.querySelectorAll('textarea').forEach(ta => {
        if (ta.value) {
            ta.style.height = 'auto';
            ta.style.height = ta.scrollHeight + 'px';
        }
    });
</script>
@endpush
@endsection
