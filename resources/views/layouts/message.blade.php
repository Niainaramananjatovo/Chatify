<div class="card" style="min-height:85vh">
    <div class="card-header">
        <div style="display: inline-block; clear: both; float: left; margin-right: 15px;">
            <img src="/image/base-profile/indian.png" alt="" width="50px" height="50px"
                style="border-radius: 50%;">
        </div>
        <div style="display: inline-block;">
            <h5> {{ $user_name }}</h5>
        </div>
    </div>

    <div class="card-body" style="overflow-y:scroll; max-height:70vh">

    </div>

    <div class="card-footer row" style="background-color: transparent">

        {{-- image message --}}
        <div class="d-inline justify-content-start col-2">
            <form class="align-items-start justify-content d-flex" style="gap:10px" id="sendPics" method="post">
                @csrf
                <label for="image"> <i class="fas fa-image btn btn-light"
                        style="font-size: 1.25rem; color:#1877f2; margin-right:5px;"> </i></label>
                <input type="number" name="from" id="from" value="{{ Auth::user()->id }}" hidden>
                <input type="number" value="{{ $id_discution }}" name="discusionId" id="discusionId" hidden>
                <input type="text" name="type" id="type" value="file" hidden>
                <input type="file" id="image" name="image" hidden>
            </form>
        </div>

        {{-- plain text message  --}}
        <div class="col-10">
            <form class="align-items-start justify-content d-flex" style="gap:10px" id="send" method="post">
                @csrf
                <input type="number" name="from" id="from" value="{{ Auth::user()->id }}" hidden>
                <input type="number" value="{{ $id_discution }}" name="discusionId" id="discusionId" hidden>
                <div class="row container-fluid w-100">
                    <div class="col-10 justify-content-start d-flex">
                        <textarea class="form-control rounded-pill" id="input" cols="90" rows="1" placeholder="message here...."
                            name="contenu" style=" resize:none;  width:max-content" class="w-125"></textarea>
                    </div>

                    <div class="col-2 justify-content-end d-flex gx-3">
                        <button type="button" class="btn btn-light emoji"> <i class="far fa-smile"
                                style="font-size: 20px; color:#1877f2"> </i></button>
                                <button class="btn btn-light" type="submit"> <i class="fas fa-paper-plane"
                                    style="font-size: 25px;color:#1877f2"> </i> </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    send()

    getAllMessage()

    uploadMedia()

    emoji()

    function send() { //plain text and emojicons
        $(document).ready(function() {
            $('#send').on('submit', function(e) {
                e.preventDefault();
                var data = $(this)[0];
                var formdata = new FormData(data);
                $.ajax({
                    url: '{{ URL::to('addmessage') }}',
                    type: 'post',
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        $('#input').val('');
                    },
                    error: (error) => {
                        $('#input').val('');
                        console.log(error)
                    }
                })
            })

        })
    }


    function getAllMessage() {
        $.ajax({
            url: '{{ URL::to('getmesssage') }}',
            type: 'get',
            datType: 'json',
            success: (response) => {
                for (i = 0; i < response.length; i++) {
                    if (response[i].id == {{ $id_discution }}) {
                        if (response[i].from == Number({{ Auth::user()->id }})) {
                            var mymessage =
                                '<div class="bg-primary p-2 m-1" style="max-width:60%; color:white; float:right; clear:both; border-radius:20px;"> <span style="text-align:right;">' +
                                response[i].message + '</span> </div>';
                        } else {
                            var mymessage =
                                '<div class="bg-light p-2 m-1" style="max-width:60%; color:black; float:left; clear:both; border-radius:20px;"> <span style="text-align:left;">' +
                                response[i].message + '</span> </div>';
                        }
                        $('.card-body').append(mymessage);
                    }
                }
            },
            error: (error) => {}
        })
    }
    // ---------------------------------------------------------------------------------------------------------------------------------------

    function uploadMedia() { //media: audio, image, video, documents (downloadable) 
        $(document).ready(function() {
            $('#image').on('change', function() {
                for (i = 0; i < this.files.length; i++) {
                    var files = this.files[i].name;
                    var url = URL.createObjectURL(this.files[i]);
                    if (files.endsWith('png') || files.endsWith('jpg') || files.endsWith('jpeg') ||
                        files.endsWith('svg') || files.endsWith('gif')) {
                        $('.card-body').append('<img src="' + url +
                            '" style="height:30%; width:20%; float:right; clear:both; margin-bottom:5px;" class="rounded">'
                        )
                    } else if (files.endsWith('mp4')) {
                        $('.card-body').append('<video src="' + url +
                            '" style="height:30%; width:20%; float:right; clear:both; margin-bottom:5px;" class="rounded">'
                        )
                    }
                }
            })
        })
    }

    function emoji() { //emojicons lists 
        $(document).ready(function() {
            $('.emoji').on('click', function() {
                let message = $('#input').val();
                var lovemoji = '❤'
                $('#input').val(message + lovemoji)
            })
        })
    }
</script>
