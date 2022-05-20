<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    })

    function simpanData() {
        $.ajax({
            url: "{{ route('teacher.penilaian.upsert') }}",
            method: "POST",
            data: $('#form').serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('#btn_simpan').block({
                    message: `<i class="fas fa-spinner fa-spin"></i>`
                }).attr('disabled', true)
            }
        }).fail(e => {
            console.log("fail", e)
            $('#error').html(e.responseText)
            $('#btn_simpan').unblock().attr('disabled', false)
        }).done(e => {
            if (e.code == 200) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Data Berhasil Disimpan',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true,
                }).then(() => {
                    window.location.reload()
                })
            }else{
                $('#btn_simpan').unblock().attr('disabled', true)
            }
        });
    }
</script>