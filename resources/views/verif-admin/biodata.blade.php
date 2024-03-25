<tbody class="show-detail-{{ $biodata->id }}" style="display: none;">
    <tr>
        <th></th>
        <th>NIK</th>
        <th>NISN</th>
        <th>ASAL SEKOLAH</th>
        <th class="text-center">FOTO</th>
    </tr>
    <tr>
        <td></td>
        <td>{{ $biodata->nik ?? '--' }}</td>
        <td>{{ $biodata->nisn ?? '--' }}</td>
        <td>{{ $biodata->asal_sekolah ?? '--' }}</td>
        <th rowspan="5" class="text-center">
            @if ($biodata->foto)
                <img class="mb-3 ml-3" src="{{ asset('storage/' . $biodata->foto) }}" alt="foto"
                    style="width: 150px; height: 200px; object-fit: cover;" data-toggle="modal"
                    data-target="#fotoModal-{{ $biodata->id }}">
            @else
                <img class="mb-3 ml-3" src="{{ asset('assets/img/profile.jpg') }}" alt="foto-default"
                    style="width: 150px; height: 200px; object-fit: cover;">
            @endif
        </th>
    </tr>
    <tr>
        <th></th>
        <th>KOTA LAHIR</th>
        <th>TANGGAL LAHIR</th>
        <th>JENIS KELAMIN</th>
    </tr>
    <tr>
        <td></td>
        <td>{{ $biodata->kota_lahir ?? '--' }}</td>
        <td>
            @if ($biodata->tgl_lahir)
                {{ \Carbon\Carbon::parse($biodata->tgl_lahir)->format('d F Y') }}
            @else
                --
            @endif
        </td>
        <td>{{ $biodata->gender ?? '--' }}</td>
    </tr>
    <tr>
        <th></th>
        <th>NOMER TELEPON</th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <td></td>
        <td> {{ $biodata->no_telp ?? '--' }} </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th></th>
        <th>KTP</th>
        <th>KARTU KELUARGA</th>
        <th>KARTU SISWA</th>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th class="text-center">
            @if ($biodata->ktp)
                <img class="mb-3 ml-3" src="{{ asset('storage/' . $biodata->ktp) }}" alt="ktp"
                    style="width: 170px; height: 100px; object-fit: contain;" data-toggle="modal"
                    data-target="#fotoKtp-{{ $biodata->id }}">
            @else
                <img class="mb-3 ml-3" src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                    style="width: 170px; height: 100px; object-fit: contain;">
            @endif
        </th>
        <th class="text-center">
            @if ($biodata->kk)
                <img class="mb-3 ml-3" src="{{ asset('storage/' . $biodata->kk) }}" alt="kk"
                    style="width: 170px; height: 100px; object-fit: contain;" data-toggle="modal"
                    data-target="#fotoKk-{{ $biodata->id }}">
            @else
                <img class="mb-3 ml-3" src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                    style="width: 170px; height: 100px; object-fit: contain;">
            @endif
        </th>
        <th class="text-center">
            @if ($biodata->kartu_siswa)
                <img class="mb-3 ml-3" src="{{ asset('storage/' . $biodata->kartu_siswa) }}" alt="kartu_siswa"
                    style="width: 170px; height: 100px; object-fit: contain;" data-toggle="modal"
                    data-target="#fotoKartuSiswa-{{ $biodata->id }}">
            @else
                <img class="mb-3 ml-3" src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                    style="width: 170px; height: 100px; object-fit: contain;">
            @endif
        </th>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th>JURUSAN SMA/SMK</th>
        <th>JURUSAN PILIHAN</th>
        <th>PRODI PILIHAN</th>
        <th></th>
    </tr>
    <tr>
        <td></td>
        <td>{{ $biodata->asal_jurusan ?? '--' }}</td>
        <td>{{ $biodata->jurusan ?? '--' }}</td>
        <td>{{ $biodata->prodi ?? '--' }}</td>
        <td></td>
    </tr>
    @include('verif-admin.biodata-pendukung')
    <tr>
        <td colspan="4"></td>
        <td class="text-center">
            <div class="d-flex justify-content-center">
                <form action="{{ route('verifikasi-pendaftar.verif', $biodata->id) }}" method="POST"
                    id="ver-<?= $biodata->id ?>">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-sm btn-success"
                        data-confirm="Verifikasi Biodata | Apakah data biodata sudah benar dan akan diverifikasi ?"
                        data-confirm-yes="submitVer(<?= $biodata->id ?>)" data-id="ver-{{ $biodata->id }}"
                        {{ $biodata->status == 'Diverifikasi' ? 'disabled' : '' }}>
                        <i class="fas fa-check-circle"></i>
                        Verifikasi
                    </button>
                </form>
                <a class="btn btn-sm btn-danger ml-2 tolak" style="color: white;">
                    <i class="fas fa-times-circle"></i>
                    Tolak
                </a>
            </div>
        </td>
    </tr>
    <tr>
        <td></td>
        <td colspan="4">
            <div class="show-tolak" style="display: none;">
                <form action="{{ route('verifikasi-pendaftar.reject', $biodata->id) }}" method="POST"
                    id="rej-<?= $biodata->id ?>" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label class="font-weight-bold ml-2 my-0">CATATAN</label>
                    <p class="m-0 p-0 text-c">
                        * Tambahkan pesan kesalahan biodata pendaftar(opsional)
                    </p>
                    <textarea class="form-control summernote" name="catatan" id="catatan" style="height: 150px;">{{ $biodata->catatan }}</textarea>
                    <div class="text-right mb-2 mt-0 p-0">
                        <button type="submit" class="btn btn-sm btn-primary"
                            data-confirm="Verifikasi Biodata | Apakah data biodata belum bisa diverifikasi dan kirim pesan kesalahan ?"
                            data-confirm-yes="sumbitRej(<?= $biodata->id ?>)" data-id="rej-{{ $biodata->id }}">
                            <i class="fas fa-paper-plane"></i>
                            Kirim
                        </button>
                    </div>
                </form>
            </div>
        </td>
    </tr>
</tbody>

@push('customStyle')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('customScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script>
        $(".summernote").summernote({
            styleWithSpan: false,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
            ],
        });
    </script>
@endpush
