<div class="container mt-2">
<div class="table-responsive">
    <table class="table table-striped table-hover d-print-table">
        <thead class="table-light">
            <tr>
                <th class="text-center">交易序號</th>
                <th class="text-center">交易時間</th>
                <th class="text-center">捐款金額</th>
                <th class="text-center">捐款人</th>
                <th class="text-center">捐款方式</th>
                <th class="text-center">已付款</th>
                <th class="text-center">需收據</th>
                <th class="text-center d-print-none">功能</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $val) {?>
            <tr>
                <td class="text-center"><?=$val['tl_pid'] ?></td>
                <td class="text-center"><?=$val['tl_create_time'] ?></td>
                <td class="text-right"><?=number_format($val['tl_money']) ?></td>
                <td class="text-center"><?=$val['tl_name'] ?></td>
                <td class="text-center"><?=$val['tl_pay_type'] ?></td>
                <td class="text-center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" <?=$val['tl_is_pay'] == 1 ? "checked" : "" ?> disabled >
                </td>
                <td class="text-center">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" <?=$val['tl_receipt'] == 1 ? "checked" : "" ?> disabled >
                </td>
                <td class="text-center d-print-none">
                    <button type="button" class="btn btn-info">查看</button>
                    <button type="button" class="btn btn-warning">收據</button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
</div>