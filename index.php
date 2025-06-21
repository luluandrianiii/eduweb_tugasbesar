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
                <img src="/jadipintar/image/taylorswift.png">
            </div>
            <div class="box">
                <h1>Bangun skill untuk tingkatkan karirmu</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi sequi fugiat accusantium reprehenderit facere fugit ipsa atque quos voluptatem quas adipisci, minima enim explicabo illo! Reiciendis illo distinctio inventore rem?</p>
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
                <img src="/jadipintar/image/graphic.png">
                <h3>graphic design</h3>
                <a href="courses.php">5 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="box">
                <img src="/jadipintar/image/feature-selection.png">
                <h3>web design</h3>
                <a href="courses.php">5 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="box">
                <img src="/jadipintar/image/seo.png">
                <h3>sales marketing</h3>
                <a href="courses.php">5 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="box">
                <img src="/jadipintar/image/app-development2.png">
                <h3>mobile aplication</h3>
                <a href="courses.php">5 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="box">
                <img src="/jadipintar/image/cognitive.png">
                <h3>personal development</h3>
                <a href="courses.php">3 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="box">
                <img src="/jadipintar/image/writing.png">
                <h3>art & humanities</h3>
                <a href="courses.php">2 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="box">
                <img src="/jadipintar/image/tax.png">
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
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur facere necessitatibus fugiat qui accusantium ipsam vel quaerat perspiciatis modi dolore! Voluptatem quaerat praesentium, tempore labore tempora ad aut repellendus cumque?</p>
        </div>
        <div class="box">
            <img src="image/app-development.png">
            <h3>performa cepat</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur facere necessitatibus fugiat qui accusantium ipsam vel quaerat perspiciatis modi dolore! Voluptatem quaerat praesentium, tempore labore tempora ad aut repellendus cumque?</p>
        </div>
        <div class="box">
            <img src="image/customer-service-agent.png">
            <h3>performa cepat</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur facere necessitatibus fugiat qui accusantium ipsam vel quaerat perspiciatis modi dolore! Voluptatem quaerat praesentium, tempore labore tempora ad aut repellendus cumque?</p>
        </div>
        <div class="box">
            <img src="image/positive.png">
            <h3>performa cepat</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur facere necessitatibus fugiat qui accusantium ipsam vel quaerat perspiciatis modi dolore! Voluptatem quaerat praesentium, tempore labore tempora ad aut repellendus cumque?</p>
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
                <img src="image/taylorswift.png">
            </div>
            <div class="box">
                <div class="heading">
                    <span>MEMBERIKAN FITUR TERBAIK</span>
                    <h1>semua yang kamu butuhkan menuju sukses</h1>
                    <P>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo quas magni ullam nihil suscipit sit, debitis eius recusandae, exercitationem quos iure quis doloremque tenetur sequi omnis dignissimos, veritatis non eum.</P>
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
                <img src="image/logo.jpg" class="tab-item active" data-target="#team-01">
                <img src="image/logo.jpg" class="tab-item active" data-target="#team-02">
                <img src="image/logo.jpg" class="tab-item active" data-target="#team-03">
                <img src="image/logo.jpg" class="tab-item active" data-target="#team-04">
                <img src="image/logo.jpg" class="tab-item active" data-target="#team-05">
                <img src="image/logo.jpg" class="tab-item active" data-target="#team-06">
            </div>
            <!----------tab content------------- -->   
            <div class="tab-content active" id="team-01">
                <img src="image/taylorswift.jpg">
                <div class="detail">
                    <h2>Sandika Galih</h2>
                    <span>Developer Tutor</span>
                    <p> <i class="bx bx-location-plus"></i> Jakarta, Indonesia </p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, saepe molestiae tempore veniam possimus sunt cupiditate vel accusamus dicta ab repellat sapiente quae! Deserunt temporibus, nesciunt ullam quibusdam corporis dicta!</p>
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
                <img src="image/taylorswift.jpg">
                <div class="detail">
                    <h2>Sandika Galih</h2>
                    <span>Developer Tutor</span>
                    <p> <i class="bx bx-location-plus"></i> Jakarta, Indonesia </p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, saepe molestiae tempore veniam possimus sunt cupiditate vel accusamus dicta ab repellat sapiente quae! Deserunt temporibus, nesciunt ullam quibusdam corporis dicta!</p>
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
                <img src="image/taylorswift.jpg">
                <div class="detail">
                    <h2>Sandika Galih</h2>
                    <span>Developer Tutor</span>
                    <p> <i class="bx bx-location-plus"></i> Jakarta, Indonesia </p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, saepe molestiae tempore veniam possimus sunt cupiditate vel accusamus dicta ab repellat sapiente quae! Deserunt temporibus, nesciunt ullam quibusdam corporis dicta!</p>
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
                <img src="image/taylorswift.jpg">
                <div class="detail">
                    <h2>Sandika Galih</h2>
                    <span>Developer Tutor</span>
                    <p> <i class="bx bx-location-plus"></i> Jakarta, Indonesia </p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, saepe molestiae tempore veniam possimus sunt cupiditate vel accusamus dicta ab repellat sapiente quae! Deserunt temporibus, nesciunt ullam quibusdam corporis dicta!</p>
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
                <img src="image/taylorswift.jpg">
                <div class="detail">
                    <h2>Sandika Galih</h2>
                    <span>Developer Tutor</span>
                    <p> <i class="bx bx-location-plus"></i> Jakarta, Indonesia </p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, saepe molestiae tempore veniam possimus sunt cupiditate vel accusamus dicta ab repellat sapiente quae! Deserunt temporibus, nesciunt ullam quibusdam corporis dicta!</p>
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
                <img src="image/taylorswift.jpg">
                <div class="detail">
                    <h2>Sandika Galih</h2>
                    <span>Developer Tutor</span>
                    <p> <i class="bx bx-location-plus"></i> Jakarta, Indonesia </p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, saepe molestiae tempore veniam possimus sunt cupiditate vel accusamus dicta ab repellat sapiente quae! Deserunt temporibus, nesciunt ullam quibusdam corporis dicta!</p>
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