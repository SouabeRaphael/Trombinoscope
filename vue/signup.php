<?php require_once '../inc/header.php';?>
<?php require_once '../controller/signup_controller.php';?>

<header class="header">
    <div class="content-header">
        <nav class="navbar navbar-login">
            <a href="#" class="item-nav logo">T</a>
        </nav>
    </div>
</header>
<main class="content-login-page content-signup-page">
    <h1>S'inscrire</h1>
    <form action="../controller/signup_controller.php" method="POST">

        <div class="fiel-firstname form-login" >
            <label for="first_name">Prénom :</label>
            <input type="text" name="first_name" class="item-form" placeholder="Prénom">
        </div>
        
        <div class="fiel-lastname form-login">
            <label for="last_name">Nom :</label>
            <input type="text" name="last_name" class="item-form" placeholder="Nom">
        </div>

        <div class="fiel-email form-login">
            <label for="email">Email :</label>
            <input type="email" name="email" class="item-form" placeholder="Email">
        </div>

        <div class="fiel-tel form-login">
            <label for="tel">Téléphone :</label>
            <input type="tel" name="tel" class="item-form" placeholder="Téléphone">
        </div>

        <div class="fiel-city form-login">
            <label for="city">Ville :</label>
            <input type="text" name="city" class="item-form" placeholder="Ville">
        </div>

        <div class="fiel-birth form-login">
            <label for="birth">Date de naissance :</label>
            <input type="date" name="birth" class="item-form" placeholder="Date de naissance">
        </div>

        <div class="fiel-grade form-login">
            <label for="grade">Classe :</label>
            <select name="grade" class="item-form">
                <option value="13" selected>--Choisir la classe--</option>

                <?php foreach(get_grade() as $grade): ?>
                    <option value="<?php echo $grade['grade_id']; ?>"><?php echo $grade['grade_name'];?></option>
                <?php endforeach; ?>

            </select>
        </div>

        <div class="fiel-speciality form-login">
            <label for="speciality">Spécialité :</label>
            <select name="speciality" class="item-form">
                <option value="">--Choisir la spécialité--</option>

                <?php foreach(get_specialities() as $spe): ?>
                    <option value="<?php echo $spe['spe_id'];?>"><?php echo $spe['spe_name']; ?></option>
                <?php endforeach; ?>

            </select>
        </div>

        <div class="fiel-password form-login">
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" class="item-form" placeholder="Mot de passe">
        </div>
       
        <button type="submit" name="btn" class="btn-login">Valider</button>
    </form> 
</main>
<?php require_once '../inc/footer.php';?>