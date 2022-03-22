@extends('layouts.app')
@section('content')

    <div class="container bg-white">
        <h2 class="p-5  text-center">APP下載</h2>
        <div class="row">
            <div class="p-5 col">

                <h3 class="  py-5">
                    <a href="/app-download/apk">直接下載</a>
                </h3>


                <h3 class="my-5 pb-5">
                    QRCode下載
                </h3>
                <img class="pb-5" src="/storage/DAV3Z1LMRV.png">
            </div>
            <div class="col p-5">
                <h3 class="  py-2">
                    設定範例 <a href="/app-download/mp4">下載</a>
                </h3>
                <video src=/storage/demonstration.mp4 controls>
                </video>
                <h5>
                    此影片已包含在APP的說明內
                </h5>
            </div>
        </div>
    </div>





@endsection
