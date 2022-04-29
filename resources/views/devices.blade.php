@extends('layouts.app')
@section('content')

    <div class="">
        <div class="row">
            <div class="col-sm-8">
                <div class="card   m-2" style="border-radius:10px!important;">
                    <h5 class="card-header bg-infoCool py-3 ml-0 mr-0" style="border-radius:10px 10px 0px 0px!important;">搜尋</h5>
                    <div class="wordStyle g-2">
                        <form>
                            <div class="row m-3 ">
                                    <div class="col-md-4 ">
                                        <label for="sedev-name" class="col-form-label">裝置名稱　</label>
                                        <input type="text" class="col-form-control" id="sedev-name">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="sedev-email" class="col-form-label">　裝置號碼　</label>
                                        <input type="number" class="col-form-control" id="sedev-number" >
                                    </div>
                                    <div class="col-md-4">
                                        <label for="sedev-UID" class="col-form-label">　裝置UID　</label>
                                        <input type="text" class="col-form-control" id="sedev-UID">
                                    </div>
                            </div>
                            <div class="row m-3"   >
                                    <div class="col-md-4">
                                        <label for="sedev-businesses" class="col-form-label">裝置商戶　</label>
                                        <input type="text" class="col-form-control"  id="sedev-businesses">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="sedev-noti_keywords" class="col-form-label">通知關鍵字　</label>
                                        <input type="text" class="col-form-control" id="sedev-noti_keywords">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="sedev-unnoti_keywords" class="col-form-label">忽略關鍵字　</label>
                                        <input type="text" class="col-form-control" id="sedev-unnoti_keywords">
                                    </div>
                            </div>
                        </form>
                    </div>
                    <button type="button" class="btn  m-3 btn-primary" id="search_dev" style="font-weight: 600;">送出</button>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card m-2" style="border-radius:10px!important;">
                    <h5 class="card-header bg-infoCool py-3 row ml-0 mr-0" style="border-radius:10px 10px 0px 0px!important;">批次編輯裝置</h5>
                    <div>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#manydevModal" class="btn m-3 btn-primary" id="se_edit_dev" disabled>依照本頁搜尋結果編輯</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#manydevModal" class="btn m-3 btn-warning" id="make_edit_dev">自訂批次編輯</button>
                    </div>
                </div>
                <button type="button" data-bs-toggle="modal" data-bs-target="#newdevModal" class="btn m-4 btn-success" id="make_new_dev">新增裝置</button>
            </div>
        </div>
        <div class="row m-2 p-3 bg-white" style="border-style:solid;border-color:#14b6ff;border-width:1px 3px 1px 3px;">
            <div class="my-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                </svg>
                    <span style="font-weight:400;">　<b>共用關鍵字： </b></span>

            </div>
            <div class="my-auto">
                {{ $allKeyWord }}
            </div>
            <div class="" style="position:sticky;left:100%;">
                <button type="button" data-bs-toggle="modal" data-bs-target="#editkeyword" class="btn btn-warning align-bottom" id="edit_keyword">編輯</button>
            </div>
        </div>

    </div>

    <div class="">
        <div class="card m-2" style="border-radius:10px!important;">
            <h5 class="card-header bg-infoCool py-3 row ml-0 mr-0" style="border-radius:10px 10px 0px 0px!important;">裝置列表</h5>
            <div class=" m-4">
                {{$dataTable->table()}}
                {{$dataTable->scripts()}}
            </div>
        </div>
    </div>


        @include('layouts.devmodal')

    <script>
        //搜索
        $('#search_dev').on('click',function(){
            var table = $('#devices-table').DataTable();
            document.getElementById("se_edit_dev").disabled = false;
            var data =[
                    "",
                    document.getElementById('sedev-name').value,
                    document.getElementById('sedev-number').value,
                    document.getElementById('sedev-UID').value,
                    document.getElementById('sedev-businesses').value,
                    document.getElementById('sedev-noti_keywords').value,
                    document.getElementById('sedev-unnoti_keywords').value,
                    ]
                //不須分詞搜尋
                table.columns(1).search(data[1]);
                table.columns(2).search(data[2]);
                table.columns(3).search(data[3]);
                //須分詞搜尋
                data[4]=stringAddsearch(data[4]);
                table.columns(4).search(data[4]);
                data[5]=stringAddsearch(data[5]);
                table.columns(5).search(data[5]);
                data[6]=stringAddsearch(data[6]);
                table.columns(6).search(data[6]);

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


        var newOrEdit =null;
        var id = null;
        var devModal = document.getElementById('devModal')
        devModal.addEventListener('show.bs.modal', function (event) {
            //獲取表格資料
            var  tr = event.relatedTarget.closest("tr");
            var data =[$(tr).children().eq(1).text(),
                        $(tr).children().eq(2).text(),
                        $(tr).children().eq(3).text(),
                        $(tr).children().eq(4).text(),
                        $(tr).children().eq(5).text(),
                        $(tr).children().eq(6).text(),
                        $(tr).children().eq(7).text(),];
            var button = event.relatedTarget
            id = button.getAttribute('data-id')
            // Extract info from data-bs-* attributes
            newOrEdit = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            var modalTitle = devModal.querySelector('.modal-title')
            //var name = devModal.querySelector('#dev-name')
                    modalTitle.textContent = '編輯裝置 ' + newOrEdit
                    devModal.querySelector('#dev-name').value = data[0];
                    devModal.querySelector('#dev-number').value = data[1];
                    devModal.querySelector('#dev-UID').value = data[2];
                    devModal.querySelector('#dev-businesses').value = data[3];
                    devModal.querySelector('#dev-noti_keywords').value = data[4];
                    devModal.querySelector('#dev-unnoti_keywords').value = data[5];
                    devModal.querySelector('#dev-note').value = data[6];
        })

            //新增資料部分
        $('.modal').on('click','#devnew_go',function(){
            var data1 =[
                    document.getElementById('ndev-name').value,
                    document.getElementById('ndev-UID').value,
            ];
            var data2 =[
                    document.getElementById('ndev-number').value,
                    document.getElementById('ndev-businesses').value,
                    document.getElementById('ndev-noti_keywords').value,
                    document.getElementById('ndev-unnoti_keywords').value,
                    document.getElementById('ndev-note').value,
            ];
            if (!data1.includes("") ){
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                method: 'POST',
                                url: `/devices/addNew`,
                                data:{
                                        "name": data1[0],
                                        "number": data2[0],
                                        "UID": data1[1],
                                        "businesses": data2[1],
                                        "noti_keywords": data2[2],
                                        "unnoti_keywords": data2[3],
                                        "note": data2[4],
                                    },
                            })
                            .done(function(msg){
                            location.reload()
                            alert(`${msg}新建成功`);
                            }).fail(function(xhr, status, data){
                                var error =Object.keys(xhr.responseJSON.errors)
                                .map(key=> `${xhr.responseJSON.errors[key]}` )
                                .join('&');
                                alert(`${error}`);
                            });
                }else {alert('請再次確認，前三項為必填或裝置號碼需超過8碼')}
        })

        //編輯共通關鍵字部分
        $('.modal').on('click','#editkeyword_go',function(){
            var data1 =document.getElementById('editkeyword-note').value;
            console.log(data1);
            if(data1!=""){
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                method: 'POST',
                                url: '/devices/editkeyword',
                                data:{
                                        "allkeyword": data1,
                                    },
                            })
                            .done(function(msg){
                            location.reload()
                            alert(`${msg}新建成功`);
                            }).fail(function(xhr, status, data){
                                var error =Object.keys(xhr.responseJSON.errors)
                                .map(key=> `${xhr.responseJSON.errors[key]}` )
                                .join('&');
                                alert(`${error}`);
                            });
                }else {alert('內容不可為空')}
        })


              //編輯資料部分
        $('.modal-footer').on('click','#devedit_go',function(){

            //資料依必填或選填分類
            var data1 =[
                    document.getElementById('dev-name').value,
                    document.getElementById('dev-number').value,
                    document.getElementById('dev-UID').value,
            ];
            var data2 =[
                    document.getElementById('dev-businesses').value,
                    document.getElementById('dev-noti_keywords').value,
                    document.getElementById('dev-unnoti_keywords').value,
                    document.getElementById('dev-note').value,
            ];
            //用來檢查表格是否完全沒填
            var check =data1[0].length+data1[1].length+data1[2].length+data2[0].length+data2[1].length+data2[2].length+data2[3].length
                if ( check >= 1 ){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                            method: 'PATCH',
                            url: `/devices/edit/${id}`,
                            data:{  "id": id,
                                    "name": data1[0],
                                    "number": data1[1],
                                    "UID": data1[2],
                                    "businesses": data2[0],
                                    "noti_keywords": data2[1],
                                    "unnoti_keywords": data2[2],
                                    "note": data2[3],
                            },
                        }).done(function(msg){
                                alert('編輯成功')
                                location.reload();
                        }).fail(function(xhr, status, data){
                                var error =Object.keys(xhr.responseJSON.errors)
                                .map(key=> `${xhr.responseJSON.errors[key]}` )
                                .join('&');
                                alert(`${error}`);
                            });
                }
                else {alert('請再次確認是否有填入值，或裝置號碼需超過8碼')
                }
        })
        //依照搜尋結果批次編輯
        var sedata =[];
        var seOrMake =0;
        $('#se_edit_dev').on('click',function(){
            var td = document.getElementsByTagName("td");
            document.getElementById("manydev").hidden = true;

            var i =0;
            //初始化sedata ，送出設定為搜尋模式

            seOrMake =0;
            sedata =[];
            document.getElementById("many_dev_name").innerHTML = sedata;
            //依照現表取id值裝入sedata
            var id =$(td).each(function( index ) {
                if(index==0 || index%9 ==0){
                    sedata[i++] = $( this ).text() ;

                }
            });
            $("#many_dev_name").append('ID 共'+sedata.length+'筆: ');
            for(i=0;i<sedata.length;i++){
                $("#many_dev_name").append(' '+sedata[i]);
            }
        })
       //自訂批次編輯
       $('#make_edit_dev').on('click',function(){
            document.getElementById("manydev").hidden = false;

            //初始化sedata ，送出設定為自訂模式
            seOrMake =1;
            sedata =[];
            document.getElementById("many_dev_name").innerHTML = sedata;

        })


       //送出批次編輯部分
        $('.modal-footer').on('click','#manydev_go',function(){
            var checkboxId =document.getElementsByName("id");
            var data1 =[];
            for(i=0,j=0;i<checkboxId.length;i++){
                if(checkboxId[i].checked == true){
                    data1[j++]=checkboxId[i].getAttribute('data-id');
                }
            }
            var data2 =[
                    document.getElementById('manydev-businesses').value,
                    document.getElementById('manydev-noti_keywords').value,
                    document.getElementById('manydev-unnoti_keywords').value,
                    document.getElementById('manydev-note').value,
            ];
            //檢查模式
            if(seOrMake ==0){
                if (confirm("是否確認編輯"+sedata.length+"項裝置?")){
                    //用來檢查表格是否完全沒填
                    var check =data2[0].length+data2[1].length+data2[2].length+data2[3].length
                    if ( check >= 1 && sedata != [] ){

                            //搜尋模式
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                    },
                                        method: 'PATCH',
                                        url: '/devices/editmany',
                                        data:{  "id": sedata,
                                                "businesses": data2[0],
                                                "noti_keywords": data2[1],
                                                "unnoti_keywords": data2[2],
                                                "note": data2[3],
                                        },
                                    }).done(function(msg){
                                            alert('編輯成功')
                                            location.reload();
                                    }).fail(function(xhr, status, data){
                                            var error =Object.keys(xhr.responseJSON.errors)
                                            .map(key=> `${xhr.responseJSON.errors[key]}` )
                                            .join('&');
                                            alert(`${error}`);
                                        });

                    }
                    else {alert('請再次確認是否有填入值')
                    }
                }
            }
            else {
                //搜尋模式 自訂模式
                if (confirm("是否確認編輯"+data1.length+"項裝置?")){
                    //用來檢查表格是否完全沒填
                    var check =data2[0].length+data2[1].length+data2[2].length+data2[3].length
                    if ( check >= 1 &&  data1 != []){
                        $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                    method: 'PATCH',
                                    url: '/devices/editmany',
                                    data:{  "id": data1,
                                            "businesses": data2[0],
                                            "noti_keywords": data2[1],
                                            "unnoti_keywords": data2[2],
                                            "note": data2[3],
                                    },
                                }).done(function(msg){
                                        alert('編輯成功')
                                        location.reload();
                                }).fail(function(xhr, status, data){
                                        var error =Object.keys(xhr.responseJSON.errors)
                                        .map(key=> `${xhr.responseJSON.errors[key]}` )
                                        .join('&');
                                        alert(`${error}`);
                                });
                    }
                    else {alert('請再次確認是否有填入值')
                    }
                }
            }
        })

        //刪除裝置
        $('table').on('click','.deletedev',function(){
            var idx = $(this).data('id');
            if (confirm("是否真的要刪除裝置?")){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    method: 'DELETE',
                    url: `/devices/${idx}/delete`,

                })
                .done(function(msg){
                    alert('刪除成功')
                    location.reload();
                }).fail(function(message){
                    alert('已存在裝置簡訊或權限不足，\n\n若存在簡訊請利用搜尋功能批次刪除\n\n盡量搜尋完整 名稱/號碼 以避免誤刪其他簡訊');
                });
            }
        })

    </script>

@endsection
