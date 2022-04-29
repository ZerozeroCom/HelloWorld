@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-3" style="border-radius:10px!important;">
            <div class="list-group-item bg-infoCool" style="border-radius:10px 10px 0px 0px!important;">APP</div>

                <div class="list-group bg-white " id="list-tab" role="tablist" style="border-radius:10px!important;">

                        <a href="#app" class="list-group-item list-group-item-action mt-2 mx-2 w-auto active" data-bs-toggle="list" role="tab">
                            使用說明
                        </a>
                        <a href="#start" class="list-group-item list-group-item-action mx-2 w-auto" data-bs-toggle="list" role="tab">
                            設定流程
                        </a>
                        <a href="#permission" class="list-group-item list-group-item-action mx-2 w-auto" data-bs-toggle="list" role="tab">
                            權限說明
                        </a>
                        <a href="#sign" class="list-group-item list-group-item-action mx-2 w-auto" data-bs-toggle="list" role="tab">
                            註冊裝置
                        </a>
                        <a href="#use" class="list-group-item list-group-item-action mx-2 w-auto" data-bs-toggle="list" role="tab">
                            開始使用
                        </a>
                        <a href="#error" class="list-group-item list-group-item-action mx-2 w-auto" data-bs-toggle="list" role="tab">
                            收不到簡訊...
                        </a>
                        <a href="#ect" class="list-group-item list-group-item-action mb-2 mx-2 w-auto" data-bs-toggle="list" role="tab" style="border-radius:0px 0px 10px 10px!important;">
                            常見問題
                        </a>
                        <div class="bg-infoCool p-3 pl-4" >網頁</div>
                        <a href="#all" class="list-group-item list-group-item-action mt-2 mx-2 w-auto" data-bs-toggle="list" role="tab" style="border-radius:10px 10px 0px 0px!important;">
                            共通:全站操作
                        </a>
                        <a href="#noti" class="list-group-item list-group-item-action mx-2 w-auto" data-bs-toggle="list" role="tab">
                            通知
                            </a>
                        <a href="#sms" class="list-group-item list-group-item-action  mx-2 w-auto" data-bs-toggle="list" role="tab">
                            簡訊列表
                        </a>
                        <a href="#user" class="list-group-item list-group-item-action mx-2 w-auto" data-bs-toggle="list" role="tab">
                            管理者權限設定
                        </a>
                        <a href="#device" class="list-group-item list-group-item-action mx-2 w-auto" data-bs-toggle="list" role="tab">
                        裝置管理
                        </a>
                        <a href="#ip" class="list-group-item list-group-item-action mx-2 mb-2 w-auto" data-bs-toggle="list" role="tab">
                        IP白名單群組管理
                        </a>


                </div>
        </div>
        <div class ="container col ">
            <div class="tab-content bg-white p-4" >

                <!--app-->
                <div class="tab-pane active" id="app" role="tabpanel" >
                    <h3 class="py-3 text-center "><b>簡訊收發APP使用說明</b></h3>
                    <h4 class="py-2 mt-3">　　<b>介面</b></h4>
                    <span class="p-4">主要分四個區塊，還有說明頁面</span>
                    <div>
                        <img src="/doc/viewnote.PNG">
                    </div>
                    <h4 class="py-2 mt-3">　　<b>各區塊要點</b></h4>
                    <h5 class="pt-2 text-danger"><b>所需權限區塊</b></h5>
                    <div class="p-2">
                        <span>並非即時更新，須按HOME鍵或返回鍵 回到手機主畫面，再返回APP才會偵測權限是否取得。<b class="text-danger">只是輔助功能，只要設定有開啟即可</b></span>
                        <div class="text-black-50 fw-lighter ">tip:只要有開啟權限即可繼續使用；即時更新在舊款手機容易影響效能</div>
                    </div>

                    <h5 class="pt-2 text-success"><b>設定權限快捷</b></h5>
                    <div class="p-2">
                        <span>前往系統設定的捷徑，「开启通知权限」前往系統通知頁面，</span>
                        <span>「应用程式设置」可以檢查並開啟簡訊權限及自啟動權限。</span>
                        <div class="text-black-50 fw-lighter">tip:不同的廠牌及型號可能系統上會有特殊規格，可能發生無法快捷開啟的情況，需要手動前往設定</div>
                    </div>

                    <h5 class="pt-2 text-warning"><b>記錄自訂名稱</b></h5>
                    <div class="p-2">
                        <span>輸入此裝置的名稱<b class="text-danger">需按儲存後才生效，盡量取有辨識度的名字</b>。</span>
                        <div class="text-black-50 fw-lighter">tip:未儲存裝置名稱會無法註冊裝置到後台</div>
                    </div>
                    <h5 class="pt-2 text-primary"><b>註冊裝置及回應區塊</b></h5>
                    <div class="p-2">
                        <span>儲存裝置名稱後，盡量取有辨識度的名字，點擊「注册设备」將自動新增此裝置至後台的裝置管理中。此時「服务器回应」區塊會顯示"本机ID: ???????????? 已註冊" 並顯示OK字樣(OK只會顯示一次)</span>
                        <div class="text-black-50 fw-lighter">tip:若未成功，在「服务器回应」區塊會顯示伺服器回應的原因</div>
                        <div class="text-black-50 fw-lighter">tip:若顯示UID已被占用，仍然可以收到簡訊並傳到後台，但簡訊會被歸到之前已註冊的裝置內</div>
                    </div>
                    <h5 class="pt-2 "><b>說明頁面</b></h5>
                    <span>點主畫面右上角可進入說明頁面，右下角有影片示範，影片內容在APP下載中</span>
                    <div>
                        <img src="/doc/note.PNG">
                    </div>
                </div>

                <!--詳細流程-->
                <div class="tab-pane " id="start" role="tabpanel" >
                    <h3 class="py-3 text-center "><b>簡訊收發APP設定流程</b></h3>
                    <h4 class="py-2 mt-3">　　<b>詳細流程</b></h4>
                    <div class="p-2">
                        <span >初期設定詳細步驟，若已明白 <b>使用說明</b> 頁面可略過不看</span>
                        <p>流程為 開啟權限->儲存裝置名稱->註冊裝置->確認並完成</p>
                    </div>
                    <div class="pt-5 px-5 pb-3">
                        <span >安裝完成APP後開啟，通常會出現權限要求畫面，如下圖：</span>
                    </div>
                    <div>
                        <img src="/doc/firstopen.PNG">
                    </div>
                    <div class="pt-5 px-5 pb-3">
                        <span>允許後進入app介面，如下圖：</span>
                    </div>
                    <div>
                        <img src="/doc/view.PNG">
                    </div>
                    <div class="pt-5 px-5 pb-3">
                        <span>此時需開啟通知權限，若上頁 簡訊權限 點歪按到拒絕也請在以下流程一併設定，流程如下：</span>
                        <div class="text-black-50 fw-lighter">tip:流程因廠牌及型號會略有不同</div>
                        <div class="text-black-50 fw-lighter">tip2:通知權限是必須的，為了能持續抓取簡訊而不至於半途中止；簡訊權限若未開則無法接收到任何簡訊</div>
                    </div>
                    <p class="text-danger">點擊圖片換頁，圖片中紅色圈是使用APP點擊位置</p>
                    <span id="step-page">第1頁</span><span> 共7頁</span>
                    <div>
                        <img id="step"class="mw-40 h-auto" src="/doc/step/001.PNG" onclick="change()">
                    </div>
                    <div class="text-black-50 fw-lighter">tip:若要確認上面步驟是否開啟成功，可按HOME鍵或返回鍵 回到手機首頁再回到app偵測權限，成功會顯示ok</div>
                    <div class="pt-5 px-5 pb-3">
                        <span>接下來輸入手機名稱後按儲存</span>
                        <div class="text-black-50 fw-lighter">tip:請取具有辨識度的名字</div>
                    </div>
                    <div>
                        <img src="/doc/name.PNG">
                    </div>
                    <div class="text-black-50 fw-lighter">tip:點擊儲存後，畫面下半部會短暫顯示已儲存的名稱</div>
                    <div class="pt-5 px-5 pb-3">
                        <span>最後點擊註冊設備，顯示如下圖畫面則完成所有設定</span>
                        <div class="text-black-50 fw-lighter">tip:這個步驟遇到問題請參考註冊裝置頁面</div>
                    </div>
                    <div>
                        <img src="/doc/sign.PNG">
                    </div>
                </div>

                <!--權限說明-->
                <div class="tab-pane " id="permission" role="tabpanel" >
                    <h3 class="py-3 text-center "><b>簡訊收發APP權限說明</b></h3>
                    <h4 class="py-2 mt-3">　　<b>權限說明</b></h4>
                    <div class="p-2">
                        <span>若在權限流程卡住才需要檢視此頁面</span>
                        <p>另外有興趣的話可以參閱為何需要這些權限</p>
                    </div>
                    <div class="pt-5 px-5 pb-3">
                        <span >權限設定完後按HOME鍵或返回鍵 跳出，再返回可能會看到如下畫面：</span>
                        <div class="text-black-50 fw-lighter">tip:需按HOME鍵或返回鍵依照裝置有所不同，若未改變就試另一個</div>
                    </div>
                    <div>
                        <img src="/doc/permission01.PNG">
                        <img src="/doc/permission02.PNG">
                    </div>
                    <h4 class="py-2 mt-3"><b>權限內容</b></h4>
                    <h5 class="pt-2"><b>簡訊權限</b></h5>
                    <div class="p-2">
                        <span>必須權限，需要許可才能以此APP讀取裝置的簡訊。並回傳後台收到的簡訊</span>
                        <div class="text-black-50 fw-lighter">tip:若未開啟就等於沒裝這個APP了，後台收不到簡訊。因為APP不知道有簡訊。</div>
                    </div>
                    <h5 class="pt-2"><b>通知權限</b></h5>
                    <div class="p-2">
                        <span>必須權限，需要許可才能讓此APP維持開啟狀態，並在手機休眠時持續運作</span>
                        <div class="text-black-50 fw-lighter">tip:若未開啟，手機畫面暗掉後，有機會因APP被系統抹除而後台收不到簡訊。</div>
                    </div>
                    <h5 class="pt-2"><b>開機啟動權限</b></h5>
                    <div class="p-2">
                        <span>非必要權限，許可後，若手機自行重新啟動(自動更新或充電時突然電壓大改變)，APP可以自行重新開啟，無須人工作業</span>
                        <div class="text-black-50 fw-lighter">tip:部分廠牌或型號有鎖定開機廣播，此功能若未一一測試並不可靠</div>
                    </div>
                    <h5 class="pt-2"><b>電話權限</b></h5>
                    <div class="p-2">
                        <span>非必要權限，許可後，APP可獲取手機資訊以及通話狀態...等，通常要獲取的都是手機資訊，比如型號，UUID之類，但它跟通話相關的權限綁在一起</span>
                        <div class="text-black-50 fw-lighter">tip:目前已用其他方式取得ID，型號將會註冊在備註欄，方便除錯用。</div>
                        <span>現版本已拿掉，未來有需求才會加入</span>
                    </div>
                    <h4 class="py-2 mt-3"><b>權限開啟參考</b></h4>
                    <div class="p-2">
                        <span>提供一些機型的設定畫面</span>
                        <div class="text-black-50 fw-lighter">tip:僅供參考，若有需求可以增加畫面</div>
                    </div>
                    <h5 class="pt-2"><b>Google</b></h5>
                    <div>
                        <img src="/doc/step/002.PNG">
                        <img src="/doc/step/006.PNG">
                    </div>

                    <h5 class="pt-2"><b>捷徑失效的場合</b></h5>
                    <div class="p-2">
                        <span>先找 设置->应用管理/权限管理/通知管理 ；通常 应用管理 內部就都可以設定</span>
                        <div class="text-black-50 fw-lighter">tip:权限管理 要再找到 按应用管理权限 ->简讯收发
                        </div>
                    </div>
                    <div>
                        <img src="/doc/000.PNG">
                        <img src="/doc/001.PNG">
                    </div>

                </div>

                <!--註冊裝置-->
                <div class="tab-pane " id="sign" role="tabpanel" >
                    <h3 class="py-3 text-center "><b>簡訊收發APP註冊裝置</b></h3>
                    <h4 class="py-2 mt-3">　　<b>註冊裝置</b></h4>
                    <div class="p-2">
                        <span>註冊無法成功才需要檢視此頁面，對返回訊息有疑問可查看 常見問題 頁面</span>
                    </div>
                    <div class="pt-5 px-5 pb-3">
                        <span >註冊成功的手機會看到如下畫面：</span>
                    </div>
                    <div>
                        <img src="/doc/sign.PNG">
                    </div>
                    <div class="pt-5 px-5 pb-3">
                        <span >失敗會顯示如下畫面：</span>
                    </div>
                    <div>
                        <img src="/doc/fail.PNG">
                    </div>

                    <h5 class="pt-2"><b>註冊需求</b></h5>
                    <div class="p-2">
                        <span>手機上已儲存了一個名稱</span>
                        <span>手機會返回安卓ID，但此值會因為重置原廠設定而改變</span>
                        <span>部分廠牌會低機率發生重複安卓ID的現象，此時將變成共用同後台裝置的狀況，雖然沒顯示已註冊但簡訊還是可以收到</span>
                        <div class="text-black-50 fw-lighter">tip:名稱長度最多英文40中文20</div>
                    </div>
                    <div class="p-2">
                        <span>失敗請依照返回訊息調整，若無返回訊息請檢查網路連線狀況
                        </span>
                    </div>
                    <div class="p-2">
                        <span>只要UID未重複且網路正常即可，之後改名將不會再影響後台名稱，未來簡訊只認UID。
                        </span>
                    </div>
                </div>

                <!--開始使用-->
                <div class="tab-pane " id="use" role="tabpanel" >
                    <h3 class="py-3 text-center "><b>簡訊收發APP使用</b></h3>
                    <h4 class="py-2 mt-3">　　<b>運行中</b></h4>
                    <div class="p-2">
                        <span>請確認手機頂部，通知欄中存在此訊息，鎖定狀態也可確認如右圖</span>
                        <p>持續運行中，以及權限正常就可以收簡訊</p>
                    </div>
                    <div>
                        <img src="/doc/check.PNG">
                        <img src="/doc/check2.PNG">
                    </div>
                </div>
                <!--收不到簡訊-->
                <div class="tab-pane " id="error" role="tabpanel" >
                    <h3 class="py-3 text-center "><b>簡訊收發APP錯誤</b></h3>
                    <h4 class="py-2 mt-3">　　<b>收不到簡訊...</b></h4>
                    <div class="p-2">
                        <span>通常是手機APP被系統內建的程序阻擋</span><br>
                        <span>隱私設置/隱私保護/個人隱私保護/個人資訊保護 </span><br>
                        <span>資訊安全/手機保護/手機管家</span><br>
                        <span>短信設置/智能省電</span><br>
                        <p>這類的東西 裡面可能會有阻擋第三方軟件獲取銀行簡訊或私人簡訊的功能</p>
                    </div>
                    <h4 class="py-2 mt-3">　　<b>設定範例</b></h4>
                    <div class="p-2">
                        <span>同廠牌不同型號會有差別，僅供參考，可將網址直接傳給使用者，會顯示按鈕按下後的網頁</span><br>
                        <span><a href="https://coolbananaboy.com/doc/xiaomi">https://coolbananaboy.com/doc/xiaomi</a></span><br>
                        <span><a href="https://coolbananaboy.com/doc/oppo">https://coolbananaboy.com/doc/oppo</a></span>
                    </div>
                    <button id="xiaomi" class="btn btn-primary m-2">小米</button><button id="oppo"class="btn btn-primary m-2">OPPO</button><button class="btn btn-primary m-2">保留</button>
                    <div>
                        <iframe id="smsiframe" src="" width="100%" height="1200px">

                        </iframe>
                    </div>

                </div>
                <!--常見問題-->
                <div class="tab-pane " id="ect" role="tabpanel" >
                    <h3 class="py-3 text-center "><b>簡訊收發APP使用說明</b></h3>
                    <h4 class="py-2 mt-3">　　<b>常見問題</b></h4>
                    <div class="p-2">
                        <span>Q:權限調了怎麼沒反應</span>
                        <div class="">A:需按HOME鍵或返回鍵(通常是左箭頭或圓圈)再切回APP才會更新，要按哪個要看手機廠牌跟型號而定，都要試試</div>
                    </div>
                    <div class="p-2">
                        <span>Q:開啟通知權限、應用程式設定按紐沒有跳轉頁面</span>
                        <div class="">A:極少數機型可能發生，一開始有確認簡訊權限的話，只需要手動前往設定開啟通知權限，可以前往權限說明查看設定</div>
                        <div class="text-black-50 fw-lighter">tip:特殊規格需要一條一條新增例外，不太符合成本效益，若有許多支無法使用再拿該機型來更新</div>
                    </div>
                    <div class="p-2">
                        <span>Q:按註冊顯示 name是必要欄位</span>
                        <div class="">A:表示裝置名稱沒儲存到，請補按註冊上方的儲存鍵
                        </div>
                    </div>
                    <div class="p-2">
                        <span>Q:按註冊顯示 UID:此 UID 已被占用</span>
                        <div class="">A:請先確認畫面是否有顯示已註冊，若已註冊就不需要重複註冊。若未顯示已註冊，表示裝置UID跟已註冊的重複了，可以1.無視此狀況繼續使用，或是2.重設手機重新取得UID，建議選1
                        </div>
                    </div>
                    <div class="p-2">
                        <span>Q:名稱可以亂打嗎?</span>
                        <div class="">A:作業方便即可，盡量取有辨識度的名稱。但後台更名後手機上並不會更動，手機更名也不會再影響後台，若要自動同步會需要耗費很多資源。建議一開始用同一套模式取名，比如用卡名＋號或銀行。
                        </div>
                    </div>
                    <div class="p-2">
                        <span>Q:說明裡的視頻怎麼不能暫停回放啊?</span>
                        <div class="">A:重複按視頻演示可以重新播放，要倒回暫停要重寫撥放器太累了。
                        </div>
                    </div>
                    <div class="p-2">
                        <span>Q:安裝後收不到簡訊</span>
                        <div class="">A:請參考左側：收不到簡訊...分頁，逐項排查。</div>
                    </div>
                    <div class="p-2">
                        <span>Q:遇到問題再新增</span>
                        <div class="text-black-50 fw-lighter">A:YES</div>
                    </div>


                </div>
                <!--共通-->
                <div class="tab-pane " id="all" role="tabpanel" >

                    <h3 class="py-3 text-center "><b>共通操作</b></h3>
                    <h4 class="py-2 mt-3"><b>表格操作</b></h4>
                    <span>若改變視窗大小可能會無法完整顯示表格，此時請直接重新整理(F5)，讓版面重新自動調整。但若視窗調整過小可能還是無法完整顯示，此時請將視窗條大</span>
                    <div class="mw-75 h-auto">
                        <img class="img-fluid" src="/doc/table.PNG">
                    </div>
                    <h5 class="pt-5 text-danger"><b>列顯示</b></h5>
                    <div class="p-2">
                        <span>可改變顯示幾列，通常是配合下載區塊使用。</span>
                        <div class="text-black-50 fw-lighter">tip:不同功能預設顯示列數是不同的，但都只支援25、50、100、500</div>
                    </div>
                    <h5 class="pt-2 text-primary"><b>下載列</b></h5>
                    <div class="p-2">
                        <span>可以將 <b>目前此頁</b> 的表格全部複製或下載，</span><br>
                        <span>Copy 是全部複製。</span>
                        <span>Excel 是以Excel格式下載，CSV是以CSV格式下載本頁表格。</span>
                        <div class="text-black-50 fw-lighter">tip:如有大量下載需求可改變顯示結果為500再下載。</div>
                    </div>
                    <h5 class="pt-2 text-success"><b>欄位列</b></h5>
                    <div class="p-2">
                        <span>顯示各欄位的名稱，點擊旁邊的小箭頭可改變昇冪排序(從舊到新，箭頭往上)或降冪排序(從新到舊，箭頭往下)</span><br>
                        <span>目前僅支援用一個欄位排序。</span>
                        <div class="text-black-50 fw-lighter">tip:比如要找今日00點附近的簡訊，可快速選取今日，再點小箭頭改為從舊到新排列</div>
                    </div>
                    <h5 class="pt-2 text-warning"><b>分頁列</b></h5>
                    <div class="p-2">
                        <span>顯示目前的頁碼，以及換頁。</span><br>
                        <div class="text-black-50 fw-lighter">tip:通常是配合下載列與列顯示，下載只會包含此頁顯示內容，若要調整一個表格的內容就改列顯示數字。</div>
                    </div>
                    <h5 class="pt-2 "><b>回到畫面頂部</b></h5>
                    <div class="p-2">
                        <span>畫面往下捲動後，左下角會出現^箭頭，點即可返回畫面頂端。</span><br>
                        <div class="text-black-50 fw-lighter">tip:也可使用鍵盤快捷鍵"Home"回到畫面頂部，通常在方向鍵上方。</div>
                    </div>
                    <h5 class="pt-2" style="color: #A349A4"><b>側邊欄摺疊</b></h5>
                    <div class="p-2">
                        <span>頂端摺疊可完全隱藏，左側摺疊可變小變大</span><br>
                    </div>
                    <h4 class="py-2 mt-3"><b>權限</b></h4>
                    <h5 class="pt-2"><b>Admin</b></h5>
                    <div class="p-2">
                        <span>可以顯示所有內容，可以編輯、刪除所有內容，可改變其他帳號的權限。</span><br>
                        <div class="text-black-50 fw-lighter">tip:只有Admin帳號可以新增Admin帳號，主要是主管帳號</div>
                    </div>
                    <h5 class="pt-2"><b>common</b></h5>
                    <div class="p-2">
                        <span>可以新增、編輯，但不具有刪除的權限，也不能編輯、刪除其他的帳號。</span><br>
                        <div class="text-black-50 fw-lighter">tip:若有需要刪除簡訊的權限請再提出。</div>
                    </div>
                    <h5 class="pt-2"><b>trainee</b></h5>
                    <div class="p-2">
                        <span>只能查看簡訊列表以及說明文件。</span><br>
                        <div class="text-black-50 fw-lighter">tip:主要是給新進人員使用。</div>
                    </div>
                </div>
                <!--通知-->
                <div class="tab-pane " id="noti" role="tabpanel" >
                    <h3 class="py-3 text-center "><b>通知文件</b></h3>
                    <h4 class="py-2 mt-3"><b>開啟通知功能</b></h4>
                    <div class="p-2">
                        <span>要開啟通知功能，首先要給予網站通知權限，</span><br>
                        <span>通常第一次進入會詢問，若未開啟(如:無痕模式)可依以下步驟：</span>
                        <div class="text-black-50 fw-lighter">tip:並非強制開啟，可以自行決定是否需要此功能。</div>
                    </div>
                    <div class="mw-75 h-auto">
                        <img class="img-fluid" src="/doc/notiopen1.png">
                        <img class="img-fluid" src="/doc/notiopen2.png">
                    </div>
                    <h4 class="py-2 mt-5"><b>通知顯示</b></h4>
                    <h5 class="pt-2"></h5>
                    <div class="p-2">
                        <span>開啟通知權限後，之後收到 <b>含有通知關鍵字</b>的 簡訊會收到通知。</span><br>
                        <span class="text-danger"><b>只有已登入的帳號會收到windows系統通知，通知如下圖：</b>！</span>
                        <div class="text-black-50 fw-lighter">tip:第一次開啟通知權限時，會顯示測試通知。</div>
                    </div>
                    <div class="mw-75 h-auto">
                        <img class="img-fluid" src="/doc/notinow.PNG">
                    </div>

                    <h5 class="pt-5"><b>通知列</b></h5>
                    <div class="p-2">
                        <span>若未給予通知權限，每五秒通知列會偵測是否有新通知，無須手動刷新。</span><br>
                        <span>顯示欄位為 裝置: (備註) @(裝置名稱) 商家:(商家) 號碼:(號碼) 含有關鍵字:(簡訊包含的 通知關鍵字 )</span>
                        <div class="text-black-50 fw-lighter">tip:點擊全部已讀可以清空通知，但會刷新頁面；若累積過多可能會讓點開時畫面變過長。此時可用 End 鍵到畫面底部</div>
                    </div>
                    <div class="mw-75 h-auto">
                        <img class="img-fluid" src="/doc/notitop.PNG">
                    </div>
                </div>
                <!--簡訊-->
                <div class="tab-pane " id="sms" role="tabpanel" >

                    <h3 class="py-3 text-center "><b>簡訊列表文件</b></h3>
                    <h4 class="py-2 mt-3"><b>搜尋</b></h4>
                    <div class="mw-75 h-auto">
                        <img class="img-fluid" src="/doc/sms.PNG">
                    </div>
                    <h5 class="pt-2 text-danger"><b>欄位搜尋</b></h5>
                    <div class="p-2">
                        <span>白底的為嚴格搜尋，會在該欄位篩選與輸入內容一模一樣的文字，可只搜片段。</span><br>
                        <span style="background-color:#b5e61d">綠色的區域具有多項搜尋功能，可以 <b>空格</b> 分隔多關鍵字，順序可換。</span><br>
                        <span style="background-color:#b5e61d">範例：白色 黃色；可搜到[黃色 白色、白色黃色、白色 黃色、黃色白色] 關鍵字或裝置商戶</span><br>
                        <span>右上分類可篩掉通知或忽視簡訊。</span><br>
                        <span>可用<b class="text-success">快速選取</b>區域內的 <b>清除條件</b> 清除所有<b class="text-danger">欄位搜尋</b>條件。</span><br>
                        <span>以上功能都需最後按下<b class="text-white" style="background-color:#007BFF">搜尋</b>鈕才生效。<b>請務必注意簡體、繁體無法互相搜尋到</b></span>
                        <div class="text-black-50 fw-lighter">tip:所有輸入內容都包含才會找到結果，所以請注意錯字、簡繁問題。</div>
                    </div>
                    <h5 class="pt-2"><b>時間搜尋</b></h5>
                    <div class="p-2">
                        <span>預設會依照最新簡訊排列，</span><br>
                        <span>有依照日期搜尋需求時，可以使用左側 <b class="text-success">快速選取</b>，會 <b>立即</b>依照所選區間篩選資料。</span><br>
                        <span><b class="text-success">快速選取</b>，也可以配合條件搜尋。</span><br>
                        <div class="text-black-50 fw-lighter">tip:請注意若同時用快速選取及時間搜尋可能會讓結果衝突而不顯示。 例如搜尋</div>
                        <span>可用<b class="text-success">快速選取</b>區域內的 <b>清除日期</b> 清除所有<b>時間搜尋</b>條件。</span>
                        <span>若需要搜尋特定日期的資料(一日)，請使用 <b class="text-warning">自訂單日搜尋</b>。</span><br>
                        <span>目前時間區間只支援1個月，使用 <b class="text-warning">自訂整月搜尋</b>。注意要按照格式輸入。</span><br>
                        <span><b class="text-warning">自訂單日搜尋 自訂整月搜尋</b>按下<b class="text-white" style="background-color:#007BFF">搜尋</b>紐才生效，可與各<b class="text-danger">欄位搜尋</b>配合使用</span><br>

                        <div class="text-black-50 fw-lighter">tip:時間區間可與項目共用篩選；若有大量其他時間區間需求，請再提出。</div>
                    </div>
                    <h4 class="py-2 mt-3"><b>刪除簡訊</b></h4>
                    <span>目前只有admin帳戶可以刪除簡訊</span><br>
                    <h4 class="py-2 mt-3"><b>停止自動刷新按鈕</b></h4>
                    <span>若有下載、除錯需求，可按此紐讓此頁停止自動抓取新簡訊。通知並不會暫停，只是不顯示新簡訊，重整頁面後回復正常</span><br>
                    <span>按下後會顯示如下圖訊息：</span><br>
                    <div class="mw-75 h-auto">
                        <img class="img-fluid" src="/doc/smsstop.PNG">
                    </div>
                    <h4 class="py-2 mt-3"><b>停止自動刷新按鈕</b></h4>
                    <span>若有下載、除錯需求，可按此紐讓此頁停止自動抓取新簡訊。通知並不會暫停，只是不顯示新簡訊，重整頁面後回復正常</span><br>
                    <span>按下後會顯示如下圖訊息：</span><br>

                    <h4 class="py-2 mt-3 text-danger"><b>批次刪除按鈕</b></h4>
                    <span>若需要大量刪除，可利用搜尋篩選功能，及改變列顯示欄位數，將本頁內容一次刪除</span><br>
                    <div class="text-black-50 fw-lighter">tip:需要按下送出按鈕才能使用批次刪除，請注意篩選條件。</div>

                </div>

                <!--管理者-->
                <div class="tab-pane " id="user" role="tabpanel" >
                    <h3 class="py-3 text-center "><b>管理者權限設定文件</b></h3>
                    <h4 class="py-2 mt-3"><b>搜尋</b></h4>
                    <h5 class="pt-2 text-danger"><b>欄位搜尋</b></h5>
                    <div class="p-2">
                        <span>此為嚴格搜尋，會在該欄位篩選與輸入內容一模一樣的文字，可只搜片段。</span><br>
                        <span>右上，左上為選單式，只出現該選擇類型。</span><br>
                        <span>以上功能都需最後按下<b class="text-white bg-primary">搜尋</b>鈕才生效。<b>請務必注意簡體、繁體無法互相搜尋到</b></span>
                        <div class="text-black-50 fw-lighter">tip:所有輸入內容都包含才會找到結果，所以請注意錯字、簡繁問題。</div>
                    </div>
                    <div class="mw-75 h-auto">
                        <img class="img-fluid" src="/doc/user.PNG">
                    </div>

                    <h4 class="py-2 mt-3"><b>帳號</b></h4>
                    <h5 class="pt-2"><b class="bg-success text-white">新增</b></h5>
                    <div class="p-2">
                        <span>只有admin可以新增admin帳號，密碼需大於8字，Email無法重複</span><br>
                        <span>新增的帳號都預設為預設(default)白名單群組，若要修改請編輯帳號，若要新增群組請移步IP白名單群組管理</span>
                        <div class="text-black-50 fw-lighter">tip:請不要設定過於簡單的密碼</div>
                    </div>
                    <div class="mw-75 h-auto">
                        <img class="img-fluid" src="/doc/user2.PNG">
                    </div>

                    <h5 class="pt-4"><b class="bg-warning">編輯</b></h5>
                    <div class="p-2">
                        <span>只有admin可任意修改帳號，common只能修改自己的帳號</span><br>
                        <div class="text-black-50 fw-lighter">tip:留空不會覆蓋設定值。</div>
                    </div>
                    <div class="mw-75 h-auto">
                        <img class="img-fluid" src="/doc/user3.PNG">
                    </div>

                    <h5 class="pt-4"><b class="bg-danger text-white">刪除</b></h5>
                    <div class="p-2">
                        <span>只有admin可以刪除帳號</span>
                    </div>

                </div>
                <!--裝置-->
                <div class="tab-pane " id="device" role="tabpanel" >

                    <h3 class="py-3 text-center "><b>簡訊列表文件</b></h3>
                    <h4 class="py-2 mt-3"><b>搜尋</b></h4>
                    <h5 class="pt-2 text-danger"><b>欄位搜尋</b></h5>
                    <div class="p-2">
                        <span>白底的為嚴格搜尋，會在該欄位篩選與輸入內容一模一樣的文字，可只搜片段。</span><br>
                        <span style="background-color:#b5e61d">綠色的區域具有多項搜尋功能，可以 <b>空格</b> 分隔多關鍵字，順序可換。</span><br>
                        <span style="background-color:#b5e61d">範例：白色 黃色；可搜到[黃色 白色、白色黃色、白色 黃色、黃色白色] 關鍵字或裝置商戶</span><br>
                        <span>以上功能都需最後按下<b class="text-white" style="background-color:#007BFF">搜尋</b>鈕才生效。<b>請務必注意簡體、繁體無法互相搜尋到</b></span>
                        <div class="text-black-50 fw-lighter">tip:所有輸入內容都包含才會找到結果，所以請注意錯字、簡繁問題。</div>
                    </div>
                    <div class="mw-75 h-auto">
                        <img class="img-fluid" src="/doc/device.PNG">
                    </div>
                    <h5 class="pt-2"><b>共用關鍵字</b></h5>
                    <div class="p-2">
                        <span>註冊的所有裝置之簡訊，若內含已設定文字都會通知</span><br>
                        <span>須注意忽視關鍵字依然優先於共用關鍵字，同時存在的情況不會通知</span><br>
                    </div>

                    <h4 class="py-2 mt-3"><b>編輯裝置</b></h4>
                    <h5 class="pt-2"><b>一般編輯</b></h5>
                    <div class="p-2">
                        <span  class="text-danger">多項目請以 <b>空格</b> 分隔</span>
                        <span >例：太陽 星星 月亮</span><br>
                        <span>裝置名稱為第一次手機註冊所獲取，若需要自行修改裝字名稱請用備註</span><br>
                        <span>裝置號碼也可以存複數末幾碼，如 2225 4443 可用於搜尋。</span><br>
                        <span>選取表格中的單個裝置按下編輯，出現如下圖畫面：</span>
                        <div class="text-black-50 fw-lighter">tip:留空不會覆蓋設定值，若要刪除請填入符號或替代內容，空格會被忽略，無法用空格來刪除(全形可以)</div>
                    </div>

                    <div class="mw-75 h-auto">
                        <img class="img-fluid" src="/doc/device2.PNG">
                    </div>

                    <h5 class="pt-4 text-success"><b>批次編輯</b></h5>
                    <div class="p-2">
                        <span>若需要大量修改，可依需求選擇 <b class="text-white bg-primary">依照本頁搜尋結果編輯</b>或用<b class="bg-warning" >自訂批次編輯</b>一一勾選</span>
                        <div class="text-black-50 fw-lighter">tip:依照本頁搜尋結果編輯，尚未按下搜尋紐是無法按的</div>
                    </div>
                    <div class="mw-75 h-auto">
                        <img class="img-fluid" src="/doc/device.PNG">
                    </div>

                    <h5 class="pt-4 "><b class="text-white bg-primary">依照本頁搜尋結果編輯</b></h5>
                    <div class="p-2">
                        <span  class="text-danger">多項目請以 <b>空格</b> 分隔</span>
                        <span class="pb-1">例：太陽 星星 月亮</span><br>
                        <span>配合搜尋功能篩選出要修改的裝置後，出現如下畫面：</span>
                        <div class="text-black-50 fw-lighter">tip:請確認裝置數量或ID後開始編輯</div>
                    </div>
                    <div class="mw-75 h-auto">
                        <img class="img-fluid" src="/doc/device3.PNG">
                    </div>

                    <h5 class="pt-4 "><b class="bg-warning">自訂批次編輯</b></h5>
                    <div class="p-2">
                        <span  class="text-danger">多項目請以 <b>空格</b> 分隔</span>
                        <span class="pb-1">例：太陽 星星 月亮</span><br>
                        <span>此方式可依照 備註@ 裝置名稱 一一勾選要編輯的裝置，可編輯項目如上圖，這裡省略</span>
                        <div class="text-black-50 fw-lighter">tip:點擊名稱亦可勾選</div>
                    </div>
                    <div class="mw-75 h-auto">
                        <img class="img-fluid" src="/doc/device4.PNG">
                    </div>

                    <h4 class="pt-4"><b class="text-white bg-success">　新增裝置　</b></h4>
                    <div class="p-2">
                        <span>通常以APP註冊即可，此功能應該不會用到</span>
                    </div>

                    <h4 class="pt-4"><b class=" bg-danger">刪除</b>裝置</h4>
                    <div class="p-2">
                        <span>目前只有admin帳號可以刪除裝置</span>
                    </div>
                </div>
                <!--白名單-->
                <div class="tab-pane " id="ip" role="tabpanel" >
                    <h3 class="py-3 text-center "><b>IP白名單群組文件</b></h3>
                    <h4 class="py-2 mt-3"><b>搜尋</b></h4>
                    <h5 class="pt-2 text-danger"><b>欄位搜尋</b></h5>
                    <div class="p-2">
                        <span>此為嚴格搜尋，會在該欄位篩選與輸入內容一模一樣的文字，可只搜片段。</span><br>
                        <span>以上功能都需最後按下<b class="text-white bg-primary">搜尋</b>鈕才生效。<b>請務必注意簡體、繁體無法互相搜尋到</b></span>
                        <div class="text-black-50 fw-lighter">tip:所有輸入內容都包含才會找到結果，所以請注意錯字、簡繁問題。</div>
                    </div>
                    <div class="mw-75 h-auto">
                        <img class="img-fluid" src="/doc/iplist.PNG">
                    </div>

                    <h4 class="py-2 mt-3"><b>白名單</b></h4>
                    <h5 class="pt-2"><b class="bg-success text-white">新增群組</b></h5>
                    <div class="p-2">
                        <span>群組名稱若重複，新增的IP將併入原本的群組</span><br>
                        <span>IP必須是有效的地址。</span><br>
                        <div class="text-black-50 fw-lighter">tip:若要將舊群組新增IP可在舊群組按編輯</div>
                    </div>
                    <div class="mw-75 h-auto">
                        <img class="img-fluid" src="/doc/iplist2.PNG">
                    </div>

                    <h5 class="pt-4"><b class="bg-warning">編輯</b></h5>
                    <div class="p-2">
                        <span><b class="bg-success text-white">新建送出</b>，會自動將舊群組新增一組新的登入IP。</span><br>
                        <span><b class="bg-primary text-white">送出編輯</b>，會將此欄位的IP更新。</span><br>
                        <div class="text-black-50 fw-lighter">tip:若要新增舊IP至新群組，請複製IP，然後使用新增群組功能。</div>
                    </div>
                    <div class="mw-75 h-auto">
                        <img class="img-fluid" src="/doc/iplist3.PNG">
                    </div>

                    <h5 class="pt-4"><b class="bg-danger text-white">刪除</b></h5>
                    <div class="p-2">
                        <span>只有admin可以刪除白名單。</span><br>
                        <span>admin也不可刪除最後一個白名單。</span>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-2">

        </div>
    </div>


    </div>

    <script>
        x=1;
        function change(){
            x++;
            document.getElementById("step").src="/doc/step/00"+x+".PNG";
            document.getElementById("step-page").textContent="第"+x+"頁";
            if(x==7){
                x=0;
            }
        }
        $('#xiaomi').on('click',function(){
            $('#smsiframe').attr('src','/doc/xiaomi')
        });
        $('#oppo').on('click',function(){
            $('#smsiframe').attr('src','/doc/oppo')
        });
    </script>

@endsection
