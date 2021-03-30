<div class="container">
    <div class="row mb-2 mt-2">
        <div class="col-8">
            <form action="TransactionList" method="post" >
                <label>日期區間：</label>
                <input type="date" id="sdate" name="sdate" value="<?= esc($sdate)?>">至
                <input type="date" id="edate" name="edate" value="<?= esc($edate)?>">
                <button type="submit" class="btn btn-primary">確認搜尋</button>
            </form>
        </div>
        <div class="col-4 text-end">
            <button type="button" class="btn btn-success" id="download-xlsx">下載成XLSX</button>
        </div>
    </div>
    <table id="myTable">
        <thead>
            <tr>
                <th>訂單編號</th>
                <th>申請時間</th>
                <th>捐款方式</th>
                <th>捐款金額</th>
                <th>捐款人姓名</th>
                <th>捐款人電話</th>
                <th>捐款人Email</th>
                <th>學號</th>
                <th>付款狀態</th>
                <th>付款時間</th>
                <th>是否索取收據</th>
                <th>收據抬頭</th>
                <th>身分證或統編</th>
                <th>市區</th>
                <th>地址</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach(esc($list) as $val) { ?>
            <tr>
                <td><?=$val['t_Orderid'] ?></td>
                <td><?=$val['t_create_datetime'] ?></td>
                <td><?=$val['pay_mode'] ?></td>
                <td><?=$val['t_money'] ?></td>
                <td><?=$val['t_name'] ?></td>
                <td><?=$val['t_tel'] ?></td>
                <td><?=$val['t_email'] ?></td>
                <td><?=$val['t_stdno'] ?></td>
                <td><?=$val['PaymentType'] ?></td>
                <td><?=$val['PaymentDate'] ?></td>
                <td><?=$val['receipt'] ?></td>
                <td><?=$val['t_receipt_title'] ?></td>
                <td><?=$val['t_id_number'] ?></td>
                <td><?=$val['city_name'] ?></td>
                <td><?=$val['t_address'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<script type="text/javascript" src="/js/xlsx.full.min.js"></script>
<script>
var table = new Tabulator("#myTable", {
    layout:"fitDataStretch",
    height: "auto",
    pagination:"local",
    paginationSize:15,
    placeholder:"目前無資料",
    columns:[
        {title:"訂單編號", field:"Orderid",hozAlign: "center",headerSort:false},
        {title:"申請時間", field:"datetime",hozAlign: "center",headerSort:false},
        {title:"捐款方式", field:"pay_mode",hozAlign: "center",headerSort:false},
        {title:"捐款金額", field:"money",hozAlign: "center",headerSort:false},
        {title:"捐款人姓名", field:"name",hozAlign: "center",headerSort:false},
        {title:"捐款人電話", field:"tel",hozAlign: "center",headerSort:false},
        {title:"捐款人Email", field:"email",hozAlign: "center",headerSort:false},
        {title:"學號", field:"stdno",hozAlign: "center",headerSort:false},
        {title:"付款狀態", field:"PaymentType",hozAlign: "center",headerSort:false},
        {title:"付款時間", field:"PaymentDate",hozAlign: "center",headerSort:false},
        {title:"是否索取收據", field:"receipt",hozAlign: "center",headerSort:false},
        {title:"收據抬頭", field:"receipt_title",hozAlign: "center",headerSort:false},
        {title:"身分證或統編", field:"id_number",hozAlign: "center",headerSort:false},
        {title:"市區", field:"city_name",hozAlign: "center",headerSort:false},
        {title:"地址", field:"t_address",hozAlign: "center",headerSort:false},
    ],
    locale:true,
    langs:{
        "zh-tw":{
            "ajax":{
                "loading":"下載中", //ajax loader text
                "error":"錯誤", //ajax error text
            },
            "groups":{ //copy for the auto generated item count in group header
                "item":"項目", //the singular  for item
                "items":"項目組", //the plural for items
            },
            "pagination":{
            	"page_size":"頁面", //label for the page size select element
                "page_title":"顯示頁面",//tooltip text for the numeric page button, appears in front of the page number (eg. "Show Page" will result in a tool tip of "Show Page 1" on the page 1 button)
                "first":"第一頁", //text for the first page button
                "first_title":"首頁", //tooltip text for the first page button
                "last":"末頁",
                "last_title":"末頁",
                "prev":"上一頁",
                "prev_title":"上一頁",
                "next":"下一頁",
                "next_title":"下一頁",
                "all":"全部",
            },
            "headerFilters":{
                "default":"filter column...", //default header filter placeholder text
                "columns":{
                    "name":"filter name...", //replace default header filter text for column name
                }
            }
        }
    },
});
document.getElementById("download-xlsx").addEventListener("click", function(){
    table.download("xlsx", "捐款資料.xlsx",{}); //download a xlsx fil
});

</script>