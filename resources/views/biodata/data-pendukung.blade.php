<form action="{{ route('biodata.storeOrUpdateSpk') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="py-3">
        <div class="form-group col-md-12 d-flex">
            <div class="form-group col-md-6">
                <label for="">Pekerjaan Orang Tua</label>
                <select class="form-control select2" name="pekerjaan_ortu" id="pekerjaan_ortu"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                    <option value="" selected disabled>Pekerjaan Orang Tua</option>
                    @foreach ($pekerjaan_ortus as $pekerjaan_ortu)
                        @if (!empty($biodata_spk->pekerjaan_ortu_id))
                            <option @selected($biodata_spk->pekerjaan_ortu_id == $pekerjaan_ortu->id) value="{{ $pekerjaan_ortu->id }}">
                                {{ $pekerjaan_ortu->pekerjaan_ortu }}
                            </option>
                        @else
                            <option value="{{ $pekerjaan_ortu->id }}">
                                {{ $pekerjaan_ortu->pekerjaan_ortu }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="">Detail Pekerjaan</label>
                <input type="text"
                    value="{{ old('detail_pekerjaan', $biodata_spk ? $biodata_spk->detail_pekerjaan : '') }}"
                    class="form-control @error('detail_pekerjaan') is-invalid @enderror" name="detail_pekerjaan"
                    id="detail_pekerjaan" placeholder="Ex. pemilik toko"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('detail_pekerjaan')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-12 d-flex">
            <div class="form-group col-md-6">
                <label for="">Penghasilan Orang Tua</label>
                <select class="form-control select2" name="gaji_ortu" id="gaji_ortu"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                    <option value="" selected disabled>Penghasilan Orang Tua</option>
                    @foreach ($gaji_ortus as $gaji_ortu)
                        @if (!empty($biodata_spk->gaji_ortu_id))
                            <option @selected($biodata_spk->gaji_ortu_id == $gaji_ortu->id) value="{{ $gaji_ortu->id }}">
                                {{ $gaji_ortu->gaji_ortu }}
                            </option>
                        @else
                            <option value="{{ $gaji_ortu->id }}">
                                {{ $gaji_ortu->gaji_ortu }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="">Luas Tanah (satuan m<sup>2</sup>)</label>
                <input type="text"
                    value="{{ old('luas_tanah', $biodata_spk ? number_format($biodata_spk->luas_tanah, 0, ',', '.') : '') }}"
                    class="form-control" name="luas_tanah" id="luas_tanah" placeholder="masukkan luas tanah anda"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
            </div>
        </div>
        <div class="form-group col-md-12 d-flex">
            <div class="form-group col-md-6">
                <label for="">Bukti Slip Gaji</label><br>
                @if ($biodata_spk)
                    @if ($biodata_spk->slip_gaji)
                        <img class="ml-3 mb-2" id="slip-gaji-preview"
                            src="{{ asset('storage/' . $biodata_spk->slip_gaji) }}" alt="slip-gaji"
                            style="width: 350px; height: 150px; object-fit: contain;">
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
                <input type="file" name="slip-gaji" id="slip-gaji" class="form-control"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
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
                        <img class="ml-3 mb-2" id="shm-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                            alt="shm" style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-c">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @endif
                @else
                    <img class="ml-3 mb-2" id="shm-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                        alt="shm" style="width: 350px; height: 150px; object-fit: contain;">
                    <p class="ml-4 mb-2 m-0 p-0 text-c">
                        * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                    </p>
                @endif
                <input type="file" name="shm" id="shm" class="form-control"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
            </div>
        </div>
        <div class="form-group col-md-12 d-flex">
            <div class="form-group col-md-6">
                <label for="">Jumlah Kamar</label>
                <input type="number" value="{{ old('kamar', $biodata_spk ? $biodata_spk->kamar : '') }}"
                    class="form-control" name="jml_kmr" id="jml_kmr" placeholder="masukkan jumlah kamar anda"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
            </div>
            <div class="form-group col-md-6">
                <label for="">Kepemilikan Kamar Mandi</label>
                <select class="form-control select2" name="jml_kmr_mandi" id="jml_kmr_mandi"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                    <option value="" selected disabled>Kepemilikan Kamar Mandi</option>
                    @foreach ($kamar_mandis as $kamar_mandi)
                        @if (!empty($biodata_spk->kamar_mandi_id))
                            <option @selected($biodata_spk->kamar_mandi_id == $kamar_mandi->id) value="{{ $kamar_mandi->id }}">
                                {{ $kamar_mandi->kamar_mandi }}
                            </option>
                        @else
                            <option value="{{ $kamar_mandi->id }}">
                                {{ $kamar_mandi->kamar_mandi }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group col-md-12 d-flex">
            <div class="form-group col-md-6">
                <label for="">Bukti Foto Kamar</label><br>
                @if ($biodata_spk)
                    @if ($biodata_spk->foto_kmr)
                        <img class="ml-3 mb-2" id="foto-kmr-preview"
                            src="{{ asset('storage/' . $biodata_spk->foto_kmr) }}" alt="foto-kamar"
                            style="width: 350px; height: 150px; object-fit: contain;">
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
                <input type="file" name="foto-kmr" id="foto-kmr" class="form-control"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
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
                        <img class="ml-3 mb-2" id="kmr-mandi-preview"
                            src="{{ asset('assets/img/default-img.jpg') }}" alt="kamar-mandi"
                            style="width: 350px; height: 150px; object-fit: contain;">
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
                <input type="file" name="kmr-mandi" id="kmr-mandi" class="form-control"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
            </div>
        </div>
        <div class="form-group col-md-12 d-flex">
            <div class="form-group col-md-6">
                <label for="">Listrik yang digunakan</label>
                <select class="form-control select2" name="tagihan_listrik" id="tagihan_listrik"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                    <option value="" selected disabled>Listrik yang digunakan</option>
                    @foreach ($tagihan_listriks as $tagihan_listrik)
                        @if (!empty($biodata_spk->tagihan_listrik_id))
                            <option @selected($biodata_spk->tagihan_listrik_id == $tagihan_listrik->id) value="{{ $tagihan_listrik->id }}">
                                {{ $tagihan_listrik->tagihan_listrik }}
                            </option>
                        @else
                            <option value="{{ $tagihan_listrik->id }}">
                                {{ $tagihan_listrik->tagihan_listrik }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="">Pajak Bumi dan Bangunan</label>
                <input type="text"
                    value="{{ old('pajak', $biodata_spk ? number_format($biodata_spk->pajak, 0, ',', '.') : '') }}"
                    class="form-control" name="pbb" id="pbb"
                    placeholder="masukkan jumlah tagihan pajak bumi dan bangunan anda"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
            </div>
        </div>
        <div class="form-group col-md-12 d-flex">
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
                <input type="file" name="listrik" id="listrik" class="form-control"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
            </div>
            <div class="form-group col-md-6">
                <label for="">Bukti Slip Pajak Bumi dan Bangunan</label><br>
                @if ($biodata_spk)
                    @if ($biodata_spk->slip_pbb)
                        <img class="ml-3 mb-2" id="slip-pbb-preview"
                            src="{{ asset('storage/' . $biodata_spk->slip_pbb) }}" alt="slip-pbb"
                            style="width: 350px; height: 150px; object-fit: contain;">
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
                <input type="file" name="slip-pbb" id="slip-pbb" class="form-control"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
            </div>
        </div>
        <div class="form-group col-md-12 d-flex">
            <div class="form-group col-md-6">
                <label for="">Jumlah Saudara</label>
                <select class="form-control select2" name="jml_sdr" id="jml_sdr"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                    <option value="" selected disabled>Jumlah Saudara</option>
                    @foreach ($saudaras as $saudara)
                        @if (!empty($biodata_spk->saudara_id))
                            <option @selected($biodata_spk->saudara_id == $saudara->id) value="{{ $saudara->id }}">
                                {{ $saudara->saudara }}
                            </option>
                        @else
                            <option value="{{ $saudara->id }}">
                                {{ $saudara->saudara }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="">Status Orang Tua</label>
                <select class="form-control select2" name="status_ortu" id="status_ortu"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                    <option value="" selected disabled>Status Orang Tua</option>
                    @foreach ($status_ortus as $status_ortu)
                        @if (!empty($biodata_spk->status_ortu_id))
                            <option @selected($biodata_spk->status_ortu_id == $status_ortu->id) value="{{ $status_ortu->id }}">
                                {{ $status_ortu->status_ortu }}
                            </option>
                        @else
                            <option value="{{ $status_ortu->id }}">
                                {{ $status_ortu->status_ortu }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group col-md-12 d-flex">
            <div class="form-group col-md-6">
                <label for="">Bukti Surat Ket Saudara</label><br>
                @if ($biodata_spk)
                    @if ($biodata_spk->surat_ket_sdr)
                        <img class="ml-3 mb-2" id="sdr-preview"
                            src="{{ asset('storage/' . $biodata_spk->surat_ket_sdr) }}" alt="ket-sdr"
                            style="width: 250px; height: 300px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-b">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @else
                        <img class="ml-3 mb-2" id="sdr-preview"
                            src="{{ asset('assets/img/blank-img-portrait.png') }}" alt="ket-sdr"
                            style="width: 250px; height: 300px; object-fit: contain;">
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
                <input type="file" name="sdr" id="sdr" class="form-control"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
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
                        <img class="ml-3 mb-2" id="ket-yatim-preview"
                            src="{{ asset('assets/img/blank-img-portrait.png') }}" alt="ket-yatim"
                            style="width: 250px; height: 300px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-c">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @endif
                @else
                    <img class="ml-3 mb-2" id="ket-yatim-preview"
                        src="{{ asset('assets/img/blank-img-portrait.png') }}" alt="ket-yatim"
                        style="width: 250px; height: 300px; object-fit: contain;">
                    <p class="ml-4 mb-2 m-0 p-0 text-c">
                        * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                    </p>
                @endif
                <input type="file" name="ket-yatim" id="ket-yatim" class="form-control"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
            </div>
        </div>
        <div class="form-group col-md-12 d-flex mb-4">
            <div class="form-group col-md-6">
                <label for="">Jumlah Hutang</label>
                <select class="form-control select2" name="jml_hutang" id="jml_hutang"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                    <option value="" selected disabled>Jumlah Hutang</option>
                    @foreach ($hutangs as $hutang)
                        @if (!empty($biodata_spk->hutang_id))
                            <option @selected($biodata_spk->hutang_id == $hutang->id) value="{{ $hutang->id }}">
                                {{ $hutang->hutang }}
                            </option>
                        @else
                            <option value="{{ $hutang->id }}">
                                {{ $hutang->hutang }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="">Detail Jumlah Hutang</label>
                <input type="text" value="{{ old('det_hutang', $biodata_spk ? $biodata_spk->det_hutang : '') }}"
                    class="form-control" name="det_hutang" id="det_hutang" placeholder="Ex. 1.000.000"
                    {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
            </div>
        </div>
        <div class="mr-4 text-right btn-bio">
            <button class="btn btn-save px-5" {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                Simpan
            </button>
        </div>
    </div>
</form>

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

        document.getElementById('luas_tanah').addEventListener('input', function() {
            var value = this.value.replace(/[^0-9]/g, '');
            this.value = formatRupiah(value);
        });

        document.getElementById('pbb').addEventListener('input', function() {
            var value = this.value.replace(/[^0-9]/g, '');
            this.value = formatRupiah(value);
        });

        document.getElementById('det_hutang').addEventListener('input', function() {
            var value = this.value.replace(/[^0-9]/g, '');
            this.value = formatRupiah(value);
        });
    </script>
@endpush
