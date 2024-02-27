<p class="my-0 p-title">DATA DIRI PENDAFTAR</p>
<hr>
<div class="form-group col-md-12 d-flex justify-content-start">
    <div class="col-md-6">
        <label for="foto">Foto</label><br>
        @if ($biodatas)
            @if ($biodatas->foto)
                <img id="foto-preview" class="mb-3 ml-3" src="{{ asset('storage/' . $biodatas->foto) }}" alt="foto"
                    style="width: 300px; height: 400px; object-fit: cover;">
            @else
                <img id="foto-preview" class="ml-3" src="{{ asset('assets/img/profile.jpg') }}" alt="foto-default"
                    style="width: 300px; height: 400px; object-fit: cover;">
                <p class="ml-4 mt-2 m-0 p-0 text-c">* Ukuran Foto 3x4</p>
                <p class="ml-4 m-0 p-0 text-c">* Ukuran file foto maksimal 2 MB (2048 KB)</p>
                <p class="ml-4 m-0 p-0 text-c">* Ekstensi (.png, .jpg, atau .jpeg)</p>
                <p class="ml-4 mb-2 m-0 p-0 text-c">* Foto Formal (Tidak diperbolehkan swa foto)</p>
            @endif
        @else
            <img id="foto-preview" class="ml-3" src="{{ asset('assets/img/profile.jpg') }}" alt="foto-default"
                style="width: 300px; height: 400px; object-fit: cover;">
            <p class="ml-4 mt-2 m-0 p-0 text-c">* Ukuran Foto 3x4</p>
            <p class="ml-4 m-0 p-0 text-c">* Ukuran file foto maksimal 2 MB (2048 KB)</p>
            <p class="ml-4 m-0 p-0 text-c">* Ekstensi (.png, .jpg, atau .jpeg)</p>
            <p class="ml-4 mb-2 m-0 p-0 text-c">* Foto Formal (Tidak diperbolehkan swa foto)</p>
        @endif
        <input type="file" id="foto" class="form-control @error('foto') is-invalid @enderror" name="foto"
            accept="image/*" {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
        @error('foto')
            <div class="invalid-feedback feed ml-3">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="form-group col-md-12 d-flex justify-content-start">
    <div class="col-md-6">
        <label for="ktp">KTP (Kartu Tanda Penduduk)</label><br>
        @if ($biodatas)
            @if ($biodatas->ktp)
                <img class="ml-3 mb-2" id="ktp-preview" src="{{ asset('storage/' . $biodatas->ktp) }}" alt="ktp"
                    style="width: 350px; height: 150px; object-fit: contain;">
                <p class="ml-4 m-0 p-0 text-b">* Ukuran file maksimal 2 MB (2048 KB)</p>
                <p class="ml-4 mb-2 m-0 p-0 text-b">* Ekstensi (.png, .jpg, atau .jpeg)</p>
            @else
                <img class="ml-3 mb-2" id="ktp-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                    alt="ktp-default" style="width: 350px; height: 150px; object-fit: contain;">
                <p class="ml-4 m-0 p-0 text-c">* Ukuran file maksimal 2 MB (2048 KB)</p>
                <p class="ml-4 mb-2 m-0 p-0 text-c">* Ekstensi (.png, .jpg, atau .jpeg)</p>
            @endif
        @else
            <img class="ml-3 mb-2" id="ktp-preview" src="{{ asset('assets/img/default-img.jpg') }}" alt="ktp-default"
                style="width: 350px; height: 150px; object-fit: contain;">
            <p class="ml-4 m-0 p-0 text-c">* Ukuran file maksimal 2 MB (2048 KB)</p>
            <p class="ml-4 mb-2 m-0 p-0 text-c">* Ekstensi (.png, .jpg, atau .jpeg)</p>
        @endif
        <input type="file" id="ktp" class="form-control @error('ktp') is-invalid @enderror" name="ktp"
            accept="image/*" {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
        @error('ktp')
            <div class="invalid-feedback feed ml-3">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="kartu_siswa">Kartu Siswa</label><br>
        @if ($biodatas)
            @if ($biodatas->kartu_siswa)
                <img class="ml-3 mb-2" id="kartu-siswa-preview" src="{{ asset('storage/' . $biodatas->kartu_siswa) }}"
                    alt="kartu-siswa" style="width: 350px; height: 150px; object-fit: contain;">
                <p class="ml-4 m-0 p-0 text-b">* Ukuran file maksimal 2 MB (2048 KB)</p>
                <p class="ml-4 mb-2 m-0 p-0 text-b">* Ekstensi (.png, .jpg, atau .jpeg)</p>
            @else
                <img class="ml-3 mb-2" id="kartu-siswa-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                    alt="kartu-siswa-default" style="width: 350px; height: 150px; object-fit: contain;">
                <p class="ml-4 m-0 p-0 text-c">* Ukuran file maksimal 2 MB (2048 KB)</p>
                <p class="ml-4 mb-2 m-0 p-0 text-c">* Ekstensi (.png, .jpg, atau .jpeg)</p>
            @endif
        @else
            <img class="ml-3 mb-2" id="kartu-siswa-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                alt="kartu-siswa-default" style="width: 350px; height: 150px; object-fit: contain;">
            <p class="ml-4 m-0 p-0 text-c">* Ukuran file maksimal 2 MB (2048 KB)</p>
            <p class="ml-4 mb-2 m-0 p-0 text-c">* Ekstensi (.png, .jpg, atau .jpeg)</p>
        @endif
        <input type="file" id="kartu_siswa" class="form-control @error('kartu_siswa') is-invalid @enderror"
            name="kartu_siswa" accept="image/*" {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
        @error('kartu_siswa')
            <div class="invalid-feedback feed ml-3">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="form-group col-md-12 d-flex justify-content-start">
    <div class="col-md-6">
        <label for="kk">Kartu Keluarga</label><br>
        @if ($biodatas)
            @if ($biodatas->kk)
                <img class="ml-3 mb-2" id="kk-preview" src="{{ asset('storage/' . $biodatas->kk) }}" alt="kk"
                    style="width: 350px; height: 150px; object-fit: contain;">
                <p class="ml-4 m-0 p-0 text-b">* Ukuran file maksimal 2 MB (2048 KB)</p>
                <p class="ml-4 mb-2 m-0 p-0 text-b">* Ekstensi (.png, .jpg, atau .jpeg)</p>
            @else
                <img class="ml-3 mb-2" id="kk-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                    alt="kk-default" style="width: 350px; height: 150px; object-fit: contain;">
                <p class="ml-4 m-0 p-0 text-c">* Ukuran file maksimal 2 MB (2048 KB)</p>
                <p class="ml-4 mb-2 m-0 p-0 text-c">* Ekstensi (.png, .jpg, atau .jpeg)</p>
            @endif
        @else
            <img class="ml-3 mb-2" id="kk-preview" src="{{ asset('assets/img/default-img.jpg') }}" alt="kk-default"
                style="width: 350px; height: 150px; object-fit: contain;">
            <p class="ml-4 m-0 p-0 text-c">* Ukuran file maksimal 2 MB (2048 KB)</p>
            <p class="ml-4 mb-2 m-0 p-0 text-c">* Ekstensi (.png, .jpg, atau .jpeg)</p>
        @endif
        <input type="file" id="kk" class="form-control @error('kk') is-invalid @enderror" name="kk"
            accept="image/*" {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
        @error('kk')
            <div class="invalid-feedback feed ml-3">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="form-group col-md-12 d-flex justify-content-start">
    <div class="col-md-6">
        <label for="">Nama Lengkap Pendaftar</label>
        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
            value="{{ $biodatas ? $biodatas->nama : '' }}" placeholder="masukkan nama lengkap anda"
            {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
        @error('nama')
            <div class="invalid-feedback feed ml-3">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="">Asal Sekolah</label>
        <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror" id="asal_sekolah"
            name="asal_sekolah" value="{{ old('asal_sekolah', $biodatas ? $biodatas->asal_sekolah : '') }}"
            placeholder="masukkan asal sekolah anda" {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
        @error('asal_sekolah')
            <div class="invalid-feedback feed ml-3">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="form-group col-md-12 d-flex">
    <div class="col-md-6">
        <label for="">Kota Lahir</label>
        <input type="text" class="form-control @error('kota_lahir') is-invalid @enderror" id="kota_lahir"
            name="kota_lahir" value="{{ old('kota_lahir', $biodatas ? $biodatas->kota_lahir : '') }}"
            placeholder="masukkan kota lahir anda" {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
        @error('kota_lahir')
            <div class="invalid-feedback feed ml-3">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
            value="{{ old('tgl_lahir', $biodatas ? $biodatas->tgl_lahir : '') }}"
            {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
    </div>
</div>
<div class="form-group col-md-12 d-flex">
    <div class="col-md-6">
        <label for="">NIK</label>
        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik"
            value="{{ old('nik', $biodatas ? $biodatas->nik : '') }}" placeholder="masukkan nik anda"
            {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
        @error('nik')
            <div class="invalid-feedback feed ml-3">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="">NISN</label>
        <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn"
            value="{{ old('nisn', $biodatas ? $biodatas->nisn : '') }}" placeholder="masukkan nisn anda"
            {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
        @error('nisn')
            <div class="invalid-feedback feed ml-3">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="form-group col-md-12 d-flex">
    <div class="col-md-6">
        <label for="">No Telepon</label>
        <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp"
            name="no_telp" value="{{ old('no_telp', $biodatas ? $biodatas->no_telp : '') }}"
            placeholder="masukan nomer telepon anda" {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
        @error('no_telp')
            <div class="invalid-feedback feed ml-3">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="">Jenis Kelamin</label>
        <select class="form-control select2" name="gender" id="gender"
            {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
            <option value="">-- Pilih jenis kelamin --</option>
            <option value="Laki-laki" {{ isset($biodatas) && $biodatas->gender === 'Laki-laki' ? 'selected' : '' }}>
                Laki-laki
            </option>
            <option value="Perempuan" {{ isset($biodatas) && $biodatas->gender === 'Perempuan' ? 'selected' : '' }}>
                Perempuan
            </option>
        </select>
    </div>
</div>

@push('customScript')
    <script>
        $(document).ready(function() {
            $('#foto').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#foto-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#ktp').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#ktp-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#kartu_siswa').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#kartu-siswa-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#kk').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#kk-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>
@endpush
