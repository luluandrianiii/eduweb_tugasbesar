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
            <p>JadiPintar adalah platform pembelajaran online yang menyediakan berbagai kursus berkualitas tinggi dari tutor-tutor terbaik. Kami hadir untuk mendukung semua orang dalam mengembangkan diri, membangun keterampilan, dan mencapai kesuksesan melalui akses belajar yang mudah, fleksibel, dan menyenangkan.</p>
            <div class="flex-btn">
                <a href="login.php" class="btn">masuk untuk mulai</a>
                <a href="contact.php" class="btn">hubungi kami</a>
            </div>
        </div>
        <img src="image/banner.png">
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
                    <p>JadiPintar dibangun dengan semangat untuk memberikan akses pendidikan yang setara bagi siapa saja, di mana saja. Kami percaya bahwa setiap individu memiliki potensi besar yang dapat diasah melalui pembelajaran berkelanjutan, didampingi oleh tutor berpengalaman dan materi yang relevan dengan perkembangan zaman.</p>
                    <p>Dengan menggabungkan teknologi digital, pengalaman belajar yang interaktif, serta fitur-fitur inovatif, JadiPintar menjadi solusi terbaik bagi pelajar, mahasiswa, maupun profesional yang ingin meningkatkan kompetensi dan mencapai tujuan karier mereka.</p>
                </div>
                <div class="detail">
                    <i class="bx bxl-facebook"></i>
                    <div>
                        <h3>kelas fleksibel</h3>
                        <p>Belajar bisa disesuaikan dengan waktumu. Kami menyediakan kelas yang dapat diakses kapan saja, sehingga kamu dapat belajar sesuai ritmemu sendiri, tanpa tekanan.</p>
                    </div>
                </div>
                <div class="detail">
                    <i class="bx bxl-facebook"></i>
                    <div>
                        <h3>belajar dari mana aja</h3>
                        <p>Cukup dengan perangkat dan koneksi internet, kamu bisa mengakses berbagai kursus menarik dari rumah, kampus, atau bahkan saat bepergian.</p>
                    </div>
                </div>
                <div class="detail">
                    <i class="bx bxl-facebook"></i>
                    <div>
                        <h3>tutor yang berpengalaman</h3>
                        <p>Setiap tutor di JadiPintar telah terverifikasi dan berpengalaman di bidangnya. Mereka siap membimbingmu hingga paham dengan metode belajar yang ramah dan interaktif.</p>
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
                    <p>Mulai dari mendaftar, memilih kursus sesuai minat, hingga menyelesaikan modul dan mendapatkan sertifikat—semuanya bisa kamu lakukan secara online dengan cepat dan mudah di JadiPintar. Kami memastikan setiap proses belajar kamu berjalan efisien, efektif, dan tentunya menyenangkan.</p>
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
                <p>Kami percaya bahwa pengalaman belajar terbaik datang dari kepercayaan pengguna. Inilah beberapa pendapat dari mereka yang telah mengikuti kursus dan berkembang bersama JadiPintar.</p>
            </div>
            <div class="container">
                <div class="testimonial-item active">
                    <i class="bx bxs-quote-right" id="quote"></i>
                    <img src="image/nattawin.jpg">
                    <h1>Apo Nattawin</h1>
                    <p>“Awalnya saya ragu belajar online, tapi JadiPintar punya sistem yang mudah diikuti dan tutor-tutornya sangat komunikatif. Dalam beberapa minggu saja, saya sudah punya skill baru yang langsung saya pakai untuk kerja!”</p>
                </div>
                <div class="testimonial-item">
                    <i class="bx bxs-quote-right" id="quote"></i>
                    <img src="image/kanawut.jpg">
                    <h1>Gulf Kanawut</h1>
                    <p>“Kelasnya fleksibel dan bisa diakses kapan pun. Ini cocok banget buat saya yang punya jadwal sibuk. Materi kursus juga sangat up-to-date dan aplikatif!”</p>
                </div>
                <div class="testimonial-item">
                    <i class="bx bxs-quote-right" id="quote"></i>
                    <img src="image/jj.jpg">
                    <h1>JJ</h1>
                    <p>“Saya sudah mencoba beberapa platform belajar, tapi menurut saya JadiPintar adalah yang paling nyaman. Fitur-fiturnya lengkap, tutor sangat ramah, dan komunitasnya suportif!”</p>
                </div>
                <div class="testimonial-item">
                    <i class="bx bxs-quote-right" id="quote"></i>
                    <img src="image/nanon.jpg">
                    <h1>Nanon Korapat</h1>
                    <p>“Yang saya suka dari JadiPintar adalah pendekatan belajarnya yang interaktif. Visualnya menarik dan penjelasan materi benar-benar bikin paham. Cocok buat pemula maupun lanjutan.”</p>
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