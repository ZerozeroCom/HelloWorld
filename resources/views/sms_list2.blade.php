@extends('layouts.app')
@section('content')
<div id="myapptable">
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
                <button type="button" class="m-2 btn btn-outline-info" v-on:click="lastmonth()">上月</button>
                <button type="button" class="m-2 btn btn-outline-success" v-on:click="thismonth()">今月</button>
                <button type="button" class="m-2 btn btn-outline-primary" v-on:click="before_yesterday()">前日</button>
                <button type="button" class="m-2 btn btn-outline-info" v-on:click="date_yesterday()">昨日</button>
                <button type="button" class="m-2 btn btn-outline-success" v-on:click="date_today()">今日</button>
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
<div id="app"></div>
<div class="">
    <div class="card m-2" style="border-radius:10px!important;">
        <h5 class="card-header bg-infoCool py-3 row ml-0 mr-0" style="border-radius:10px 10px 0px 0px!important;">簡訊列表</h5>
        <div class=" m-4"  >
            <table >
                <thead>
                    <tr>
                        <th>smsid</th>
                        <th>sms_sendtime</th>
                        <th>device_id</th>
                        <th>send_number</th>
                        <th>sms_content</th>
                        <th>keyword</th>
                        <th>noticode</th>
                        <th>status</th>
                        <th>op</th>
                    </tr>
                </thead>
                <tbody >
                    <tr class="item" v-for="item in dataA" :key="item.smsid">
                        <td class="smsid" >@{{item.smsid}}</td>
                        <td class="sms_sendtime" >@{{item.sms_sendtime | timeString('YYYY-MM-DD HH:mm:ss')}}</td>
                        <td class="device_id" >@{{item.device_id}}</td>
                        <td class="send_number" >@{{item.send_number}}</td>
                        <td class="sms_content" >@{{item.sms_content}}</td>
                        <td class="keyword" >@{{item.keyword}}</td>
                        <td class="noticode" >@{{item.noticode}}</td>
                        <td class="status" >@{{item.status}}</td>
                        <td><button class="btn btn-danger " :data-id="item.smsid" v-on:click="deletesms(item)">刪除</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="{{ mix('/js/app.js') }}" >
</script>

<script >
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

</script>

@endsection
