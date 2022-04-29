@extends('layouts.app')
@section('content')

    <div class="row ">
        <div class="card m-2 px-0  col-5" style="border-radius:10px!important;">
            <h5 class="card-header bg-infoCool py-3 ml-0 mr-0" style="border-radius:10px 10px 0px 0px!important;">APP下載</h5>

                <h3 class="mx-auto  py-3">
                    <a href="/app-download/apk">直接下載</a>
                </h3>


                <h3 class="mx-auto my-2 pb-2">
                    QRCode下載
                </h3>
                <img class="mx-auto  my-5" src="/QRcode/app.png">
        </div>




        <div class="card m-2 px-0 col-5" style="border-radius:10px!important;">
            <h5 class="card-header bg-infoCool py-3 ml-0 mr-0" style="border-radius:10px 10px 0px 0px!important;">APP設定-範例影片</h5>
            <h3 class="mx-auto  py-3">
                    <a href="/app-download/mp4">下載</a>
            </h3>
            <h3 class="mx-auto  ">設定範例</h3>
            <h5 class="mx-3 mb-3">
                此影片已包含在APP的說明內
            </h5>
            <video class="mx-auto  " height="50%" width="50%"  src=/storage/demonstration.mp4 controls intrinsicsize></video>
        </div>
    </div>


@endsection
