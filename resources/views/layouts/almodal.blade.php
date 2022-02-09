<div class="modal fade" id="alModal" tabindex="-1" aria-labelledby="alModalLabel" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alModalLabel">編輯白名單</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="allow-list" class="col-form-label">白名單:</label>
                        <input type="ip" class="form-control" id="allow-list">
                    </div>
                </form>
            </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                <button type="button" class="btn btn-primary" id="aledit_go">送出編輯</button>
                <button type="button" class="btn btn-success" id="alnew_go">新建送出</button>
            </div>
            </div>
    </div>
</div>

<div class="modal fade" id="nalModal" tabindex="-1" aria-labelledby="nalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nalModalLabel">編輯白名單</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="nallow-group" class="col-form-label">群組名稱:</label>
                        <input type="text" class="form-control" id="nallow-group">
                    </div>
                    <div class="mb-3">
                        <label for="nallow-list" class="col-form-label">白名單:</label>
                        <input type="ip" class="form-control" id="nallow-list">
                    </div>
                </form>
            </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                <button type="button" class="btn btn-success" id="nalnew_go">新建送出</button>
            </div>
            </div>
    </div>
</div>
