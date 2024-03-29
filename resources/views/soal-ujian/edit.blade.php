@extends('layouts.app')
@section('content')
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
                            <input type="text" class="form-control @error('jawaban_a') is-invalid @enderror"
                                id="jawaban_a" name="jawaban_a" value="{{ $soalUjian->jawaban_a }}">
                            @error('jawaban_a')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jawaban_b">Jawaban B</label>
                            <input type="text" class="form-control @error('jawaban_b') is-invalid @enderror"
                                id="jawaban_b" name="jawaban_b" value="{{ $soalUjian->jawaban_b }}">
                            @error('jawaban_b')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jawaban_c">Jawaban C</label>
                            <input type="text" class="form-control @error('jawaban_c') is-invalid @enderror"
                                id="jawaban_c" name="jawaban_c" value="{{ $soalUjian->jawaban_c }}">
                            @error('jawaban_c')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jawaban_d">Jawaban D</label>
                            <input type="text" class="form-control @error('jawaban_d') is-invalid @enderror"
                                id="jawaban_d" name="jawaban_d" value="{{ $soalUjian->jawaban_d }}">
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
@endpush

@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush
