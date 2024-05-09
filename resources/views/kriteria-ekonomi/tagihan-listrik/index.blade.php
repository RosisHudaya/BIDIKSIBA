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
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th style="width: 350px;">Tagihan Listrik</th>
                                            <th class="text-center">Nilai</th>
                                            @role('super-admin')
                                                <th class="text-center">Aksi</th>
                                            @endrole
                                        </tr>
                                        @foreach ($tagihan_listriks as $key => $tagihan_listrik)
                                            <tr>
                                                <td class="text-center">
                                                    {{ ($tagihan_listriks->currentPage() - 1) * $tagihan_listriks->perPage() + $key + 1 }}
                                                </td>
                                                <td>{{ $tagihan_listrik->tagihan_listrik }}</td>
                                                <td class="text-center">{{ $tagihan_listrik->nilai }}</td>
                                                @role('super-admin')
                                                    <td class="text-right">
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ route('tagihan-listrik.edit', $tagihan_listrik->id) }}"
                                                                class="btn btn-sm btn-info btn-icon "><i
                                                                    class="fas fa-edit i-all"></i>
                                                                Edit
                                                            </a>
                                                        </div>
                                                    </td>
                                                @endrole
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center d-pag">
                                {{ $tagihan_listriks->withQueryString()->links() }}
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script>
        function submitDel(id) {
            $('#del-' + id).submit()
        }
    </script>
@endpush
