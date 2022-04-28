<script>
    let idEdit = null
    const arrOldUrl = JSON.parse($('#old_link').val())
    console.log(arrOldUrl)
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("body").tooltip({
            selector: '[data-toggle=tooltip]'
        });

        $('#button_add_link').on('click', e => {
            generateNewLinkForm()
        })

        $('#teacher_id').on('change', e => {
            const teacher_id = $('#teacher_id :selected').val()
            let a = getMapelByTeacher(teacher_id)
            a.done(e => {
                if(e.length == 0){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: `${$('#teacher_id :selected').text()} Tidak memiliki MAPEL`,
                    })
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
        })

        initData()

        $('#form').on('submit', function(e){
            e.preventDefault()
            let formData = new FormData(this);
            let TotalFiles = $('#arr_lampiran')[0].files.length;
            let files = $('#arr_lampiran')[0];
            for (let i = 0; i < TotalFiles; i++) { 
                formData.append('files' + i, files.files[i]);
            }
            formData.append('TotalFiles', TotalFiles);
            processStore(formData)
        })
    })

    function initData()
    {
        $('#teacher_id').val(`{{ $meetings->teacher_id }}`)
        $('#homeroom_teacher_id').val(`{{ $meetings->homeroom_teacher_id }}`)
        $('#is_task').val(`{{ $meetings->is_task }}`)

        let a = getMapelByTeacher(`{{ $meetings->teacher_id }}`)
        a.done(e => {
            if(e.length == 0){
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: `${$('#teacher_id :selected').text()} Tidak memiliki MAPEL`,
                })
            }else{
                $('#subject_id').html(``)
                let htmlnya = `<option value=""></option>`
                e.forEach(el => {
                    const id = el.id
                    const subject = el.subject?.name
                    htmlnya += `<option value="${id}">${subject}</option>`
                });
                $('#subject_id').html(htmlnya).attr('disabled', false).attr('required', true).val(`{{ $meetings->subject_id }}`)
            }
        })

        let htmlnya = ``;
        arrOldUrl.forEach(el => {
            htmlnya += `
                <div class="input-group mt-2">
                    <input type="url" class="form-control" name="link[]" value="${el.url}" required />
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger" onclick="removeNewLinkForm(this)"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            `;
        })
        $('#group_link').append(htmlnya)
    }

    function deleteAttachment(id)
    {
        $(`#row_${id}`).remove()
    }

    function getMapelByTeacher(teacher_id)
    {
        return $.ajax({
            url: `{{ url('teacher/pertemuan/show/subject') }}/${teacher_id}`,
            method: 'get',
            dataType: 'json',
            beforeSend: e => {
                //
            }
        }).fail(e => {
            console.log(e)
        })
    }

    function generateNewLinkForm()
    {
        let htmlnya = `
        <div class="input-group mt-2">
            <input type="url" class="form-control" name="link[]" required />
            <div class="input-group-append">
                <button type="button" class="btn btn-danger" onclick="removeNewLinkForm(this)"><i class="fas fa-trash"></i></button>
            </div>
        </div>
        `;

        $('#group_link').append(htmlnya)
    }

    function removeNewLinkForm(el)
    {
        $(el).parent().parent().remove()

    }

    function processStore(formData) {
        $.ajax({
            url: `{{ route('teacher.pertemuan.update', $meeting_id) }}`,
            method: 'post',
            dataType: 'json',
            cache:false,
            contentType: false,
            processData: false,
            data: formData,
            beforeSend: e => {
                $('#simpan').html('<i class="fas fa-spinner fa-spin"></i> Processing...').attr('disabled', true)
            }
        }).fail(e => {
            console.log(e)
            $('#debug').html(e.responseText)
            $('#simpan').html('<i class="fas fa-save"></i> Simpan').attr('disabled', false)
        }).done(e => {
            console.log(e)
            if(e.code == 200){
                window.location.replace("{{ route('teacher.pertemuan') }}");
            }else{
                $('#simpan').html('<i class="fas fa-save"></i> Simpan').attr('disabled', false)
            }
        })
    }
</script>