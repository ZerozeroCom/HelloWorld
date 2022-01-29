<div class="modal fade" id="accModal" tabindex="-1" aria-labelledby="accModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="accModalLabel">帳號修改</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="acc-name" class="col-form-label">帳號名稱:</label>
            <input type="text" class="form-control" id="acc-name">
          </div>
          <div class="mb-3">
            <label for="acc-email" class="col-form-label">E-MAIL:</label>
            <input type="text" class="form-control" id="email">
          </div>
          <div class="mb-3">
            <label for="acc-type" class="col-form-label">管理類型:</label>
            <input type="text" class="form-control" autocomplete="new-type" id="acc-type">
          </div>
          <div class="mb-3 password">
            <label for="acc-password" class="col-form-label">帳號密碼:</label>
            <input type="password" class="form-control" autocomplete="new-password" id="acc-password">
          </div>
          <div class="mb-3 password">
            <label for="acc-password_confirmation" class="col-form-label">確認密碼:</label>
            <input type="password" class="form-control" autocomplete="new-password" id="acc-password_confirmation">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" id="accedit_go">發送</button>
      </div>
    </div>
  </div>
</div>
