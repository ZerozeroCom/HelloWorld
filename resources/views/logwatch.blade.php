@extends('layouts.app')
@section('content')

    <div>
        <h2>顯示log</h2>

        <div>
        @foreach ( $files as $file)
            <div class="mb-2">{{$file}}  <a href="../{{$file}}"><button>顯示文件</button></a></div>
        @endforeach
        </div>

    </div>
    <a href="/sms-log/33456/all-download"><button>全部下載</button></a>
    <a href="/sms-log/33456/all-delete"><button>全部刪除</button></a>


@endsection
