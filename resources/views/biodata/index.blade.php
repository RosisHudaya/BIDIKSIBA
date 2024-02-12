@extends('landing-page.app')
@section('title', 'BIDIKSIBA POLINEMA | Biodata Pendaftar')
@push('style')
    <link rel="stylesheet" href="/assets/css/public.css">
@endpush
@section('main')
    <div class="col-md-11 mx-auto text-justify my-4">
        <p class="p-main-title mb-0 py-1 px-3">BIODATA PENDAFTAR</p>
        <div class="p-main py-1 px-3">
            <form action="{{ route('biodata.storeOrUpdate') }}" method="post">
                <div class="py-3">
                    <p class="my-0 p-title">DATA DIRI PENDAFTAR</p>
                    <hr>
                    <div class="form-group col-md-12 d-flex justify-content-start">
                        <div class="col-md-6">
                            <label for="">Nama Lengkap Pendaftar</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ $biodatas ? $biodatas->nama : '' }}"
                                placeholder="masukkan nama lengkap anda">
                            @error('nama')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="">Asal Sekolah</label>
                            <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror"
                                id="asal_sekolah" name="asal_sekolah" value="{{ $biodatas ? $biodatas->asal_sekolah : '' }}"
                                placeholder="masukkan asal sekolah anda">
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
                            <input type="text" class="form-control @error('kota_lahir') is-invalid @enderror"
                                id="kota_lahir" name="kota_lahir" value="{{ $biodatas ? $biodatas->kota_lahir : '' }}"
                                placeholder="masukkan kota lahir anda">
                            @error('kota_lahir')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                value="{{ $biodatas ? $biodatas->tgl_lahir : '' }}">
                        </div>
                    </div>
                    <div class="form-group col-md-12 d-flex">
                        <div class="col-md-6">
                            <label for="">NIK</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik"
                                name="nik" value="{{ $biodatas ? $biodatas->nik : '' }}"
                                placeholder="masukkan nik anda">
                            @error('nik')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="">NISN</label>
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn"
                                name="nisn" value="{{ $biodatas ? $biodatas->nisn : '' }}"
                                placeholder="masukkan nisn anda">
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
                                name="no_telp" value="{{ $biodatas ? $biodatas->no_telp : '' }}"
                                placeholder="masukan nomer telepon anda">
                            @error('no_telp')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="">Jenis Kelamin</label>
                            <select class="form-control select2" name="gender" id="gender">
                                <option value="">-- Pilih jenis kelamin --</option>
                                <option value="Laki-laki"
                                    {{ isset($biodatas) && $biodatas->gender === 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="Perempuan"
                                    {{ isset($biodatas) && $biodatas->gender === 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="pb-3">
                    <p class="my-0 p-title">JURUSAN PILIHAN</p>
                    <hr>
                    <div class="col-md-12 d-flex">
                        <div class="form-group col-md-6">
                            <label for="">Jurusan SMA/SMK</label>
                            <select class="form-control select2" name="asal_jurusan_id" data-id="select-asal-jurusan"
                                id="asal_jurusan_id">
                                <option value="">-- Pilih jurusan SMA/SMK --</option>
                                @foreach ($asalJurusans as $asalJurusan)
                                    @if (!empty($biodatas->id_asal_jurusan))
                                        <option @selected($biodatas->id_asal_jurusan == $asalJurusan->id) value="{{ $asalJurusan->id }}">
                                            {{ $asalJurusan->asal_jurusan }}
                                        </option>
                                    @else
                                        <option value="{{ $asalJurusan->id }}">
                                            {{ $asalJurusan->asal_jurusan }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex">
                        <div class="form-group col-md-6">
                            <label for="">Jurusan Pilihan</label>
                            <select class="form-control select2" name="jurusan_id" data-id="select-jurusan"
                                id="jurusan_id">
                                <option value="">-- Pilih jurusan --</option>
                            </select>
                        </div>
                        <div class=" form-group col-md-6">
                            <label for="">Program Studi Pilihan</label>
                            <select class="form-control select2" name="prodi_id" data-id="select-prodi" id="prodi_id">
                                <option value="">-- Pilih program studi --</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mr-4 text-right">
                    <button class="btn btn-save px-5">Simpan</button>
                </div>
            </form>

            <div class="pb-3">
                <p class="my-0 p-title">DATA PENDUKUNG</p>
                <hr>
                <div class="col-md-12 d-flex">
                    <div class="form-group col-md-6">
                        <label for="">Pekerjaan Orang Tua</label>
                        <select class="form-control select2" name="" id="">
                            <option value="">-- Pilih pekerjaan orang tua --</option>
                            <option value="">Tidak Bekerja</option>
                            <option value="">Honorer</option>
                            <option value="">Serabutan</option>
                            <option value="">Wiraswasta</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Detail Pekerjaan</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 d-flex">
                    <div class="form-group col-md-6">
                        <label for="">Penghasilan Orang Tua</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Luas Tanah</label>
                        <input type="number" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 d-flex">
                    <div class="form-group col-md-6">
                        <label for="">Bukti Slip Gaji</label>
                        <input type="file" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Bukti SHM (Surat Hak Milik) Tanah</label>
                        <input type="file" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 d-flex">
                    <div class="form-group col-md-6">
                        <label for="">Jumlah Kamar</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Kepemilikan Kamar Mandi</label>
                        <select class="form-control select2" name="" id="">
                            <option value="">-- Pilih --</option>
                            <option value="">Memiliki</option>
                            <option value="">Tidak Memilki</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 d-flex">
                    <div class="form-group col-md-6">
                        <label for="">Bukti Foto Kamar</label>
                        <input type="file" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Bukti Foto Kamar Mandi</label>
                        <input type="file" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 d-flex">
                    <div class="form-group col-md-6">
                        <label for="">Listrik yang digunakan</label>
                        <select class="form-control select2" name="" id="">
                            <option value="">-- Pilih --</option>
                            <option value="">Tidak Memiliki</option>
                            <option value="">Listrik 450 watt</option>
                            <option value="">Listrik 900 watt</option>
                            <option value="">Listrik 1300 watt</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Pajak Bumi dan Bangunan</label>
                        <input type="number" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 d-flex">
                    <div class="form-group col-md-6">
                        <label for="">Bukti Tagihan Listrik</label>
                        <input type="file" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Bukti Slip Pajak Bumi dan Bangunan</label>
                        <input type="file" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 d-flex">
                    <div class="form-group col-md-6">
                        <label for="">Jumlah Saudara</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Status Orang Tua</label>
                        <select class="form-control select2" name="" id="">
                            <option value="">-- Pilih --</option>
                            <option value="">Yatim Piatu</option>
                            <option value="">Yatim</option>
                            <option value="">Piatu</option>
                            <option value="">Tidak Semuanya</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 d-flex">
                    <div class="form-group col-md-6">
                        <label for="">Bukti Surat Ket Saudara</label>
                        <input type="file" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Bukti Surat Ket Yatim</label>
                        <input type="file" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 d-flex mb-4">
                    <div class="form-group col-md-6">
                        <label for="">Jumlah Hutang</label>
                        <input type="number" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('customScript')
    <script>
        var getJurusansRoute = '{{ route('getJurusans') }}';
        var getProdisRoute = '{{ route('getProdis') }}';
        var selectAsalJurusanId =
            "{{ $biodatas ? $biodatas->id_asal_jurusan : '' }}";
        var selectJurusan =
            "{{ $biodatas ? $biodatas->id_jurusan : '' }}";
        var selectJurusanId = "{{ $biodatas ? $biodatas->id_jurusan : '' }}";
        var selectProdi = "{{ $biodatas ? $biodatas->id_prodi : '' }}";
    </script>

    <script src="/assets/js/select2.min.js"></script>
    <script src="/assets/js/pendidikan.js"></script>
@endpush

@push('style')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush
