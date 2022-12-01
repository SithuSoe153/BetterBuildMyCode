<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="assets/function.js">

<body>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="bar-icon"></span>
        <span class="bar-icon"></span>
        <span class="bar-icon"></span>

    </button>

    <div id="menu-area">
        <div class="logo">
            <a href="#">
                <img src="images/ha.jpg" alt="">
            </a>
        </div>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Store</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Account</a></li>
            <li><a href="#">Home</a></li>
            <li><a href="#">Store</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Account</a></li>
        </ul>
    </div>

    <div class="banner-area">
        <div class="banner-text">
            <h2>Stickey nav bar</h2>
            <a href="#">Learn More</a>
        </div>
    </div>

    <div class="main-con">
        <div class="wrapper">
            <h2>content header</h2>
        </div>
    </div>

    <script>
        window.addEventListener("scroll", function() {
            let menuArea = document.getElementById('menu-area');

            if (window.pageYOffset > 0) {
                menuArea.classList.add("cus-nav");
            } else {
                menuArea.classList.remove("cus-nav")
            }
        });
    </script>

    <p style="font-size:90px">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laborum pariatur deserunt eos error ducimus, tempore enim, explicabo maxime eius nam expedita temporibus quo natus doloribus quasi iusto aspernatur! Assumenda, laboriosam.</p>

</body>

</html>