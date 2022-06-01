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

        $('#form_edit').on('submit', e => {
            e.preventDefault()
            updateData()
        })

        $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.guru.wali_kelas.datatables') }}",
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

        $('#school_year_id').on('change', e => {
            const school_year_id = $('#school_year_id :selected').val()
            getListKelas(school_year_id)
        })
    })

    function getListKelas(school_year_id)
    {
        $.ajax({
            url: `{{ url('admin/guru/wali_kelas/show_available_kelas') }}/${school_year_id}`,
            method: 'get',
            dataType: 'json',
            beforeSend: e => {
                //
            }
        }).fail(e => {
            console.log(e)
        }).done(e => {
            let htmlnya = `<option value=""></option>`
            $('#class_room_id').html(htmlnya)
            e.forEach(el => {
                let id = el.id
                let name = el.name
                let classroom_type = el.classroom_type
                let vocational_type = el.vocational_type
                htmlnya += `<option value="${ id }">${ name } - ${ classroom_type } - ${ vocational_type }</option>`
            });
            $('#class_room_id').html(htmlnya)
        })
    }

    function editData(id) {
        idEdit = id
        $.ajax({
            url: `{{ url('admin/guru/wali_kelas/show') }}/${idEdit}`,
            method: 'get',
            dataType: 'json',
            beforeSend: e => {
                //
            }
        }).fail(e => {
            console.log(e)
        }).done(e => {
            $('#school_year_id_edit').val(e.school_year_id)
            $('#teacher_id_edit').val(e.teacher_id)
            $('#class_room_name_edit').val(e.class_room.name)
            $('#class_room_id_edit').val(e.class_room_id)
            $('#modal_edit').modal('show')
        })
    }

    function updateData() {
        $.ajax({
            url: `{{ url('admin/guru/wali_kelas/update') }}/${idEdit}`,
            method: 'post',
            dataType: 'json',
            data: $('#form_edit').serialize(),
            beforeSend: e => {
                $('#btn_edit').text('Processing...').attr('disabled', true)
            }
        }).fail(e => {
            console.log(e.responseText)
            $('#btn_edit').text('Simpan').attr('disabled', false)
        }).done(e => {
            if (e.code == 200) {
                Swal.fire({
                    icon: 'success',
                    title: 'Update Berhasil',
                    toast: true,
                    timer: 1500,
                    position: 'top-end',
                    showConfirmButton: false,
                }).then(() => {
                    $('#modal_edit').modal('hide')
                    let oTable = $('.datatables').dataTable();
                    oTable.fnDraw(false);
                    $('#btn_edit').text('Simpan').attr('disabled', false)
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Update Gagal',
                    text: 'Silahkan Coba Kembali',
                    toast: true,
                    timer: 2000,
                    position: 'top-end',
                    showConfirmButton: false,
                }).then(() => {
                    $('#modal_edit').modal('hide')
                    $('#btn_edit').text('Simpan').attr('disabled', false)
                })
            }
        })
    }
</script>