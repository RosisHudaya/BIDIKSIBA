<div class="col-md-12 d-flex">
    <div class="form-group col-md-6">
        <label for="">Pekerjaan Orang Tua</label>
        <select class="form-control select2" name="pekerjaan_ortu" id="pekerjaan_ortu">
            <option value="">-- Pilih pekerjaan orang tua --</option>
            <option value="Tidak Bekerja"
                {{ isset($biodata_spk) && $biodata_spk->pekerjaan_ortu === 'Tidak Bekerja' ? 'selected' : '' }}>
                Tidak Bekerja
            </option>
            <option value="Honorer"
                {{ isset($biodata_spk) && $biodata_spk->pekerjaan_ortu === 'Honorer' ? 'selected' : '' }}>
                Honorer
            </option>
            <option value="Serabutan"
                {{ isset($biodata_spk) && $biodata_spk->pekerjaan_ortu === 'Serabutan' ? 'selected' : '' }}>
                Serabutan
            </option>
            <option value="Wiraswasta"
                {{ isset($biodata_spk) && $biodata_spk->pekerjaan_ortu === 'Wiraswasta' ? 'selected' : '' }}>
                Wiraswasta
            </option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="">Detail Pekerjaan</label>
        <input type="text" value="{{ old('detail_pekerjaan', $biodata_spk ? $biodata_spk->detail_pekerjaan : '') }}"
            class="form-control @error('detail_pekerjaan') is-invalid @enderror" name="detail_pekerjaan"
            id="detail_pekerjaan" placeholder="e.g pemilik toko">
        @error('detail_pekerjaan')
            <div class="invalid-feedback feed ml-3">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="col-md-12 d-flex">
    <div class="form-group col-md-6">
        <label for="">Penghasilan Orang Tua</label>
        <input type="text" value="{{ old('gaji_ortu', $biodata_spk ? $biodata_spk->gaji_ortu : '') }}"
            class="form-control" name="gaji_ortu" id="gaji_ortu" placeholder="e.g 1.000.000">
    </div>
    <div class="form-group col-md-6">
        <label for="">Luas Tanah (satuan meter)</label>
        <input type="text" value="{{ old('luas_tanah', $biodata_spk ? $biodata_spk->luas_tanah : '') }}"
            class="form-control" name="luas_tanah" id="luas_tanah" placeholder="e.g 200">
    </div>
</div>
<div class="col-md-12 d-flex">
    <div class="form-group col-md-6">
        <label for="">Bukti Slip Gaji</label><br>
        @if ($biodata_spk)
            @if ($biodata_spk->slip_gaji)
                <img class="ml-3 mb-2" id="slip-gaji-preview" src="{{ asset('storage/' . $biodata_spk->slip_gaji) }}"
                    alt="slip-gaji" style="width: 350px; height: 150px; object-fit: contain;">
                <p class="ml-4 mb-2 m-0 p-0 text-b">
                    * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                </p>
            @else
                <img class="ml-3 mb-2" id="slip-gaji-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                    alt="slip-gaji" style="width: 350px; height: 150px; object-fit: contain;">
                <p class="ml-4 mb-2 m-0 p-0 text-c">
                    * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                </p>
            @endif
        @else
            <img class="ml-3 mb-2" id="slip-gaji-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                alt="slip-gaji" style="width: 350px; height: 150px; object-fit: contain;">
            <p class="ml-4 mb-2 m-0 p-0 text-c">
                * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
            </p>
        @endif
        <input type="file" name="slip-gaji" id="slip-gaji" class="form-control">
    </div>
    <div class="form-group col-md-6">
        <label for="">Bukti SHM (Surat Hak Milik) Tanah</label><br>
        @if ($biodata_spk)
            @if ($biodata_spk->shm)
                <img class="ml-3 mb-2" id="shm-preview" src="{{ asset('storage/' . $biodata_spk->shm) }}"
                    alt="shm" style="width: 350px; height: 150px; object-fit: contain;">
                <p class="ml-4 mb-2 m-0 p-0 text-b">
                    * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                </p>
            @else
                <img class="ml-3 mb-2" id="shm-preview" src="{{ asset('assets/img/default-img.jpg') }}" alt="shm"
                    style="width: 350px; height: 150px; object-fit: contain;">
                <p class="ml-4 mb-2 m-0 p-0 text-c">
                    * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                </p>
            @endif
        @else
            <img class="ml-3 mb-2" id="shm-preview" src="{{ asset('assets/img/default-img.jpg') }}" alt="shm"
                style="width: 350px; height: 150px; object-fit: contain;">
            <p class="ml-4 mb-2 m-0 p-0 text-c">
                * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
            </p>
        @endif
        <input type="file" name="shm" id="shm" class="form-control">
    </div>
