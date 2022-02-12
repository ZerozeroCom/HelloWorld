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
                                    <label for="sedev-email" class="col-form-label">裝置號碼　:</label>
                                    <input type="text" class="col-form-control" id="sedev-number" >
                                </div>
                                <div class="col-md-4">
                                    <label for="sedev-UID" class="col-form-label">裝置UID　　 :</label>
                                    <input type="text" class="col-form-control" id="sedev-UID">
                                </div>
                        </div>
                        <div class="row m-3">
                                <div class="col-md-4">
                                    <label for="sedev-note" class="col-form-label">備註　　:</label>
                                    <input type="text" class="col-form-control"  id="sedev-note">
                                </div>
                                <div class="col-md-4">
                                    <label for="sedev-noti_keywords" class="col-form-label">通知關鍵字:</label>
                                    <input type="text" class="col-form-control" id="sedev-noti_keywords">
                                </div>
                                <div class="col-md-4">
                                    <label for="sedev-unnoti_keywords" class="col-form-label">不通知關鍵字:</label>
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
                    <button type="button" data-bs-toggle="modal" data-bs-target="#manydevModal" class="btn m-3 btn-warning" id="se_edit_dev">依照本頁搜尋結果編輯</button>
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
            var data =[
                    "",
                    document.getElementById('sedev-name').value,
                    document.getElementById('sedev-number').value,
                    document.getElementById('sedev-UID').value,
                    document.getElementById('sedev-note').value,
                    document.getElementById('sedev-noti_keywords').value,
                    document.getElementById('sedev-unnoti_keywords').value,
                    ]
            for(var i =1;i<data.length;i++){
                table.columns(i).search(data[i]);
            }
            table.draw();
        })



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
                        $(tr).children().eq(6).text(),];
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
                    devModal.querySelector('#dev-note').value = data[3];
                    devModal.querySelector('#dev-noti_keywords').value = data[4];
                    devModal.querySelector('#dev-unnoti_keywords').value = data[5];
        })

            //新增資料部分
        $('.modal').on('click','#devnew_go',function(){
            var data1 =[
                    document.getElementById('ndev-name').value,
                    document.getElementById('ndev-number').value,
                    document.getElementById('ndev-UID').value,
            ];
            var data2 =[
                    document.getElementById('ndev-note').value,
                    document.getElementById('ndev-noti_keywords').value,
                    document.getElementById('ndev-unnoti_keywords').value,
            ];
            if (!data1.includes("") && data1[1].length >= 9){
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                method: 'POST',
                                url: `/devices/addNew`,
                                data:{
                                        "name": data1[0],
                                        "number": data1[1],
                                        "UID": data1[2],
                                        "note": data2[0],
                                        "noti_keywords": data2[1],
                                        "unnoti_keywords": data2[2],
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
                    document.getElementById('dev-note').value,
                    document.getElementById('dev-noti_keywords').value,
                    document.getElementById('dev-unnoti_keywords').value,
            ];
            //用來檢查表格是否完全沒填
            var check =data1[0].length+data1[1].length+data1[2].length+data2[0].length+data2[1].length+data2[2].length
                if ( check >= 1 && (data1[1].length >= 9 || data1[1] == "")){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                            method: 'POST',
                            url: `/devices/edit/${id}`,
                            data:{  "id": id,
                                    "name": data1[0],
                                    "number": data1[1],
                                    "UID": data1[2],
                                    "note": data2[0],
                                    "noti_keywords": data2[1],
                                    "unnoti_keywords": data2[2],
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
        $('#se_edit_dev').on('click',function(){
            var td = document.getElementsByTagName("td");
            var i =0;
            //初始化sedata
            sedata =[];
            //依照現表取id值裝入sedata
            var id =$(td).each(function( index ) {
                if(index==0 || index%8 ==0){
                    sedata[i++] = $( this ).text() ;

                }
            });
        })



       //送出批次編輯部分
        $('.modal-footer').on('click','#manydev_go',function(){
            var data2 =[
                    document.getElementById('manydev-note').value,
                    document.getElementById('manydev-noti_keywords').value,
                    document.getElementById('manydev-unnoti_keywords').value,
            ];
            if (confirm("是否真的要編輯?")){
                //用來檢查表格是否完全沒填
                var check =data2[0].length+data2[1].length+data2[2].length
                if ( check >= 1 && sedata != []){
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                                method: 'POST',
                                url: '/devices/editmany',
                                data:{  "id": sedata,
                                        "note": data2[0],
                                        "noti_keywords": data2[1],
                                        "unnoti_keywords": data2[2],
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
        })

        //刪除裝置
        $('table').on('click','.deletedev',function(){
            var idx = $(this).data('id');
            if (confirm("是否真的要刪除裝置?")){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    method: 'POST',
                    url: `/devices/${idx}/delete`,

                })
                .done(function(msg){
                    alert('刪除成功')
                    location.reload();
                }).fail(function(message){
                    alert(`${message}錯誤`);
                });
            }
        })

    </script>

@endsection
