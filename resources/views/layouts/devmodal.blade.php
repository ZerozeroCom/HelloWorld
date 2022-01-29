<div class="modal fade" id="devModal" tabindex="-1" aria-labelledby="devModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="devModalLabel">裝置修改</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="dev-name" class="col-form-label">裝置名稱:</label>
              <input type="text" class="form-control" id="dev-name">
            </div>
            <div class="mb-3">
              <label for="dev-email" class="col-form-label">裝置號碼:</label>
              <input type="text" class="form-control" id="dev-number">
            </div>
            <div class="mb-3">
              <label for="dev-UID" class="col-form-label">裝置UID:</label>
              <input type="text" class="form-control" autocomplete="new-UID" id="dev-UID">
            </div>
            <div class="mb-3">
              <label for="dev-note" class="col-form-label">備註:</label>
              <input type="message-text" class="form-control" autocomplete="new-note" id="dev-note">
            </div>
            <div class="mb-3">
              <label for="dev-noti_keywords" class="col-form-label">通知關鍵字:</label>
              <input type="text" class="form-control" autocomplete="new-noti_keywords" id="dev-noti_keywords">
            </div>
            <div class="mb-3">
                <label for="dev-unnoti_keywords" class="col-form-label">不通知關鍵字:</label>
                <input type="text" class="form-control" autocomplete="new-unnoti_keywords" id="dev-unnoti_keywords">
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
          <button type="button" class="btn btn-primary" id="devedit_go">發送</button>
        </div>
      </div>
    </div>
  </div>

