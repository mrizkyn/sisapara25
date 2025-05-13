@extends('layouts.panel.main')

@section('main')
    <div class="container mt-4">
        <h3 class="mb-4 fw-bold text-center">Data Reservasi</h3>
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered" id="reservasiTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama User</th>
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

    <script>
        $(function() {
            $('#reservasiTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.reservasi.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
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
                        data: 'time_start',
                        name: 'time_start'
                    },
                    {
                        data: 'time_end',
                        name: 'time_end'
                    },
                    {
                        data: 'status_label',
                        name: 'status',
                        orderable: false,
                        searchable: false
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
