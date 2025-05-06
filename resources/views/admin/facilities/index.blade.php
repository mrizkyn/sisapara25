@extends('layouts.panel.main')

@section('main')
    @include('admin.facilities.delete')
    <div class="container-fluid py-4">
        <h2 class="mb-4 fw-bold  text-center">📋 Manajemen Prasarana</h2>

        <div class="card  border-0">
            <div class="card-header text-white fw-semibold ">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-black">Data Prasarana</span>
                    <a href="{{ route('admin.facilities.create') }}" class="btn btn-sm btn-success shadow-sm" <i
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
                                <th>Tipe</th>
                                <th>Pengelola</th>
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
                ajax: '{{ route('admin.facilities.index') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
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
