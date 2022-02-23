<!--新增用-->
<div class="modal fade" id="newdevModal" tabindex="-1" aria-labelledby="newdevModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newdevModalLabel">新增裝置</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="ndev-name" class="col-form-label">裝置名稱:</label>
              <input type="text" class="validate form-control" id="ndev-name" required>
            </div>
            <div class="mb-3">
              <label for="ndev-email" class="col-form-label">裝置號碼:</label>
              <input type="number" class="validate form-control" id="ndev-number" required minlength="9">
            </div>
            <div class="mb-3">
              <label for="ndev-UID" class="col-form-label">裝置UID:</label>
              <input type="text" class="validate form-control" autocomplete="new-UID" id="ndev-UID" required>
            </div>
            <div class="mb-3">
              <label for="ndev-businesses" class="col-form-label">商戶:</label>
              <input type="message-text" class="validate form-control" autocomplete="new-businesses" id="ndev-businesses">
            </div>
            <div class="mb-3">
              <label for="ndev-noti_keywords" class="col-form-label">通知關鍵字:</label>
              <input type="text" class="validate form-control" autocomplete="new-noti_keywords" id="ndev-noti_keywords">
            </div>
            <div class="mb-3">
                <label for="ndev-unnoti_keywords" class="col-form-label">忽略關鍵字:</label>
                <input type="text" class="validate form-control" autocomplete="new-unnoti_keywords" id="ndev-unnoti_keywords">
              </div>
              <div class="mb-3">
                <label for="ndev-note" class="col-form-label">備註:</label>
                <input type="message-text" class="validate form-control" autocomplete="new-note" id="ndev-note">
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
          <button type="button" class="btn btn-primary" id="devnew_go">送出</button>
        </div>
      </div>
    </div>
  </div>

<!--編輯用-->
  <div class="modal fade" id="devModal" tabindex="-1" aria-labelledby="devModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="devModalLabel">裝置修改</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <span class="m-3 d-flex justify-content-center">留空將維持原設定值，不會清除數據</span>
        <div class="modal-body">
            <form>
                <div class="mb-3">
                    <label for="dev-name" class="col-form-label">裝置名稱:</label>
                    <input type="text" class="validate form-control" id="dev-name">
                </div>
                <div class="mb-3">
                    <label for="dev-number" class="col-form-label">裝置號碼:</label>
                    <input type="number" class="validate form-control" id="dev-number" minlength="9">
                </div>
                <div class="mb-3">
                    <label for="dev-UID" class="col-form-label">裝置UID:</label>
                    <input type="text" class="validate form-control" id="dev-UID">
                </div>
                <div class="mb-3">
                    <label for="dev-businesses" class="col-form-label">商戶:</label>
                    <input type="message-text" class="validate form-control" autocomplete="edit-businesses" id="dev-businesses">
                  </div>
                <div class="mb-3">
                    <label for="dev-noti_keywords" class="col-form-label">通知關鍵字:</label>
                    <input type="text" class="validate form-control" autocomplete="edit-noti_keywords" id="dev-noti_keywords">
                </div>
                <div class="mb-3">
                    <label for="dev-unnoti_keywords" class="col-form-label">忽略關鍵字:</label>
                    <input type="text" class="validate form-control" autocomplete="edit-unnoti_keywords" id="dev-unnoti_keywords">
                </div>
                <div class="mb-3">
                    <label for="dev-note" class="col-form-label">備註:</label>
                    <input type="message-text" class="validate form-control" autocomplete="edit-note" id="dev-note">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary" id="devedit_go">送出</button>
        </div>
      </div>
    </div>
  </div>

  <!--批次編輯用-->
<div class="modal fade" id="manydevModal" tabindex="-1" aria-labelledby="manydevModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="manydevModalLabel">批次編輯裝置</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <span class="m-3 d-flex justify-content-center">留空將維持原設定值，不會清除數據</span>
        <div class="modal-body">
          <form>
            <div class="mb-3 border border-info">
                <label for="manydev" class="col-form-label">選取裝置:<span id="many_dev_name"></span></label>
                <div  class="form-check  mb-3" id="manydev" >
                    @foreach ( App\Models\Device::select("id","name")->get() as $value )
                    <span class=" col-auto " id ="dev-{{$value->id}}">
                        <label class="col-form-label "><input class="form-check-input" type="checkbox" name="id" data-id="{{$value->id}}" >{{$value->name}}</label>
                        <span>　</span>
                    </span>
                    @endforeach
                </div>
            </div>
            <div class="mb-3">
                <label for="manydev-businesses" class="col-form-label">裝置商戶:</label>
                <input type="message-text" class="validate form-control" id="manydev-businesses">
            </div>
            <div class="mb-3">
                <label for="manydev-noti_keywords" class="col-form-label">通知關鍵字:</label>
                <input type="text" class="validate form-control" id="manydev-noti_keywords">
            </div>
            <div class="mb-3">
                <label for="manydev-unnoti_keywords" class="col-form-label">忽略關鍵字:</label>
                <input type="text" class="validate form-control" id="manydev-unnoti_keywords">
            </div>
            <div class="mb-3">
                <label for="manydev-note" class="col-form-label">備註:</label>
                <input type="message-text" class="validate form-control" id="manydev-note">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
          <button type="button" class="btn btn-primary" id="manydev_go">送出</button>
        </div>
      </div>
    </div>
  </div>
