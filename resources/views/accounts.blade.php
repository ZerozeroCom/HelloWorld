@extends('layouts.app')
@section('content')

    <div>
          <button type="button" data-bs-toggle="modal" data-bs-target="#accModal" class="btn btn-success" id="make_new_acc">新增</button>
    </div>

    <div >
    {{$dataTable->table()}}
    </div>

    {{$dataTable->scripts()}}

    @include('layouts.accmodal')
    <script>
        var newOrEdit =null;
        var id = null;
        //edit account modal
        var accModal = document.getElementById('accModal')
        accModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            newOrEdit = button.getAttribute('data-bs-whatever')
            id = button.getAttribute('data-id')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            var modalTitle = accModal.querySelector('.modal-title')
            var modalBodyInput = accModal.querySelector('.modal-body input')

            if(newOrEdit == null){
                modalTitle.textContent = '新增帳號'
                document.getElementById('acc-name').value ="";
                document.getElementById('email').value ="";
                document.getElementById('acc-type').value ="";
                document.getElementById('acc-password').value ="";
                document.getElementById('acc-password_confirmation').value ="";

            }else{
                modalTitle.textContent = '編輯帳號 ' + newOrEdit
            }
        })

        //edit account
        $('.modal-footer').on('click','#accedit_go',function(){
            var name = document.getElementById('acc-name').value
            var email = document.getElementById('email').value
            var type = document.getElementById('acc-type').value
            var password = document.getElementById('acc-password').value
            var password_confirmation = document.getElementById('acc-password_confirmation').value

            console.log(id)
            if(newOrEdit ==null){
                if (  (password == password_confirmation) &&
                    (  password.length >=8 )){
                        if( email != "" && name != ""){
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                method: 'POST',
                                url: `/accounts/addNew`,
                                data:{
                                        "type": type,
                                        "name": name,
                                        "email": email,
                                        "password": password,
                                        "password_confirmation": password_confirmation,
                                    },
                            }).done(function(msg){
                                alert('新增成功');
                                location.reload();
                                })
                        }
                        else {alert('請再次確認是否填滿欄位')
                        }
                }
                else {alert('請再次確認密碼是否相符，或者密碼長度達到八位以上')
                }
            }
            else{
                if (  (password == password_confirmation) &&
                    (  password == ""   || password.length >=8 )){
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                method: 'POST',
                                url: `/accounts/edit/${id}`,
                                data:{  "id": id,
                                        "type": type,
                                        "name": name,
                                        "email": email,
                                        "password": password,
                                        "password_confirmation": password_confirmation,
                                    },
                            }).done(function(msg){
                                alert('編輯成功');
                                location.reload();
                            });
                }
                else {alert('請再次確認密碼是否相符，或者密碼長度達到八位以上')
                }
            }
        })

        //delete account
        $('table').on('click','.deleteac',function(){
            var id = $(this).data('id');
            if (confirm("是否真的要刪除帳號?")){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    method: 'POST',
                    url: `/accounts/delete/${id}`,
                }).done(function(msg){
                    alert('刪除成功')
                    location.reload();
                });
            }else {
            }
        })
    </script>

@endsection
