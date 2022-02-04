@extends('layouts.app')
@section('content')



    <div >
    {{$dataTable->table()}}
    </div>


    {{$dataTable->scripts()}}

    <script>
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
