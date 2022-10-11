<script>
    let idEdit = null
    const arrOldUrl = JSON.parse($('#old_link').val())
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#periode_aktif').daterangepicker({
            timePicker: true,
            startDate: moment($('#from_period').val()),
            endDate: moment($('#to_period').val()),
            autoUpdateInput: false,
        })

        $('#periode_aktif').on('apply.daterangepicker', function(ev, picker) {
            $('#from_period').val(picker.startDate.format('YYYY-MM-DD HH:mm:ss'))
            $('#to_period').val(picker.endDate.format('YYYY-MM-DD HH:mm:ss'))
            $(this).val(picker.startDate.format('DD/MM/YYYY hh:mm A') + ' - ' + picker.endDate.format('DD/MM/YYYY hh:mm A'));
        });

        $('#button_add_link').on('click', e => {
            generateNewLinkForm()
        })

        // $('#teacher_id').on('change', e => {
        //     const teacher_id = $('#teacher_id :selected').val()
        //     let a = getMapelByTeacher(teacher_id)
        //     a.done(e => {
        //         if(e.length == 0){
        //             Swal.fire({
        //                 icon: 'warning',
        //                 title: 'Oops...',
        //                 text: `${$('#teacher_id :selected').text()} Tidak memiliki MAPEL`,
        //             })
        //         }else{
        //             $('#subject_id').html(``)
        //             let htmlnya = `<option value=""></option>`
        //             e.forEach(el => {
        //                 const id = el.id
        //                 const subject = el.subject?.name
        //                 htmlnya += `<option value="${id}">${subject}</option>`
        //             });
        //             $('#subject_id').html(htmlnya).attr('disabled', false).attr('required', true)
        //         }
        //     })
        // })

        $('#is_task').on('change', e => {
            if($('#is_task :selected').val() == "1"){
                $('#periode_aktif').attr('disabled', false).attr('required', true)
            }else{
                $('#periode_aktif').attr('disabled', true).attr('required', false).val('')
            }
        })

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

        initData()
    })

    function initData()
    {
        $.blockUI()

        setTimeout(() => {
            // $('#teacher_id').val(`{{ $meetings->teacher_id }}`).trigger('change')
            $('#teacher_name').val(`{{ $meetings->teacher->name }}`)
            $('#homeroom_teacher_id').val(`{{ $meetings->homeroom_teacher_id }}`)
            $('#periode_aktif').val(`${moment($('#from_period').val()).format('DD/MM/YYYY hh:mm A')} - ${moment($('#to_period').val()).format('DD/MM/YYYY hh:mm A')}`)
            $('#subject_id').val(`{{ $meetings->subject_id }}`)
            $('#active_date').val(`{{ $meetings->active_date }}`)
            $('#is_task').val(`{{ $meetings->is_task }}`).trigger('change')

            // let a = getMapelByTeacher(`{{ $meetings->teacher_id }}`)
            // a.done(e => {
            //     if(e.length == 0){
            //         Swal.fire({
            //             icon: 'warning',
            //             title: 'Oops...',
            //             text: `${$('#teacher_id :selected').text()} Tidak memiliki MAPEL`,
            //         })
            //     }else{
            //         $('#subject_id').html(``)
            //         let htmlnya = `<option value=""></option>`
            //         e.forEach(el => {
            //             const id = el.id
            //             const subject_id = el.subject_id
            //             const subject = el.subject?.name
            //             htmlnya += `<option value="${subject_id}">${subject}</option>`
            //         });
            //         $('#subject_id').html(htmlnya).attr('disabled', false).attr('required', true).val(`{{ $meetings->subject_id }}`)
            //     }
            // })

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
        }, 500);
        
        setTimeout(() => {
            $.unblockUI()
        }, 1500);
    }

    function deleteAttachment(id)
    {
        $(`#row_${id}`).remove()
    }

    // function getMapelByTeacher(teacher_id)
    // {
    //     return $.ajax({
    //         url: `{{ url('teacher/pertemuan/show/subject') }}/${teacher_id}`,
    //         method: 'get',
    //         dataType: 'json',
    //         beforeSend: e => {
    //             //
    //         }
    //     }).fail(e => {
    //         console.log(e)
    //     })
    // }

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