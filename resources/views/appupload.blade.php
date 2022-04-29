@extends('layouts.app')
@section('content')

    <div>
        <form method="post" enctype="multipart/form-data" action="/app-upload/22568/uploadapp/0">
            @csrf
            <input type="file" name="apk">
            <input type="submit" value="上傳APK">
        </form>
    </div>
    <div>
        <form method="post" enctype="multipart/form-data" action="/app-upload/22568/uploadapp/1">
            @csrf
            <input type="file" name="mp4">
            <input type="submit" value="上傳MP4">
        </form>
    </div>


    <div class="m-3 bg-white">
        @foreach ( Storage::files('public') as $file)
            <div class="mb-2">{{$file}} </div>
        @endforeach
    </div>
    <table>
        <thead>
            <tr><th>SMSid</th><th>時間</th><th>裝置id</th><th>狀態</th><th>內容</th></tr>
        </thead>
        <tbody class="mb-2">
        @foreach ( App\Models\Sms_list::orderByDesc('smsid')->limit(100)->get() as $data)
            <tr ><td>{{$data->smsid}}</td><td>{{$data->sms_sendtime}}</td><td>{{$data->device_id}}</td><td>{{$data->status}}</td><td>{{$data->sms_content}}</td> </tr>
        @endforeach
        </tbody>
    </table>
@endsection
