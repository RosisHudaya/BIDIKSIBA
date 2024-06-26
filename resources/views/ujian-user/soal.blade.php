@extends('ujian-user.app')
@section('title', 'BIDIKSIBA POLINEMA | Ujian')
@push('style')
    <link rel="stylesheet" href="/assets/css/public.css">
@endpush
@section('main')
    <div class="col-soal-ujian col-md-11 d-flex mx-auto my-4">
        <div class="col-md-4 col-numb">
            <div class="p-ujian-n px-3 py-4 d-flex flex-column">
                <div class="d-flex">
                    <div class="col-md-6 m-0 p-0">
                        <p class="m-0 p-0 font-weight-bold">NOMER</p>
                    </div>
                    <div class="col-md-6 m-0 p-0 text-right">
                        <p id="countdown-timer" class="m-0 p-0 font-weight-bold"></p>
                    </div>
                </div>
                <div class="soal-n">
                    <hr class="mt-3 mb-2 p-0">
                    <div class="d-flex justify-content-start">
                        @foreach ($soals as $key => $soal)
                            @php
                                $number = str_pad($key + 1, 3, '0', STR_PAD_LEFT);
                            @endphp
                            <button
                                class="btn btn-numb btn-choice mx-1 px-3 soal {{ isset($jawabans[$soal->id]) && $jawabans[$soal->id] ? 'active-number' : '' }}"
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
                <div class="p-ujian-b">
                    <hr class="mt-3 mb-2 p-0">
                    <form id="selesaiForm" action="{{ route('selesai.ujian', $soal->id_sesi) }}" method="POST">
                        @csrf
                        <button type="button" class="btn btn-sm btn-wrong btn-block font-weight-bold"
                            onclick="confirmSelesai()">
                            Selesai
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @php
            function isImageUrl($url)
            {
                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
                $urlExtension = pathinfo($url, PATHINFO_EXTENSION);

                return strpos($url, 'thumbnail?id=') !== false || in_array(strtolower($urlExtension), $imageExtensions);
            }

        @endphp
        <div class="col-md-8 col-ques">
            <div class="p-ujian px-3 py-4">
                @foreach ($soals as $key => $soal)
                    <form class="ujianForm" action="{{ route('ujian.soal', [$soal->id, $soal->id_sesi]) }}" method="post">
                        @csrf
                        <div class="m-0 p-0 show-soal-{{ $soal->id }}" style="display: none;">
                            <p class="p-numb m-0 p-0 font-weight-bold">SOAL NO. {{ $key + 1 }}</p>
                            <hr class="mt-3 mb-2 p-0">
                            @if ($soal->gambar)
                                <img class="mb-2" src="{{ $soal->gambar }}" alt="gambar-soal"
                                    style="object-fit: contain;">
                            @endif
                            <p class="mt-0 p-0">{{ $soal->soal }}</p>
                            <div class="d-flex my-2">
                                <button type="button"
                                    class="btn btn-choice btn-ans mr-3 ml-4 {{ isset($jawabans[$soal->id]) && $jawabans[$soal->id] == 'A' ? 'active' : '' }}"
                                    value="A" name="jawab" data-id="{{ $soal->id }}">
                                    A
                                </button>
                                @if (isImageUrl($soal->jawaban_a))
                                    <img class="mb-2" src="{{ $soal->jawaban_a }}" alt="jawaban_a"
                                        style="object-fit: contain;">
                                @else
                                    <p class="my-2 p-choice">{{ $soal->jawaban_a }}</p>
                                @endif
                            </div>
                            <div class="d-flex my-2">
                                <button type="button"
                                    class="btn btn-choice btn-ans mr-3 ml-4 {{ isset($jawabans[$soal->id]) && $jawabans[$soal->id] == 'B' ? 'active' : '' }}"
                                    value="B" name="jawab" data-id="{{ $soal->id }}">
                                    B
                                </button>
                                @if (isImageUrl($soal->jawaban_b))
                                    <img class="mb-2" src="{{ $soal->jawaban_b }}" alt="jawaban_b"
                                        style="object-fit: contain;">
                                @else
                                    <p class="my-2 p-choice">{{ $soal->jawaban_b }}</p>
                                @endif
                            </div>
                            <div class="d-flex my-2">
                                <button type="button"
                                    class="btn btn-choice btn-ans mr-3 ml-4 {{ isset($jawabans[$soal->id]) && $jawabans[$soal->id] == 'C' ? 'active' : '' }}"
                                    value="C" name="jawab" data-id="{{ $soal->id }}">
                                    C
                                </button>
                                @if (isImageUrl($soal->jawaban_c))
                                    <img class="mb-2" src="{{ $soal->jawaban_c }}" alt="jawaban_c"
                                        style="object-fit: contain;">
                                @else
                                    <p class="my-2 p-choice">{{ $soal->jawaban_c }}</p>
                                @endif
                            </div>
                            <div class="d-flex my-2">
                                <button type="button"
                                    class="btn btn-choice btn-ans mr-3 ml-4 {{ isset($jawabans[$soal->id]) && $jawabans[$soal->id] == 'D' ? 'active' : '' }}"
                                    value="D" name="jawab" data-id="{{ $soal->id }}">
                                    D
                                </button>
                                @if (isImageUrl($soal->jawaban_d))
                                    <img class="mb-2" src="{{ $soal->jawaban_d }}" alt="jawaban_d"
                                        style="object-fit: contain;">
                                @else
                                    <p class="my-2 p-choice">{{ $soal->jawaban_d }}</p>
                                @endif
                            </div>
                            <div class="text-right m-0 p-0">
                                <form action="{{ route('reset.jawaban', [$soal->id, $soal->id_sesi]) }}" method="post">
                                    @csrf
                                    <button class="reset-jawaban btn btn-sm btn-warning text-white font-weight-bold px-3">
                                        Reset Jawaban
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <script>
        function confirmSelesai() {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menyelesaikan ujian?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Selesai!',
                cancelButtonText: 'Batal',
                allowOutsideClick: false,
                customClass: {
                    confirmButton: 'btn btn-alert',
                    cancelButton: 'btn btn-wrong'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('selesaiForm').submit();
                }
            });
        }
    </script>
    <script>
        function showTimeUpAlert() {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Waktu ujian telah habis, klik OK untuk keluar dari ujian?',
                icon: 'warning',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK',
                allowOutsideClick: false,
                customClass: {
                    confirmButton: 'btn btn-alert',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('selesaiForm').submit();
                }
            });
        }
    </script>
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

                $('.btn-ans').click(function(event) {
                    event.preventDefault();

                    const button = $(this);
                    const btnAns = button.closest('.btn-ans');

                    const form = $(this).closest('form');
                    const formData = form.serialize();

                    const url = form.attr('action');

                    const nilaiJawab = $(this).val();

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: formData + '&jawab=' + nilaiJawab,
                        success: function(response) {
                            $(`.btn-ans[data-id="${currentSoalId}"]`).removeClass(
                                'active');
                            btnAns.addClass('active');
                            $(`.soal[data-id="${currentSoalId}"]`).addClass(
                                'active-number');
                        },
                        error: function(xhr, status, error) {
                            console.error('Gagal mengirim jawaban:', error);
                        }
                    });
                });

                $('.reset-jawaban').click(function(event) {
                    event.preventDefault();
                    const form = $(this).closest('form');
                    const url = form.attr('action');

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            $(`.btn-ans[data-id="${currentSoalId}"]`).removeClass(
                                'active');
                            $(`.soal[data-id="${currentSoalId}"]`).removeClass(
                                'active-number');
                        },
                        error: function(xhr, status, error) {
                            console.error('Gagal mereset jawaban:', error);
                        }
                    });
                });
            });
        });
    </script>
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

                showTimeUpAlert();
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
