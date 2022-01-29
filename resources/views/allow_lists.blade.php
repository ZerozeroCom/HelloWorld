@extends('layouts.app')
@section('content')

    <div >
    {{$dataTable->table()}}
    </div>


    {{$dataTable->scripts()}}

    @include('layouts.almodal')

    <script>
        var alModal = document.getElementById('alModal')
        alModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = alModal.querySelector('.modal-title')
        var modalBodyInput = alModal.querySelector('.modal-body input')

        modalTitle.textContent = '編輯白名單 ' + recipient
        modalBodyInput.value = recipient
        })

        //DELETE
        $('table').on('click','.deleteal',function(){
            var id = $(this).data('id');
            if (confirm("是否真的要刪除白名單?")){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    method: 'POST',
                    url: `/allow-lists/${id}/delete`,
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
