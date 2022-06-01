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
            ajax: "{{ route('teacher.pertemuan.datatables') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        return data.homeroom_teacher.school_year.name
                    }
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        const d = moment(data.active_date)
                        const oddFrom = moment(data.homeroom_teacher.school_year.odd_period_from)
                        const oddTo = moment(data.homeroom_teacher.school_year.odd_period_to)
                        const evenFrom = moment(data.homeroom_teacher.school_year.even_period_from)
                        const evenTo = moment(data.homeroom_teacher.school_year.even_period_to)
                        if(d.isAfter(oddFrom) && d.isBefore(oddTo)){
                            return "GANJIL"
                        }else if(d.isAfter(evenFrom) && d.isBefore(evenTo)){
                            return "GANJIL"
                        }else{
                            return "UNKNOWN"
                        }
                        // return data.homeroom_teacher.school_year.name
                    }
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        return data.teacher.name
                    }
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        return data.homeroom_teacher.class_room.name
                    }
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        return data.subject.name
                    }
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        return data.title
                    }
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