</div>
<div class="col-md-12 d-flex">
    <div class="form-group col-md-6">
        <label for="">Jumlah Kamar</label>
        <input type="text" value="{{ old('jml_kmr', $biodata_spk ? $biodata_spk->jml_kmr : '') }}"
            class="form-control @error('jml_kmr') is-invalid @enderror" name="jml_kmr" id="jml_kmr"
            placeholder="masukkan jumlah kamar">
        @error('jml_kmr')
            <div class="invalid-feedback feed ml-3">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="">Kepemilikan Kamar Mandi</label>
        <select class="form-control select2" name="jml_kmr_mandi" id="jml_kmr_mandi">
            <option value="">-- Pilih --</option>
            <option value="Memiliki"
                {{ isset($biodata_spk) && $biodata_spk->jml_kmr_mandi === 'Memiliki' ? 'selected' : '' }}>
                Memiliki
            </option>
            <option value="Tidak Memiliki"
                {{ isset($biodata_spk) && $biodata_spk->jml_kmr_mandi === 'Tidak Memiliki' ? 'selected' : '' }}>
                Tidak Memilki
            </option>
        </select>
    </div>
</div>
<div class="col-md-12 d-flex">
    <div class="form-group col-md-6">
        <label for="">Bukti Foto Kamar</label><br>
        @if ($biodata_spk)
            @if ($biodata_spk->foto_kmr)
                <img class="ml-3 mb-2" id="foto-kmr-preview" src="{{ asset('storage/' . $biodata_spk->foto_kmr) }}"
                    alt="foto-kamar" style="width: 350px; height: 150px; object-fit: contain;">
                <p class="ml-4 mb-2 m-0 p-0 text-b">
                    * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                </p>
            @else
                <img class="ml-3 mb-2" id="foto-kmr-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                    alt="foto-kamar" style="width: 350px; height: 150px; object-fit: contain;">
                <p class="ml-4 mb-2 m-0 p-0 text-c">
                    * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                </p>
            @endif
        @else
            <img class="ml-3 mb-2" id="foto-kmr-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                alt="foto-kamar" style="width: 350px; height: 150px; object-fit: contain;">
            <p class="ml-4 mb-2 m-0 p-0 text-c">
                * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
            </p>
        @endif
        <input type="file" name="foto-kmr" id="foto-kmr" class="form-control">
    </div>
    <div class="form-group col-md-6">
        <label for="">Bukti Foto Kamar Mandi</label><br>
        @if ($biodata_spk)
            @if ($biodata_spk->foto_kmr_mandi)
                <img class="ml-3 mb-2" id="kmr-mandi-preview"
                    src="{{ asset('storage/' . $biodata_spk->foto_kmr_mandi) }}" alt="kamar-mandi"
                    style="width: 350px; height: 150px; object-fit: contain;">
                <p class="ml-4 mb-2 m-0 p-0 text-b">
                    * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                </p>
            @else
                <img class="ml-3 mb-2" id="kmr-mandi-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                    alt="kamar-mandi" style="width: 350px; height: 150px; object-fit: contain;">
                <p class="ml-4 mb-2 m-0 p-0 text-c">
                    * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                </p>
            @endif
        @else
            <img class="ml-3 mb-2" id="kmr-mandi-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                alt="kamar-mandi" style="width: 350px; height: 150px; object-fit: contain;">
            <p class="ml-4 mb-2 m-0 p-0 text-c">
                * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
            </p>
        @endif
        <input type="file" name="kmr-mandi" id="kmr-mandi" class="form-control">
    </div>
