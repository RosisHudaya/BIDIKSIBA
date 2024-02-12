<tbody class="show-detail-{{ $biodata->id }}" style="display: none;">
    <tr>
        <th></th>
        <th>NIK</th>
        <th>NISN</th>
        <th>ASAL SEKOLAH</th>
        <th></th>
    </tr>
    <tr>
        <td></td>
        <td>{{ $biodata->nik }}</td>
        <td>{{ $biodata->nisn }}</td>
        <td>{{ $biodata->asal_sekolah }}</td>
        <td></td>
    </tr>
    <tr>
        <th></th>
        <th>KOTA LAHIR</th>
        <th>TANGGAL LAHIR</th>
        <th>JENIS KELAMIN</th>
        <th></th>
    </tr>
    <tr>
        <td></td>
        <td>{{ $biodata->kota_lahir }}</td>
        <td>{{ \Carbon\Carbon::parse($biodata->tgl_lahir)->format('d F Y') }}
        </td>
        <td>{{ $biodata->gender }}</td>
        <td></td>
    </tr>
    <tr>
        <th></th>
        <th>NOMER TELEPON</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <td></td>
        <td> {{ $biodata->no_telp }} </td>
        <td></td>
        <td></td>
        <td></td>
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
        <td>{{ $biodata->asal_jurusan }}</td>
        <td>{{ $biodata->jurusan }}</td>
        <td>{{ $biodata->prodi }}</td>
        <td></td>
    </tr>
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
        <td colspan="5">
            <div class="show-tolak text-right" style="display: none;">
                <form action="{{ route('verifikasi-pendaftar.reject', $biodata->id) }}" method="POST"
                    id="rej-<?= $biodata->id ?>" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <textarea name="catatan" id="catatan" cols="100" rows="5">{{ $biodata->catatan }}</textarea>
                    <br>
                    <p class="m-0 p-0 text-c">* Tambahkan pesan kesalahan biodata
                        pendaftar(opsional)</p>
                    <button type="submit" class="btn btn-sm btn-primary ml-2"
                        data-confirm="Verifikasi Biodata | Apakah data biodata belum bisa diverifikasi dan kirim pesan kesalahan ?"
                        data-confirm-yes="sumbitRej(<?= $biodata->id ?>)" data-id="rej-{{ $biodata->id }}">
                        <i class="fas fa-paper-plane"></i>
                        Kirim
                    </button>
                </form>
            </div>
        </td>
    </tr>
</tbody>
