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
            serverSide: false,
            ajax: "{{ route('admin.setup.kelompok.mapel.datatables') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
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

        $('body').on('click', '.delete', function() {
            if (confirm("Delete Record?") == true) {
                let id = $(this).data('id');
                let token = $("meta[name='csrf-token']").attr("content");
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.setup.kelompok.mapel.destroy') }}",
                    data: {
                        id: id,
                        _token: token,
                    },
                    dataType: 'json',
                    success: function(res) {
                        window.location.reload()
                    }
                });
            }
        });
    })

    function editData(id) {
        idEdit = id
        $.ajax({
            url: `{{ url('admin/setup/kelompok-mapel/show') }}/${idEdit}`,
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
            url: `{{ url('admin/setup/kelompok-mapel/update') }}/${idEdit}`,
            method: 'post',
            dataType: 'json',
            data: $('#form_edit').serialize(),
            beforeSend: e => {
                $('#btn_edit').text('Processing...').attr('disabled', true)
            }
        }).fail(e => {
            console.log(e)
            $('#btn_edit').text('Simpan').attr('disabled', false)
        }).always(e => {
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
