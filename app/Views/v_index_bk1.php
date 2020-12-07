<!DOCTYPE HTML>
<html>

<head>
    <title>亞東技術學院 完善就學計畫網站</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="完善就學計畫,亞東技術學院,生活輔導組" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>

<body class="is-preload">
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Intro -->
        <section class="intro">
            <header>
                <h1>完善就學協助計畫</h1>
                <p>提升高教公共性：完善就學協助機制，有效促進社會流動</p>
                <ul class="actions">
                    <li><a href="#first" class="arrow scrolly"><span class="label">Next</span></a></li>
                </ul>
            </header>
            <div class="content">
                <span class="image fill" data-position="center"><img src="images/pic01.jpg" alt="" /></span>
            </div>
        </section>
        <!-- Section -->
        <section id="first">
            <header>
                <h2>三大對象目標 + 六大輔導機制</h2>
            </header>
            <div class="content">
                <p>經濟環境不利學生，也有不同的需求，若不針對他們的需要給於輔導機制，效果恐怕會有折扣，為明確且有效的幫助本校經濟環境不利學生，我們特此訂定出三大對象目標及六大輔導機制策略，精準針對學生需求及符合本校教育規劃方針，建立亞東特色之完善就學協助計畫。
                </p>
                <span class="image main"><img src="images/pic02.jpg" alt="" /></span>
            </div>
        </section>
        <!-- Section -->
        <section>
            <header>
                <h2>為2021年的「亞東技術學院 完善就學協助機制」捐款</h2>
            </header>
            <div class="content">
                <p>亞東技術學院致力在真正能幫助到學生的立場上，而去制定輔導機制，減少部分同學對經濟困難產生的心理信心問題與實質經濟困難，針對學生不同的需求面相給予真正需要的措施，減少失學、增加向上競爭改變自我的機會，讓這些孩子未來成長成社會的中堅份子。
                </p>
                <p>政府與教育部也相當重視教育的公共公平性，<strong>現在只要您捐款1元，教育部就補助這個計畫1元</strong>，也就是說假設亞東技術學院能夠募款到100萬元，等於有200萬元可供亞東的孩子成長改變的機會。
                </p>
                <p>因此，您的愛心我們保證會讓未來更美好，這些孩子會感恩現在您的幫助並在未來成為幫助別人的孩子的大人，為了讓愛心永續、亞東技術學院完善就學協助機制永續、擴大，幫助更多需要的孩子，希望有您的行動與參與，翻轉未來的世界。
                </p>
                <!-- Section -->
                <section>
                    <header>
                        <h3>Erat aliquam</h3>
                        <p>Vehicula ultrices dolor amet ultricies et condimentum. Magna sed etiam consequat, et lorem
                            adipiscing sed dolor sit amet, consectetur amet do eiusmod tempor incididunt ipsum
                            suspendisse ultrices gravida.</p>
                    </header>
                    <div class="content">
                        <div class="gallery">
                            <a href="images/gallery/fulls/01.jpg" class="landscape"><img
                                    src="images/gallery/thumbs/01.jpg" alt="" /></a>
                            <a href="images/gallery/fulls/02.jpg"><img src="images/gallery/thumbs/02.jpg" alt="" /></a>
                            <a href="images/gallery/fulls/03.jpg"><img src="images/gallery/thumbs/03.jpg" alt="" /></a>
                            <a href="images/gallery/fulls/04.jpg" class="landscape"><img
                                    src="images/gallery/thumbs/04.jpg" alt="" /></a>
                        </div>
                    </div>
                </section>
            </div>
        </section>
        <!-- Section -->
        <section>
            <header>
                <h2>捐款資料填寫</h2>
            </header>
            <div class="content">
                <p><strong>完善就學計畫</strong> 感謝支持與幫助.</p>
                <form name="dataform" action="/Home/cashcheck" method="POST">
                    <div class="fields">
                        <div class="field">
                            <label for="money">助學金額</label>
                            <input type="number" name="money" id="money" placeholder="輸入金額" />
                        </div>
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
            </div>
            <footer>
                <ul class="items">
                    <li>
                        <h3>Email</h3>
                        <a href="#">sc_adm@mail.oit.edu.tw</a>
                    </li>
                    <li>
                        <h3>Tel</h3>
                        <a href="#">(02) 7738-8000</a>
                    </li>
                    <li>
                        <h3>地址</h3>
                        <span>220新北市板橋區四川路二段58號</span>
                    </li>
                    <li>
                        <h3>Elsewhere</h3>
                        <ul class="icons">
                            <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
                            <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a>
                            </li>
                            <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a>
                            </li>
                            <li><a href="#" class="icon brands fa-linkedin-in"><span class="label">LinkedIn</span></a>
                            </li>
                            <li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
                            <li><a href="#" class="icon brands fa-codepen"><span class="label">Codepen</span></a></li>
                        </ul>
                    </li>
                </ul>
            </footer>
        </section>
        <!-- Copyright -->
        <div class="copyright">&copy; 完善就學計畫網站.</div>
    </div>
    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
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
