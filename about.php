<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/user_style.css">
    <title>Jadi Pintar - tentang kami</title>
</head>
<body>
    <?php include 'components/user_header.php'?>

    <!----------banner section------------- -->
    <div class="banner">
        <div class="detail">
            <div class="title">
                <a href="index.php">beranda</a><span><i class="bx bx-chevron-right">tentang</i></span>
            </div>
            <h1>Ketahui lebih banyak tentang Jadi Pintar</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut molestias eum eligendi commodi modi temporibus quibusdam vel esse harum, quidem dolorum ea cupiditate deleniti fuga, doloremque sit? Vitae, ipsam maxime.</p>
            <div class="flex-btn">
                <a href="login.php" class="btn">masuk untuk mulai</a>
                <a href="contact.php" class="btn">hubungi kami</a>
            </div>
        </div>
        <img src="image/taylorswift.png">
    </div>
    <!----------about section------------- -->
    <div class="about">
        <div class="box-container">
            <div class="box">
                <img src="image/taylorswift.jpg" class="img">
                <div class="thumbnail-1">
                    <img src="image/Alex.jpg">
                </div>
                <div class="thumbnail-2">
                    <img src="image/Maudy-Ayunda.jpg">
                </div>
                <div class="thumbnail-3">
                    <img src="image/candra.jpg">
                </div>
            </div>
            <div class="box">
                <div class="title">
                    <span>ketahui tentang kami</span>
                    <h1>ketahui tentang platform jadi pintar</h1>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis dignissimos pariatur itaque rem? Expedita, nesciunt commodi, debitis alias obcaecati unde animi corrupti assumenda minus ex cumque, illo fuga eos sed!</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia cumque animi, facilis mollitia quam atque expedita. Magnam repudiandae, nisi aliquam, at impedit recusandae sint quasi consectetur officiis fugiat deleniti perferendis.</p>
                </div>
                <div class="detail">
                    <i class="bx bxl-facebook"></i>
                    <div>
                        <h3>kelas fleksibel</h3>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto quae veritatis error debitis magni in reiciendis, alias, nihil ut vitae fugit ipsum. Quae saepe repellat veniam ad! Totam, natus harum.</p>
                    </div>
                </div>
                <div class="detail">
                    <i class="bx bxl-facebook"></i>
                    <div>
                        <h3>belajar dari mana aja</h3>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto quae veritatis error debitis magni in reiciendis, alias, nihil ut vitae fugit ipsum. Quae saepe repellat veniam ad! Totam, natus harum.</p>
                    </div>
                </div>
                <div class="detail">
                    <i class="bx bxl-facebook"></i>
                    <div>
                        <h3>tutor yang berpengalaman</h3>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto quae veritatis error debitis magni in reiciendis, alias, nihil ut vitae fugit ipsum. Quae saepe repellat veniam ad! Totam, natus harum.</p>
                    </div>
                </div>
                <a href="" class="btn">ketahui lebih banyak tentang kami</a>
            </div>
        </div>
    </div>
    <!-- -------------------work section--------------------------- -->
     <div class="work">
        <div class="box-container">
            <div class="content">
                <div class="heading">
                    <span>gimana sih cara kerja jadi pintar?</span>
                    <h1>bangun karirmu dan tingkatkan hidupmu</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam esse quas necessitatibus voluptas dignissimos magnam hic porro tempore repellat velit, repellendus pariatur laboriosam reiciendis earum expedita iste quos dolor id!</p>
                    <a href="" class="btn">ketahui lebih banyak tentang kami</a>
                </div>
            </div>
            <div class="img-box">
                <img src="image/online-education.png" >
            </div>
        </div>
     </div>
     <!-- ----------------testimoni section-------------------- -->
      <div class="testimonial-container">
            <div class="heading">
                <span>umpan balik dari peserta didik</span>
                <h1>apa yang orang-orang katakan tentang kita</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, mollitia eius. Incidunt recusandae necessitatibus possimus nulla ipsum voluptatum maxime ratione accusantium, neque placeat porro iure odit ad fugit ducimus ipsa?</p>
            </div>
            <div class="container">
                <div class="testimonial-item active">
                    <i class="bx bxs-quote-right" id="quote"></i>
                    <img src="image/nattawin.jpg">
                    <h1>Apo Nattawin</h1>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo animi aspernatur cupiditate consequuntur dignissimos incidunt possimus ipsam eveniet nihil quidem reprehenderit voluptas tempora maiores quisquam vero, ducimus repellendus error placeat!</p>
                </div>
                <div class="testimonial-item">
                    <i class="bx bxs-quote-right" id="quote"></i>
                    <img src="image/kanawut.jpg">
                    <h1>Gulf Kanawut</h1>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo animi aspernatur cupiditate consequuntur dignissimos incidunt possimus ipsam eveniet nihil quidem reprehenderit voluptas tempora maiores quisquam vero, ducimus repellendus error placeat!</p>
                </div>
                <div class="testimonial-item">
                    <i class="bx bxs-quote-right" id="quote"></i>
                    <img src="image/jj.jpg">
                    <h1>JJ</h1>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo animi aspernatur cupiditate consequuntur dignissimos incidunt possimus ipsam eveniet nihil quidem reprehenderit voluptas tempora maiores quisquam vero, ducimus repellendus error placeat!</p>
                </div>
                <div class="testimonial-item">
                    <i class="bx bxs-quote-right" id="quote"></i>
                    <img src="image/nanon.jpg">
                    <h1>Nanon Korapat</h1>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo animi aspernatur cupiditate consequuntur dignissimos incidunt possimus ipsam eveniet nihil quidem reprehenderit voluptas tempora maiores quisquam vero, ducimus repellendus error placeat!</p>
                </div>
                <div class="left-arrow" onclick="nextSlide()"><i class="bx bx-left-arrow-alt"></i>
                </div>
                <div class="right-arrow" onclick="prevSlide()"><i class="bx bx-right-arrow-alt"></i>
                </div>
            </div> 
      </div>


    <?php include 'components/footer.php'?>
    <script>
            // profile
            let body = document.body;
            let profile = document.querySelector('.header .flex .profile');
            let searchForm = document.querySelector('.header .flex .search-form');
            let navbar = document.querySelector('.header .flex .navbar');

            document.querySelector('#user-btn').onclick = () => {
            profile.classList.toggle('active');
            searchForm.classList.remove('active');
            };

            document.querySelector('#search-btn').onclick = () => {
            searchForm.classList.toggle('active');
            profile.classList.remove('active');
            };

            document.querySelector('#menu-btn').onclick = () => {
            navbar.classList.toggle('active');
            body.classList.toggle('active');
            };

            window.onscroll = () =>{
            profile.classList.remove('active')
            searchForm.classList.remove('active');

            if(window.innerWidth < 1200) {
                sideBar.classList.remove('active');
                body.classList.remove('active');
            }
            };

            // Counter//
            document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll(".counter");

            counters.forEach((counter) => {
                const target = +counter.getAttribute("data-target");
                const boxCounter = counter.closest(".box-counter");
                const speed = +boxCounter.getAttribute("data-speed");

                let count = 0;
                const increment = Math.ceil(target / speed);

                const updateCounter = () => {
                count += increment;
                if (count < target) {
                    counter.textContent = count;
                    setTimeout(updateCounter, 1);
                } else {
                    counter.textContent = target;
                }
                };

                updateCounter();
            });
            });

            // testimoni
            let index = 0;

            function getSlides() {
                return Array.from(document.querySelectorAll('.testimonial-item'));
            }

            function showSlide(newIndex) {
                const slides = getSlides();
                if (newIndex >= slides.length) newIndex = 0;
                if (newIndex < 0) newIndex = slides.length - 1;

                slides.forEach(slide => slide.classList.remove('active'));
                slides[newIndex].classList.add('active');
                index = newIndex;
            }

            window.nextSlide = function () {
                showSlide(index + 1);
            };

            window.prevSlide = function () {
                showSlide(index - 1);
            };

            document.addEventListener("DOMContentLoaded", function () {
                const slides = getSlides();
                slides.forEach((slide, i) => {
                if (slide.classList.contains("active")) {
                    index = i;
                }
                });
            });
    </script>
</body>
</html>