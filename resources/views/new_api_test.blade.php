@extends('layouts.app')
@section('content')

    <div class="header">
        <h5 class="modal-title" id="SMStestLabel">簡訊API測試</h5>
    </div>
    <div class="body">
        <form>
        <div class="mb-3">
            <label for="dev-email" class="col-form-label">裝置號碼:</label>
            <input type="text" class="form-control"autocomplete="number" id="dev-number">
        </div>
        <div class="mb-3">
            <label for="dev-UID" class="col-form-label">發送號碼:</label>
            <input type="text" class="form-control" autocomplete="send-number" id="send-number">
        </div>
        <div class="mb-3">
            <label for="message-text" class="col-form-label">簡訊內容:</label>
            <textarea type="message-text" class="form-control" autocomplete="new-content" id="sms-content"></textarea>
        </div>
        </form>
    </div>
    <div class="footer">
        <button type="button" class="btn btn-primary" id="sms_go">發送</button>
    </div>

    <script>
        $('.footer').on('click','#sms_go',function(){
            //測試用id號
            var id = 0;
            var data =[
                    document.getElementById('dev-number').value,
                    document.getElementById('send-number').value,
                    document.getElementById('sms-content').value,];
                //若必填有空值就不傳資料
                if ( data[0] != "" && data[1] != "" && data[2] != ""){
                    console.log(12)
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                method: 'POST',
                                url: `/sms-lists/API/${id}`,
                                dataType: "json",
                                data:{
                                        "number": data[0],
                                        "send_number": data[1],
                                        "sms_content": data[2],
                                    },
                            }).done(function(msg){
                            alert('新建成功')
                            location.reload();
                            });
                }else {alert('請再次確認')}
        })
    </script>

@endsection
