<script>
    let schoolYearId = '';
    let classRoomId = '';
    let periode = '';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('#btn_show').on('click', () => {
            let school_year_id = $('#school_year_id').val()
            let period = $('input[name=period]').val()
            let class_room_id = $('#class_room_id').val()
            if (school_year_id && class_room_id) {
                schoolYearId = school_year_id
                periode = period
                classRoomId = class_room_id
                renderNilai(school_year_id, class_room_id);
            }
        })

        $('#form').on('submit', function(e) {
            e.preventDefault()
            processStore()
        })
    })

    function renderNilai(school_year_id, class_room_id) {
        console.log(school_year_id, class_room_id)
        $.ajax({
            url: `{{ url('/teacher/report_card/render_nilai') }}/${school_year_id}/${class_room_id}`,
            method: 'get',
            dataType: 'json',
            beforeSend: e => {
                $('#v_data').html('').block()
            }
        }).fail(e => {
            console.log(e)
            $('#v_data').unblock()
        }).done(e => {
            console.log(e)
            let loop_1 = ''
            let loop_2 = ''
            let loop_3 = ''
            e.data.subjects.forEach(key => {
                loop_1 += `
                    <td colspan="5" class="text-center bg-info">
                        ${key.name}
                    </td>`
                loop_2 += `
                    <td rowspan="2" class="align-bottom bg-primary text-center"style="min-width: 70px;">KKM</td>
                    <td colspan="2" class="align-bottom bg-info text-center">Pengetahuan</td>
                    <td colspan="2" class="align-bottom bg-info text-center">Keterampilan</td>
                `
                loop_3 += `
                    <td class="text-center bg-primary" style="min-width: 70px;">Nilai</td>
                    <td class="text-center bg-primary" style="min-width: 70px;">Predikat</td>
                    <td class="text-center bg-primary" style="min-width: 70px;">Nilai</td>
                    <td class="text-center bg-primary" style="min-width: 70px;">Predikat</td>
                `
            });

            let loop_4 = ''
            e.data.students.forEach(key => {
                loop_4 +=
                    `<tr>
                        <td style="position: sticky; left: 0px;" class="bg-white">
                            ${key.name}
                            <input type="hidden" name="student_id[]" value="${key.id}"  />
                        </td>`
                e.data.subjects.forEach(key2 => {
                    loop_4 += `
                        <td class="text-center">
                            <input type="number" class="form-control form-control-sm" min="0" max="100" name="kkm[]" />
                        </td>
                        <td class="text-center">
                            <input type="number" class="form-control form-control-sm" min="0" max="100" name="pengetahuan_nilai[]" />
                        </td>
                        <td class="text-center">
                            <select class="form-control" style="height: 2rem; padding: .275rem .75rem;" name="pengetahuan_predikat[]">
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                                <option value="e">E</option>
                            </select>
                        </td>
                        <td class="text-center">
                            <input type="number" class="form-control form-control-sm" min="0" max="100" name="keterampilan_nilai[]" />
                        </td>
                        <td class="text-center">
                            <select class="form-control" style="height: 2rem; padding: .275rem .75rem;" name="keterampilan_predikat[]">
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                                <option value="e">E</option>
                            </select>
                        </td>
                    `
                })
                loop_4 += `</tr>`
            })

            let data_subjects_length = e.data.subjects.length
            let htmlnya = `
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <td rowspan="4" class="align-bottom bg-info"
                            style="position: sticky; left: 0px; min-width: 200px;">Nama
                            Murid</td>
                        <td colspan="${data_subjects_length * 5}" class="text-center bg-info">Nilai</td>
                    </tr>
                    <tr>
                        ${loop_1}
                    </tr>
                    <tr>
                        ${loop_2}
                    </tr>
                    <tr>
                        ${loop_3}
                    </tr>
                    ${loop_4}
            `
            $('#v_data').html(htmlnya)
            $('#v_data').unblock()
        })
    }

    function processStore() {
        $.ajax({
            url: `{{ url('/teacher/report_card/upsert') }}/${schoolYearId}/${periode}/${classRoomId}`,
            method: 'post',
            dataType: 'json',
            data: $('#form').serialize(),
            beforeSend: e => {
                $('#simpan').html('<i class="fas fa-spinner fa-spin"></i> Processing...').attr('disabled',
                    true)
            }
        }).fail(e => {
            console.log(e)
            $('#debug').html(e.responseText)
            $('#simpan').html('<i class="fas fa-save"></i> Simpan').attr('disabled', false)
        }).done(e => {
            console.log(e)
            if (e.code == 200) {
                window.location.replace("{{ route('teacher.pertemuan') }}");
            } else {
                $('#simpan').html('<i class="fas fa-save"></i> Simpan').attr('disabled', false)
            }
        })
    }
</script>
