@extends('ujian-user.app')
@section('title', 'BIDIKSIBA POLINEMA | Ujian')
@push('style')
    <link rel="stylesheet" href="/assets/css/public.css">
@endpush
@section('main')
    <div class="col-md-11 d-flex mx-auto my-4">
        <div class="col-md-4">
            <div class="p-ujian px-3 py-4">
                <p class="m-0 p-0 font-weight-bold">NOMER</p>
                <hr class="mt-3 mb-2 p-0">
                <div class="d-flex justify-content-start">
                    @foreach ($soals as $key => $soal)
                        @php
                            $number = str_pad($key + 1, 2, '0', STR_PAD_LEFT);
                        @endphp
                        <button class="btn btn-choice mx-2 px-3 soal" data-id="{{ $soal->id }}">
                            {{ $number }}
                        </button>
                        @if (($key + 1) % 5 == 0)
                </div>
                <div class="d-flex justify-content-start mt-2">
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="p-ujian px-3 py-4">
                @foreach ($soals as $key => $soal)
                    <form action="{{ route('ujian.soal', [$soal->id, $soal->id_sesi]) }}" method="post">
                        @csrf
                        <div class="m-0 p-0 show-soal-{{ $soal->id }}" style="display: none;">
                            <p class="m-0 p-0 font-weight-bold">SOAL NO. {{ $key + 1 }}</p>
                            <hr class="mt-3 mb-2 p-0">
                            <p class="mt-0 p-0">{{ $soal->soal }}</p>
                            <div class="d-flex my-2">
                                <button type="submit" class="btn btn-choice mr-3 ml-4" value="A" name="jawab">
                                    A
                                </button>
                                <p class="my-2 p-choice">{{ $soal->jawaban_a }}</p>
                            </div>
                            <div class="d-flex my-2">
                                <button type="submit" class="btn btn-choice mr-3 ml-4" value="B" name="jawab">
                                    B
                                </button>
                                <p class="my-2 p-choice">{{ $soal->jawaban_b }}</p>
                            </div>
                            <div class="d-flex my-2">
                                <button type="submit" class="btn btn-choice mr-3 ml-4" value="C" name="jawab">
                                    C
                                </button>
                                <p class="my-2 p-choice">{{ $soal->jawaban_c }}</p>
                            </div>
                            <div class="d-flex my-2">
                                <button type="submit" class="btn btn-choice mr-3 ml-4" value="D" name="jawab">
                                    D
                                </button>
                                <p class="my-2 p-choice">{{ $soal->jawaban_d }}</p>
                            </div>
                            <hr class="mt-3 p-0">
                        </div>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@push('customScript')
    <script>
        $(document).ready(function() {
            var currentSoalId = '{{ $soals[0]->id }}';
            $('.show-soal-' + currentSoalId).show();

            $('.soal').on('click', function() {
                var soalId = $(this).data('id');

                $('.show-soal-' + currentSoalId).hide();

                $('.show-soal-' + soalId).show();

                currentSoalId = soalId;
            });
        });
    </script>
@endpush
