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
                <input type="text" class="validate form-control" id="acc-name">
            </div>
            <div class="mb-3">
                <label for="acc-email" class="col-form-label">E-MAIL:</label>
                <input type="email" class="validate form-control" id="email">
            </div>
            <div class="mb-3">
                <label for="acc-type" class="col-form-label">管理類型:</label>
                <select type="text" class="form-control" autocomplete="new-type" id="acc-type" >
                    <option>common</option>
                    <option>admin</option>
                    <option>trainee</option>
                </select>
            </div>
            <div class="mb-3 password">
                <label for="acc-password" class="col-form-label">帳號密碼:</label>
                <input type="password" class="validate form-control" autocomplete="new-password" id="acc-password" minlength="8" >
            </div>
            <div class="mb-3 password">
                <label for="acc-password_confirmation" class="col-form-label">確認密碼:</label>
                <input type="password" class="validate form-control" autocomplete="new-password" id="acc-password_confirmation" minlength="8" >
            </div>
            <div class="mb-3 allow_group">
            <label for="acc-allow_group" class="col-form-label">白名單群組:</label>
            <select type="text" class="form-control" autocomplete="new-allow_group" id="acc-allow_group" >
                <option></option>
                @foreach ($allow_group_list as $key =>$value)
                    <option>{{$value->allow_group}}</option>
                @endforeach
            </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" id="accedit_go">送出</button>
      </div>
    </div>
  </div>
</div>

<!--新增用-->
<div class="modal fade" id="naccModal" tabindex="-1" aria-labelledby="naccModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="naccModalLabel">帳號新增</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="acc-name" class="col-form-label">帳號名稱:</label>
              <input type="text" class="validate form-control" id="nacc-name" placeholder required>
            </div>
            <div class="mb-3">
              <label for="acc-email" class="col-form-label">E-MAIL:</label>
              <input type="email" class="validate form-control" id="nemail" placeholder required>
            </div>
            <div class="mb-3">
              <label for="acc-type" class="col-form-label">管理類型:</label>
              <select type="text" class="form-control" autocomplete="new-type" id="nacc-type" placeholder required>
                  <option>common</option>
                  <option>admin</option>
                  <option>trainee</option>
              </select>
            </div>
            <div class="mb-3 password">
              <label for="acc-password" class="col-form-label">帳號密碼:</label>
              <input type="password" class="validate form-control" autocomplete="new-password" id="nacc-password" placeholder required minlength="8">
            </div>
            <div class="mb-3 password">
              <label for="acc-password_confirmation" class="col-form-label">確認密碼:</label>
              <input type="password" class="validate form-control" autocomplete="new-password" id="nacc-password_confirmation"placeholder required minlength="8">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
          <button type="button" class="btn btn-primary" id="accnew_go">送出</button>
        </div>
      </div>
    </div>
  </div>
