<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }


    $select_likes = $conn->prepare("SELECT * FROM likes WHERE user_id = ?");
    $select_likes->execute([$user_id]);
    $total_likes = $select_likes->rowCount();

    $select_comments = $conn->prepare("SELECT * FROM comments WHERE user_id = ?");
    $select_comments->execute([$user_id]);
    $total_comments = $select_comments->rowCount();

    $select_bookmarks = $conn->prepare("SELECT * FROM bookmark WHERE user_id = ?");
    $select_bookmarks->execute([$user_id]);
    $total_bookmarks = $select_bookmarks->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/user_style.css">
    <title>Jadi Pintar - beranda</title>
</head>
<body>
    <?php include 'components/user_header.php'?>

    <!----------home section------------- -->
    <div class="hero">
        <div class="box-container">
            <div class="box">
                <img src="image/banner.png">
            </div>
            <div class="box">
                <h1>Bangun skill untuk tingkatkan karirmu</h1>
                <p>
                    Kembangkan dirimu melalui berbagai kursus berkualitas. JadiPintar hadir untuk membantumu belajar dengan mudah, fleksibel, dan menyenangkan kapan pun dan di mana pun.</p>
                <a href="courses.php" class="btn">Lihat Konten</a>
            </div>
        </div>
    </div>
    <!----------kategori section------------- -->
    <div class="categories">
        <div class="heading">
            <span>kategori</span>
            <h1>jelajahi kategori kursus populer<br>yang akan merubah dirimu</h1>
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/graphic.png">
                <h3>graphic design</h3>
                <a href="courses.php">5 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="box">
                <img src="image/feature-selection.png">
                <h3>web design</h3>
                <a href="courses.php">5 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="box">
                <img src="image/seo.png">
                <h3>sales marketing</h3>
                <a href="courses.php">5 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="box">
                <img src="image/app-development2.png">
                <h3>mobile aplication</h3>
                <a href="courses.php">5 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="box">
                <img src="image/cognitive.png">
                <h3>personal development</h3>
                <a href="courses.php">3 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="box">
                <img src="image/writing.png">
                <h3>art & humanities</h3>
                <a href="courses.php">2 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="box">
                <img src="image/tax.png">
                <h3>finance & accounting</h3>
                <a href="courses.php">2 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
        </div>
    </div>
    <!----------ikon section------------- -->
    <div class="icon-section">
        <div class="box">
            <img src="image/speed.png">
            <h3>performa cepat</h3>
            <p>Sistem kami dirancang untuk memberikan akses belajar yang cepat dan lancar tanpa hambatan.</p>
        </div>
        <div class="box">
            <img src="image/app-development.png">
            <h3>desain interaktif</h3>
            <p>Materi kursus dibuat dengan tampilan menarik dan mudah dipahami untuk semua kalangan.</p>
        </div>
        <div class="box">
            <img src="image/customer-service-agent.png">
            <h3>pengajar profesional</h3>
            <p>Dipandu oleh tutor berpengalaman yang siap membimbingmu hingga mahir.</p>
        </div>
        <div class="box">
            <img src="image/positive.png">
            <h3>mudah digunakan</h3>
            <p>Antarmuka yang sederhana memudahkan siapa saja untuk mulai belajar tanpa ribet.</p>
        </div>
    </div>

    <!----------krusus section------------- -->
    <div class="courses">
        <div class="heading">
            <span>kursus populer</span>
            <h1>peserta didik jadi pintar <br> bisa gabung dengan kita !!!</h1>
        </div>
        <div class="box-container">
            <?php
                $select_courses = $conn->prepare("SELECT * FROM playlist WHERE status = ? ORDER BY date DESC LIMIT 6");
                $select_courses->execute(['active']);
                if ($select_courses->rowCount() > 0) {
                    while($fetch_courses = $select_courses->fetch(PDO::FETCH_ASSOC)){
                        $course_id = $fetch_courses['id'];

                        $select_tutor = $conn->prepare("SELECT * FROM tutors WHERE id = ?");
                        $select_tutor->execute([$fetch_courses['tutor_id']]);
                        $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);

                        
                  
            ?>
            <div class="box">
                <div class="tutor">
                    <img src="uploaded_files/<?= $fetch_tutor['image']; ?>">
                    <div>
                        <h3><?= $fetch_tutor['name']; ?></h3>
                        <span><?= $fetch_courses['date']; ?></span>
                    </div>
                </div>
                <img src="uploaded_files/<?= $fetch_courses['thumb']; ?>" class="thumb">
                <h3 class="title"><?= $fetch_courses['title']; ?></h3>
                <a href="playlist.php?get_id=<?= $course_id; ?>" class="btn">lihat playlist</a>
            </div>
            <?php
                  }
                }else{
                    echo '<p class="empty">belum ada kursus ditambahkan</p>';
                }
            ?>
        </div>
        <div class="more-btn">
            <a href="courses.php" class="btn">lihat selengkapnya</a>
        </div>
    </div>

    <!----------benefit section------------- -->
    <div class="benifites">
        <img src="image/map-indonesia.png" class="map">
        <div class="detail">
            <h1>Terpercaya berdasarkan <br> ribuan pelanggan </h1>
            <p>Kerja Cerdas</p>
            <a href="courses.php" class="btn">jelajahi kursus</a>
            <p>APASIH KEUNTUNGAN DARI JADI PINTAR?</p>
            <div class="box-container">
                <div class="box">
                    <img src="image/time.png">
                    <p>Gratis Perbarui <br> Seumur Hidup</p>
                </div>
                <div class="box">
                    <img src="image/support.png">
                    <p>Garansi Selama <br> 6 bulan</p>
                </div>
                <div class="box">
                    <img src="image/speed.png">
                    <p>Kecepatan <br>Performa</p>
                </div>
                <div class="box">
                    <img src="image/diamond.png">
                    <p>Kami Menyediakan <br> Kursus Premium</p>
                </div>
            </div>
        </div>
    </div>

    <!----------learner section------------- -->
    <div class="learners">
        <div class="heading">
            <span>kenapa harus kami</span>
            <h1>membangun komunitas <br> belajar berkelanjutan </h1>
        </div>
        <div class="box-container">
            <div class="box">
                <div class="shape"></div>
                <div class="round">
                    <img src="image/graduating-student.png">
                </div>
                    <div class="box-counter" data-speed="200">
                        <p class="counter" data-target= "200">0</p>
                        <i class="bx bx-plus"></i> </div>
                    <p>peserta didik saat ini</p>
            </div>
            <div class="box">
                <div class="shape"></div>
                <div class="round">
                    <img src="image/laptop.png">
                </div>
                    <div class="box-counter" data-speed="100">
                        <p class="counter" data-target= "100">0</p>
                        <i class="bx bx-plus"></i> </div>
                    <p>kursus & video</p>
            </div>
            <div class="box">
                <div class="shape"></div>
                <div class="round">
                    <img src="image/certificate.png">
                </div>
                    <div class="box-counter" data-speed="250">
                        <p class="counter" data-target= "250">0</p>
                        <i class="bx bx-plus"></i> </div>
                    <p>peserta didik tersertifikasi</p>
            </div>
            <div class="box">
                <div class="shape"></div>
                <div class="round">
                    <img src="image/graduation-cap.png">
                </div>
                    <div class="box-counter" data-speed="300">
                        <p class="counter" data-target= "300">0</p>
                        <i class="bx bx-plus"></i> </div>
                    <p>terdaftar sebagai peserta didik</p>
            </div>
        </div>
    </div>
    <!----------about us section------------- -->
    <div class="about-us">
        <div class="box-container">
            <div class="box">
                <img src="image/banner2.png">
            </div>
            <div class="box">
                <div class="heading">
                    <span>MEMBERIKAN FITUR TERBAIK</span>
                    <h1>semua yang kamu butuhkan menuju sukses</h1>
                    <P>JadiPintar adalah platform pembelajaran online yang menyediakan berbagai kursus dan materi edukatif. Kami percaya bahwa pendidikan harus mudah diakses oleh siapa saja untuk membuka lebih banyak peluang di masa depan.</P>
                    <a href="about.php" class="btn">ketahui lebih banyak tentang kami</a>
                </div>
            </div>
        </div>
    </div>

    <!----------tutor section------------- -->   
    <div class="teacher-section">
        <div class="heading">
            <span>Tutor</span>
            <h1>yang akan menginsprirasimu</h1>
        </div>
        <div class="box-container">
            <div class="teacher-tabs">
                <img src="image/sandhika.jpg" class="tab-item active" data-target="#team-01">
                <img src="image/Alex.jpg" class="tab-item" data-target="#team-02">
                <img src="image/Maudy-Ayunda.jpg" class="tab-item" data-target="#team-03">
                <img src="image/Felicia Putri Tjiasaka.jpeg" class="tab-item" data-target="#team-04">
                <img src="image/agusleo.jpeg" class="tab-item" data-target="#team-05">
                <img src="image/candra.jpg" class="tab-item" data-target="#team-06">
            </div>
            <!----------tab content------------- -->   
            <div class="tab-content active" id="team-01">
                <img src="image/sandhika.jpg">
                <div class="detail">
                    <h2>Sandhika Galih</h2>
                    <span>Developer Tutor</span>
                    <p> <i class="bx bx-location-plus"></i> Jakarta, Indonesia </p>
                    <p>Seorang dosen dan praktisi pengembangan web dengan pengalaman lebih dari 10 tahun. Sandhika dikenal dengan gaya mengajarnya yang santai dan mudah dipahami, serta aktif membagikan ilmu pemrograman melalui berbagai platform edukatif.</p>
                    <div class="icons">
                        <i class="bx bxl-instagram"></i>
                        <i class="bx bxl-twitter"></i>
                        <i class="bx bxl-facebook"></i>
                        <i class="bx bxl-linkedin"></i>
                    </div>
                    <a href=""><i class="bx bxl-phone"></i>+62 897-2346-7859</a>
                    <a href=""><i class="bx bxl-envelope"></i>example@gmail.com</a>
                </div>
            </div>
            <div class="tab-content" id="team-02">
                <img src="image/Alex.jpg">
                <div class="detail">
                    <h2>Alex Freberg</h2>
                    <span>Data Analyst</span>
                    <p> <i class="bx bx-location-plus"></i> USA </p>
                    <p>Alex adalah analis data profesional dari Amerika Serikat yang dikenal lewat kanal edukasinya di YouTube. Ia mengajarkan data science, Python, dan visualisasi data dengan pendekatan praktis yang cocok untuk pemula hingga menengah.</p>
                    <div class="icons">
                        <i class="bx bxl-instagram"></i>
                        <i class="bx bxl-twitter"></i>
                        <i class="bx bxl-facebook"></i>
                        <i class="bx bxl-linkedin"></i>
                    </div>
                    <a href=""><i class="bx bxl-phone"></i>+62 897-2346-7859</a>
                    <a href=""><i class="bx bxl-envelope"></i>example@gmail.com</a>
                </div>
            </div>
            <div class="tab-content" id="team-03">
                <img src="image/Maudy-Ayunda.jpg">
                <div class="detail">
                    <h2>Maudy Ayunda</h2>
                    <span>Artis</span>
                    <p> <i class="bx bx-location-plus"></i> Jakarta, Indonesia </p>
                    <p>Maudy bukan hanya seorang artis multitalenta, tetapi juga lulusan Oxford dan Stanford. Ia menginspirasi generasi muda untuk terus belajar, berpikir kritis, dan berani mengejar impian melalui pendidikan berkualitas.</p>
                    <div class="icons">
                        <i class="bx bxl-instagram"></i>
                        <i class="bx bxl-twitter"></i>
                        <i class="bx bxl-facebook"></i>
                        <i class="bx bxl-linkedin"></i>
                    </div>
                    <a href=""><i class="bx bxl-phone"></i>+62 897-2346-7859</a>
                    <a href=""><i class="bx bxl-envelope"></i>example@gmail.com</a>
                </div>
            </div>
            <div class="tab-content" id="team-04">
                <img src="image/Felicia Putri Tjiasaka.jpeg">
                <div class="detail">
                    <h2>Felicia Putri Tjiasaka</h2>
                    <span>Financial Consultant</span>
                    <p> <i class="bx bx-location-plus"></i> Surabaya, Indonesia </p>
                    <p>Sebagai pendiri Ternak Uang dan konsultan keuangan muda, Felicia memberikan pemahaman finansial dengan cara yang sederhana namun berdampak. Ia fokus membantu generasi muda memahami pentingnya literasi keuangan sejak dini.</p>
                    <div class="icons">
                        <i class="bx bxl-instagram"></i>
                        <i class="bx bxl-twitter"></i>
                        <i class="bx bxl-facebook"></i>
                        <i class="bx bxl-linkedin"></i>
                    </div>
                    <a href=""><i class="bx bxl-phone"></i>+62 897-2346-7859</a>
                    <a href=""><i class="bx bxl-envelope"></i>example@gmail.com</a>
                </div>
            </div>
            <div class="tab-content" id="team-05">
                <img src="image/agusleo.jpeg">
                <div class="detail">
                    <h2>Agusleo Halim</h2>
                    <span>Digital Marketing</span>
                    <p> <i class="bx bx-location-plus"></i> Surabaya, Indonesia </p>
                    <p>Digital marketer profesional yang berpengalaman dalam membangun strategi pemasaran untuk brand lokal dan global. Agusleo membagikan ilmunya agar kamu dapat bersaing di era digital dengan tools dan strategi kekinian.</p>
                    <div class="icons">
                        <i class="bx bxl-instagram"></i>
                        <i class="bx bxl-twitter"></i>
                        <i class="bx bxl-facebook"></i>
                        <i class="bx bxl-linkedin"></i>
                    </div>
                    <a href=""><i class="bx bxl-phone"></i>+62 897-2346-7859</a>
                    <a href=""><i class="bx bxl-envelope"></i>example@gmail.com</a>
                </div>
            </div>
            <div class="tab-content" id="team-06">
                <img src="image/candra.jpg">
                <div class="detail">
                    <h2>Candra</h2>
                    <span>Designer</span>
                    <p> <i class="bx bx-location-plus"></i> Jakarta, Indonesia </p>
                    <p>Desainer kreatif yang ahli dalam UI/UX dan branding visual. Candra telah bekerja di berbagai proyek kreatif dan siap membimbing kamu menguasai desain digital dengan tools modern dan pendekatan yang inspiratif.</p>
                    <div class="icons">
                        <i class="bx bxl-instagram"></i>
                        <i class="bx bxl-twitter"></i>
                        <i class="bx bxl-facebook"></i>
                        <i class="bx bxl-linkedin"></i>
                    </div>
                    <a href=""><i class="bx bxl-phone"></i>+62 897-2346-7859</a>
                    <a href=""><i class="bx bxl-envelope"></i>example@gmail.com</a>
                </div>
            </div>
            <!----------tab content------------- -->   
        </div>
    </div>

    <?php include 'components/footer.php'?>
    <script src="js/user_script.js" defer></script>
</body>
</html>