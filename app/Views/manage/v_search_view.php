<div class="container d-print-none">
    <h2>捐款清單</h2>
    <hr>
    <form class="row gx-3 gy-2 align-items-center" action="#" method="post">
        <div class="col-auto">
            <label class="col-form-label" for="FormDate">日期</label>
            <input class="form-control" type="Date" id="FormDate" name="FormDate" value="<?= $field['FormDate'] ?>"">
            <input class="form-control" type="Time" id="FormTime" name="FormTime" value="<?= $field['FormTime'] ?>">
        </div>
        <div class="col-auto">
            <label class="col-form-label" for="ToDate">至</label>
            <input class="form-control" type="Date" id="ToDate" name="ToDate" value="<?= $field['ToDate'] ?>">
            <input class="form-control" type="Time" id="ToTime" name="ToTime" value="<?= $field['ToTime'] ?>">
        </div>
        <div class="col-sm-3">
            <label class="col-form-label" for="Pid">交易序號</label>
            <input type="text" class="form-control" id="Pid" name="Pid" placeholder="交易序號" value="<?= $field['Pid'] ?>">
        </div>
        <div class="col-auto">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_pay" value="1" id="is_pay" <?= $field['is_pay'] == 1 ? 'checked' : '' ?>>
                <label class="form-check-label" for="is_pay">
                    已付款
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="tl_receipt" value="1" id="tl_receipt" <?= $field['tl_receipt'] == 1 ? 'checked' : '' ?>>
                <label class="form-check-label" for="tl_receipt">
                    需收據
                </label>
            </div>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">搜尋</button>
        </div>
        <div class="col-auto">
            <a class="btn btn-secondary" href="/manage/TransactionList">清除搜尋資料</a>
        </div>
    </form>
</div>