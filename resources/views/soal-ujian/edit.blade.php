@extends('layouts.app')
@section('content')
    @php
        function isImageUrl($url)
        {
            return strpos($url, 'thumbnail?id=') !== false;
        }
    @endphp
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Soal Ujian</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <form action="{{ route('soal-ujian.update', [$soalUjian, $ujian]) }}" method="POST">
                    <div class="card-header">
                        <h4>Validasi Edit Data Soal Ujian</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        @if ($soalUjian->gambar)
                            <div class="form-group">
                                <label for="gambarl">Gambar</label><br>
                                <img class="mb-2" id="gambar-preview" src="{{ asset($soalUjian->gambar) }}" alt="gambar"
                                    style="width: 200px; height: 200px; object-fit: contain;"
                                    onerror="this.onerror=null;this.src='{{ asset($soalUjian->gambar) }}';"><br>
                                <input type="text" class="form-control @error('soal') is-invalid @enderror"
                                    id="gambar" name="gambar" placeholder="e.g https://acesse.one/LRP2X"
                                    value="{{ $soalUjian->gambar }}" oninput="previewGambar()">
                                @error('gambar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="soal">Soal</label>
                            <input type="text" class="form-control @error('soal') is-invalid @enderror" id="soal"
                                name="soal" value="{{ $soalUjian->soal }}">
                            @error('soal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jawaban_a">Jawaban A</label>
                            <div id="preview_jawaban_a" class="mb-2">
                                @if (isImageUrl($soalUjian->jawaban_a))
                                    <img src="{{ $soalUjian->jawaban_a }}" alt="preview"
                                        style="max-width: 200px; max-height: 200px; object-fit: contain;">
                                @endif
                            </div>
                            <input type="text" class="form-control @error('jawaban_a') is-invalid @enderror"
                                id="jawaban_a" name="jawaban_a" value="{{ $soalUjian->jawaban_a }}"
                                oninput="previewImage('jawaban_a', 'preview_jawaban_a')">
                            @error('jawaban_a')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jawaban_b">Jawaban B</label>
                            <div id="preview_jawaban_b" class="mb-2">
                                @if (isImageUrl($soalUjian->jawaban_b))
                                    <img src="{{ $soalUjian->jawaban_b }}" alt="preview"
                                        style="max-width: 200px; max-height: 200px; object-fit: contain;">
                                @endif
                            </div>
                            <input type="text" class="form-control @error('jawaban_b') is-invalid @enderror"
                                id="jawaban_b" name="jawaban_b" value="{{ $soalUjian->jawaban_b }}"
                                oninput="previewImage('jawaban_b', 'preview_jawaban_b')">
                            @error('jawaban_b')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jawaban_c">Jawaban C</label>
                            <div id="preview_jawaban_c" class="mb-2">
                                @if (isImageUrl($soalUjian->jawaban_c))
                                    <img src="{{ $soalUjian->jawaban_c }}" alt="preview"
                                        style="max-width: 200px; max-height: 200px; object-fit: contain;">
                                @endif
                            </div>
                            <input type="text" class="form-control @error('jawaban_c') is-invalid @enderror"
                                id="jawaban_c" name="jawaban_c" value="{{ $soalUjian->jawaban_c }}"
                                oninput="previewImage('jawaban_c', 'preview_jawaban_c')">
                            @error('jawaban_c')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jawaban_d">Jawaban D</label>
                            <div id="preview_jawaban_d" class="mb-2">
                                @if (isImageUrl($soalUjian->jawaban_d))
                                    <img src="{{ $soalUjian->jawaban_d }}" alt="preview"
                                        style="max-width: 200px; max-height: 200px; object-fit: contain;">
                                @endif
                            </div>
                            <input type="text" class="form-control @error('jawaban_d') is-invalid @enderror"
                                id="jawaban_d" name="jawaban_d" value="{{ $soalUjian->jawaban_d }}"
                                oninput="previewImage('jawaban_d', 'preview_jawaban_d')">
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
                                <option value="A" {{ $soalUjian->jawaban_benar === 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ $soalUjian->jawaban_benar === 'B' ? 'selected' : '' }}>B</option>
                                <option value="C" {{ $soalUjian->jawaban_benar === 'C' ? 'selected' : '' }}>C</option>
                                <option value="D" {{ $soalUjian->jawaban_benar === 'D' ? 'selected' : '' }}>D</option>
                            </select>
                            @error('jawaban_benar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" href="{{ route('soalUjian', ['ujian' => $ujian->id]) }}">Cancel</a>
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

        $(document).ready(function() {
            previewImage('jawaban_a', 'preview_jawaban_a');
            previewImage('jawaban_b', 'preview_jawaban_b');
            previewImage('jawaban_c', 'preview_jawaban_c');
            previewImage('jawaban_d', 'preview_jawaban_d');
        });

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
