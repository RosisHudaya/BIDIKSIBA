@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Peserta Ujian</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Validasi Tambah Peserta Ujian</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('sesi-user.store', $sesiUjian) }}" method="post">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tbody>
                                    <tr>
                                        <th class="text-center" style="width: 100px;">#</th>
                                        <th>Nama</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                    </tr>
                                    @foreach ($biodatas as $key => $biodata)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" name="user_ids[]" value="{{ $biodata->id_user }}">
                                            </td>
                                            <td style="text-transform: uppercase;">{{ $biodata->nama }}</td>
                                            <td class="text-center">{{ $biodata->gender }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <a class="btn btn-secondary"
                                    href="{{ route('sesiUjian', ['sesi_ujian' => $sesiUjian->id]) }}">Cancel
                                </a>
                            </div>
                            <div class="d-flex justify-content-center">
                                {{ $biodatas->withQueryString()->links() }}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section>
@endsection
