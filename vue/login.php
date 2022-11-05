<?php require_once '../inc/header.php';?>

<header class="header">
    <div class="content-header">
        <nav class="navbar navbar-login">
            <a href="#" class="item-nav logo">T</a>
        </nav>
    </div>
</header>
<main class="content-login-page">
    <h1>Se connecter</h1>
    <form action="../controller/login_controller.php" method="POST">

        <div class="fiel-identifiant form-login" >
            <label for="email">Email :</label>
            <input type="email" name="email" class="item-form" placeholder="Email">
        </div>
        
        <div class="fiel-password form-login">
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" class="item-form" placeholder="Passwold">
        </div>
       
        <button type="submit" name="btn" class="btn-login">Valider</button>
    </form> 
</main>
<?php require_once '../inc/footer.php';?>