</div>
<div class="col-md-12 d-flex">
    <div class="form-group col-md-6">
        <label for="">Listrik yang digunakan</label>
        <select class="form-control select2" name="tagihan_listrik" id="tagihan_listrik">
            <option value="">-- Pilih --</option>
            <option value="Tidak Memiliki"
                {{ isset($biodata_spk) && $biodata_spk->tagihan_listrik === 'Tidak Memilki' ? 'selected' : '' }}>
                Tidak Memiliki
            </option>
            <option value="450 Watt"
                {{ isset($biodata_spk) && $biodata_spk->tagihan_listrik === '450 Watt' ? 'selected' : '' }}>
                Listrik 450 watt
            </option>
            <option value="900 Watt"
                {{ isset($biodata_spk) && $biodata_spk->tagihan_listrik === '900 Watt' ? 'selected' : '' }}>
                Listrik 900 watt
            </option>
            <option value="1300 Watt"
                {{ isset($biodata_spk) && $biodata_spk->tagihan_listrik === '1300 Watt' ? 'selected' : '' }}>
                Listrik 1300 watt
            </option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="">Pajak Bumi dan Bangunan</label>
        <input type="text" value="{{ old('pbb', $biodata_spk ? $biodata_spk->pbb : '') }}" class="form-control"
            name="pbb" id="pbb" placeholder="e.g 450.000">
    </div>
</div>
<div class="col-md-12 d-flex">
    <div class="form-group col-md-6">
        <label for="">Bukti Tagihan Listrik</label><br>
        @if ($biodata_spk)
            @if ($biodata_spk->slip_tagihan)
                <img class="ml-3 mb-2" id="listrik-preview"
                    src="{{ asset('storage/' . $biodata_spk->slip_tagihan) }}" alt="slip-tagihan"
                    style="width: 350px; height: 150px; object-fit: contain;">
                <p class="ml-4 mb-2 m-0 p-0 text-b">
                    * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                </p>
            @else
                <img class="ml-3 mb-2" id="listrik-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                    alt="slip-tagihan" style="width: 350px; height: 150px; object-fit: contain;">
                <p class="ml-4 mb-2 m-0 p-0 text-c">
                    * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                </p>
            @endif
        @else
            <img class="ml-3 mb-2" id="listrik-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                alt="slip-tagihan" style="width: 350px; height: 150px; object-fit: contain;">
            <p class="ml-4 mb-2 m-0 p-0 text-c">
                * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
            </p>
        @endif
        <input type="file" name="listrik" id="listrik" class="form-control">
    </div>
    <div class="form-group col-md-6">
        <label for="">Bukti Slip Pajak Bumi dan Bangunan</label>
        @if ($biodata_spk)
            @if ($biodata_spk->slip_pbb)
                <img class="ml-3 mb-2" id="slip-pbb-preview" src="{{ asset('storage/' . $biodata_spk->slip_pbb) }}"
                    alt="slip-pbb" style="width: 350px; height: 150px; object-fit: contain;">
                <p class="ml-4 mb-2 m-0 p-0 text-b">
                    * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                </p>
            @else
                <img class="ml-3 mb-2" id="slip-pbb-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                    alt="slip-pbb" style="width: 350px; height: 150px; object-fit: contain;">
                <p class="ml-4 mb-2 m-0 p-0 text-c">
                    * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                </p>
            @endif
        @else
            <img class="ml-3 mb-2" id="slip-pbb-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                alt="slip-pbb" style="width: 350px; height: 150px; object-fit: contain;">
            <p class="ml-4 mb-2 m-0 p-0 text-c">
                * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
            </p>
        @endif
        <input type="file" name="slip-pbb" id="slip-pbb" class="form-control">
    </div>
</div>
<div class="col-md-12 d-flex">
    <div class="form-group col-md-6">
        <label for="">Jumlah Saudara</label>
        <input type="text" value="{{ old('jml_sdr', $biodata_spk ? $biodata_spk->jml_sdr : '') }}"
            class="form-control @error('jml_sdr') is-invalid @enderror" name="jml_sdr" id="jml_sdr"
            placeholder="masukkan jumlah saudara">
        @error('jml_sdr')
            <div class="invalid-feedback feed ml-3">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="">Status Orang Tua</label>
        <select class="form-control select2" name="status_ortu" id="status_ortu">
            <option value="">-- Pilih --</option>
            <option value="Yatim Piatu"
                {{ isset($biodata_spk) && $biodata_spk->status_ortu === 'Yatim Piatu' ? 'selected' : '' }}>
                Yatim Piatu
            </option>
            <option value="Yatim"
                {{ isset($biodata_spk) && $biodata_spk->status_ortu === 'Yatim' ? 'selected' : '' }}>
                Yatim
            </option>
            <option value="Piatu"
                {{ isset($biodata_spk) && $biodata_spk->status_ortu === 'Piatu' ? 'selected' : '' }}>
                Piatu
            </option>
            <option value="Tidak Semuanya"
                {{ isset($biodata_spk) && $biodata_spk->status_ortu === 'Tidak Semuanya' ? 'selected' : '' }}>
                Tidak Semuanya
            </option>
        </select>
    </div>
