<div class="show-pekerjaan-{{ $bobot_pekerjaan->id }}" style="display: none;">
    <hr class="mt-0 pt-0">
    <div class="col-md-12 d-flex sub-warp-bobot">
        <label class="my-auto">Pekerjaan Orang tua</label>
        <div class="col-md-6">
            <select class="form-control select2" name="bobot_penghasilan_1" id="bobot_penghasilan_1">
                <option value="1" {{ $bobot_pekerjaan->to_c2 == 1 ? 'selected' : '' }}>
                    Sama
                </option>
                <option value="3.03" {{ $bobot_pekerjaan->to_c2 == 3.03 ? 'selected' : '' }}>
                    1 Tigkat Lebih Penting dari
                </option>
                <option value="5" {{ $bobot_pekerjaan->to_c2 == 5 ? 'selected' : '' }}>
                    2 Tingkat Lebih Penting dari
                </option>
                <option value="7.14" {{ $bobot_pekerjaan->to_c2 == 7.14 ? 'selected' : '' }}>
                    3 Tingkat Lebih Penting dari
                </option>
                <option value="9.09" {{ $bobot_pekerjaan->to_c2 == 9.09 ? 'selected' : '' }}>
                    4 Tingkat Lebih Penting dari
                </option>
                <option value="0.33" {{ $bobot_pekerjaan->to_c2 == 0.33 ? 'selected' : '' }}>
                    1 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.2" {{ $bobot_pekerjaan->to_c2 == 0.2 ? 'selected' : '' }}>
                    2 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.14" {{ $bobot_pekerjaan->to_c2 == 0.14 ? 'selected' : '' }}>
                    3 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.11" {{ $bobot_pekerjaan->to_c2 == 0.11 ? 'selected' : '' }}>
                    4 Tingkat dibawah Pentingnya dari
                </option>
            </select>
        </div>
        <label class="my-auto">Penghasilan Orang tua</label>
    </div><br>
    <div class="col-md-12 d-flex sub-warp-bobot">
        <label class="my-auto">Pekerjaan Orang tua</label>
        <div class="col-md-6">
            <select class="form-control select2" name="bobot_kamar_mandi_1" id="bobot_kamar_mandi_1">
                <option value="1" {{ $bobot_pekerjaan->to_c5 == 1 ? 'selected' : '' }}>
                    Sama
                </option>
                <option value="3.03" {{ $bobot_pekerjaan->to_c5 == 3.03 ? 'selected' : '' }}>
                    1 Tigkat Lebih Penting dari
                </option>
                <option value="5" {{ $bobot_pekerjaan->to_c5 == 5 ? 'selected' : '' }}>
                    2 Tingkat Lebih Penting dari
                </option>
                <option value="7.14" {{ $bobot_pekerjaan->to_c5 == 7.14 ? 'selected' : '' }}>
                    3 Tingkat Lebih Penting dari
                </option>
                <option value="9.09" {{ $bobot_pekerjaan->to_c5 == 9.09 ? 'selected' : '' }}>
                    4 Tingkat Lebih Penting dari
                </option>
                <option value="0.33" {{ $bobot_pekerjaan->to_c5 == 0.33 ? 'selected' : '' }}>
                    1 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.2" {{ $bobot_pekerjaan->to_c5 == 0.2 ? 'selected' : '' }}>
                    2 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.14" {{ $bobot_pekerjaan->to_c5 == 0.14 ? 'selected' : '' }}>
                    3 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.11" {{ $bobot_pekerjaan->to_c5 == 0.11 ? 'selected' : '' }}>
                    4 Tingkat dibawah Pentingnya dari
                </option>
            </select>
        </div>
        <label class="my-auto">Kepemilikan Kamar Mandi</label>
    </div><br>
    <div class="col-md-12 d-flex sub-warp-bobot">
        <label class="my-auto">Pekerjaan Orang tua</label>
        <div class="col-md-6">
            <select class="form-control select2" name="bobot_listrik_1" id="bobot_listrik_1">
                <option value="1" {{ $bobot_pekerjaan->to_c6 == 1 ? 'selected' : '' }}>
                    Sama
                </option>
                <option value="3.03" {{ $bobot_pekerjaan->to_c6 == 3.03 ? 'selected' : '' }}>
                    1 Tigkat Lebih Penting dari
                </option>
                <option value="5" {{ $bobot_pekerjaan->to_c6 == 5 ? 'selected' : '' }}>
                    2 Tingkat Lebih Penting dari
                </option>
                <option value="7.14" {{ $bobot_pekerjaan->to_c6 == 7.14 ? 'selected' : '' }}>
                    3 Tingkat Lebih Penting dari
                </option>
                <option value="9.09" {{ $bobot_pekerjaan->to_c6 == 9.09 ? 'selected' : '' }}>
                    4 Tingkat Lebih Penting dari
                </option>
                <option value="0.33" {{ $bobot_pekerjaan->to_c6 == 0.33 ? 'selected' : '' }}>
                    1 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.2" {{ $bobot_pekerjaan->to_c6 == 0.2 ? 'selected' : '' }}>
                    2 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.14" {{ $bobot_pekerjaan->to_c6 == 0.14 ? 'selected' : '' }}>
                    3 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.11" {{ $bobot_pekerjaan->to_c6 == 0.11 ? 'selected' : '' }}>
                    4 Tingkat dibawah Pentingnya dari
                </option>
            </select>
        </div>
        <label class="my-auto">Tagihan Listrik</label>
    </div><br>
    <div class="col-md-12 d-flex sub-warp-bobot">
        <label class="my-auto">Pekerjaan Orang tua</label>
        <div class="col-md-6">
            <select class="form-control select2" name="bobot_hutang_1" id="bobot_hutang_1">
                <option value="1" {{ $bobot_pekerjaan->to_c8 == 1 ? 'selected' : '' }}>
                    Sama
                </option>
                <option value="3.03" {{ $bobot_pekerjaan->to_c8 == 3.03 ? 'selected' : '' }}>
                    1 Tigkat Lebih Penting dari
                </option>
                <option value="5" {{ $bobot_pekerjaan->to_c8 == 5 ? 'selected' : '' }}>
                    2 Tingkat Lebih Penting dari
                </option>
                <option value="7.14" {{ $bobot_pekerjaan->to_c8 == 7.14 ? 'selected' : '' }}>
                    3 Tingkat Lebih Penting dari
                </option>
                <option value="9.09" {{ $bobot_pekerjaan->to_c8 == 9.09 ? 'selected' : '' }}>
                    4 Tingkat Lebih Penting dari
                </option>
                <option value="0.33" {{ $bobot_pekerjaan->to_c8 == 0.33 ? 'selected' : '' }}>
                    1 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.2" {{ $bobot_pekerjaan->to_c8 == 0.2 ? 'selected' : '' }}>
                    2 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.14" {{ $bobot_pekerjaan->to_c8 == 0.14 ? 'selected' : '' }}>
                    3 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.11" {{ $bobot_pekerjaan->to_c8 == 0.11 ? 'selected' : '' }}>
                    4 Tingkat dibawah Pentingnya dari
                </option>
            </select>
        </div>
        <label class="my-auto">Jumlah Hutang</label>
    </div><br>
    <div class="col-md-12 d-flex sub-warp-bobot">
        <label class="my-auto">Pekerjaan Orang tua</label>
        <div class="col-md-6">
            <select class="form-control select2" name="bobot_saudara_1" id="bobot_saudara_1">
                <option value="1" {{ $bobot_pekerjaan->to_c9 == 1 ? 'selected' : '' }}>
                    Sama
                </option>
                <option value="3.03" {{ $bobot_pekerjaan->to_c9 == 3.03 ? 'selected' : '' }}>
                    1 Tigkat Lebih Penting dari
                </option>
                <option value="5" {{ $bobot_pekerjaan->to_c9 == 5 ? 'selected' : '' }}>
                    2 Tingkat Lebih Penting dari
                </option>
                <option value="7.14" {{ $bobot_pekerjaan->to_c9 == 7.14 ? 'selected' : '' }}>
                    3 Tingkat Lebih Penting dari
                </option>
                <option value="9.09" {{ $bobot_pekerjaan->to_c9 == 9.09 ? 'selected' : '' }}>
                    4 Tingkat Lebih Penting dari
                </option>
                <option value="0.33" {{ $bobot_pekerjaan->to_c9 == 0.33 ? 'selected' : '' }}>
                    1 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.2" {{ $bobot_pekerjaan->to_c9 == 0.22 ? 'selected' : '' }}>
                    2 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.14" {{ $bobot_pekerjaan->to_c9 == 0.14 ? 'selected' : '' }}>
                    3 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.11" {{ $bobot_pekerjaan->to_c9 == 0.11 ? 'selected' : '' }}>
                    4 Tingkat dibawah Pentingnya dari
                </option>
            </select>
        </div>
        <label class="my-auto">Jumlah Saudara</label>
    </div><br>
    <div class="col-md-12 d-flex sub-warp-bobot">
        <label class="my-auto">Pekerjaan Orang tua</label>
        <div class="col-md-6">
            <select class="form-control select2" name="bobot_status_ortu_1" id="bobot_status_ortu_1">
                <option value="1" {{ $bobot_pekerjaan->to_c10 == 1 ? 'selected' : '' }}>
                    Sama
                </option>
                <option value="3.03" {{ $bobot_pekerjaan->to_c10 == 3.03 ? 'selected' : '' }}>
                    1 Tigkat Lebih Penting dari
                </option>
                <option value="5" {{ $bobot_pekerjaan->to_c10 == 5 ? 'selected' : '' }}>
                    2 Tingkat Lebih Penting dari
                </option>
                <option value="7.14" {{ $bobot_pekerjaan->to_c10 == 7.14 ? 'selected' : '' }}>
                    3 Tingkat Lebih Penting dari
                </option>
                <option value="9.09" {{ $bobot_pekerjaan->to_c10 == 9.09 ? 'selected' : '' }}>
                    4 Tingkat Lebih Penting dari
                </option>
                <option value="0.33" {{ $bobot_pekerjaan->to_c10 == 0.33 ? 'selected' : '' }}>
                    1 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.2" {{ $bobot_pekerjaan->to_c10 == 0.2 ? 'selected' : '' }}>
                    2 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.14" {{ $bobot_pekerjaan->to_c10 == 0.14 ? 'selected' : '' }}>
                    3 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.11" {{ $bobot_pekerjaan->to_c10 == 0.11 ? 'selected' : '' }}>
                    4 Tingkat dibawah Pentingnya dari
                </option>
            </select>
        </div>
        <label class="my-auto">Status Orang Tua</label>
    </div>
    <hr>
</div>
