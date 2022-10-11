<script>
    let idEdit = null
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("body").tooltip({
            selector: '[data-toggle=tooltip]'
        });

        $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('teacher.report_card.datatables') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'school_year.name',
                    data: 'school_year.name',
                },
                {
                    data: 'class_room_student.class_room.name',
                    name: 'class_room_student.class_room.name',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
            order: [
                [0, 'desc']
            ]
        })

        $('body').on('click', '.delete', function() {
            Swal.fire({
                icon: 'question',
                title: 'Apakah kamu yakin?',
                html: `Kamu akan menghapus data <b>${$(this).data('title')}</b>`,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus Data!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data('id');
                    let token = $("meta[name='csrf-token']").attr("content");
                    $.ajax({
                        type: "POST",
                        url: "{{ route('teacher.pertemuan.destroy') }}",
                        data: {
                            id: id,
                            _token: token,
                        },
                        dataType: 'json',
                        success: function(res) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Data Berhasil Dihapus',
                                showConfirmButton: false,
                                timer: 1500,
                                toast: true,
                            })
                            let oTable = $('.datatables').dataTable();
                            oTable.fnDraw(false);
                        }
                    });
                }
            })
        });
    })
</script>
