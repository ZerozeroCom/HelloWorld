@extends('layouts.app')
@section('content')

    <div class="card row m-2" >
        <h5 class="card-header bg-info py-3 row ml-0 mr-0">搜尋</h5>
        <div >
            <form>
                <div class="row m-3">
                        <div class="col-md-3 ">
                            <label for="sesend_number" class="col-form-label">簡訊發送號碼:</label>
                            <input type="text" class="col-form-control" id="sesend_number">
                        </div>
                        <div class="col-md-3">
                            <label for="sesms_content" class="col-form-label">簡訊內容:</label>
                            <input type="text" class="col-form-control" id="sesms_content">
                        </div>
                        <div class="col-md-3 ">
                            <label for="sesend_number" class="col-form-label">分類　　:</label>
                            <select type="text" class="col-form-control col-md-4"  id="sesnoticode" >
                                <option></option>
                                <option value="1">通知</option>
                                <option value="0">忽視</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                                <label for="sesms_content" class="col-form-label">關鍵字　:</label>
                                <input type="text" class="col-form-control" id="sesms_keyword">
                        </div>
                </div>
                <div class="row m-3">
                    <div class="col-md-3 ">
                        <label for="sedev_name" class="col-form-label">裝置　名稱　:</label>
                        <input type="text" class="col-form-control" id="sedev_name">
                    </div>
                    <div class="col-md-3 ">
                        <label for="sedev_businesses" class="col-form-label">裝置商戶:</label>
                        <input type="text" class="col-form-control" id="sedev_businesses">
                    </div>
                    <div class="col-md-3">
                        <label for="sedev_number" class="col-form-label">裝置號碼:</label>
                        <input type="text" class="col-form-control" id="sedev_number">
                    </div>
                </div>
            </form>
        </div>
        <button type="button" class="btn m-2 btn-primary" id="search_sms">搜尋</button>
    </div>
    <div>
        <button type="button" class="btn m-2 btn btn-dark" id="stop_reload">停止自動刷新</button>
        <label id="stop_message" style="color: red"></label>
    </div>

    <div>
    {{$dataTable->table()}}
    </div>
    {{$dataTable->scripts()}}

    <script>
        //自動刷新
        var stop =true;
        function myrefresh()
        {

            if(stop){
                //window.location.reload();
                $('#sms_lists-table').DataTable().draw();
            }
            setTimeout('myrefresh()',5000);
        }
        setTimeout('myrefresh()',5000);

        $('#stop_reload').on('click',function(){
            document.getElementById('stop_message').innerHTML="已暫停自動刷新，重開請按F5";
            stop = false;
        })
        //搜索
        $('#search_sms').on('click',function(){
            var table = $('#sms_lists-table').DataTable();
            var data =[
                    "",
                    document.getElementById('sedev_name').value,
                    document.getElementById('sedev_businesses').value,
                    document.getElementById('sedev_number').value,
                    document.getElementById('sesend_number').value,
                    document.getElementById('sesms_content').value,
                    document.getElementById('sesnoticode').value,
                    document.getElementById('sesms_keyword').value,
                    ]
            for(var i =1;i<data.length;i++){
                table.column(i).search(data[i]);
            }
            table.draw();
        })
        //刪除
        $('table').on('click','.deletesms',function(){
            var id = $(this).data('id');
            if (confirm("是否真的要刪除簡訊?\n ＊並不會實際刪除手機的簡訊，\n　　但後台不會再看到此簡訊")){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    method: 'POST',
                    url: `/sms-lists/${id}/delete`,
                })
                .done(function(msg){
                    alert('刪除成功')
                    location.reload();
                }).fail(function(message){
                    alert(`${message}錯誤`);
                });
            }else {
            }
        })

    </script>
@endsection
