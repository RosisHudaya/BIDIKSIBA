<div class="py-3">
    <p class="my-0 p-title">JURUSAN PILIHAN</p>
    <hr>
    <div class="col-md-12 d-flex">
        <div class="form-group col-md-6">
            <label for="">Jurusan SMA/SMK</label>
            <select class="form-control select2" name="asal_jurusan_id" data-id="select-asal-jurusan" id="asal_jurusan_id"
                {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
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
            <select class="form-control select2" name="jurusan_id" data-id="select-jurusan" id="jurusan_id"
                {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                <option value="">-- Pilih jurusan --</option>
            </select>
        </div>
        <div class=" form-group col-md-6">
            <label for="">Program Studi Pilihan</label>
            <select class="form-control select2" name="prodi_id" data-id="select-prodi" id="prodi_id"
                {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                <option value="">-- Pilih program studi --</option>
            </select>
        </div>
    </div>
</div>

@push('customScript')
    <script>
        var getJurusansRoute = '{{ route('getJurusans') }}';
        var getProdisRoute = '{{ route('getProdis') }}';
        var status = '{{ $biodatas ? $biodatas->status == 'Diverivikasi' : false }}';
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
