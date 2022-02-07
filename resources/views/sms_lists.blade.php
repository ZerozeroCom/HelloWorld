@extends('layouts.app')
@section('content')

    <div >
        <span class-"">搜尋</span>
        <div>
            <form>
                <label for="sesend_number" class="">簡訊發送號碼:</label>
                <input type="text" class="" id="sesend_number">
                <label for="sesms_content" class="">簡訊內容:</label>
                <input type="text" class="" id="sesms_content">

            </form>
            <button type="button" class="btn btn-primary" id="search_sms">搜尋</button>
        </div>
    </div>

    <div >
    {{$dataTable->table()}}
    </div>
    {{$dataTable->scripts()}}

    <script>
        //搜索
        $('#search_sms').on('click',function(){
            var table = $('#sms_lists-table').DataTable();
            var data =[
                    "",
                    "",
                    "",
                    "",
                    "",
                    document.getElementById('sesend_number').value,
                    document.getElementById('sesms_content').value,
                    "",
                    ]
            for(var i =2;i<data.length;i++){
                table.columns(i).search(data[i]);
            }
            table.draw();
        })
        //刪除
        $('table').on('click','.deletesms',function(){
            var id = $(this).data('id');
            if (confirm("是否真的要刪除簡訊?")){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    method: 'POST',
                    url: `/sms-lists/${id}/delete`,
                })
                .done(function(msg){
                    alert('刪除成功')
                    location.reload();
                }).fail(function(message){
                    alert(`${message}錯誤`);
                });
            }else {
            }
        })

    </script>
@endsection
