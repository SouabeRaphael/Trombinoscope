<?php require_once '../inc/navbar.php';?>
<?php require_once '../controller/archive_student_controller.php';?>
<?php $id = $_GET['grade_id']; ?>
<main class="page-content page-content-archive-student">
    <div class="container-archive-student">
        <div class="top-page-trombi">
            <div class="container-icon-arrow">
                <a href="./home_page.php"><img class="icon-arrow" src="../assets/svg/Icon-arrow-back.svg"></a>
            </div>
            <div class="title-grade">
                <?php foreach(get_name_id($id) as $grade_id): ?>
                <h1><?php echo $grade_id['grade_name']?></h1>
                <?php endforeach; ?>
            </div>
            <!-- fleche cacher pour pouvoir bien center le titre -->
            <div class="container-icon-arrow" style="visibility: hidden;">
                <a href="./home_page.php"><img class="icon-arrow" src="../assets/svg/Icon-arrow-back.svg"></a>
            </div>
            <!-- ----------------------------------------------- -->
        </div>
        <div class="container-card-student">
            <?php foreach(get_students_grade($id) as $user): ?>
            <div class="card-item-student" id="<?php echo $user['users_id']; ?>">
                <figure class="img-profil">
                <?php foreach(get_img($user['image_id']) as $image): ?>
                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode( $image['image'] ) . '" />';; ?>
                <?php endforeach; ?>
                </figure>

                <div class="separator-bottom-img-profil"></div>

                <h3 class="name-student"><a href="../vue/student_page.php?grade_id=<?php echo $id;?>&student_id=<?php echo $user['users_id']?>"><?php echo $user['first_name'] .' '. $user['last_name'] ?></a></h3>
                
                <?php foreach(get_spe($user['spe_id']) as $spe): ?>
                <p class="specialities-student"><?php echo $spe['spe_name']; ?></p>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="container-btn-add-student">
            <a href="../vue/signup.php"><button class="btn-add add-student">Ajouté</button></a>
        </div>
    </div>
    
</main>
<?php require_once '../inc/footer.php';?>