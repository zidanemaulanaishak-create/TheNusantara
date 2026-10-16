@extends('layouts.admin')
@section('title', ($editData ? 'Edit' : 'Tambah') . ' Tentang - The Nusantara')
@section('content')
<style>
    <style>* {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .ft-page {
        max-width: 680px;
        margin: 0 auto;
        padding: 1.5rem 0;
    }

    .ft-back-link {
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

    .ft-back-link:hover {
        opacity: .7;
    }

    .ft-form-header {
        margin-bottom: 1.5rem;
    }

    .ft-form-header h1 {
        font-size: 20px;
        font-weight: 500;
        color: #3d1b08;
        margin-bottom: 3px;
    }

    .ft-form-header p {
        font-size: 16px;
        color: #58290d9f;
    }

    .ft-card {
        background: #fefefe;
        border-radius: 14px;
        border: 1.5px solid #58290D;
        padding: 32px 36px;
        margin-bottom: 14px;
    }

    .ft-section-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        color: #58290D;
        margin-bottom: 20px;
    }

    .ft-section-label::after {
        content: '';
        flex: 1;
        height: 0.5px;
        background: #58290D;
    }

    .ft-field {
        margin-bottom: 22px;
    }

    .ft-field:last-child {
        margin-bottom: 0;
    }

    .ft-field label {
        display: block;
        font-size: 16px;
        font-weight: 500;
        color: #58290D;
        margin-bottom: 6px;
    }

    .ft-req {
        color: #58290D;
    }

    .ft-field input[type=text],
    .ft-field input[type=date],
    .ft-field textarea {
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

    .ft-field input[type=text]:focus,
    .ft-field input[type=date]:focus,
    .ft-field textarea:focus {
        border-bottom-color: #58290D;
    }

    .ft-field input::placeholder,
    .ft-field textarea::placeholder {
        color: #58290da9;
    }

    .ft-char-count {
        font-size: 11px;
        color: #58290D;
        text-align: right;
        margin-top: 3px;
    }

    .ft-drop {
        border: 0.5px dashed #58290D;
        border-radius: 10px;
        padding: 24px;
        text-align: center;
        cursor: pointer;
        background: #fffaf5;
        transition: border-color .2s, background .2s;
        margin-bottom: 16px;
    }

    .ft-drop:hover,
    .ft-drop.over {
        border-color: #58290D;
        background: #faf0e4;
    }

    .ft-drop i {
        font-size: 26px;
        color: #58290D;
        display: block;
        margin-bottom: 8px;
    }

    .ft-drop p {
        font-size: 14px;
        color: #58290D;
        font-weight: 500;
        margin-bottom: 3px;
    }

    .ft-drop small {
        font-size: 11px;
        color: #58290da9;
    }

    .ft-preview-row {
        display: flex;
        gap: 10px;
        margin-bottom: 8px;
        flex-wrap: wrap;
    }

    .ft-preview-item {
        position: relative;
        flex: 1;
        min-width: 90px;
        max-width: 160px;
    }

    .ft-preview-item img {
        width: 100%;
        height: 88px;
        object-fit: cover;
        border-radius: 8px;
        display: block;
        border: 0.5px solid #58290D;
    }

    .ft-preview-item span {
        display: block;
        font-size: 11px;
        color: #58290D;
        text-align: center;
        margin-top: 4px;
    }

    .ft-preview-remove {
        position: absolute;
        top: 4px;
        right: 4px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: rgba(88, 41, 13, 0.7);
        color: #fff;
        border: none;
        cursor: pointer;
        font-size: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .ft-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 8px;
    }

    .ft-btn-save {
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

    .ft-btn-save:hover {
        background: #3d1b08;
    }

    .ft-btn-cancel {
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

    .ft-btn-cancel:hover {
        border-color: #3a1a08;
        background-color: #58290d4f;
        color: #58290D;
    }

    @media (max-width: 600px) {
        .ft-card {
            padding: 20px 16px;
        }
    }
</style>

@php $slots = ['gambar', 'gambar2', 'gambar3']; @endphp

<div class="main-content ft-page">

    <a href="{{ route('admin.tentang.index') }}" class="ft-back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke tentang
    </a>

    <div class="ft-form-header">
        <h1>{{ $editData ? 'Edit data tentang' : 'Tambah data tentang' }}</h1>
        <p>Isi formulir di bawah untuk {{ $editData ? 'memperbarui' : 'menambahkan' }} konten halaman Tentang.</p>
    </div>

    <form method="POST" action="{{ $editData ? route('admin.tentang.update', $editData['id']) : route('admin.tentang.store') }}"
        enctype="multipart/form-data" id="ftForm">
        @csrf
        @if($editData)
            @method('PUT')
            <input type="hidden" name="existing_gambar" id="existing_gambar"
                value="{{ $editData['gambar'] ?? '' }}">
            <input type="hidden" name="existing_gambar2" id="existing_gambar2"
                value="{{ $editData['gambar2'] ?? '' }}">
            <input type="hidden" name="existing_gambar3" id="existing_gambar3"
                value="{{ $editData['gambar3'] ?? '' }}">
        @endif

        <!-- GAMBAR -->
        <div class="ft-card">
            <div class="ft-section-label"><i class="fas fa-image"></i> Gambar</div>

            <div class="ft-drop" id="dropZone" onclick="document.getElementById('ftFileInput').click()"
                ondragover="event.preventDefault(); this.classList.add('over')"
                ondragleave="this.classList.remove('over')" ondrop="handleDrop(event)">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Pilih file atau drag &amp; drop di sini</p>
                <small>JPG, PNG atau WEBP, maks. 10MB (hingga 3 gambar)</small>
                <input type="file" id="ftFileInput" accept="image/*" multiple style="display:none"
                    onchange="handleFiles(this.files)">
            </div>

            <div class="ft-preview-row" id="previewRow">
                @php $no = 1; @endphp
                @foreach($slots as $i => $slot)
                    @if(!empty($editData[$slot]))
                        <div class="ft-preview-item" id="preview-{{ $i }}">
                            <img src="{{ asset('storage/foto/'.$editData[$slot]) }}" alt="Gambar {{ $no }}">
                            <button type="button" class="ft-preview-remove"
                                onclick="removeExisting({{ $i }}, '{{ $slot }}')">✕</button>
                            <span>Gambar {{ $no++ }}</span>
                        </div>
                    @endif
                @endforeach
            </div>

            <div style="display:none;">
                <input type="file" name="gambar" id="slot0" accept="image/*">
                <input type="file" name="gambar2" id="slot1" accept="image/*">
                <input type="file" name="gambar3" id="slot2" accept="image/*">
            </div>
        </div>

        <!-- KONTEN -->
        <div class="ft-card">
            <div class="ft-section-label"><i class="fas fa-align-left"></i> Konten</div>

            <div class="ft-field">
                <label>Judul <span class="ft-req">*</span></label>
                <input type="text" name="judul" placeholder="Masukkan judul konten"
                    value="{{ $editData['judul'] ?? '' }}" required>
            </div>

            <div class="ft-field">
                <label>Isi konten <span class="ft-req">*</span></label>
                <textarea name="isi" rows="2" placeholder="Tuliskan deskripsi atau isi konten tentang..."
                    oninput="ftCnt(this,'ft-cnt-isi');ftAuto(this)"
                    required>{{ $editData['isi'] ?? '' }}</textarea>
                <div class="ft-char-count" id="ft-cnt-isi">
                    {{ $editData ? mb_strlen($editData['isi'] ?? '') : 0 }} karakter
                </div>
            </div>
        </div>

        <!-- AKSI -->
        <div class="ft-actions">
            <a href="{{ route('admin.tentang.index') }}" class="ft-btn-cancel">
                <i class="fas fa-times"></i> Batal
            </a>
            <button type="submit" name="simpan" class="ft-btn-save">
                <i class="fas fa-save"></i> Simpan data
            </button>
        </div>

    </form>
</div>

@push('scripts')
<script>
    let newFiles = [null, null, null];

    function getPreviewCount() {
        return document.querySelectorAll('#previewRow .ft-preview-item').length;
    }

    function handleFiles(fileList) {
        Array.from(fileList).forEach(file => {
            const slot = newFiles.indexOf(null);
            if (slot === -1) { alert('Maksimal 3 gambar.'); return; }
            newFiles[slot] = file;
            renderNewPreview(slot, file);
            const dt = new DataTransfer();
            dt.items.add(file);
            document.getElementById('slot' + slot).files = dt.files;
        });
    }

    function handleDrop(e) {
        e.preventDefault();
        document.getElementById('dropZone').classList.remove('over');
        handleFiles(e.dataTransfer.files);
    }

    function renderNewPreview(slot, file) {
        const existing = document.getElementById('new-preview-' + slot);
        if (existing) existing.remove();
        const no = getPreviewCount() + 1;
        const row = document.getElementById('previewRow');
        const div = document.createElement('div');
        div.className = 'ft-preview-item';
        div.id = 'new-preview-' + slot;
        div.innerHTML = `
        <img src="${URL.createObjectURL(file)}" alt="Gambar ${no}">
        <button type="button" class="ft-preview-remove" onclick="removeNew(${slot})">✕</button>
        <span>Gambar ${no}</span>`;
        row.appendChild(div);
    }

    function removeNew(slot) {
        newFiles[slot] = null;
        document.getElementById('slot' + slot).value = '';
        const el = document.getElementById('new-preview-' + slot);
        if (el) el.remove();
        renumberPreviews();
    }

    function removeExisting(i, fieldName) {
        const el = document.getElementById('preview-' + i);
        const hidden = document.getElementById('existing_' + fieldName);
        if (el) el.remove();
        if (hidden) hidden.value = '';
        renumberPreviews();
    }

    function renumberPreviews() {
        document.querySelectorAll('#previewRow .ft-preview-item').forEach((item, idx) => {
            const span = item.querySelector('span');
            const img = item.querySelector('img');
            if (span) span.textContent = 'Gambar ' + (idx + 1);
            if (img) img.alt = 'Gambar ' + (idx + 1);
        });
    }

    function ftCnt(el, id) {
        document.getElementById(id).textContent = el.value.length + ' karakter';
    }

    function ftAuto(el) {
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
