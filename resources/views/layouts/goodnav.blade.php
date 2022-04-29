            <!-- Topbar -->
            <nav class="navbar navbar-expand bg-gradient-secondary border-b  topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <div class="m-1">
                    <button id="sidebarToggleTop" class="btn rounded-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                    </button>
                </div>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <a style="display:none">{{ $notifications =Auth::user()->unreadNotifications ?? []; }}</a>
                    <!-- Nav Item - Alerts -->
                    <label class="my-auto" id="navstop_message" style="color: red"></label>
                    <button class="m-4 text-secondary" id="navstop_reload" style="background-color:transparent">暫停通知</button>
                    <li class="nav-item dropdown no-arrow mx-1" id="notiarea">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                            </svg>
                            <!-- Counter - 未讀通知計數 -->
                            <span class="badge badge-danger badge-counter" id="no_read_count" {{ $notifications->count() == 0  ? "hidden":""}}>{{ $notifications->count()}}</span>
                        </a>
                        <!-- Dropdown - 未讀通知顯示 -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in "
                            aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                通知
                            </h6>
                            <div id="no_read_content">
                                @foreach ($notifications as $notification)
                                <a class="dropdown-item d-flex align-items-center read_notification" data-id="{{$notification->id}}"  href="/sms-lists">
                                    <div class="mr-3">
                                        <span class="read">
                                            @if ($notification->read_at)
                                                (已讀)
                                            @endif
                                        </span>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">{{$notification->created_at}}</div>
                                        <span class="font-weight-bold">{{$notification->data[0]}}</span>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            @if ($notifications->count() != 0)
                                <a class="dropdown-item text-center small text-gray-500 no_read_foot" id="all_read" href="#">全部已讀</a>
                                <a class="dropdown-item text-center small text-gray-500 no_read_foot" id="no_unread_noti" hidden href="#">沒有未讀通知</a>
                            @else
                                <a class="dropdown-item text-center small text-gray-500 no_read_foot" id="all_read" hidden href="#">全部已讀</a>
                                <a class="dropdown-item text-center small text-gray-500 no_read_foot" id="no_unread_noti" href="#">沒有未讀通知</a>
                            @endif

                        </div>
                    </li>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle">
                            <span class="mr-2 d-none d-lg-inline text-gray-200 small">{{ Auth::user()->name }}</span>
                        </a>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->


                <div class="m-2 p-2"  >
                    @yield('content')
                </div>

                <script>
                    $('#navstop_reload').on('click',function(){
                        if(stop){
                            document.getElementById('navstop_message').innerHTML="已暫停讀取通知，重開請再次按鈕";
                            stop = false;
                        }else{
                            document.getElementById('navstop_message').innerHTML="";
                            stop = true;
                        }

                    })
                    $('.read_notification').on('click',function(){
                        var $this = $(this)
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            method:'POST',
                            url:'read-notification',
                            data: {id: $this.data('id')}

                        })
                        .done(function(msg){
                            if(msg.result){
                                $this.find('.read').text('(已讀)')
                            }
                        })
                    })
                    $('#all_read').on('click',function(){
                        var $this = $(this)
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            method:'POST',
                            url:'read-all-notification',
                            data: {'ok':1}
                        })
                        .done(function(msg){
                            top.location.reload()
                        })
                    })
                    var count0 =$('#no_read_count').text();
                    function notirefresh(){
                        if(stop){
                                console.log(count0);
                            var $this = $(this)
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                method:'POST',
                                url:'get-notification',
                                data: {'count': count0,}
                            })
                            .done(function(notifications){
                                if(count0 ==0){
                                        var navcount= document.getElementById("all_read").hidden = false;
                                        var navcount= document.getElementById("no_unread_noti").hidden = true;
                                    }
                                var end=notifications.countSer-count0;
                                count0 =notifications.countSer;
                                if(notifications.notifications == "nonew"){
                                }else{
                                    var navcount= document.getElementById("no_read_count").hidden = false;
                                    $('#no_read_count').text(count0);
                                    for(i=0;i<end ;i++){
                                        //console.log(notifications.notifications[i].data);
                                        let date = new Date(notifications.notifications[i].created_at);
                                        $('#no_read_content').append('<a class="dropdown-item d-flex align-items-center read_notification" data-id="{{'+notifications.notifications[i].id+'"  href="/sms-lists"><div class="mr-3"></div><div><div class="small text-gray-500">'+date+'</div><span class="font-weight-bold">'+notifications.notifications[i].data+'</span></div></a>');
                                        var notification = new Notification(notifications.notifications[i].data, {
                                                                                    icon: '/icon/send.svg',
                                                                                    body: '內文請在簡訊列表查看',
                                                                                });

                                    }

                                }

                            })
                        }
                        setTimeout('notirefresh()',5000);
                    }
                    setTimeout('notirefresh()',6000);
                </script>
            @stack('modals')
