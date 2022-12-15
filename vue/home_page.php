<?php require_once '../inc/navbar.php';?>
<?php require_once '../controller/home_page_controller.php';?>
<?php require_once '../controller/is_connect.php';?>


<main class="page-content">
    <div class="container-school-level top-page">
        <div class="container-slide">
            <?php $id = 0?>
            <?php foreach($array_grade as $grade): ?>
                <?php $id++; ?>
                <div class="item-shool-level" id="<?php echo $id?>">
                    <p class="school-level"><a href="../vue/archive_student.php?grade_id=<?php echo $grade['grade_id']?>"><?php echo $grade['grade_name'] ?></a></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="bottom-page">
        <div class="content-swipe">
            <div class="arrow arrow-left"><img src="../assets/svg/icon-arrow.svg"></div>
            <p class="text-swipe">swipe</p>
            <div class="arrow arrow-right"><img src="../assets/svg/icon-arrow.svg"></div>
        </div>
        <div class="end-page">
            <button class="btn-add add-grade">Ajouté</button>
            <div class="actif-section">
                <?php for($i = 1; $i <= count($array_grade); $i++): ?>
                    <a href="#"><div class="item-landmark" id="<?php echo $i; ?>"></div></a>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    
    <div class="section_add_grade"></div>
    <div class="container_pop_up">
        <div class="pop_up_add_grade">
            <div class="separator-top"></div>
            <form action="../controller/home_page_controller.php" method="post">

                <div class="fiel-grade form-grade" >
                    <label for="grade">Ajouter une classe:</label>
                    <input type="text" name="grade" class="item-form" placeholder="Saisir le nom de la classe">
                </div>

                <button type="submit" name="btn_pop_up_add_grade" class="btn_grade">Ajouté</button>
            </form> 
        </div>
    </div>
</main>

<?php require_once '../inc/footer.php'; ?>