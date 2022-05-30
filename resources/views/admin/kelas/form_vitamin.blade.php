<script>
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
        },
    });

    $(document).ready(function() {
        $('#student_id').select2()

        $("#form").on("submit", (e) => {
            e.preventDefault()
            if ($('#student_id :selected').length == 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Tidak ada siswa terpilih',
                    showConfirmButton: false,
                    toast: true,
                    timer: 1500,
                }).then(e => {
                    $('#student_id').focus()
                })
            } else {
                prosesSimpan()
            }
        });
    });

    function prosesSimpan() {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
            },
            url: `{{ url('admin/kelas/update/'.$homeroom_teacher_id.'/'.$class_room_id) }}`,
            method: "post",
            dataType: "json",
            data: {
                arr_siswa: $('#student_id').val(),
            },
            beforeSend: (e) => {
                $("#simpan")
                    .html(`<i class="fas fa-spinner fa-spin"></i> Prosess...`)
                    .attr("disabled", true);
            },
        }).fail((e) => {
            console.log(e);
            $('#error').html(e.responseText)
            $("#simpan")
                .html(`<i class="fas fa-save fa-fw"></i> Simpan`)
                .attr("disabled", false);
        }).done((e) => {
            if (e.code == 200) {
                window.location.replace(`{{ route('admin.kelas') }}`);
            } else {
                $("#simpan")
                    .html(`<i class="fas fa-save fa-fw"></i> Simpan`)
                    .attr("disabled", false);
            }
        });
    }
</script>