@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>List</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="m-0 p-0">
                                @role('super-admin')
                                    <a href="{{ route('menu-ranking.matriks') }}" class="btn btn-primary mb-3 text-white">
                                        <i class="fas fa-square-root-alt"></i> Matriks Perandingan Pasangan
                                    </a>
                                @endrole
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th style="width: 350px;">Nama Kriteria</th>
                                            <th class="text-center">Jenis Kriteria</th>
                                            <th class="text-center">Bobot Kriteria</th>
                                        </tr>
                                        @foreach ($bobots as $key => $bobot)
                                            <tr>
                                                <td class="text-center">
                                                    {{ ($bobots->currentPage() - 1) * $bobots->perPage() + $key + 1 }}
                                                </td>
                                                <td>{{ $bobot->kriteria }}</td>
                                                <td class="text-center">{{ $bobot->jenis }}</td>
                                                <td class="text-center">{{ number_format($bobot->bobot, 6) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center d-pag">
                                {{ $bobots->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('customScript')
    <script src="/assets/js/pagination.js"></script>
@endpush

@push('customStyle')
@endpush
