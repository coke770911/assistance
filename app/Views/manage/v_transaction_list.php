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
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled"
                            <?=$val['tl_is_pay'] == 1 ? "checked" : "" ?> disabled>
                    </td>
                    <td class="text-center">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled"
                            <?=$val['tl_is_receipt'] == 1 ? "checked" : "" ?> disabled>
                    </td>
                    <td class="text-center d-print-none">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"
                            data-OrderNumber="<?=$val['tl_pid'] ?>" data-money="<?=$val['tl_money'] ?>"
                            data-payer="<?=$val['tl_name'] ?>" data-email="<?=$val['tl_email'] ?>"
                            data-tel="<?=$val['tl_tel'] ?>" data-message="<?=$val['tl_message'] ?>"
                            data-address="<?=$val['city_name'].$val['city_area_name'].$val['tl_address'] ?>"
                            data-stdId="<?=$val['tl_std_id'] ?>" 
                            data-receiptTitle="<?=$val['tl_receipt_title'] ?>">詳細</button>
                        <button type="button" class="btn btn-warning">收據</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="txt_money" class="col-form-label">金額</label>
                                <input type="text" class="form-control" id="txt_money" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="txt_Title" class="col-form-label">收據抬頭</label>
                                <input type="text" class="form-control" id="txt_Title" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="txt_address" class="col-form-label">收據地址</label>
                                <input type="text" class="form-control" id="txt_address" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="txt_stdId" class="col-form-label">學號</label>
                                <input type="text" class="form-control" id="txt_stdId" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="txt_payer" class="col-form-label">捐款人</label>
                                <input type="text" class="form-control" id="txt_payer" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="txt_email" class="col-form-label">捐款人Email</label>
                                <input type="text" class="form-control" id="txt_email" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="txt_tel" class="col-form-label">捐款人電話</label>
                                <input type="text" class="form-control" id="txt_tel" disabled>
                            </div>
                            <div class="mb-3" style="display: none;">
                                <label for="txt_message" class="col-form-label">訊息</label>
                                <textarea class="form-control" id="txt_message" disabled></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var exampleModal = document.getElementById('exampleModal')
exampleModal.addEventListener('show.bs.modal', function(event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-* attributes
    var OrderNumber = button.getAttribute('data-OrderNumber')
    var money = button.getAttribute('data-money')
    var payer = button.getAttribute('data-payer')
    var email = button.getAttribute('data-email')
    var tel = button.getAttribute('data-tel')
    var message = button.getAttribute('data-message')

    var receiptTitle = button.getAttribute('data-receiptTitle')
    var address = button.getAttribute('data-address')
    var stdId = button.getAttribute('data-stdId')
    
    var modalTitle = exampleModal.querySelector('.modal-title')
    var txt_money = exampleModal.querySelector('.modal-body #txt_money')
    var txt_payer = exampleModal.querySelector('.modal-body #txt_payer')
    var txt_email = exampleModal.querySelector('.modal-body #txt_email')
    var txt_tel = exampleModal.querySelector('.modal-body #txt_tel')
    var txt_message = exampleModal.querySelector('.modal-body #txt_message')

    var txt_Title = exampleModal.querySelector('.modal-body #txt_Title')
    var txt_address = exampleModal.querySelector('.modal-body #txt_address')
    var txt_stdId = exampleModal.querySelector('.modal-body #txt_stdId')

    modalTitle.textContent = '捐款編號 ' + OrderNumber
    txt_money.value = money
    txt_payer.value = payer
    txt_email.value = email
    txt_tel.value = tel
    txt_message.value = message
    txt_Title.value = receiptTitle
    txt_address.value = address
    txt_stdId.value = stdId
})
</script>