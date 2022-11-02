<?php require_once '../inc/navbar.php';?>

<main class="page-content">
    <div class="section-shool-level">
        <p class="school-level">Bachelor 1</p>
    </div>
    <div class="content-swipe">
        <div class="arrow arrow-left"><img src="../assets/svg/icon-arrow.svg"></div>
        <p class="text-swipe">swipe</p>
        <div class="arrow arrow-right"><img src="../assets/svg/icon-arrow.svg"></div>
    </div>
    <div class="end-page">
        <button class="add-school">Ajouté</button>
        <div class="actif-section">
            <a href="#"><div class="item-landmark"></div></a>
            <a href="#"><div class="item-landmark"></div></a>
            <a href="#"><div class="item-landmark actif"></div></a>
            <a href="#"><div class="item-landmark"></div></a>
            <a href="#"><div class="item-landmark"></div></a>
        </div>
    </div>
    <div class="section_add_grade">
        <div class="pop_up_add_grade">
            <div class="separator-top"></div>
            <form action="" method="POST">

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