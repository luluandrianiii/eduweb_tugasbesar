<?php
    if(isset($message)){
        foreach ($message as $message){
            echo '
                <div class="message">
                <span>'.$message.'</span>
                <i class="bx bx-x" onclick="this.parentElement.remove();"></i>
                </div>
                ';
        }
    }
?>
<header class="header">
    <section class="flex">
        <a href="home.php"> 
            <img src="image/logo.jpg" width="130px"> </a>
        <nav class="navbar">
            <a href="index.php"><span>Beranda</span></a>
            <a href="about.php"><span>Tentang Kami</span></a>
            <a href="courses.php"><span>Kursus</span></a>
            <a href="teachers.php"><span>Tutor</span></a>
            <a href="contact.php"><span>Kontak Kami</span></a>
        </nav>
        <form action="search_course.php" method="post" class="search-form">
            <input type="text" name="search_course" placeholder="cari kursus..." required maxlength="100">
            <button type="submit" name="search_course_btn" class="bx bx-search-alt-2"></button>
        </form>
        <div class="icons">
            <div id="menu-btn" class="bx bx-list-plus"></div>
            <div id="search-btn" class="bx bx-search-alt-2"></div>
            <div id="user-btn" class="bx bxs-user"></div>
        </div>
        <div class="profile">
                <?php
                $select_profile = $conn->prepare("SELECT * FROM users WHERE id=?");
                $select_profile->execute([$user_id]);
                if($select_profile->rowCount() > 0){
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
                <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="Profile Image">
                <h3><?= $fetch_profile['name']; ?></h3>
                <span>peserta didik</span><br>

                <div id="flex-btn">
                    <a href="profile.php" class="btn">Lihat Profil</a>
                    <a href="user_logout.php" onclick="return confirm('keluar dari website ini ?');" class="btn">keluar</a>
                </div>
                <?php
                    }else{
                ?>
                 <h3 style="margin-bottom: 1rem;">Silahkan masuk atau daftar</h3>
                 <div id="flex-btn">
                    <a href="login.php" class="btn">masuk</a>
                     <a href="register.php" class="btn">daftar</a>
                </div>
                <?php } ?>
            </div>
    </section>
</header>
