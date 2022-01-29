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
                        <label for="message-text" class="col-form-label">使用者:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">白名單:</label>
                    <input type="text" class="form-control" id="recipient-name">
                </div>

                </form>
            </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                <button type="button" class="btn btn-primary" id="aledit_go">確認</button>
            </div>
            </div>
    </div>
</div>
