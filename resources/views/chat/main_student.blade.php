<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Chats</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-danger text-white">
                                Online Person
                            </div>
                            <div class="card-body">
                                <div id="group_guru"></div>
                                <div id="group_murid"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-info text-white font-weight-bold text-center">
                                Kirim Pesan
                            </div>
                            <div class="card-body">
                                <form id="form">
                                    <div class="form-group" id="data-message">
                                        <textarea id="message" class="form-control" placeholder="Tulis Pesan..."
                                            rows="10" minlength="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-block"
                                            id="btnSubmit">Kirim</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        {{ env('APP_NAME') }} — Chat Room — {{ $data_chatroom['meeting_title'] }}
                    </div>
                    <div class="card-body">
                        <div class="row overflow-auto" id="v_chat" style="height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('adminlte3/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>

</body>

</html>

<script>
    const message = $('#message')
    const btnSubmit = $('#btnSubmit')
    const vChat = $('#v_chat')
    const objDiv = document.getElementById("v_chat");

    $(function(){
       //init
       setOnlineUser()
       getOnlineUser()
       renderChats(true)

       //loop
       setInterval(() => setOnlineUser(), 5000);
       setInterval(() => getOnlineUser(), 5000);
       setInterval(() => renderChats(), 1000);

       $('#form').on('submit', e => {
           e.preventDefault()
           sendMessage()
       })
    })

    function getOnlineUser()
    {
        $.ajax({
            url: `{{ route('student.chat.online', $chatToken) }}`,
            method: 'get',
            dataType: 'json',
        }).fail(e => {
            // window.close();
        }).done(e => {
            console.log(e)
            if(e.code == 200){
                console.log("User Status Online Updated")
                let htmlGuruNya = ``
                let htmlMuridNya = ``

                e.user_online_teacher.forEach(key => {
                    htmlGuruNya += `<span class="badge badge-primary mr-2"><i class="fas fa-user fa-fw"></i> ${key.name}</span>`
                });
                $('#group_guru').html(htmlGuruNya)

                e.user_online_student.forEach(key => {
                    htmlMuridNya += `<span class="badge badge-info mr-2"><i class="fas fa-user fa-fw"></i> ${key.name}</span>`
                });
                $('#group_murid').html(htmlMuridNya)
            }else{
                console.log("Failed User Status Online Updated")
            }
        })
    }

    function setOnlineUser()
    {
        $.ajax({
            url: `{{ route('student.chat.online.set', $chatToken) }}`,
            method: 'get',
            dataType: 'json',
        }).fail(e => {
            window.close();
        }).done(e => {
            if(e.code == 200){
                console.log("User Online Updated")
            }else{
                console.log("Failed User Online Updated")
            }
        })
    }

    function sendMessage()
    {
        $.ajax({
            url: `{{ route('student.chat.send', $chatToken) }}`,
            method: 'get',
            dataType: 'json',
            data: {
                message: message.val()
            },
            beforeSend: () => {
                btnSubmit.attr('disabled', true)
            }
        }).fail(e => {
            // window.close();
            btnSubmit.attr('disabled', false)
        }).done(e => {
            console.log(e)
            if(e.code == 200){
                console.log("Message Sent Success")
                renderChats(true)
                message.focus().val('')
                btnSubmit.attr('disabled', false)
            }else{
                console.log("Message Sent Failed")
                btnSubmit.attr('disabled', false)
            }
        })
    }

    function renderChats(scrollToBottom = false)
    {
        $.ajax({
            url: `{{ route('student.chat.render', $chatToken) }}`,
            method: 'get',
            dataType: 'json',
        }).fail(e => {
            // window.close();
        }).done(e => {
            console.log(e)
            if(e.code == 200){
                console.log("Render Success")
                let htmlnya = ''
                e.data.forEach(key => {
                    if(key.user_type == "student"){
                        let color = (key.align == "right")? "success" : "secondary"
                        htmlnya += `
                            <div class="col-12 text-${key.align}">
                                <span class="badge badge-${color} text-left">
                                    <i class="fas fa-user fa-fw"></i> ${key.name}
                                </span>
                                <p class="text-muted text-${key.align}"><small>${ moment.parseZone(key.created_at).utcOffset('+0700').fromNow() }</small></p>
                                <p class="text-${key.align}" title="${key.name}">${key.message}</p>
                                <hr />
                            </div>
                        `
                    }else{
                        htmlnya += `
                        <div class="col-12 text-${key.align}">
                            <span class="badge badge-primary text-left">
                                <i class="fas fa-user fa-fw"></i> ${key.name}
                            </span>
                            <p class="text-muted text-${key.align}"><small>${ moment.parseZone(key.created_at).utcOffset('+0700').fromNow() }</small></p>
                            <p class="text-${key.align}" title="${key.name}">${key.message}</p>
                            <hr />
                        </div>
                        `
                    }
                });

                vChat.html(htmlnya)
                if(scrollToBottom == true){
                    objDiv.scrollTop = objDiv.scrollHeight;
                }
            }else{
                console.log("Render Failed")
            }
        })
    }
</script>