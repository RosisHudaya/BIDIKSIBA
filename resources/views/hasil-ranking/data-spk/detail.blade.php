<tbody class="show-detail-{{ $result['id'] }}" style="display: none;">
    <tr>
        <th></th>
        <th class="align-middle">PEKERJAAN ORANG TUA</th>
        <th class="align-middle">PENGHASILAN ORANG TUA</th>
        <th class="align-middle">LUAS TANAH</th>
        <th class="text-center align-middle">JUMLAH KAMAR</th>
        <th class="text-center align-middle">KAMAR MANDI</th>
    </tr>
    <tr>
        <td></td>
        <td>{{ $result['pekerjaan_ortu'] }}</td>
        <td>{{ $result['gaji_ortu'] }}</td>
        <td>{{ $result['luas_tanah'] }}<sup>2</sup></td>
        <td class="text-center">{{ $result['kamar'] }}</td>
        <td class="text-center">{{ $result['kamar_mandi'] }}</td>
    </tr>
    <tr>
        <th></th>
        <th class="align-middle">TAGIHAN LISTRIK</th>
        <th class="align-middle">PAJAK BUMI DAN BANGUNAN</th>
        <th class="align-middle">JUMLAH HUTANG</th>
        <th class="text-center align-middle">JUMLAH SAUDARA</th>
        <th class="text-center align-middle">STATUS ORANG TUA</th>
    </tr>
    <tr>
        <td></td>
        <td>{{ $result['tagihan_listrik'] }}</td>
        <td>{{ $result['pajak'] }}</td>
        <td>Rp {{ $result['hutang'] !== null ? $result['hutang'] : '0' }}</td>
        <td class="text-center">{{ $result['saudara'] }}</td>
        <td class="text-center">{{ $result['status_ortu'] }}</td>
    </tr>
</tbody>
