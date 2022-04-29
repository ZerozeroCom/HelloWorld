@extends('layouts.app')
@section('content')

    <div class="card row m-2 " style="border-radius:10px!important;">
        <h5 class="card-header bg-infoCool py-3 row ml-0 mr-0 " style="border-radius:10px 10px 0px 0px!important;">搜尋</h5>
        <div class="col wordStyle">
            <form>
                <div class="row m-3">
                        <div class="col-md-3 ">
                            <label for="sesend_number" class="col-form-label">簡訊發送號碼　</label>
                            <input type="number" class="col-form-control" id="sesend_number" >
                        </div>
                        <div class="col-md-3" >
                            <label for="sesms_content" class="col-form-label">　關鍵字　</label>
                            <input type="text" class="col-form-control" id="sesms_keyword">
                        </div>
                        <div class="col-md-3">
                            <label for="sesms_content" class="col-form-label">簡訊內容　</label>
                            <input type="text" class="col-form-control" id="sesms_content">
                        </div>
                        <div class="col-md-3 " >
                            <label for="sesnoticode" class="col-form-label">　　分類　</label>
                            <select type="text" class="col-form-control"  id="sesnoticode" >
                                <option></option>
                                <option value="1">通知</option>
                                <option value="0">忽視</option>
                            </select>
                        </div>
                </div>
                <div class="row m-3">
                    <div class="col-md-3 ">
                        <label for="sedev_name" class="col-form-label">　　裝置名稱　</label>
                        <input type="text" class="col-form-control" id="sedev_name">
                    </div>
                    <div class="col-md-3 ">
                        <label for="sedev_businesses" class="col-form-label">裝置商戶　</label>
                        <input type="text" class="col-form-control" id="sedev_businesses">
                    </div>
                    <div class="col-md-3">
                        <label for="sedev_number" class="col-form-label">裝置號碼　</label>
                        <input type="number" class="col-form-control" id="sedev_number">
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-8 btn-group"  role="group" >
                    <label for="" class="col-form-label my-auto">快速選取:</label>
                    <button type="button" class="m-2 btn btn-outline-info" id="sedev_date_lastmonth">上月</button>
                    <button type="button" class="m-2 btn btn-outline-success" id="sedev_date_month">今月</button>
                    <button type="button" class="m-2 btn btn-outline-primary" id="sedev_date_before_yesterday">前日</button>
                    <button type="button" class="m-2 btn btn-outline-info" id="sedev_date_yesterday">昨日</button>
                    <button type="button" class="m-2 btn btn-outline-success" id="sedev_date_day">今日</button>
                    <button type="button" class="m-2 btn btn-outline-dark" id="sedev_date_clear">清除日期</button>
                    <button type="button" class="m-2 btn btn-outline-dark" id="sedev_all_clear">清除條件</button>
                </div>
                <div class="col my-auto">
                    <label for="sedev_number" class="col-form-label">自訂單日搜尋:</label>
                    <input type="date" class="col-form-control" id="sedev_date">
                </div>
                <div class="col-1" hidden>
                    <label for="sedev_month" class="col-form-label">自訂整月搜尋: (例: 2022-01)</label>
                    <div class="col-md-1">
                            <input clas4s="form-control " id="sedev_month" placeholder="yyyy-MM" type="text" maxlength="7" oninput = "value=value.replace(/[^\d-]|-{2}|\d{5}|^\w{1,3}-/g,'')">
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn m-3 btn-primary " id="search_sms" style="font-weight: 600;">送出</button>
    </div>
    <div>
        <button type="button" class="btn m-3 btn-danger" id="se_del_sms" disabled>依照本頁搜尋結果刪除</button>
        <button type="button" class="btn m-2 btn btn-dark " id="stop_reload">停止自動刷新</button>
        <label id="stop_message" style="color: red"></label>


    </div>

    <div class="">
        <div class="card m-2" style="border-radius:10px!important;">
            <h5 class="card-header bg-infoCool py-3 row ml-0 mr-0" style="border-radius:10px 10px 0px 0px!important;">簡訊列表</h5>
            <div class=" m-4">
                {{$dataTable->table()}}
                {{$dataTable->scripts()}}
            </div>
        </div>
    </div>

    <script>
        setTimeout('markUpall();',900);
        //自動刷新
        var stop =true;
        function myrefresh(){
            if(stop){
                //window.location.reload();
                $('#sms_lists-table').DataTable().draw();
                setTimeout('markUpall();',900);
            }
            setTimeout('myrefresh()',6000);
        }
        setTimeout('myrefresh()',6000);

        //setTimeout('markUpall()',800);

        $('#stop_reload').on('click',function(){
            if(stop){
            document.getElementById('stop_message').innerHTML="已暫停自動刷新，重開請再次點擊或按F5";
            stop = false;
            }else{
                document.getElementById('stop_message').innerHTML="";
                stop = true;
            }
        })
        //搜索
            //快速選取

            $('#sedev_date_before_yesterday').on('click',function(){
                let date = new Date();
                date.setDate(date.getDate() - 2);
                date=date.toISOString().split('T')[0];
                var table = $('#sms_lists-table').DataTable();
                table.columns(0).search(date);
                table.draw();
            })
            $('#sedev_date_lastmonth').on('click',function(){
                let date = new Date();
                //避免跨月日期錯誤 將日期設為1
                date.setDate(1);
                date.setMonth(date.getMonth() - 1);
                date=date.toISOString().split('T')[0];
                var table = $('#sms_lists-table').DataTable();
                table.columns(0).search(date.slice(0,7));
                table.draw();
            })
            $('#sedev_date_month').on('click',function(){
                let date = new Date();
                date=date.toISOString().split('T')[0];
                var table = $('#sms_lists-table').DataTable();
                table.columns(0).search(date.slice(0,7));
                table.draw();
            })

            $('#sedev_date_yesterday').on('click',function(){
                let date = new Date();
                date.setDate(date.getDate() - 1);
                date=date.toISOString().split('T')[0];
                var table = $('#sms_lists-table').DataTable();
                table.columns(0).search(date);
                table.draw();
            })
            $('#sedev_date_day').on('click',function(){
                let date = new Date();
                date=date.toISOString().split('T')[0];
                var table = $('#sms_lists-table').DataTable();
                table.columns(0).search(date);
                table.draw();
            })
            $('#sedev_date_clear').on('click',function(){
                $('#sedev_month').val('');
                $('#sedev_date').val('');
                var table = $('#sms_lists-table').DataTable();
                table.columns(0).search('%');
                table.draw();
            })
            $('#sedev_all_clear').on('click',function(){
                $('#sedev_name').val('');
                $('#sedev_businesses').val('');
                $('#sedev_number').val('');
                $('#sesend_number').val('');
                $('#sesms_content').val('');
                $('#sesnoticode').val('');
                $('#sesms_keyword').val('');
            })
        $('#search_sms').on('click',function(){
            document.getElementById("se_del_sms").disabled = false;
            var table = $('#sms_lists-table').DataTable();
            var month =document.getElementById('sedev_month').value;
            var data =[
                    document.getElementById('sedev_date').value,
                    document.getElementById('sedev_name').value,
                    document.getElementById('sedev_businesses').value,
                    document.getElementById('sedev_number').value,
                    document.getElementById('sesend_number').value,
                    document.getElementById('sesms_content').value,
                    document.getElementById('sesnoticode').value,
                    document.getElementById('sesms_keyword').value,
                    ]
                 if(month != ""){data[0]=month};
                 //日期搜尋
                 if(data[0]!=""){
                    table.columns(0).search(data[0]);
                 }
                //不須分詞搜尋
                table.columns(1).search(data[1]);
                //須分詞搜尋
                data[2]=stringAddsearch(data[2]);
                table.columns(2).search(data[2]);
                //不須分詞搜尋
                table.columns(3).search(data[3]);
                table.columns(4).search(data[4]);
                table.columns(5).search(data[5]);
                table.columns(6).search(data[6]);
                //須分詞搜尋
                data[7]=stringAddsearch(data[7]);
                table.columns(7).search(data[7]);

            table.draw();
        })
        function stringAddsearch(string){
            string=string.replace(/\s+/g,' ');
            string=string.trim();
            string=string.split(" ");
            string=string.sort();
            string=string.join("%%");
            return string;
        }
        //刪除
        $('table').on('click','.deletesms',function(){
            var id = $(this).data('id');
            if (confirm("是否真的要刪除簡訊?\n ＊並不會實際刪除手機的簡訊，\n　　但後台不會再看到此簡訊")){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    method: 'DELETE',
                    url: `/sms-lists/${id}/delete`,
                })
                .done(function(msg){
                    alert('刪除成功')
                    location.reload();
                }).fail(function(message){
                    alert(`權限不足`);
                });
            }else {
            }
        })

        //搜尋批次刪除
        $('#se_del_sms').on('click',function(){
                    var td = document.getElementsByTagName("td");
                    var i =0;
                    var data1 =[];
                    //依照現表取id值裝入data1
                    var id =$(td).each(function(index) {
                        if( index%9 ==8){
                            data1[i++] = $(this).find("button").data('id');
                        }
                    });
                    if (confirm("是否真的要刪除本頁簡訊?\n \n＊並不會實際刪除手機的簡訊，\n　　但後台不會再看到此簡訊\n")){
                        if (confirm("*****!!批次刪除本頁所有簡訊 再次確認!!*****")){
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            method: 'DELETE',
                            url: '/sms-lists/deleteMany',
                            data:{
                                "id":data1
                            }
                        })
                        .done(function(msg){
                            alert('刪除成功')
                            location.reload();
                        }).fail(function(message){
                            alert(`權限不足`);
                        });
                        }else {
                    }
                    }else {
                    }
                })
        function markUpall(){
            var noticode=$(".noticode:contains('通知:')");
            var keywordOoO ="";
            var smsContentOoO=null;
            for (var i = 0; i < noticode.length; i++ ) {
                keywordOoO=noticode.eq(i).next().text().trim().split(' ');
                smsContentOoO=noticode.eq(i).prev().text();
                for(var j =0;j<keywordOoO.length;j++){
                    console.log(keywordOoO[j]);

                    var re = new RegExp(keywordOoO[j],"g");
                    smsContentOoO=smsContentOoO.replace(re, '<mark>'+keywordOoO[j]+'</mark>');
                    noticode.eq(i).prev().html(smsContentOoO);
                }
            }
        }

    </script>
@endsection
