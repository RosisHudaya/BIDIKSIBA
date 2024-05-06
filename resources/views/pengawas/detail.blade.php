@extends('landing-page.app')
@section('title', 'BIDIKSIBA POLINEMA | List Ujian Peserta')
@push('style')
    <link rel="stylesheet" href="/assets/css/public.css">
@endpush
@section('main')
    <div class="col-md-11 mx-auto my-4">
        <div class="col-md-12 d-flex p-main-title mb-0 py-1 px-3">
            <div class="col-md-6 p-0">
                <p class="my-2 det-peng">HALAMAN LIST PESERTA UJIAN</p>
                <i class="fas fa-users i-peng"></i>
            </div>
            <div class="col-md-6 text-right p-0">
                <a href="{{ route('ujian.pengawas') }}" class="a-back">
                    <i class="fas fa-arrow-alt-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="p-main pt-1 pb-4 px-3">
            <div class="col-md-10 p-0 my-2 mx-auto">
                <p class="mb-2 p-0 p-t">LIST PESERTA UJIAN</p>
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <tbody>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th style="width: 300px;">NAMA</th>
                                <th style="width: 500px;">JENIS KELAMIN</th>
                                <th class="text-center" style="width: 200px;">STATUS</th>
                            </tr>
                            @foreach ($sesi_users as $key => $sesi_user)
                                <tr>
                                    <td class="text-center">
                                        {{ ($sesi_users->currentPage() - 1) * $sesi_users->perPage() + $key + 1 }}
                                    </td>
                                    <td>{{ $sesi_user->nama }}</td>
                                    <td>{{ $sesi_user->gender }}</td>
                                    <td class="text-center">
                                        @if ($sesi_user->status == 'sudah')
                                            <button class="btn btn-sm btn-success font-weight-bold">SUDAH</button>
                                        @else
                                            <button class="btn btn-sm btn-danger font-weight-bold">BELUM</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center d-pag">
                    {{ $sesi_users->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('customScript')
    <script src="/assets/js/pagination.js"></script>
@endpush
