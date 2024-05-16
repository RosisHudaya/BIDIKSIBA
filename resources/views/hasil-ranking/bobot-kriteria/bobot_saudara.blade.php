<div class="show-saudara-{{ $bobot_saudara->id }}" style="display: none;">
    <hr class="mt-0 pt-0">
    <div class="col-md-12 d-flex sub-warp-bobot">
        <label class="my-auto">Jumlah Saudara</label>
        <div class="col-md-6">
            <select class="form-control select2" name="bobot_status_ortu_9" id="bobot_status_ortu_9">
                <option value="1" {{ $bobot_saudara->to_c10 == 1 ? 'selected' : '' }}>
                    Sama
                </option>
                <option value="3.03" {{ $bobot_saudara->to_c10 == 3.03 ? 'selected' : '' }}>
                    1 Tigkat Lebih Penting dari
                </option>
                <option value="5" {{ $bobot_saudara->to_c10 == 5 ? 'selected' : '' }}>
                    2 Tingkat Lebih Penting dari
                </option>
                <option value="7.14" {{ $bobot_saudara->to_c10 == 7.14 ? 'selected' : '' }}>
                    3 Tingkat Lebih Penting dari
                </option>
                <option value="9.09" {{ $bobot_saudara->to_c10 == 9.09 ? 'selected' : '' }}>
                    4 Tingkat Lebih Penting dari
                </option>
                <option value="0.33" {{ $bobot_saudara->to_c10 == 0.33 ? 'selected' : '' }}>
                    1 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.2" {{ $bobot_saudara->to_c10 == 0.2 ? 'selected' : '' }}>
                    2 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.14" {{ $bobot_saudara->to_c10 == 0.14 ? 'selected' : '' }}>
                    3 Tingkat dibawah Pentingnya dari
                </option>
                <option value="0.11" {{ $bobot_saudara->to_c10 == 0.11 ? 'selected' : '' }}>
                    4 Tingkat dibawah Pentingnya dari
                </option>
            </select>
        </div>
        <label class="my-auto">Status Orang Tua</label>
    </div>
    <hr>
</div>
