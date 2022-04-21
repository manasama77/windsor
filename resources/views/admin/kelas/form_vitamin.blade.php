<script>
    let schoolYearId = null;
    let classRoomId = null;
    let arrSiswa = [];
    let vSiswa = $('#vSiswa')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        }
    });

    $(document).ready(function() {
        initData()

        $('#form').on('submit', e => {
            e.preventDefault()
            prosesSimpan()
        })
    })

    function initData()
    {
        let usedData = {!! $usedStudent !!}
        let otherUsedData = {!! $otherUsedStudent !!}

        usedData.forEach(i => {
            arrSiswa.push({
                id: i.student_id,
                name: i.student.name,
            })
            $(`#student_id > option[value=${i.student_id}]`).attr('hidden', true)
        })
        otherUsedData.forEach(i => {
            $(`#student_id > option[value=${i.student_id}]`).attr('hidden', true)
        })
        renderTable()
    }

    function tambahSiswa() {
        let student = $('#student_id :selected')
        if (student.val()) {
            arrSiswa.push({
                id: student.val(),
                name: student.text(),
            })
            student.attr('hidden', true)
            $('#student_id').val('')
            renderTable()
        }
    }

    function renderTable() {
        let no = 1
        let htmlnya = ``
        arrSiswa.forEach(i => {
            htmlnya += `
            <tr>
                <td>${no}</td>
                <td>${i.name}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteData(${i.id})">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            `
            no++
        })
        vSiswa.html(htmlnya)
    }

    function deleteData(id) {
        const newArr = arrSiswa.splice(arrSiswa.findIndex(item => item.id === id), 1)
        $(`#student_id > option[value=${id}]`).attr('hidden', false)
        renderTable()
    }

    function prosesSimpan() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            },
            url: `{{ url('admin/kelas/update/'.$homeroom_teacher_id.'/'.$class_room_id) }}`,
            method: 'post',
            dataType: 'json',
            data: {
                arr_siswa: arrSiswa
            },
            beforeSend: e => {
                $('#simpan').html(`<i class="fas fa-spinner fa-spin"></i> Prosess...`).attr('disabled', true)
            }
        }).fail(e => {
            console.log(e)
            $('#simpan').html(`<i class="fas fa-save fa-fw"></i> Simpan`).attr('disabled', false)
        }).done(e => {
            if (e.code == 200) {
                window.location.replace(`{{ route('admin.kelas') }}`);
            } else {
                $('#simpan').html(`<i class="fas fa-save fa-fw"></i> Simpan`).attr('disabled', false)
            }
        });
    }
</script>