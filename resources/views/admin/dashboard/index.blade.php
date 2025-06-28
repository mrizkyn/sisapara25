@extends('layouts.panel.main')
@push('css')
    <style>
        .status-box {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .status-box h4 {
            color: #016974;
            font-weight: bold;
            font-size: 1.8rem;
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

        .fc-scrollgrid-sync-inner a {
            color: #000 !important;
            text-decoration: none;
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
            border-radius: 6px;
        }

        .tooltip-inner {
            background-color: #016974;
            color: white;
            font-size: 14px;
            text-align: left;
        }

        .tooltip.tooltip-pending .tooltip-inner {
            background-color: #ffc107;
            color: #000;
        }

        .tooltip.tooltip-verified .tooltip-inner {
            background-color: #0dcaf0;
            color: #fff;
        }

        .tooltip.tooltip-approved .tooltip-inner {
            background-color: #28a745;
            color: #fff;
        }

        .tooltip.tooltip-rejected .tooltip-inner {
            background-color: #dc3545;
            color: #fff;
        }

        .tooltip.tooltip-pending.bs-tooltip-top .tooltip-arrow::before,
        .tooltip.tooltip-pending.bs-tooltip-bottom .tooltip-arrow::before {
            border-color: #ffc107;
        }

        .tooltip.tooltip-verified.bs-tooltip-top .tooltip-arrow::before,
        .tooltip.tooltip-verified.bs-tooltip-bottom .tooltip-arrow::before {
            border-color: #0dcaf0;
        }

        .tooltip.tooltip-approved.bs-tooltip-top .tooltip-arrow::before,
        .tooltip.tooltip-approved.bs-tooltip-bottom .tooltip-arrow::before {
            border-color: #28a745;
        }

        .tooltip.tooltip-rejected.bs-tooltip-top .tooltip-arrow::before,
        .tooltip.tooltip-rejected.bs-tooltip-bottom .tooltip-arrow::before {
            border-color: #dc3545;
        }

        .status-pending {
            background-color: #ffc107 !important;
            border-color: #ffc107 !important;
            color: #000 !important;
        }

        .status-verified {
            background-color: #0dcaf0 !important;
            border-color: #0dcaf0 !important;
            color: #fff !important;
        }

        .status-approved {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
            color: #fff !important;
        }

        .status-rejected {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
            color: #fff !important;
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
                color: #000 !important;
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
    </style>
@endpush

@section('main')
    <div class="container mt-5">
        <h2 class="fw-bold mb-3">Halo, {{ Auth::user()->name }} 👋</h2>
        <p class="text-muted">Berikut ringkasan aktivitas reservasi di fasilitas yang Anda kelola.</p>
        <div class="row my-4">
            <div class="col-md-3 col-12 mb-3">
                <div class="status-box">
                    <h4>{{ $totalPending }} ⏳</h4>
                    <p>Perlu Verifikasi</p>
                </div>
            </div>
            <div class="col-md-3 col-12 mb-3">
                <div class="status-box">
                    <h4>{{ $totalVerified }} 🔍</h4>
                    <p>Menunggu Superadmin</p>
                </div>
            </div>
            <div class="col-md-3 col-12 mb-3">
                <div class="status-box">
                    <h4>{{ $totalApproved }} ✅</h4>
                    <p>Disetujui</p>
                </div>
            </div>
            <div class="col-md-3 col-12 mb-3">
                <div class="status-box">
                    <h4>{{ $totalRejected }} ❌</h4>
                    <p>Ditolak</p>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="status-box">
                    <h4>{{ $totalFacilities }} 🏟️</h4>
                    <p>Fasilitas Dikelola</p>
                </div>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-6 mb-4">
                <div id="calendar" style="min-height: 450px;"></div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="dashboard-card h-100">
                    <h5 class="fw-bold mb-3 text-center">Reservasi Terbaru di Fasilitas Anda</h5>
                    <div class="table-responsive">
                        <table id="reservasiTable"
                            class="table table-bordered table-striped table-hover align-middle text-center w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama User</th>
                                    <th>Fasilitas</th>
                                    <th>waktu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function() {
            $('#reservasiTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.dashboard.recent-reservations') }}",
                columns: [{
                        data: 'no',
                        name: 'no'
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },
                    {
                        data: 'facility_name',
                        name: 'facility_name'
                    },
                    {
                        data: 'waktu',
                        name: 'waktu',
                        searchable: false
                    },
                    {
                        data: 'status_label',
                        name: 'status',
                        orderable: false,
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
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
                events: "{{ route('admin.dashboard.events') }}",

                eventDidMount: function(info) {
                    const title = info.event.title || '-';
                    const facility = info.event.extendedProps.facility || '-';
                    const status = info.event.extendedProps.status || '-';

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
                        <strong>Waktu:</strong> ${jamMulai} - ${jamSelesai}<br>
                        <strong>Status:</strong> ${status}
                    `;

                    info.el.setAttribute('data-bs-toggle', 'tooltip');
                    info.el.setAttribute('data-bs-html', 'true');
                    info.el.setAttribute('title', tooltipContent);

                    const tooltip = new bootstrap.Tooltip(info.el);

                    info.el.addEventListener('mouseenter', () => {
                        setTimeout(() => {
                            const tooltipEl = document.querySelector('.tooltip');
                            if (tooltipEl) {
                                tooltipEl.classList.remove(
                                    'tooltip-pending',
                                    'tooltip-verified',
                                    'tooltip-approved',
                                    'tooltip-rejected'
                                );
                                tooltipEl.classList.add(`tooltip-${status}`);
                            }
                        }, 3);
                    });

                    info.el.classList.add(`status-${status}`);
                },

                windowResize: function() {
                    calendar.changeView(window.innerWidth < 768 ? 'timeGridWeek' : 'dayGridMonth');
                }
            });

            calendar.render();
        });
    </script>
@endpush
