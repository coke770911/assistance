<!DOCTYPE HTML>
<!--
	Dimension by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
    <title>完善就學協助機制 亞東技術學院</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <style>
    .li-style {
        list-style-type: none;
        padding: 0.1rem 0rem 0.5rem 4rem;
        margin-bottom: 1rem;
        position: relative;
    }

    .li-style:before {
        content: "";
        position: absolute;
        top: 15px;
        left: -25px;
        width: 71px;
        height: 71px;
        background-repeat: no-repeat;
    }

    .intro:nth-of-type(1):before {
        background: url("images/side-01.png");
    }

    .intro:nth-of-type(2):before {
        background: url("images/side-02.png");
    }

    .intro:nth-of-type(3):before {
        background: url("images/side-03.png");
    }

    .Results:nth-of-type(1):before {
        background: url("images/side-06.png");
    }

    .Results:nth-of-type(2):before {
        background: url("images/side-07.png");
    }
   
    .formHide {
        display: none;
    }

    .error {
        color:red;
        font-weight: bold;
    }

    #footer .copyright {
        text-transform: none;
    }

    .fontColor {
        color: #E3007F;
    }

    body {
        background: #2d1e3c;
    }

   
    

    </style>
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" />
    </noscript>
</head>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <header id="header">
            <div class="logo">
                <img src="images/side-05.png" alt="捐款箱圖案" width="100%">
            </div>
            <div class="content">
                <div class="inner">
                    <h1>“為亞東技術學院 2021年<br>「完善就學協助機制」捐款”</h1>
                    <p>現在只要您捐<span class="fontColor">1</span>元給亞東技術學院、教育部就補助<span class="fontColor">1</span>元，<span class="fontColor">讓您的愛心加倍”Double”</span><br>也就是當亞東技術學院多募到<span class="fontColor">1萬</span>元，<br>我們就有<span class="fontColor">2萬</span>元可以幫助亞東技術學院的學生追尋他的夢想</p>
                </div>
            </div>
            <nav>
                <ul>
                    <li><a href="#intro">用途說明</a></li>
                    <li><a href="#Results">計畫成果</a></li>
                    <li><a href="#Rosterlist">捐款名冊</a></li>
                    <li><a href="#contact"><span class="fontColor">線上捐款</span></a></li>
                </ul>
            </nav>
        </header>

        <!-- Main -->
        <div id="main">
            <!-- Intro -->
            <article id="intro">
                <h2 class="major">用途說明 - 完善就學協助機制</h2>
                <ul>
                    <li class="intro li-style">
                        <h3>1:1募款補助</h3>
                        <p>108年獲徐元智先生紀念基金會捐贈150萬，提供109年計畫實施，109年計畫總經費354萬3,500元。</p>
                    </li>
                    <li class="intro li-style">
                        <h3>制定六大輔導機制策略</h3>
                        <p>針對上、中、下三大對象學力學生需求，提供六大面相輔導機制，進而達成三大目標。</p>
                        <img src="images/side-04.png" width="100%" alt="制定六大輔導機制策略圖例">
                    </li>
                    <li class="intro li-style">
                        <h3>19項輔導內容</h3>
                        <p>六大機制策略共有19項多元輔導內容，學生可自由依照學習興趣與學力需求，進而提升自我能力，幫助
                            學生精準定位自我。</p>
                        <img src="images/side-08.png" width="100%" alt="19項輔導內容">
                    </li>
                </ul>
            </article>
            <article id="Results">
                <h2 class="major">計畫成果 - 三年計畫執行成效</h2>
                <ul>
                    <li class="Results li-style">
                        <h3>107-108成果</h3>
                        <p>108年獲徐元智先生紀念基金會捐贈150萬，提供109年計畫實施，109年計畫總經費354萬3,500元。</p>
                    </li>
                    <li class="Results li-style">
                        <h3>109成果</h3>
                        <p>針對上、中、下三大對象學力學生需求，提供六大面相輔導機制，進而達成三大目標。</p>
                    </li>
                </ul>
                <ul>
                    <li><h3 style="font-size: 26px;">107-108成果共輔導學生357人次</h3></li>
                    <li><h3 style="font-size: 26px;">109年累計輔導學生共585人次!</h3></li>
                </ul>
            </article>

            <article id="Rosterlist">
                <h2 class="major">捐款名冊 - 歷年捐款紀錄</h2>
                <ul>
                    <li>
                        <h3>108年捐款人</h3>
                        <ol>
                            <li>
                                <p>徐元智先生紀念基金會 1,500,000元</p>
                            </li>
                        </ol>
                    </li>
                </ul>
            </article>

            <!-- Contact -->
            <article id="contact">
                <h2 class="major">線上捐款</h2>
                <form id="form" name="dataform" action="/Home/cashcheck" method="post"">
                    <div class="fields">
                    <div class="field half">
                        <input type="radio" id="receipt_no" name="tl_is_receipt" value="0" checked>
                        <label for="receipt_no">不索取捐款收據</label>
                    </div>
                    <div class="field half">
                        <input type="radio" id="receipt_yes" name="tl_is_receipt" value="1">
                        <label for="receipt_yes">索取捐款收據</label>
                    </div>
                    <div class="field half">
                        <label for="money">捐款金額</label>
                        <input type="number" name="money" id="money" placeholder="輸入金額" />
                    </div>
                    <div class="field half"></div>
                    <div class="field half" style="display: none;">
                        <label for="city">縣市</label>
                        <select name="city" id="city" onchange="selArea(this)">
                            <option value="0">-</option>
                            <?php foreach(esc($City) as $val) { ?>
                            <option value="<?= $val['city_code']; ?>"><?= $val['city_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="field half" style="display: none;">
                        <label for="city_area">市區</label>
                        <select name="city_area" id="city_area">
                            <option value="0">-</option>
                            <?php foreach(esc($CityArea) as $val) { ?>
                            <option class="CityArea <?= "city".$val['city_parent_code']; ?>"
                                value="<?= $val['city_code']; ?>"><?= $val['city_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="field half formHide">
                        <label for="tl_receipt_title">收據抬頭</label>
                        <input type="text" name="tl_receipt_title" id="tl_receipt_title" placeholder="收據抬頭" />
                    </div>
                    <div class="field formHide">
                        <label for="address">收據地址</label>
                        <input type="text" name="address" id="address" placeholder="收據地址" />
                    </div>
                    <div class="field half">
                        <label for="name">捐款人姓名</label>
                        <input type="text" name="name" id="name" placeholder="您的大名" />
                    </div>
                    <div class="field half"></div>
                    <div class="field half">
                        <label for="tel">連絡電話</label>
                        <input type="text" name="tel" id="tel" placeholder="連絡電話" />
                    </div>
                    <div class="field half"></div>
                    <div class="field half">
                        <label for="email">電子信箱</label>
                        <input type="email" name="email" id="email" placeholder="電子信箱" />
                    </div>
                    <div class="field half"></div>
                    <div class="field half">
                        <label for="stdId">您的學號(非校友免填寫)</label>
                        <input type="text" name="tl_std_id" id="stdId" placeholder="學號" />
                    </div>
                    <div class="field half"></div>
                    <div class="field">
                    <label>是否同意公開您的捐款紀錄於捐款名冊上</label>
                    </div>
                    <div class="field half">
                        <input type="radio" id="show_list_no" name="tl_is_show" value="0" checked>
                        <label for="show_list_no">不同意</label>
                    </div>
                    <div class="field half">
                        <input type="radio" id="show_list_yes" name="tl_is_show" value="1">
                        <label for="show_list_yes">同意</label>
                    </div>
                    <div class="field" style="display: none;">
                        <label for="message">想說的話</label>
                        <textarea name="message" id="message" placeholder="Message" rows="4"></textarea>
                    </div>

        </div>
        <ul class="actions">
            <li><input type="submit" value="送出資料" class="button primary" /></li>
        </ul>
        </form>
        </article>
    </div>
    <!-- Footer -->
    <footer id="footer">
        <p class="copyright">Copyright © 亞東技術學院　220新北市板橋區四川路二段58號 TEL: (02) 7738-8000</p>
        <p class="copyright">教育部高等教育深耕計畫附錄一：提升高教公共性完善就學協助機制</p>
        <p class="copyright">計畫主持人：陳俊宏學務長　承辦人：邱雅威</p>
        <p class="copyright">聯絡資訊　E-mail：ot195@mail.oit.edu.tw　分機：1315</p>
    </footer>
    </div>

    <!-- BG -->
    <div id="bg"></div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script>
    $(function() {
        $('.CityArea').hide();

        $('#form').validate({
            onkeyup: function(element, event) {
            //去除左側空白
            var value = this.elementValue(element).replace(/^\s+/g, "");
            $(element).val(value);
            },rules: {
                money: {
                    required: true,
                    maxlength: 6,
                    range: [100, 100000],
                    number: true,
                },
                name: {
                    required: true,
                    maxlength: 20,
                },
                tel: {
                    required: true,
                    maxlength: 25,
                },
                email: {
                    required: true,
                    maxlength: 50,
                    email: true,
                },
            },messages: {
                money: {
                    required:'金額未填寫',
                    maxlength: '最多輸入6個數字',
                    range: '捐款金額最少一百元至最多十萬元整',
                    number: '金額需為數字',                   
                },
                name: {
                    required: '捐款人姓名未填寫',
                    maxlength: '捐款人姓名最多20個字',
                },
                tel: {
                    required: '連絡電話未填寫',
                    maxlength: '連絡電話最多長度25個字元',
                },
                email: {
                    required: '電子信箱未填寫',
                    maxlength: '電子信箱長度最多50個字元',
                    email: '您輸入的信箱格式有錯誤',
                },
            }, 
            submitHandler: function(form) {
            form.submit();
        }});

    })


    var selArea = function(e) {
        $('.CityArea').hide();
        document.getElementById('city_area').selectedIndex = 0
        $(".city" + e.value).show();
    }

    $('body').on('change','input[name="tl_is_receipt"]',function() {
        if($(this).val() == '1') {
            $('.formHide').show()
        } else {
            $('.formHide').hide()
        }
    })

    </script>
</body>

</html>