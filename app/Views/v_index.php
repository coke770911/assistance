<!DOCTYPE HTML>
<!--
	Dimension by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
    <title>Dimension by HTML5 UP</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
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
                <span class="icon fa-gem"></span>
            </div>
            <div class="content">
                <div class="inner">
                    <h1>完善就學協助計畫</h1>
                    <p>A fully responsive site template designed by <a href="https://html5up.net">HTML5 UP</a> and
                        released<br />
                        for free under the <a href="https://html5up.net/license">Creative Commons</a> license.</p>
                </div>
            </div>
            <nav>
                <ul>
                    <li><a href="#intro">計畫目的</a></li>
                    <li><a href="#contact">幫助學生</a></li>
                </ul>
            </nav>
        </header>

        <!-- Main -->
        <div id="main">

            <!-- Intro -->
            <article id="intro">
                <h2 class="major">Intro</h2>
                <span class="image main"><img src="images/pic01.jpg" alt="" /></span>
                <p>Aenean ornare velit lacus, ac varius enim ullamcorper eu. Proin aliquam facilisis ante interdum
                    congue. Integer mollis, nisl amet convallis, porttitor magna ullamcorper, amet egestas mauris. Ut
                    magna finibus nisi nec lacinia. Nam maximus erat id euismod egestas. By the way, check out my <a
                        href="#work">awesome work</a>.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis dapibus rutrum facilisis. Class aptent
                    taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam tristique
                    libero eu nibh porttitor fermentum. Nullam venenatis erat id vehicula viverra. Nunc ultrices eros ut
                    ultricies condimentum. Mauris risus lacus, blandit sit amet venenatis non, bibendum vitae dolor.
                    Nunc lorem mauris, fringilla in aliquam at, euismod in lectus. Pellentesque habitant morbi tristique
                    senectus et netus et malesuada fames ac turpis egestas. In non lorem sit amet elit placerat maximus.
                    Pellentesque aliquam maximus risus, vel sed vehicula.</p>
            </article>

            <!-- Contact -->
            <article id="contact">
                <h2 class="major">捐助填寫</h2>
                <form name="dataform" action="/Home/cashcheck" method="post"">
                    <div class="fields">
                        <div class="field half">
                            <label for="money">助學金額</label>
                            <input type="number" name="money" id="money" placeholder="輸入金額" />
                        </div>
                        <div class="field half"></div>
                        <div class="field half">
                            <input type="radio" id="receipt_no" name="receipt" value="0" checked>
                            <label for="receipt_no">不索取捐款收據</label>
                        </div>
                        <div class="field half">
                            <input type="radio" id="receipt_yes" name="receipt" value="1">
                            <label for="receipt_yes">索取捐款收據</label>
                        </div>
                        <div class="field half">
                            <label for="name">捐款人姓名</label>
                            <input type="text" name="name" id="name" placeholder="您的大名" />
                        </div>
                        <div class="field half">
                            <label for="tel">連絡電話</label>
                            <input type="text" name="tel" id="tel" placeholder="連絡電話" />
                        </div>
                        <div class="field half">
                            <label for="email">電子信箱</label>
                            <input type="email" name="email" id="email" placeholder="電子信箱" />
                        </div>
                        <div class="field">
                            <label for="message">想說的話</label>
                            <textarea name="message" id="message" placeholder="Message" rows="4"></textarea>
                        </div>
                        <div class="field half">
                            <label for="city">縣市</label>
                            <select name="city" id="city" onchange="selArea(this)">
                                <option value="0">-</option>
                                <?php foreach(esc($City) as $val) { ?>
                                <option value="<?= $val['city_code']; ?>"><?= $val['city_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="field half">
                            <label for="city_area">市區</label>
                            <select name="city_area" id="city_area">
                                <option value="0">-</option>
                                <?php foreach(esc($CityArea) as $val) { ?>
                                <option class="CityArea <?= "city".$val['city_parent_code']; ?>"
                                    value="<?= $val['city_code']; ?>"><?= $val['city_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="field">
                            <label for="address">地址</label>
                            <input type="text" name="address" id="address" placeholder="地址" />
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
            <p class="copyright">&copy; 2020 完善就學計畫網站.</p>
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
    <script>
    $(function() {
        $('.CityArea').hide();
    })
    var selArea = function(e) {
        $('.CityArea').hide();
        document.getElementById('city_area').selectedIndex = 0
        $(".city" + e.value).show();
    }
    </script>
</body>

</html>