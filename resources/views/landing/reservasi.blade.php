@extends('layouts.user.main')
@section('title', '| Reservasi')

@push('css')
    <style>
        .hero-reservasi {
            background-color: #016974;
            font-family: 'Arial', sans-serif;
        }

        .text-left-block {
            padding: 40px;
        }

        .brand-title {
            font-size: 4rem;
            color: #F3F3F2;
            font-weight: 700;
            line-height: 1.2;
        }

        .subtext {
            font-size: 1rem;
            color: #F3F3F2;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        .btn-reserve {
            margin-top: 20px;
            border: 1px solid #F3F3F2;
            background-color: transparent;
            text-transform: uppercase;
            font-weight: bold;
            color: #F3F3F2;
        }

        .floating-box {
            background-color: #F3F3F2;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            height: 150px;
            padding: 10px;
            margin-top: 40px;
            border-radius: 5px
        }

        #calendar {
            max-width: 100%;
            margin-top: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .fc-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #016974;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
        }

        .fc-toolbar h2 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #F3F3F2;
            margin: 0;
        }

        .fc-button {
            background-color: #016974;
            color: white;
            border-radius: 50%;
            padding: 8px 15px;
            border: none;
            font-size: 1rem;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .fc-button:hover {
            background-color: #014f55;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .fc-button:focus {
            outline: none;
        }

        .fc-button-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .fc-button-group .fc-prev-button,
        .fc-button-group .fc-next-button {
            margin: 0 5px;
        }

        .fc-button-prev,
        .fc-button-next,
        .fc-button-today {
            padding: 10px 15px;
            font-size: 1rem;
        }

        .fc-event {
            background-color: #016974;
            border: 1px solid #016974;
            color: white;
            border-radius: 6px;
        }

        .tooltip-inner {
            background-color: #016974;
            color: white;
            font-size: 14px;
            text-align: left;
        }

        .tooltip.bs-tooltip-top .tooltip-arrow::before {
            border-top-color: #016974;
        }

        .tooltip.bs-tooltip-bottom .tooltip-arrow::before {
            border-bottom-color: #016974;
        }

        .fc-daygrid-day-number,
        .fc-day-number {
            color: #000000;
        }

        .fc-col-header-cell-cushion {
            color: #000000;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .fc-toolbar {
                flex-direction: column;
                align-items: flex-start;
                padding: 15px;
            }

            .fc-toolbar h2 {
                font-size: 1.2rem;
                margin-bottom: 10px;
            }

            .fc-button {
                padding: 6px 12px;
                font-size: 0.9rem;
            }

            .fc-button-group {
                width: 55%;
                justify-content: space-evenly;
            }

            .fc-scrollgrid-sync-inner {
                font-size: 0.7rem;
            }
        }

        @media (max-width: 480px) {
            #calendar {
                padding: 5px;
            }

            .fc-toolbar {
                font-size: 14px;
            }
        }

        .card-img-fixed {
            height: 200px;
            object-fit: cover;
        }

        .nav-pills .nav-link {
            border: 1px solid black;
            color: black;
            border-radius: 15px;
        }

        .nav-pills .nav-link.active {
            background-color: #016974;
            color: white;
            border-radius: 15px;
        }

        .col .card {
            box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
        }

        .custom-btn {
            display: inline-block;
            border: 1px solid #016974;
            border-radius: 50px;
            padding: 5px 30px;
            color: black;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .custom-btn:hover {
            background-color: #016974;
            color: #F3F3F2;
        }
    </style>
@endpush

@section('main-content')
    <section class="hero-reservasi py-5">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6 text-left-block ">
                    <div class="subtext">Equip Yourself for the City</div>
                    <div class="brand-title">
                        Reservasi with<br>
                        SISAPARA
                    </div>
                    <div class="floating-box container">
                        <div class="row text-center d-flex align-items-center justify-content-center h-100">
                            <div class="col-4">
                                <i class='bx bx-calendar-check' style="font-size: 2rem;"></i>
                                <p>Booking</p>
                            </div>
                            <div class="col-4">
                                <i class='bx bx-time-five' style="font-size: 2rem;"></i>
                                <p>Waktu</p>
                            </div>
                            <div class="col-4">
                                <i class='bx bx-user-check' style="font-size: 2rem;"></i>
                                <p>Konfirmasi</p>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-reserve mt-4">RESERVASI SEKARANG</button>
                </div>
                <div class="col-lg-6 image-right position-relative">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="text-start mt-5">
                <small class="text-muted">// Reservasi Sarana dan Prasarana</small>
                <h2 class="fw-bold">Eksplorasi Fasilitas Kami <br><span style="color: teal">Lapangan, Kolam, dan
                        Lainnya</span></h2>
                <p class="w-75">Temukan fasilitas olahraga kami yang lengkap untuk mendukung kegiatan rekreasi dan
                    prestasi. Ayo, eksplor sekarang juga dan lakukan reservasi untuk pengalaman terbaik Anda!</p>
            </div>
        </div>
        <div class="card container border-0 bg-white">
            <div class="card-header border-0 bg-white">
                <ul class="nav nav-pills card-header-pills float-end">
                    <li class="nav-item me-2" role="presentation">
                        <a class="nav-link active" id="prasarana-tab" data-bs-toggle="pill" href="#prasarana"
                            role="tab">Prasarana</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="sarana-tab" data-bs-toggle="pill" href="#sarana" role="tab">Sarana</a>
                    </li>
                </ul>
            </div>
            <div class="card-body tab-content container" id="myTabContent">
                <div class="tab-pane fade show active" id="prasarana" role="tabpanel">
                    <div id="equipments-container">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
                            @foreach ($facilities as $facility)
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="{{ asset('storage/' . $facility->banner) }}"
                                            class="card-img-top card-img-fixed" alt="{{ $facility->name }}">
                                        <div class="card-body d-flex justify-content-lg-between align-items-center"
                                            style="margin-bottom:0;">
                                            <div class="text-container">
                                                <p class="fs-4">{{ $facility->name }}</p>
                                            </div>
                                            <div class="button-container m-3 ms-auto">
                                                <a href="{{ route('landing.reservasi.show', $facility->id) }}"
                                                    class="custom-btn">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <p><i class='bx bx-user'></i>{{ $facility->capacity }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="sarana" role="tabpanel">
                    <div id="facilities-container">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
                            @foreach ($equipments as $equipment)
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="{{ asset('storage/' . $equipment->image) }}"
                                            class="card-img-top card-img-fixed" alt="{{ $equipment->name }}">
                                        <div class="card-body d-flex justify-content-lg-between align-items-center"
                                            style="margin-bottom:0;">
                                            <div class="text-container">
                                                <p class="fs-4">{{ $equipment->name }}</p>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <p><i class='bx bx-user'></i>{{ $equipment->quantity }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const triggerTab = new bootstrap.Tab(document.querySelector('#prasarana-tab'));
            triggerTab.show();
        });
    </script>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: 'bootstrap5',
                locale: 'id',
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '{{ route('jadwal.reservasi') }}',

                eventDidMount: function(info) {
                    const title = info.event.title || '-';
                    const facility = info.event.extendedProps.facility || '-';

                    const startDate = info.event.start;
                    const endDate = info.event.end;

                    const tanggalMulai = startDate.toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    const tanggalSelesai = endDate.toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });

                    const jamMulai = startDate.toLocaleTimeString('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    const jamSelesai = endDate.toLocaleTimeString('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    const tooltipContent = `
                        <strong>Peminjam:</strong> ${title}<br>
                        <strong>Fasilitas:</strong> ${facility}<br>
                        <strong>Tanggal:</strong> ${tanggalMulai} - ${tanggalSelesai}<br>
                        <strong>Waktu:</strong> ${jamMulai} - ${jamSelesai}`;

                    info.el.setAttribute('data-bs-toggle', 'tooltip');
                    info.el.setAttribute('data-bs-html', 'true');
                    info.el.setAttribute('title', tooltipContent);

                    new bootstrap.Tooltip(info.el);
                },

                windowResize: function() {
                    calendar.changeView(window.innerWidth < 768 ? 'timeGridWeek' : 'dayGridMonth');
                }
            });

            calendar.render();
        });
    </script>
@endpush
