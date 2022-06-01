<script>
    const dataValue = [];

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#form').on('submit', e => {
            e.preventDefault()
            simpanData()
        })

        // cekValue()
    })

    function simpanData() {
        for (let i = 0; i < $(`input[name*="value"]`).length; i++) {
            let selectedValue = $(`input[name="value[${i}]"]`).val()
            dataValue.push(selectedValue)
        }

        if(dataValue.length == 0){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Data Nilai Belum Terisi',
                showConfirmButton: true,
            })
        }else{
            $.ajax({
                url: "{{ route('teacher.penilaian.upsert') }}",
                method: "POST",
                data: {
                    meeting_id: $('#meeting_id').val(),
                    homeroom_teacher_id: $('#homeroom_teacher_id').val(),
                    data_value: dataValue,
                },
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
                    })
                }
                setTimeout(() => {
                    $('#btn_simpan').unblock().attr('disabled', false)
                }, 2000);
            });        
        }
    }

    function cekValue() {
        $.ajax({
            url: `{{ url('/teacher/penilaian/cek_presensi') }}/${ $('#meeting_id').val() }`,
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