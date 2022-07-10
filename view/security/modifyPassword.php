<?php 
    $user = $result['data']['user'];
    $session = $result['data']['session'];
    $title = "Modifier mon mot de passe";
    $h1 = "Modifier mon mot de passe";
    
    echo $session->getFlash('password-message');
?>

<section id="modify-password">

    <form action="index.php?ctrl=security&action=modifyPasswordSubmit" method="post" class="d-flex w-50 flex-column m-auto pb-5">
        <label for="password">Nouveau mot de passe:</label>
        <input type="password" name="password" id="password" required>

        <label for="confirm-password">Confirmer le mot de passe:</label>
        <input type="password" name="confirm-password" id="confirm-password" required>
        
        <input type="submit" value="Valider" class="mt-3 btn btn-outline-dark align-self-center">
    </form>

    <a class="btn btn-dark mt-5 d-block m-auto btn-return" href="index.php?ctrl=security&action=detailAccount">Revenir à mon profil</a>
</section>