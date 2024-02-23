@extends('ujian-user.app')
@section('title', 'BIDIKSIBA POLINEMA | Ujian')
@push('style')
    <link rel="stylesheet" href="/assets/css/public.css">
@endpush
@section('main')
    <div class="col-md-11 d-flex mx-auto my-4">
        <div class="col-md-4">
            <div class="p-ujian px-3 py-4">
                <div class="d-flex">
                    <div class="col-md-6 m-0 p-0">
                        <p class="m-0 p-0 font-weight-bold">NOMER</p>
                    </div>
                    <div class="col-md-6 m-0 p-0 text-right">
                        <p id="countdown-timer" class="m-0 p-0 font-weight-bold"></p>
                    </div>
                </div>
                <hr class="mt-3 mb-2 p-0">
                <div class="d-flex justify-content-start">
                    @foreach ($soals as $key => $soal)
                        @php
                            $number = str_pad($key + 1, 2, '0', STR_PAD_LEFT);
                        @endphp
                        <button
                            class="btn btn-choice mx-2 px-3 soal {{ isset($jawabans[$soal->id]) && $jawabans[$soal->id] ? 'active-number' : '' }}"
                            data-id="{{ $soal->id }}">
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
                                <button type="submit"
                                    class="btn btn-choice mr-3 ml-4 {{ isset($jawabans[$soal->id]) && $jawabans[$soal->id] == 'A' ? 'active' : '' }}"
                                    value="A" name="jawab">
                                    A
                                </button>
                                <p class="my-2 p-choice">{{ $soal->jawaban_a }}</p>
                            </div>
                            <div class="d-flex my-2">
                                <button type="submit"
                                    class="btn btn-choice mr-3 ml-4 {{ isset($jawabans[$soal->id]) && $jawabans[$soal->id] == 'B' ? 'active' : '' }}"
                                    value="B" name="jawab">
                                    B
                                </button>
                                <p class="my-2 p-choice">{{ $soal->jawaban_b }}</p>
                            </div>
                            <div class="d-flex my-2">
                                <button type="submit"
                                    class="btn btn-choice mr-3 ml-4 {{ isset($jawabans[$soal->id]) && $jawabans[$soal->id] == 'C' ? 'active' : '' }}"
                                    value="C" name="jawab">
                                    C
                                </button>
                                <p class="my-2 p-choice">{{ $soal->jawaban_c }}</p>
                            </div>
                            <div class="d-flex my-2">
                                <button type="submit"
                                    class="btn btn-choice mr-3 ml-4 {{ isset($jawabans[$soal->id]) && $jawabans[$soal->id] == 'D' ? 'active' : '' }}"
                                    value="D" name="jawab">
                                    D
                                </button>
                                <p class="my-2 p-choice">{{ $soal->jawaban_d }}</p>
                            </div>
                            <div class="text-right m-0 p-0">
                                <form action="{{ route('reset.jawaban', [$soal->id, $soal->id_sesi]) }}" method="post">
                                    @csrf
                                    <button class="btn btn-sm btn-warning text-white font-weight-bold px-3">Reset
                                        Jawaban
                                    </button>
                                </form>
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
    <script>
        var countdownElement = document.getElementById('countdown-timer');
        var countdownInterval;

        function getSavedCountdown() {
            var savedCountdown = localStorage.getItem('countdown');
            return savedCountdown ? JSON.parse(savedCountdown) : null;
        }

        function saveCountdown() {
            var countdownData = {
                totalDetik: totalDetik
            };
            localStorage.setItem('countdown', JSON.stringify(countdownData));
        }

        function removeCountdown() {
            localStorage.removeItem('countdown');
        }

        var savedCountdown = getSavedCountdown();
        var totalDetik;

        if (savedCountdown) {
            totalDetik = savedCountdown.totalDetik;
        } else {
            var durasiArray = "{{ $durasi }}".split(':');
            var jam = parseInt(durasiArray[0]);
            var menit = parseInt(durasiArray[1]);
            var detik = parseInt(durasiArray[2]);
            totalDetik = jam * 3600 + menit * 60 + detik;
        }

        function updateTimer() {
            var sisaDetik = totalDetik;

            var jamSisa = Math.floor(sisaDetik / 3600);
            sisaDetik %= 3600;

            var menitSisa = Math.floor(sisaDetik / 60);
            sisaDetik %= 60;

            var formattedTimer = ('0' + jamSisa).slice(-2) + ':' + ('0' + menitSisa).slice(-2) + ':' + ('0' + sisaDetik)
                .slice(-2);

            countdownElement.textContent = formattedTimer;

            totalDetik--;

            saveCountdown();

            if (totalDetik < 0) {
                clearInterval(countdownInterval);
                countdownElement.textContent = '00:00:00';
                removeCountdown();
            }
        }

        countdownInterval = setInterval(updateTimer, 1000);

        window.addEventListener('beforeunload', function() {
            if (window.location.href.includes('ujian/jawab/{soalUjian}/{sesiUjian}') || window.location.href
                .includes('ujian/reset/{soalUjian}/{sesiUjian}')) {

            } else {
                removeCountdown();
            }
        });
    </script>
@endpush
