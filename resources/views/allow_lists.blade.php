@extends('layouts.app')
@section('content')

    <div class="card row m-2" >
        <h5 class="card-header bg-info py-3 row ml-0 mr-0">搜尋</h5>
        <div >
            <form>
                <div class="row m-3">
                        <div class="col-md-12 ">
                            <label for="seallow_ip_addr" class="col-form-label">IP位址:</label>
                            <input type="text" class="col-form-control" id="seallow_ip_addr">
                        </div>
                </div>
            </form>
        </div>
        <button type="button" class="btn m-2 btn-primary" id="search_al">搜尋</button>
    </div>



    <div >
    {{$dataTable->table()}}
    </div>


    {{$dataTable->scripts()}}

    @include('layouts.almodal')


    <script>
        //搜索
        $('#search_al').on('click',function(){
            var table = $('#allow_lists-table').DataTable();
            var data =[
                    "",
                    "",
                    document.getElementById('seallow_ip_addr').value,
                    ]
            for(var i =2;i<data.length;i++){
                table.columns(i).search(data[i]);
            }
            table.draw();
        })



        var id = null;
        var alModal = document.getElementById('alModal')
        alModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        id = button.getAttribute('data-id')
        user_id=  button.getAttribute('data-bs-user')
        // Extract info from data-bs-* attributes
        newOrEdit = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = alModal.querySelector('.modal-title')
        var modalBodyInput = alModal.querySelector('.modal-body input')

        modalTitle.textContent = '編輯白名單 ' + newOrEdit
        modalBodyInput.value = newOrEdit
        })

          //新增資料部分
        $('.modal-footer').on('click','#alnew_go',function(){
            var data1 =[
                    user_id,
                    document.getElementById('allow-list').value,
            ];
            if (!data1.includes("")){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                            method: 'POST',
                            url: `/allow-lists/addNew`,
                            data:{
                                    "user_id": data1[0],
                                    "allow_ip_addr": data1[1],
                            },
                        }).done(function(msg){
                            alert('新建成功')
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

        })
            //編輯資料部分
        $('.modal-footer').on('click','#aledit_go',function(){
            var data1 =[
                    user_id,
                    document.getElementById('allow-list').value,
            ];
            console.log(123);
            if (!data1.includes("")){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                            method: 'POST',
                            url: `/allow-lists/edit/${id}`,
                            data:{
                                    "user_id": data1[0],
                                    "allow_ip_addr": data1[1],
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

        })


        //DELETE
        $('table').on('click','.deleteal',function(){
            var idx = $(this).data('id');
            if (confirm("是否真的要刪除白名單?")){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    method: 'POST',
                    url: `/allow-lists/${idx}/delete`,
                })
                .done(function(msg){
                    alert('刪除成功')
                    location.reload();
                }).fail(function(error){
                      alert('請勿刪除最後一個白名單，直接刪除帳號可消除所有白名單。');
                    });
            }else {
            }
        })

    </script>


@endsection
