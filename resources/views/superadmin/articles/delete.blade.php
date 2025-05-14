<script>
    $(document).on('click', '.btn-delete', function() {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data artikel tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/superadmin/articles/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Terhapus!', response.success, 'success');
                            $('#superadmin-table').DataTable().ajax.reload();
                        }
                    },
                    error: function(xhr) {
                        const errorResponse = xhr.responseJSON;
                        if (errorResponse && errorResponse.error) {
                            Swal.fire('Gagal!', errorResponse.error, 'error');
                        } else {
                            Swal.fire('Error', 'Terjadi kesalahan saat menghapus.',
                                'error');
                        }
                    }
                });
            }
        });
    });
</script>
