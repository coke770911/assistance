<div class="container d-print-none">
    <h2>捐款清單</h2>
    <hr>
    <form id="DataForm" class="row gx-3 gy-2 align-items-center" action="#" method="post">
        <div class="col-auto">
            <label class="col-form-label" for="FromDate">日期</label>
        </div>
        <div class="col-auto">
            <input class="form-control" type="Date" id="FormDate" name="FormDate" value="<?= $field['FormDate'] ?>"">
        </div>
        <div class=" col-auto">
            <input class="form-control" type="Time" id="FormTime" name="FormTime" value="<?= $field['FormTime'] ?>">
        </div>
        <div class="col-auto">
            <label class="col-form-label" for="ToDate">至</label>
        </div>
        <div class="col-auto">
            <input class="form-control" type="Date" id="ToDate" name="ToDate" value="<?= $field['ToDate'] ?>">
        </div>
        <div class="col-auto">
            <input class="form-control" type="Time" id="ToTime" name="ToTime" value="<?= $field['ToTime'] ?>">
        </div>
        <div class="col-auto">
            <label class="col-form-label" for="Pid">交易序號</label>
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="Pid" name="Pid" placeholder="交易序號" value="<?= $field['Pid'] ?>">
        </div>
        <div class="col-auto">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_pay" value="1" id="is_pay"
                    <?= $field['is_pay'] == 1 ? 'checked' : '' ?>>
                <label class="form-check-label" for="is_pay">
                    已付款
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="tl_is_receipt" value="1" id="tl_is_receipt"
                    <?= $field['tl_is_receipt'] == 1 ? 'checked' : '' ?>>
                <label class="form-check-label" for="tl_is_receipt">
                    需收據
                </label>
            </div>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">搜尋</button>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-success" onclick="exreport()">匯出資料</<button>
        </div>
        <div class="col-auto">
            <a class="btn btn-secondary" href="/manage/TransactionList">清除搜尋資料</a>
        </div>
    </form>
</div>
<script>
var exreport = function() {
    const $Form = document.getElementById('DataForm');
    $data = {};
    for (var $i = 0; $i < $Form.elements.length; $i++) {
        var feled = $Form.elements[$i];
        switch (feled.type) {
            case undefined:
            case 'button':
            case 'file':
            case 'reset':
            case 'submit':
                break;
            case 'checkbox':
            case 'radio':
                if (!feled.checked) {
                    break;
                }
                default:
                    if ($data[feled.name]) {
                        $data[feled.name] = $data[feled.name] + ',' + feled.value;
                    } else {
                        $data[feled.name] = feled.value;
                    }
        }
    }
    
    function objectToQuerystring(obj) {
        return Object.keys(obj).reduce(function(str, key, i) {
            var delimiter, val;
            delimiter = (i === 0) ? '?' : '&';
            key = encodeURIComponent(key);
            val = encodeURIComponent(obj[key]);
            return [str, delimiter, key, '=', val].join('');
        }, '');
    }
    window.open('/manage/exreportlist'+objectToQuerystring($data))
}
</script>