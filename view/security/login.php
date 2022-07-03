<?php
    $session = $result['data']['session'];
    $h1 = "Se connecter";
?>
<?php 
    echo $session->getFlash('login-message');
    if ($session->getUser()): header('Location: index.php?ctrl=security&action=detailAccount'); endif;
?> 


<section id="login">
    <form action="index.php?ctrl=security&action=submitLogin" method="post" class="d-flex flex-column w-50 m-auto">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" value="Se connecter" class="mt-3 btn btn-outline-dark align-self-center">
        
    </form>
    <p class="text-center mt-4">Nouvel utilisateur ? 
        <a href="index.php?ctrl=security&action=registerForm">Cliquez ici</a> pour créer un compte
    </p>

</section>
