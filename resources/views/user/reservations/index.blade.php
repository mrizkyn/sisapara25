@extends('layouts.user.main')

@section('main-content')
    <style>
        .hero-reservasi {
            height: 18vh;
        }

        #users-table th,
        #users-table thead {
            background-color: #016974 !important;
            color: white !important;
        }

        .pagination .page-link {
            color: #016974 !important;
            border-radius: 5px;
            padding: 8px 15px;
            font-size: 14px;
            text-decoration: none !important;
        }

        .pagination .page-link:hover {
            background-color: #016974 !important;
            color: white !important;
        }

        .pagination .page-item.active .page-link {
            background-color: #016974 !important;
            color: white !important;
            border-color: #016974 !important;
        }

        @media (max-width: 768px) {
            .row {
                gap: 5px;
                flex-wrap: wrap-reverse;
                margin: 0;
                padding: 0;
            }

            select {
                margin-left: 20px;
                padding: 5px 0;
            }

            .dataTables_length,
            .dataTables_filter {
                flex: 1 0 auto;
                display: flex;
                justify-content: space-between;
            }

            #users-table_filter input {
                width: 95%;
            }

            .dataTables_length label {
                padding-left: 12px;
            }

            .previous {
                padding-left: 100px;
            }
        }
    </style>
    <div class="hero-reservasi">
    </div>
    <div class="container py-4">
        <h2 class="mb-4 fw-bold text-center"><i class='bx bx-calendar' style='color:#016974; font-size: 40px'></i> Riwayat
            Reservasi Saya</h2>

        <div class="card  border-0">
            <div class="card-header text-white fw-semibold ">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-black">Data Reservasi</span>
                    <a href="{{ route('user.reservasi.create') }}" class="btn btn-sm btn-success shadow-sm" <i
                        class="bi bi-plus-circle"></i> Ajukan Reservasi
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="users-table"
                        class="table table-bordered table-striped table-hover align-middle text-center w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Fasilitas</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- DataTables Script --}}
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('user.reservasi.index') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'facility_name',
                        name: 'facility_name'
                    },
                    {
                        data: 'time_start',
                        name: 'time_start',
                        render: function(data) {
                            if (!data) return '-';
                            const date = new Date(data);
                            return date.toLocaleString('id-ID', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                            });
                        }
                    },
                    {
                        data: 'time_end',
                        name: 'time_end',
                        render: function(data) {
                            if (!data) return '-';
                            const date = new Date(data);
                            return date.toLocaleString('id-ID', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                            });
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data) {
                            return {
                                'pending': '<span class="badge bg-warning">Pending</span>',
                                'verified': '<span class="badge bg-info">Verified</span>',
                                'approved': '<span class="badge bg-success">Approved</span>',
                                'rejected': '<span class="badge bg-danger">Rejected</span>',
                            } [data] || '-';
                        }
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
    </script>
@endsection
