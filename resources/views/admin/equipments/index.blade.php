@extends('layouts.panel.main')

@section('main')
    @include('admin.equipments.delete')
    <div class="container-fluid py-4">
        <h2 class="mb-4 fw-bold text-center">📋 Manajemen Sarana</h2>

        <div class="card border-0">
            <div class="card-header text-white fw-semibold">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-black">Data Sarana</span>
                    <a href="{{ route('admin.equipments.create') }}" class="btn btn-sm btn-success shadow-sm">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="equipments-table" class="table table-bordered table-striped text-center w-100">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Merk</th>
                                <th>Jumlah</th>
                                <th>Fasilitas Terkait</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- DataTables --}}
    <script>
        $(document).ready(function() {
            $('#equipments-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('admin.equipments.index') }}',
                columns: [{
                        data: 'no',
                        name: 'no'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'brand',
                        name: 'brand'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'facility_name',
                        name: 'facility_name'
                    },
                    {
                        data: 'image',
                        name: 'image',
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
