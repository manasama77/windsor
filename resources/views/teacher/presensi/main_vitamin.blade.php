<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        cekPresensi()
    })

    function simpanData() {
        const dataStatusPresence = [];
        const dataDescription = [];
        for (let i = 0; i < $(`select[name*="status_presence"]`).length; i++) {
            let selectedSp = $(`select[name="status_presence[${i}]"]`).val()
            dataStatusPresence.push(selectedSp)

            let selectedD = $(`input[name="description[${i}]"]`).val()
            dataDescription.push(selectedD)
        }

        $.ajax({
            url: "{{ route('teacher.presensi.upsert') }}",
            method: "POST",
            data: {
                meeting_id: $('#meeting_id').val(),
                homeroom_teacher_id: $('#homeroom_teacher_id').val(),
                status_presence: dataStatusPresence,
                description: dataDescription,
            },
            dataType: 'json',
            beforeSend: function() {
                $('#btn_simpan').block({
                    message: `<i class="fas fa-spinner fa-spin"></i>`
                })
            }
        }).fail(e => {
            console.log("fail", e)
            $('#error').html(e.responseText)
            $('#btn_simpan').unblock()
        }).done(e => {
            if (e.code == 200) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Data Berhasil Disimpan',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true,
                })
            }
            $('#btn_simpan').unblock()
        });
    }

    function cekPresensi() {
        $.ajax({
            url: `{{ url('/teacher/presensi/cek_presensi') }}/${ $('#meeting_id').val() }`,
            method: "GET",
            dataType: 'json',
            beforeSend: function() {
                $('#vdata').block({
                    message: `<i class="fas fa-spinner fa-spin"></i>`
                })
            }
        }).fail(e => {
            console.log("fail", e)
            $('#error').html(e.responseText)
            $('#vdata').unblock()
        }).done(e => {
            if (e.code == 200) {
                e.data.forEach(el => {
                    $(`#student_id_${el.student_id} select`).val(el.status_presence)
                    $(`#student_id_${el.student_id} input`).val(el.description)
                });
            }

            $('#vdata').unblock()
        });
    }
</script>