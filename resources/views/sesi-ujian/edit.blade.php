@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Sesi Ujian</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <form action="{{ route('sesi-ujian.update', $sesiUjian) }}" method="POST">
                    <div class="card-header">
                        <h4>Validasi Edit Data Sesi Ujian</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="id_ujian">Ujian</label>
                            <select class="form-control select2 @error('id_ujian') is-invalid @enderror" name="id_ujian"
                                data-id="select-ujian" id="id_ujian">
                                <option value="">-- Pilih ujian --</option>
                                @foreach ($ujians as $ujian)
                                    <option @selected($ujian->id == $sesiUjian->id_ujian) value="{{ $ujian->id }}"
                                        {{ old('id_ujian') == $ujian->id ? 'selected' : '' }}>
                                        {{ $ujian->nama_ujian }}</option>
                                @endforeach
                            </select>
                            @error('id_ujian')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_sesi">Nama Ujian</label>
                            <input type="text" class="form-control @error('nama_sesi') is-invalid @enderror"
                                id="nama_sesi" name="nama_sesi" value="{{ $sesiUjian->nama_sesi }}">
                            @error('nama_sesi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="waktu_mulai">Waktu Mulai</label>
                            <input type="datetime-local" class="form-control @error('waktu_mulai') is-invalid @enderror"
                                id="waktu_mulai" name="waktu_mulai" value="{{ $sesiUjian->waktu_mulai }}">
                            @error('waktu_mulai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="waktu_akhir">Waktu Selesai</label>
                            <input type="datetime-local" class="form-control @error('waktu_akhir') is-invalid @enderror"
                                id="waktu_akhir" name="waktu_akhir" value="{{ $sesiUjian->waktu_akhir }}">
                            @error('waktu_akhir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" href="{{ route('sesi-ujian.index') }}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('customScript')
    <script src="/assets/js/select2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startInput = document.getElementById('waktu_mulai');
            const endInput = document.getElementById('waktu_akhir');

            const now = new Date().toISOString().slice(0, 16);
            startInput.setAttribute('min', now);

            function setEndMinDate() {
                if (startInput.value) {
                    endInput.setAttribute('min', startInput.value);
                }
            }

            setEndMinDate();

            startInput.addEventListener('change', setEndMinDate);
        });
    </script>
@endpush

@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush
