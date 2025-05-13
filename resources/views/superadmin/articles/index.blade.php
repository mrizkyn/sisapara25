@extends('layouts.panel.main')

@section('main')
    @include('superadmin.articles.delete')
    <div class="container-fluid py-4">
        <h2 class="mb-4 fw-bold  text-center">📋 Manajemen Artikel</h2>

        <div class="card  border-0">
            <div class="card-header text-white fw-semibold ">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-black">Data Artikel</span>
                    <a href="{{ route('superadmin.articles.create') }}" class="btn btn-sm btn-success shadow-sm" <i
                        class="bi bi-plus-circle"></i> Tambah
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="super-admin-table"
                        class="table table-bordered table-striped table-hover align-middle text-center w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- DataTables Init --}}
    @push('script')
        <script>
            $(document).ready(function() {
                $('#super-admin-table').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: '{{ route('superadmin.articles.index') }}',
                    columns: [{
                            data: 'no',
                            name: 'no',
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'user_name',
                            name: 'user_name'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,

                        }
                    ]
                });
            });
        </script>
    @endpush
@endsection
