<div class="show-kamar-{{ $bobot_kamar->id }}" style="display: none;">
    <hr class="mt-0 pt-0">
    <div class="col-md-12 d-flex sub-warp-bobot">
        <label class="my-auto">Jumlah Kamar</label>
        <div class="col-md-6">
            <select class="form-control select2" name="bobot_pajak_4" id="bobot_pajak_4">
                <option value="1" {{ $bobot_kamar->to_c7 == 1 ? 'selected' : '' }}>
                    Sama
                </option>
                <option value="3.03" {{ $bobot_kamar->to_c7 == 3.03 ? 'selected' : '' }}>
                    1 Tigkat Lebih Penting dari
                </option>
                <option value="5" {{ $bobot_kamar->to_c7 == 5 ? 'selected' : '' }}>
                    2 Tingkat Lebih Penting dari
                </option>
                <option value="7.14" {{ $bobot_kamar->to_c7 == 7.14 ? 'selected' : '' }}>
                    3 Tingkat Lebih Penting dari
                </option>
                <option value="9.09" {{ $bobot_kamar->to_c7 == 9.09 ? 'selected' : '' }}>
                    4 Tingkat Lebih Penting dari
                </option>
                <option value="0.33" {{ $bobot_kamar->to_c7 == 0.33 ? 'selected' : '' }}>
                    1 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.2" {{ $bobot_kamar->to_c7 == 0.2 ? 'selected' : '' }}>
                    2 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.14" {{ $bobot_kamar->to_c7 == 0.14 ? 'selected' : '' }}>
                    3 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.11" {{ $bobot_kamar->to_c7 == 0.11 ? 'selected' : '' }}>
                    4 Tingkat dibawah Pentingnya dari
                </option>
            </select>
        </div>
        <label class="my-auto">Pajak Bumi dan Bangunan</label>
    </div>
    <hr>
</div>
