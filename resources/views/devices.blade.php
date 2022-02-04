@extends('layouts.app')
@section('content')

    <div>
        <span class-"">搜尋</span>
        <div >
            <div>
                <span>裝置名稱 <input type="search" class="form-control form-control-sm" placeholder aria-controls="devices-table"></span>
                <span>裝置號碼<input></span>
                <span>裝置UID<input></span>
                <span>裝置備註<input></span>
                <span>通知關鍵字<input></span>
                <span>不通知關鍵字<input></span>
            </div>
        </div>
        <button type="button" data-bs-toggle="modal" data-bs-target="#newdevModal" class="btn btn-success" id="make_new_dev">新增</button>
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
                    modalTitle.textContent = '編輯裝置 ' + newOrEdit
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
                    console.log(12)
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
            console.log(data2[0].length);
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
