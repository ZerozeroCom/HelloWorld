@extends('layouts.app')
@section('content')

    <div>
        <button type="button" data-bs-toggle="modal" data-bs-target="#devModal" class="btn btn-success" id="make_new_dev">新增</button>
    </div>
    <div >
        {{$dataTable->table()}}
    </div>
        {{$dataTable->scripts()}}

        @include('layouts.devmodal')

    <script>
        var newOrEdit =null;
        var id = null;
        var devModal = document.getElementById('devModal')
        devModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = event.relatedTarget
            id = button.getAttribute('data-id')
            // Extract info from data-bs-* attributes
            newOrEdit = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            var modalTitle = devModal.querySelector('.modal-title')
            var modalBodyInput = devModal.querySelector('.modal-body input')
            if(newOrEdit == null){
                    //把要新建的表單清空
                    modalTitle.textContent = '新增帳號'
                    document.getElementById('dev-name').value ="";
                    document.getElementById('dev-number').value ="";
                    document.getElementById('dev-UID').value ="";
                    document.getElementById('dev-note').value ="";
                    document.getElementById('dev-noti_keywords').value ="";
                    document.getElementById('dev-unnoti_keywords').value ="";

                }else{
                    //若是編輯 把標題改名
                    modalTitle.textContent = '編輯帳號 ' + newOrEdit
                }
            })

        //發送新增或編輯資料
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
            check =JSON.stringify(data1)+JSON.stringify(data2);

            if(newOrEdit == null){
                //若必填有空值就不傳資料
                if (  !data1.includes("")){
                    console.log(12)
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                method: 'POST',
                                url: `/devices/addNew`,
                                dataType: "json",
                                data:{
                                        "name": data1[0],
                                        "number": data1[1],
                                        "UID": data1[2],
                                        "note": data2[0],
                                        "noti_keywords": data2[1],
                                        "unnoti_keywords": data2[2],
                                    },
                            }).done(function(msg){
                            alert('新建成功')
                            location.reload();
                            });
                }else {alert('請再次確認，前三項為必填')}
            }else{  //編輯資料部分
                if ( check.length > 20){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                            method: 'POST',
                            url: `/devices/edit/${id}`,
                            dataType: "json",
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
                        });
                }
                else {alert('請再次確認是否有填入值')
                }
            }
        })

        //刪除裝置
        $('table').on('click','.deletedev',function(){
            var id = $(this).data('id');
            if (confirm("是否真的要刪除裝置?")){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    method: 'POST',
                    url: `/devices/${id}/delete`,

                })
                .done(function(msg){
                    alert('刪除成功')
                    location.reload();
                })
            }else {
            }
        })

    </script>

@endsection
