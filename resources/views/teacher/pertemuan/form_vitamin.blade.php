<script>
    let idEdit = null
    $(document).ready(function() {
        $('#periode_aktif').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(168, 'hour'),
            autoUpdateInput: false,
        })

        $('#periode_aktif').on('apply.daterangepicker', function(ev, picker) {
            $('#from_period').val(picker.startDate.format('YYYY-MM-DD HH:mm:ss'))
            $('#to_period').val(picker.endDate.format('YYYY-MM-DD HH:mm:ss'))
            $(this).val(picker.startDate.format('DD/MM/YYYY hh:mm A') + ' - ' + picker.endDate.format('DD/MM/YYYY hh:mm A'));
        });

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
            getMapelByTeacher(teacher_id)
        })

        $('#is_task').on('change', e => {
            if($('#is_task :selected').val() == "1"){
                $('#periode_aktif').attr('disabled', false).attr('required', true)
            }else{
                $('#periode_aktif').attr('disabled', true).attr('required', false)
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
        $('#teacher_id').val(`{{ Auth::guard('teacher')->user()->id }}`).trigger('change')
    }

    function getMapelByTeacher(teacher_id)
    {
        $.ajax({
            url: `{{ url('teacher/pertemuan/show/subject') }}/${teacher_id}`,
            method: 'get',
            dataType: 'json',
            beforeSend: e => {
                //
            }
        }).fail(e => {
            console.log(e)
        }).done(e => {
            if(e.length == 0){

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
            url: `{{ route('teacher.pertemuan.store') }}`,
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