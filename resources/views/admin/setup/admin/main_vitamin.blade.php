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
            ajax: "{{ route('admin.setup.admin.datatables') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
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
                    url: "{{ route('admin.setup.admin.destroy') }}",
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

    function editData(id) {
        idEdit = id
        $.ajax({
            url: `{{ url('admin/setup/admin/show') }}/${idEdit}`,
            method: 'get',
            dataType: 'json',
            beforeSend: e => {
                //
            }
        }).fail(e => {
            console.log(e)
        }).done(e => {
            console.log(e)
            $('#name_edit').val(e.name)
            $('#modal_edit').modal('show')
        })
    }

    function updateData() {
        $.ajax({
            url: `{{ url('admin/setup/admin/update') }}/${idEdit}`,
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

    function resetPassword(id) {
        idEdit = id
        $('#password_edit').val('')
        $('#modal_reset').modal('show')
    }

    function resetDataPassword()
    {
        $.ajax({
            url: `{{ url('admin/setup/admin/reset_password') }}/${idEdit}`,
            method: 'post',
            dataType: 'json',
            data: $('#form_reset').serialize(),
            beforeSend: e => {
                $('#btn_reset').text('Processing...').attr('disabled', true)
            }
        }).fail(e => {
            console.log(e)
            $('#btn_reset').text('Simpan').attr('disabled', false)
        }).done(e => {
            if (e.code == 200) {
                Swal.fire({
                    icon: 'success',
                    title: 'Reset Password Berhasil',
                    toast: true,
                    timer: 1500,
                    position: 'top-end',
                    showConfirmButton: false,
                }).then(() => {
                    $('#modal_reset').modal('hide')
                    let oTable = $('.datatables').dataTable();
                    oTable.fnDraw(false);
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Reset Password Gagal',
                    text: 'Silahkan Coba Kembali',
                    toast: true,
                    timer: 2000,
                    position: 'top-end',
                    showConfirmButton: false,
                }).then(() => {
                    $('#modal_reset').modal('hide')
                })
            }
        })
    }
</script>