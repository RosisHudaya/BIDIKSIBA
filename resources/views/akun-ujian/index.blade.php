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
                            <form id="search" method="GET" action="{{ route('akun-ujian.index') }}">
                                <div class="d-flex mb-3">
                                    <input type="text" name="name" class="form-control mr-2" id="name"
                                        placeholder="cari nama pendaftar..." value="{{ app('request')->input('name') }}">
                                    <button class="btn btn-primary mr-1 py-0 px-4" type="submit">Submit</button>
                                    <a class="btn btn-secondary py-2 px-4" href="{{ route('akun-ujian.index') }}">Reset</a>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th style="width: 350px;">Nama</th>
                                            <th style="width: 350px;">Token Ujian</th>
                                            <th>Password</th>
                                        </tr>
                                        @foreach ($akunUjians as $key => $akunUjian)
                                            <tr>
                                                <td class="text-center">
                                                    {{ ($akunUjians->currentPage() - 1) * $akunUjians->perPage() + $key + 1 }}
                                                </td>
                                                <td style="text-transform: uppercase;">{{ $akunUjian->nama }}</td>
                                                <td>{{ $akunUjian->token }}</td>
                                                <td>{{ $akunUjian->password }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $akunUjians->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('customScript')
    <script>
        $(document).ready(function() {
            $('.import').click(function(event) {
                event.stopPropagation();
                $(".show-import").slideToggle("fast");
                $(".show-search").hide();
            });
            $('.search').click(function(event) {
                event.stopPropagation();
                $(".show-search").slideToggle("fast");
                $(".show-import").hide();
            });
            //ganti label berdasarkan nama file
            $('#file-upload').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#file-upload')[0].files[0].name;
                $(this).prev('label').text(file);
            });
        });
    </script>
@endpush

@push('customStyle')
    <script>
        function submitDel(id) {
            $('#del-' + id).submit()
        }
    </script>
@endpush
