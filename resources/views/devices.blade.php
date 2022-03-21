@extends('layouts.app')
@section('content')

    <div class="">
        <div class="row">
        <div class="col-sm-8">
            <div class="card   m-2" >
                <h5 class="card-header bg-info py-3 ml-0 mr-0">搜尋</h5>
                <div class=" g-2">
                    <form>
                        <div class="row m-3 ">
                                <div class="col-md-4 ">
                                    <label for="sedev-name" class="col-form-label">裝置名稱:</label>
                                    <input type="text" class="col-form-control" id="sedev-name">
                                </div>
                                <div class="col-md-4">
                                    <label for="sedev-email" class="col-form-label">　裝置號碼:</label>
                                    <input type="number" class="col-form-control" id="sedev-number" >
                                </div>
                                <div class="col-md-4">
                                    <label for="sedev-UID" class="col-form-label">　裝置UID :</label>
                                    <input type="text" class="col-form-control" id="sedev-UID">
                                </div>
                        </div>
                        <div class="row m-3"  style="background-color:#82FF82;" >
                                <div class="col-md-4">
                                    <label for="sedev-businesses" class="col-form-label">裝置商戶:</label>
                                    <input type="text" class="col-form-control"  id="sedev-businesses">
                                </div>
                                <div class="col-md-4">
                                    <label for="sedev-noti_keywords" class="col-form-label">通知關鍵字:</label>
                                    <input type="text" class="col-form-control" id="sedev-noti_keywords">
                                </div>
                                <div class="col-md-4">
                                    <label for="sedev-unnoti_keywords" class="col-form-label">忽略關鍵字:</label>
                                    <input type="text" class="col-form-control" id="sedev-unnoti_keywords">
                                </div>
                        </div>
                    </form>
                </div>
                <button type="button" class="btn  m-3 btn-primary" id="search_dev">搜尋</button>
            </div>

        </div>
        <div class="col-sm-4">
            <div class="card m-2">
                <h6 class="card-header bg-info py-3 row ml-0 mr-0">批次編輯裝置</h6>
                <div>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#manydevModal" class="btn m-3 btn-primary" id="se_edit_dev" disabled>依照本頁搜尋結果編輯</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#manydevModal" class="btn m-3 btn-warning" id="make_edit_dev">自訂批次編輯</button>
                </div>
            </div>
            <button type="button" data-bs-toggle="modal" data-bs-target="#newdevModal" class="btn m-4 btn-success" id="make_new_dev">新增裝置</button>
        </div>

        </div>

    </div>


    <div >
        {{$dataTable->table()}}
    </div>
        {{$dataTable->scripts()}}

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
                    alert(`權限不足`);
                });
            }
        })

    </script>

@endsection
