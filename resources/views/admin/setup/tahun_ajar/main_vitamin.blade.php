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
            ajax: "{{ route('admin.setup.tahun_ajar.datatables') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: null,
                    name: null,
                    searchable: false,
                    orderable: false,
                    render: function(data, type, full, meta)
                    {
                        return `${moment(data.even_period_from).format("D MMMM YYYY")} — ${moment(data.even_period_to).format("D MMMM YYYY")}`
                    }
                },
                {
                    data: null,
                    name: null,
                    searchable: false,
                    orderable: false,
                    render: function(data, type, full, meta)
                    {
                        return `${moment(data.odd_period_from).format("D MMMM YYYY")} — ${moment(data.odd_period_to).format("D MMMM YYYY")}`
                    }
                },
                {
                    data: null,
                    name: 'is_active',
                    render: function(data, type, full, meta)
                    {
                        return (data.is_active == 1) ? "Aktif" : "Tidak Aktif"
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
                    url: "{{ route('admin.setup.tahun_ajar.destroy') }}",
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
            url: `{{ url('admin/setup/tahun_ajar/show') }}/${idEdit}`,
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
            $('#even_period_from_edit').val(e.even_period_from)
            $('#even_period_to_edit').val(e.even_period_to)
            $('#odd_period_from_edit').val(e.odd_period_from)
            $('#odd_period_to_edit').val(e.odd_period_to)
            $('#is_active_edit').val(e.is_active)
            $('#modal_edit').modal('show')
        })
    }

    function updateData() {
        $.ajax({
            url: `{{ url('admin/setup/tahun_ajar/update') }}/${idEdit}`,
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