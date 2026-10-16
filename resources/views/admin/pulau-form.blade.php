@extends('layouts.admin')
@section('title', ($edit ? 'Edit' : 'Tambah') . ' Pulau - The Nusantara')
@section('content')
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .fp-page {
        max-width: 720px;
        margin: 0 auto;
        padding: 1.5rem 0;
    }

    .fp-back-link {
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

    .fp-back-link:hover {
        opacity: .7;
    }

    .fp-form-header {
        margin-bottom: 1.5rem;
    }

    .fp-form-header h1 {
        font-size: 20px;
        font-weight: 500;
        color: #3d1b08;
        margin-bottom: 3px;
    }

    .fp-form-header p {
        font-size: 16px;
        color: #58290d9f;
    }

    .fp-card {
        background: #fefefe;
        border-radius: 14px;
        border: 1.5px solid #58290D;
        padding: 32px 36px;
        margin-bottom: 14px;
    }

    .fp-section-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        color: #58290D;
        margin-bottom: 20px;
    }

    .fp-section-label::after {
        content: '';
        flex: 1;
        height: 0.5px;
        background: #58290D;
    }

    .fp-field {
        margin-bottom: 22px;
    }

    .fp-field:last-child {
        margin-bottom: 0;
    }

    .fp-field label {
        display: block;
        font-size: 16px;
        font-weight: 500;
        color: #58290D;
        margin-bottom: 6px;
    }

    .fp-req {
        color: #58290D;
    }

    .fp-field input[type=text],
    .fp-field textarea {
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

    .fp-field input[type=text]:focus,
    .fp-field textarea:focus {
        border-bottom-color: #58290D;
    }

    .fp-field input[type=text]::placeholder,
    .fp-field textarea::placeholder {
        color: #58290da9;
    }

    .fp-char-count {
        font-size: 11px;
        color: #58290D;
        text-align: right;
        margin-top: 3px;
    }

    .fp-upload-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .fp-upload-slot {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .fp-slot-label {
        font-size: 14px;
        font-weight: 500;
        color: #58290D;
    }

    .fp-slot-label span {
        background: #5\;
        color: #58290D;
        border-radius: 4px;
        padding: 1px 5px;
        font-size: 14px;
    }

    .fp-preview-box {
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

    .fp-preview-box:hover {
        border-color: #58290D;
    }

    .fp-preview-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .fp-preview-box.contain img {
        object-fit: contain;
        padding: 8px;
    }

    .fp-upload-btn {
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

    .fp-upload-btn:hover {
        border-bottom-color: #58290D;
    }

    .fp-hint {
        font-size: 11px;
        color: #58290D;
        margin-top: 2px;
    }

    .fp-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 8px;
    }

    .fp-btn-save {
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

    .fp-btn-save:hover {
        background: #3d1b08;
    }

    .fp-btn-cancel {
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

    .fp-btn-cancel:hover {
        border-color: #3a1a08;
        background-color: #58290d4f;
        color: #58290D;
    }

    @media (max-width: 600px) {
        .fp-card {
            padding: 20px 16px;
        }

        .fp-upload-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="main-content fp-page">

    <a href="{{ route('admin.pulau.index') }}" class="fp-back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke daftar
    </a>

    <div class="fp-form-header">
        <h1>{{ $edit ? 'Edit pulau' : 'Tambah pulau' }}</h1>
        <p>{!! $edit
            ? 'Ubah data pulau: <strong>' . e($editData['nama']) . '</strong>'
            : 'Isi formulir di bawah untuk menambahkan data pulau baru.' !!}</p>
    </div>

    <form method="POST" action="{{ $edit ? route('admin.pulau.update', $editData['id']) : route('admin.pulau.store') }}" enctype="multipart/form-data">
        @csrf
        @if($edit)
            @method('PUT')
        @endif

        <!-- INFO DASAR -->
        <div class="fp-card">
            <div class="fp-section-label"><i class="fas fa-map"></i> Informasi pulau</div>

            <div class="fp-field">
                <label>Nama pulau <span class="fp-req">*</span></label>
                <input type="text" name="nama" value="{{ $edit ? $editData['nama'] : '' }}"
                    placeholder="Contoh: Jawa, Bali, Sumatera..." required>
            </div>

            <div class="fp-field">
                <label>Keterangan <span class="fp-req">*</span></label>
                <textarea name="keterangan" rows="2" placeholder="Tulis keterangan singkat pulau..."
                    oninput="fpCnt(this,'cnt-ket');fpAuto(this)"
                    required>{{ $edit ? $editData['keterangan'] : '' }}</textarea>
                <div class="fp-char-count" id="cnt-ket">
                    {{ $edit ? mb_strlen($editData['keterangan'] ?? '') : 0 }} karakter
                </div>
            </div>

            <div class="fp-field">
                <label>Deskripsi <span class="fp-req">*</span></label>
                <textarea name="deskripsi" rows="2" placeholder="Tulis deskripsi lengkap pulau..."
                    oninput="fpCnt(this,'cnt-desk');fpAuto(this)"
                    required>{{ $edit ? $editData['deskripsi'] : '' }}</textarea>
                <div class="fp-char-count" id="cnt-desk">
                    {{ $edit ? mb_strlen($editData['deskripsi'] ?? '') : 0 }} karakter
                </div>
            </div>
        </div>

        <!-- GAMBAR -->
        <div class="fp-card">
            <div class="fp-section-label"><i class="fas fa-image"></i> Gambar</div>
            <p style="font-size:12px;color:#9c7355;margin-bottom:16px">
                Maks. 3 MB per gambar (JPG, PNG, GIF).
            </p>
            <div class="fp-upload-grid">

                <!-- Siluet -->
                <div class="fp-upload-slot">
                    <div class="fp-slot-label">Siluet pulau <span>peta</span></div>
                    <div class="fp-preview-box contain" id="prev-gambar">
                        @if($edit && !empty($editData['gambar']))
                            <img src="{{ asset('storage/foto/'.$editData['gambar']) }}" alt="preview">
                        @else
                            <i class="fas fa-map" style="font-size:28px;opacity:.4"></i>
                        @endif
                    </div>
                    <label class="fp-upload-btn">
                        <i class="fas fa-upload" style="font-size:11px"></i> Pilih foto
                        <input type="file" name="gambar" accept="image/*" style="display:none"
                            onchange="fpPrev(this,'prev-gambar')">
                    </label>
                    @if($edit)
                        <span class="fp-hint">Kosongkan jika tidak ingin mengganti.</span>
                    @endif
                </div>

                <!-- Hero -->
                <div class="fp-upload-slot">
                    <div class="fp-slot-label">Hero section <span>background</span></div>
                    <div class="fp-preview-box" id="prev-hero">
                        @if($edit && !empty($editData['herosection']))
                            <img src="{{ asset('storage/foto/'.$editData['herosection']) }}" alt="preview">
                        @else
                            <i class="fas fa-image" style="font-size:28px;opacity:.4"></i>
                        @endif
                    </div>
                    <label class="fp-upload-btn">
                        <i class="fas fa-upload" style="font-size:11px"></i> Pilih foto
                        <input type="file" name="herosection" accept="image/*" style="display:none"
                            onchange="fpPrev(this,'prev-hero')">
                    </label>
                    @if($edit)
                        <span class="fp-hint">Kosongkan jika tidak ingin mengganti.</span>
                    @endif
                </div>

            </div>
        </div>

        <!-- AKSI -->
        <div class="fp-actions">
            <a href="{{ route('admin.pulau.index') }}" class="fp-btn-cancel">
                <i class="fas fa-times"></i> Batal
            </a>
            <button type="submit" name="{{ $edit ? 'update' : 'tambah' }}" class="fp-btn-save">
                <i class="fas fa-save"></i> {{ $edit ? 'Simpan perubahan' : 'Tambah data' }}
            </button>
        </div>

    </form>
</div>

@push('scripts')
<script>
    function fpPrev(input, id) {
        if (!input.files || !input.files[0]) return;
        const box = document.getElementById(id);
        box.innerHTML = '';
        const img = document.createElement('img');
        img.src = URL.createObjectURL(input.files[0]);
        box.appendChild(img);
    }
    function fpCnt(el, id) {
        document.getElementById(id).textContent = el.value.length + ' karakter';
    }
    function fpAuto(el) {
        el.style.height = 'auto';
        el.style.height = el.scrollHeight + 'px';
    }
    document.querySelectorAll('textarea').forEach(ta => {
        if (ta.value) {
            ta.style.height = 'auto';
            ta.style.height = ta.scrollHeight + 'px';
        }
    });
</script>
@endpush
@endsection
