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

        $('#form_reset').on('submit', e => {
            e.preventDefault()
            resetDataPassword()
        })

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
                        return data.id
                    }
                },
                {
                    data: null,
                    render: function(data, type, full, meta)
                    {
                        return data.id
                    }
                },
                {
                    data: null,
                    render: function(data, type, full, meta)
                    {
                        return data.id
                    }
                },
                {
                    data: null,
                    render: function(data, type, full, meta)
                    {
                        return data.id
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

        $('#teacher_id').on('change', e => {
            const teacher_id = $('#teacher_id :selected').val()
            getMapelByTeacher(teacher_id)
        })
    })

    function getMapelByTeacher(teacher_id)
    {
        $.ajax({
            url: `{{ url('teacher/pertemuan/show/subject') }}/${teacher_id}`,
            method: 'get',
            dataType: 'json',
            beforeSend: e => {
                //
            }
        }).fail(e => {
            console.log(e)
        }).done(e => {
            if(e.length == 0){

            }else{
                $('#subject_id').html(``)
                let htmlnya = `<option value=""></option>`
                e.forEach(el => {
                    const id = el.id
                    const subject = el.subject?.name
                    htmlnya += `<option value="${id}">${subject}</option>`
                });
                $('#subject_id').html(htmlnya).attr('disabled', false).attr('required', true)
            }
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
            console.log(e)
            $('#school_year_id_edit').val(e.school_year_id)
            $('#teacher_id_edit').val(e.teacher_id)
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
            console.log(e)
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
                })
            }
        })
    }
</script>