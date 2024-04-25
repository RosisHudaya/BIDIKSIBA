@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Soal Ujian</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Validasi Tambah Data Soal Ujian</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('soal-ujian.store', $ujian) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="gambarl">Gambar</label><br>
                            <img class="mb-2" id="gambar-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                                alt="gambar" style="width: 200px; height: 200px; object-fit: contain;"
                                onerror="this.onerror=null;this.src='{{ asset('assets/img/default-img.jpg') }}';"><br>
                            <input type="text" class="form-control @error('soal') is-invalid @enderror" id="gambar"
                                name="gambar" placeholder="ex. https://acesse.one/LRP2X" value="{{ old('gambar') }}"
                                oninput="previewGambar()">
                            @error('gambar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="soal">Soal</label>
                            <input type="text" class="form-control @error('soal') is-invalid @enderror" id="soal"
                                name="soal" placeholder="Masukkan soal..." value="{{ old('soal') }}">
                            @error('soal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jawaban_a">Jawaban A</label>
                            <div id="preview_jawaban_a" class="mb-2"></div>
                            <input type="text" class="form-control @error('jawaban_a') is-invalid @enderror"
                                id="jawaban_a" name="jawaban_a" placeholder="Masukkan jawaban pilihan A..."
                                value="{{ old('jawaban_a') }}" oninput="previewImage('jawaban_a', 'preview_jawaban_a')">
                            @error('jawaban_a')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jawaban_b">Jawaban B</label>
                            <div id="preview_jawaban_b" class="mb-2"></div>
                            <input type="text" class="form-control @error('jawaban_b') is-invalid @enderror"
                                id="jawaban_b" name="jawaban_b" placeholder="Masukkan jawaban pilihan B..."
                                value="{{ old('jawaban_b') }}" oninput="previewImage('jawaban_b', 'preview_jawaban_b')">
                            @error('jawaban_b')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jawaban_c">Jawaban C</label>
                            <div id="preview_jawaban_c" class="mb-2"></div>
                            <input type="text" class="form-control @error('jawaban_c') is-invalid @enderror"
                                id="jawaban_c" name="jawaban_c" placeholder="Masukkan jawaban pilihan C..."
                                value="{{ old('jawaban_c') }}" oninput="previewImage('jawaban_c', 'preview_jawaban_c')">
                            @error('jawaban_c')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jawaban_d">Jawaban D</label>
                            <div id="preview_jawaban_d" class="mb-2"></div>
                            <input type="text" class="form-control @error('jawaban_d') is-invalid @enderror"
                                id="jawaban_d" name="jawaban_d" placeholder="Masukkan jawaban pilihan D..."
                                value="{{ old('jawaban_d') }}" oninput="previewImage('jawaban_d', 'preview_jawaban_d')">
                            @error('jawaban_d')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jawaban_benar">Jawaban Benar</label>
                            <select name="jawaban_benar" id="jawaban_benar"
                                class="form-control select2 @error('id_jurusan') is-invalid @enderror">
                                <option value="">-- Pilih jawaban benar --</option>
                                <option value="A" {{ old('jawaban_benar') === 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('jawaban_benar') === 'B' ? 'selected' : '' }}>B</option>
                                <option value="C" {{ old('jawaban_benar') === 'C' ? 'selected' : '' }}>C</option>
                                <option value="D" {{ old('jawaban_benar') === 'D' ? 'selected' : '' }}>D</option>
                            </select>
                            @error('jawaban_benar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <p class="m-0 p-0 text-c">* isikan jawaban benar sesui dengan jawaban pilihan A, B, C, atau D
                            </p>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                            <a class="btn btn-secondary"
                                href="{{ route('soalUjian', ['ujian' => $ujian->id]) }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
    </section>
@endsection
@push('customScript')
    <script src="/assets/js/select2.min.js"></script>
    <script>
        function previewGambar() {
            var linkGambar = $('#gambar').val();
            if (linkGambar.trim() === '') {
                $('#gambar-preview').attr('src', '{{ asset('assets/img/default-img.jpg') }}');
            } else {
                $('#gambar-preview').attr('src', linkGambar);
            }
        }

        function previewImage(inputId, previewId) {
            var inputValue = $('#' + inputId).val();
            var previewElement = $('#' + previewId);

            if (inputValue.trim() === '') {
                previewElement.empty();
                return;
            }

            if (isImageUrl(inputValue)) {
                previewElement.html('<img src="' + inputValue +
                    '" alt="preview" style="max-width: 200px; max-height: 200px; object-fit: contain;">');
            } else {
                previewElement.empty();
            }
        }

        function isImageUrl(url) {
            return url.includes('thumbnail?id=');
        }
    </script>
@endpush

@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush
