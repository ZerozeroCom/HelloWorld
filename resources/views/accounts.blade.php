@extends('layouts.app')
@section('content')

    <div class="card row m-2" >
        <h5 class="card-header bg-info py-3 row ml-0 mr-0">搜尋</h5>
        <div >
            <form>
                <div class="row m-3">
                        <div class="col-md-4 ">
                            <label for="seacc-type" class="col-form-label">管理者類型:</label>
                            <select type="text" class="col-form-control col-md-4"  id="seacc-type" >
                                <option></option>
                                <option>common</option>
                                <option>admin</option>
                                <option>trainee</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="seacc-name" class="col-form-label">帳號名稱:</label>
                            <input type="text" class="col-form-control" id="seacc-name" >
                        </div>
                        <div class="col-md-4">
                            <label for="seemail" class="col-form-label">E-MAIL:</label>
                            <input type="text" class="col-form-control" id="seemail">
                        </div>
                </div>
            </form>
        </div>
        <button type="button" class="btn btn-primary" id="search_acc">搜尋</button>
    </div>

    <div>
          <button type="button" data-bs-toggle="modal" data-bs-target="#naccModal" class="btn btn-success" id="make_new_acc">新增</button>
    </div>

    <div >
    {{$dataTable->table()}}
    </div>

    {{$dataTable->scripts()}}

    @include('layouts.accmodal')
    <script>
        //搜索
        $('#search_acc').on('click',function(){
            var table = $('#users-table').DataTable();
            var data =[
                    "",
                    document.getElementById('seacc-type').value,
                    document.getElementById('seacc-name').value,
                    document.getElementById('seemail').value,
                    ]
            for(var i =1;i<data.length;i++){
                table.columns(i).search(data[i]);
            }
            table.draw();
        })

        var id = null;
        //edit account modal
        var accModal = document.getElementById('accModal');
        accModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            var Edit = button.getAttribute('data-bs-whatever');
            id = button.getAttribute('data-id');
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            var modalTitle = accModal.querySelector('.modal-title');
            var modalBodyInput = accModal.querySelector('.modal-body input');
                modalTitle.textContent = '編輯帳號 ' + Edit;
                document.getElementById('acc-type').value ="";
        })
        //new
        $('.modal-footer').on('click','#accnew_go',function(){
            var name1 = document.getElementById('nacc-name').value
            var email1 = document.getElementById('nemail').value
            var type1 = document.getElementById('nacc-type').value
            var password1 = document.getElementById('nacc-password').value
            var password_confirmation1 = document.getElementById('nacc-password_confirmation').value

                if (  (password1 == password_confirmation1) &&
                    (  password1.length >=8 )){
                        if( email1 != "" && name1 != ""){
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                method: 'POST',
                                url: `/accounts/addNew`,
                                data:{
                                        "type": type1,
                                        "name": name1,
                                        "email": email1,
                                        "password": password1,
                                        "password_confirmation": password_confirmation1,
                                    },
                            }).done(function(msg){
                                alert('新增成功');
                                location.reload();
                                })
                                .fail(function(xhr, status, data){
                                var error =Object.keys(xhr.responseJSON.errors)
                                .map(key=> `${xhr.responseJSON.errors[key]}` )
                                .join('&');
                                alert(`${error}`);
                            });
                        }
                        else {alert('請再次確認是否填滿欄位')
                        }
                }
                else {alert('請再次確認密碼是否相符，或者密碼長度達到八位以上')
                }
        })

        //edit account
        $('.modal-footer').on('click','#accedit_go',function(){
            var name = document.getElementById('acc-name').value
            var email = document.getElementById('email').value
            var type = document.getElementById('acc-type').value
            var password = document.getElementById('acc-password').value
            var password_confirmation = document.getElementById('acc-password_confirmation').value
            var lang = name.length+email.length+type.length+password.length

                if ( lang!=0 && (password == password_confirmation) &&
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
                            })
                            .fail(function(xhr, status, data){
                                var error =Object.keys(xhr.responseJSON.errors)
                                .map(key=> `${xhr.responseJSON.errors[key]}` )
                                .join('&');
                                alert(`${error}`);
                            });
                }
                else {alert('請再次是否有填入內容，或密碼是否相符，或者密碼長度達到八位以上')
                }
        })

        //delete account
        $('table').on('click','.deleteac',function(){
            var idx = $(this).data('id');
            if (confirm("是否真的要刪除帳號?")){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    method: 'POST',
                    url: `/accounts/delete/${idx}`,
                }).done(function(msg){
                    alert('刪除成功')
                    location.reload();
                });
            }else {
            }
        })

    </script>

@endsection
