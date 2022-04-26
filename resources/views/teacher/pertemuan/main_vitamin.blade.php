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
                    render: function(data, type, full, meta)
                    {
                        return data.homeroom_teacher.school_year.name
                    }
                },
                {
                    data: null,
                    render: function(data, type, full, meta)
                    {
                        return data.teacher.name
                    }
                },
                {
                    data: null,
                    render: function(data, type, full, meta)
                    {
                        return data.homeroom_teacher.class_room.name
                    }
                },
                {
                    data: null,
                    render: function(data, type, full, meta)
                    {
                        return data.subject.name
                    }
                },
                {
                    data: null,
                    render: function(data, type, full, meta)
                    {
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
            if (confirm("Delete Record?") == true) {
                let id = $(this).data('id');
                let token = $("meta[name='csrf-token']").attr("content");
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.guru.wali_kelas.destroy') }}",
                    data: {
                        id: id,
                        _token: token,
                    },
                    dataType: 'json',
                    success: function(res) {
                        let oTable = $('.datatables').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        });
    })
</script>