<?php require_once '../inc/navbar.php';?>
<?php require_once '../controller/archive_student_controller.php';?>
<?php $id = $_GET['grade_id']; ?>
<?php $student_id = $_GET['student_id'];?>

<main class="page-content page-content-student">
    <div class="container-student">
        <div class="top-page-trombi">
            <div class="container-icon-arrow">
                <a href="../vue/archive_student.php?grade_id=<?php echo $id; ?>"><img class="icon-arrow" src="../assets/svg/Icon-arrow-back.svg"></a>
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
        <div class="container-detail-student">
            <?php foreach(get_students($student_id) as $user): ?>
            <figure class="img-profil">
            <?php foreach(get_img($user['image_id']) as $image): ?>
                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode( $image['image'] ) . '" />';; ?>
            <?php endforeach; ?>
            </figure>

            <h3 class="name-student"><?php echo $user['first_name'] .' '. $user['last_name'] ?></h3>

            <?php foreach(get_spe($user['spe_id']) as $spe): ?>
            <p class="specialities-student"><?php echo $spe['spe_name']; ?></p>
            <?php endforeach; ?>
                
            <div class="location">
                <img class="icon-location" src="../assets/svg/Icon material-location-on.svg">
                <p class="location-student"><?php echo $user['Location']; ?></p>
            </div>
            
            <div class="section-info-horizontal">
                <div class="column-age">
                    <p class="label-item">Age</p>
                    <p class="value-item"><?php echo $user['age']; ?> ans</p>
                </div>
                <div class="separator-vertical"></div>
                <div class="column-phone">
                    <p class="label-item">Numéros</p>
                    <p class="value-item">0<?php echo $user['phone']; ?></p>
                </div>
                <div class="separator-vertical"></div>
                <div class="column-age">
                    <p class="label-item">Age</p>
                    <p class="value-item">18 ans</p>
                </div>
            </div>

            <div class="container-description">
                <h3 class="title-description">Description</h3>
                <p class="description"><?php echo $user['description']; ?></p>
            </div>

            <div class="container-email">
                <p class="email"><b>Email : </b><?php echo $user['email']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    
</main>
<?php require_once '../inc/footer.php';?> 