</div>
<div class="col-md-12 d-flex">
    <div class="form-group col-md-6">
        <label for="">Bukti Surat Ket Saudara</label><br>
        @if ($biodata_spk)
            @if ($biodata_spk->surat_ket_sdr)
                <img class="ml-3 mb-2" id="sdr-preview" src="{{ asset('storage/' . $biodata_spk->surat_ket_sdr) }}"
                    alt="ket-sdr" style="width: 250px; height: 300px; object-fit: contain;">
                <p class="ml-4 mb-2 m-0 p-0 text-b">
                    * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                </p>
            @else
                <img class="ml-3 mb-2" id="sdr-preview" src="{{ asset('assets/img/blank-img-portrait.png') }}"
                    alt="ket-sdr" style="width: 250px; height: 300px; object-fit: contain;">
                <p class="ml-4 mb-2 m-0 p-0 text-c">
                    * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                </p>
            @endif
        @else
            <img class="ml-3 mb-2" id="sdr-preview" src="{{ asset('assets/img/blank-img-portrait.png') }}"
                alt="ket-sdr" style="width: 250px; height: 300px; object-fit: contain;">
            <p class="ml-4 mb-2 m-0 p-0 text-c">
                * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
            </p>
        @endif
        <input type="file" name="sdr" id="sdr" class="form-control">
    </div>
    <div class="form-group col-md-6">
        <label for="">Bukti Surat Ket Yatim</label><br>
        @if ($biodata_spk)
            @if ($biodata_spk->surat_ket_yatim)
                <img class="ml-3 mb-2" id="ket-yatim-preview"
                    src="{{ asset('storage/' . $biodata_spk->surat_ket_yatim) }}" alt="ket-yatim"
                    style="width: 250px; height: 300px; object-fit: contain;">
                <p class="ml-4 mb-2 m-0 p-0 text-b">
                    * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                </p>
            @else
                <img class="ml-3 mb-2" id="ket-yatim-preview" src="{{ asset('assets/img/blank-img-portrait.png') }}"
                    alt="ket-yatim" style="width: 250px; height: 300px; object-fit: contain;">
                <p class="ml-4 mb-2 m-0 p-0 text-c">
                    * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                </p>
            @endif
        @else
            <img class="ml-3 mb-2" id="ket-yatim-preview" src="{{ asset('assets/img/blank-img-portrait.png') }}"
                alt="ket-yatim" style="width: 250px; height: 300px; object-fit: contain;">
            <p class="ml-4 mb-2 m-0 p-0 text-c">
                * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
            </p>
        @endif
        <input type="file" name="ket-yatim" id="ket-yatim" class="form-control">
    </div>
</div>
<div class="col-md-12 d-flex mb-4">
    <div class="form-group col-md-6">
        <label for="">Jumlah Hutang</label>
        <input type="text" value="{{ old('jml_hutang', $biodata_spk ? $biodata_spk->jml_hutang : '') }}"
            class="form-control" name="jml_hutang" id="jml_hutang" placeholder="e.g 500.000">
    </div>
</div>
<div class="mr-4 mb-5 text-right">
    <button class="btn btn-save px-5">
        Simpan
    </button>
</div>

@push('customScript')
    <script>
        $(document).ready(function() {
            $('#slip-gaji').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#slip-gaji-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#shm').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#shm-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#foto-kmr').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#foto-kmr-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#kmr-mandi').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#kmr-mandi-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#listrik').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#listrik-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#slip-pbb').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#slip-pbb-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#sdr').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#sdr-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#ket-yatim').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#ket-yatim-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });

        function formatRupiah(angka) {
            var formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });
            var formatted = formatter.format(angka);
            formatted = formatted.replace("Rp", "");
            return formatted;
        }

        document.getElementById('gaji_ortu').addEventListener('input', function() {
            var value = this.value.replace(/[^0-9]/g, '');
            this.value = formatRupiah(value);
        });

        document.getElementById('luas_tanah').addEventListener('input', function() {
            var value = this.value.replace(/[^0-9]/g, '');
            this.value = formatRupiah(value);
        });

        document.getElementById('pbb').addEventListener('input', function() {
            var value = this.value.replace(/[^0-9]/g, '');
            this.value = formatRupiah(value);
        });

        document.getElementById('jml_hutang').addEventListener('input', function() {
            var value = this.value.replace(/[^0-9]/g, '');
            this.value = formatRupiah(value);
        });
    </script>
@endpush
