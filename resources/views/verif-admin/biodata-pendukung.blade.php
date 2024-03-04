<tr>
    <th colspan="5" class="text-center" style="font-size: 18px;">
        -- DATA PENDUKUNG --
    </th>
</tr>
<tr>
    <th></th>
    <th>PEKERJAAN ORANG TUA</th>
    <th>DETAIL PEKERJAAN</th>
    <th>PENGHASILAN ORANG TUA</th>
    <th>BUKTI SLIP GAJI</th>
</tr>
<tr>
    <td></td>
    <td>{{ $biodata->pekerjaan_ortu ?? '--' }}</td>
    <td>{{ $biodata->detail_pekerjaan ?? '--' }}</td>
    <td>Rp {{ $biodata->gaji_ortu ?? '--' }}</td>
    <td>
        @if ($biodata->slip_gaji)
            <img class="mb-3 ml-3" src="{{ asset('storage/' . $biodata->slip_gaji) }}" alt="slip_gaji"
                style="width: 170px; height: 100px; object-fit: contain;" data-toggle="modal"
                data-target="#fotoSlipGaji-{{ $biodata->id }}">
        @else
            <img class="mb-3 ml-3" src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                style="width: 170px; height: 100px; object-fit: contain;">
        @endif
    </td>
</tr>
<tr>
    <th></th>
    <th>LUAS TANAH</th>
    <th>SURAT HAK MILIK</th>
    <th>JUMLAH KAMAR</th>
    <th>FOTO KAMAR</th>
</tr>
<tr>
    <td></td>
    <td>{{ $biodata->luas_tanah ?? '--' }} m<sup>2</sup></td>
    <td>
        @if ($biodata->shm)
            <img class="mb-3 ml-3" src="{{ asset('storage/' . $biodata->shm) }}" alt="shm"
                style="width: 170px; height: 100px; object-fit: contain;" data-toggle="modal"
                data-target="#fotoShm-{{ $biodata->id }}">
        @else
            <img class="mb-3 ml-3" src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                style="width: 170px; height: 100px; object-fit: contain;">
        @endif
    </td>
    <td>{{ $biodata->jml_kmr ?? '--' }} Kamar</td>
    <td>
        @if ($biodata->foto_kmr)
            <img class="mb-3 ml-3" src="{{ asset('storage/' . $biodata->foto_kmr) }}" alt="foto-kamar"
                style="width: 170px; height: 100px; object-fit: contain;" data-toggle="modal"
                data-target="#fotoKamar-{{ $biodata->id }}">
        @else
            <img class="mb-3 ml-3" src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                style="width: 170px; height: 100px; object-fit: contain;">
        @endif
    </td>
</tr>
<tr>
    <th></th>
    <th>KEPEMILIKAN KAMAR MANDI</th>
    <th>FOTO KAMAR MANDI</th>
    <th>LISTRIK</th>
    <th>BUKTI TAGIHAN LISTRIK</th>
</tr>
<tr>
    <td></td>
    <td>{{ $biodata->jml_kmr_mandi ?? '--' }}</td>
    <td>
        @if ($biodata->foto_kmr_mandi)
            <img class="mb-3 ml-3" src="{{ asset('storage/' . $biodata->foto_kmr_mandi) }}" alt="foto-kamar-mandi"
                style="width: 170px; height: 100px; object-fit: contain;" data-toggle="modal"
                data-target="#fotoKamarMandi-{{ $biodata->id }}">
        @else
            <img class="mb-3 ml-3" src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                style="width: 170px; height: 100px; object-fit: contain;">
        @endif
    </td>
    <td>{{ $biodata->tagihan_listrik ?? '--' }}</td>
    <td>
        @if ($biodata->slip_tagihan)
            <img class="mb-3 ml-3" src="{{ asset('storage/' . $biodata->slip_tagihan) }}" alt="tagihan-listrik"
                style="width: 170px; height: 100px; object-fit: contain;" data-toggle="modal"
                data-target="#fotoTagihanListrik-{{ $biodata->id }}">
        @else
            <img class="mb-3 ml-3" src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                style="width: 170px; height: 100px; object-fit: contain;">
        @endif
    </td>
</tr>
<tr>
    <th></th>
    <th>PAJAK BUMI DAN BANGUNAN</th>
    <th>BUKTI SLIP PBB</th>
    <th>JUMLAH SAUDARA</th>
    <th>SURAT KET SAUDARA</th>
</tr>
<tr>
    <td></td>
    <td>Rp {{ $biodata->pbb ?? '--' }}</td>
    <td>
        @if ($biodata->slip_pbb)
            <img class="mb-3 ml-3" src="{{ asset('storage/' . $biodata->slip_pbb) }}" alt="slip-pbb"
                style="width: 170px; height: 100px; object-fit: contain;" data-toggle="modal"
                data-target="#fotoSlipPbb-{{ $biodata->id }}">
        @else
            <img class="mb-3 ml-3" src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                style="width: 170px; height: 100px; object-fit: contain;">
        @endif
    </td>
    <td>{{ $biodata->jml_sdr ?? '--' }} Bersaudara</td>
    <td>
        @if ($biodata->surat_ket_sdr)
            <img class="mb-3 ml-3" src="{{ asset('storage/' . $biodata->surat_ket_sdr) }}" alt="ket-sdr"
                style="width: 170px; height: 100px; object-fit: contain;" data-toggle="modal"
                data-target="#fotoKetSdr-{{ $biodata->id }}">
        @else
            <img class="mb-3 ml-3" src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                style="width: 170px; height: 100px; object-fit: contain;">
        @endif
    </td>
</tr>
<tr>
    <th></th>
    <th>STATUS ORANG TUA</th>
    <th>SURAT KET YATIM</th>
    <th>JUMLAH HUTANG</th>
    <th></th>
</tr>
<tr>
    <td></td>
    <td>{{ $biodata->status_ortu ?? '--' }}</td>
    <td>
        @if ($biodata->surat_ket_yatim)
            <img class="mb-3 ml-3" src="{{ asset('storage/' . $biodata->surat_ket_yatim) }}" alt="ket-yatim"
                style="width: 170px; height: 100px; object-fit: contain;" data-toggle="modal"
                data-target="#fotoKetYatim-{{ $biodata->id }}">
        @else
            <img class="mb-3 ml-3" src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                style="width: 170px; height: 100px; object-fit: contain;">
        @endif
    </td>
    <td>Rp {{ $biodata->jml_hutang ?? '--' }}</td>
    <td></td>
</tr>
