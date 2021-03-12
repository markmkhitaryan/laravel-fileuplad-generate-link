@extends('layouts.master')
@section('content')
    <form >
        <div class="form-group">
            <label for="file">Choose file</label>

            <input name="file" type="file" class="form-control-file" id="file" data-url="{{route('file.store')}}">


        </div>
    </form>

@endsection
@section('scripts')
    <script type="text/javascript">
        $("input:file").fileupload({
            url: $(this).attr('data-url'),
            dataType: 'json',
            beforeSend: function () {
                $("input:file").removeClass('is-invalid')
                $(".invalid-feedback").remove();
            },
            done: function (e, data) {

                if(data.result.success){
                    $('body').append(data.result.html);
                    $('#modal').modal('show')
                }
            },
            fail: function (e, data) {
                let errors = data.jqXHR.responseJSON;
                let error ="";
                $.each(errors.errors, function (key, value) {
                    $.each(value,function (k,v) {
                        error+=`<div class="invalid-feedback">${v}</div>`

                    })
                    console.log(    value);
                });
                console.log(error)
                $("input:file").addClass('is-invalid')
                $('.form-group').append(error);
            }
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
        $('body').on('click', '.closeModal', function () {
            $('#modal').modal('hide');
            $(this).parents('#modal').remove();
        })
        $('body').on('click', '.copyLink', function () {
            $("#copyLink").toggleClass('fa-copy fa-check-circle');
          //  $("#copyLink").addClass('fa-check-circle');

            var range = document.createRange();
            range.selectNode(document.getElementById("linkFile"));
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand("copy");
            window.getSelection().removeAllRanges();
            setTimeout(()=>{
                $("#copyLink").toggleClass('fa-check-circle fa-copy');
            },1500)
        })
    </script>
@endsection
