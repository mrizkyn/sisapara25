@extends('layouts.panel.main')

@section('main')
    <div class="container-fluid py-4">
        <h2 class="mb-4 fw-bold  text-center">📋 Manajemen Reservasi</h2>

        <div class="card  border-0">
            <div class="card-header text-white fw-semibold ">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-black">Data Pengajuan Reservasi</span>
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
                                <th>User</th>
                                <th>Fasilitas</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {
                $('#users-table').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: '{{ route('superadmin.reservasi.index') }}',
                    columns: [{
                            data: 'user_name',
                            name: 'user_name'
                        },
                        {
                            data: 'facility_name',
                            name: 'facility_name'
                        },
                        {
                            data: 'time_start',
                            name: 'time_start'
                        },
                        {
                            data: 'time_end',
                            name: 'time_end'
                        },
                        {
                            data: 'status_label',
                            name: 'status_label',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            });
        </script>
    @endpush
@endsection
