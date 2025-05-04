@extends('layouts.panel.main')

@section('main')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    {{-- Custom Styles --}}
    <style>
        #users-table th,
        #users-table thead {
            background-color: teal !important;
            color: white !important;
        }


        /* Tombol Pagination (Normal) */
        .pagination .page-link {
            color: teal !important;
            border-radius: 5px;
            padding: 8px 15px;
            font-size: 14px;
            text-decoration: none !important;
        }

        /* Tombol Pagination Hover */
        .pagination .page-link:hover {
            background-color: #007f6c !important;
            color: white !important;
        }

        /* Tombol Pagination Aktif */
        .pagination .page-item.active .page-link {
            background-color: #006c57 !important;
            color: white !important;
            border-color: #006c57 !important;
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

        /* CSS Responsif */
    </style>

    <div class="container-fluid py-4">
        <h2 class="mb-4 fw-bold  text-center">📋 Manajemen Admin</h2>

        <div class="card  border-0">
            <div class="card-header text-white fw-semibold ">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-black">Data Users</span>
                    <a href="{{ route('superadmin.admin-management.create') }}" class="btn btn-sm btn-success shadow-sm" <i
                        class="bi bi-plus-circle"></i> Tambah
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="users-table"
                        class="table table-bordered table-striped table-hover align-middle text-center w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- DataTables Init --}}
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('superadmin.admin-management.index') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role'
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
