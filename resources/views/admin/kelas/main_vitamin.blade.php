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
            ajax: "{{ route('admin.kelas.datatables') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: null,
                    render: function(data, type, full, meta)
                    {
                        return data.school_year.name
                    }
                },
                {
                    data: null,
                    render: function(data, type, full, meta)
                    {
                        return data.class_room.name
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
                        return data.class_room_student_count
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
            order: [
                [0, 'asc']
            ]
        })
    })
</script>