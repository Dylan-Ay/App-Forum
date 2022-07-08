<?php 
    $session = $result['data']['session'];
    $h1 = "Inscription";
?>
<?php 
    echo $session->getFlash('signup-message');
    if ($session->getUser()): header('Location: index.php?ctrl=security&action=detailAccount'); endif;
?> 

<section id="sign-up">
    <form action="index.php?ctrl=security&action=register" method="post" enctype="multipart/form-data" class="d-flex flex-column w-50 m-auto">
        
        <label for="nickname">Pseudo:</label>
        <input type="text" name="nickname" id="nickname" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="gender">Genre: <small><em>facultatif</em></small></label>
        <input type="text" name="gender" id="gender">
        
        <label for="gender">Pays: <small><em>facultatif</em></small></label>
        <input type="text" name="country" id="country">

        <label for="birthdate">Date de naissance:</label>
        <input type="date" name="birthdate" id="birthdate">

        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password" required>
        
        <label for="confirm-password">Confirmer le mot de passe:</label>
        <input type="password" name="confirm-password" id="confirm-password" required>

        <input type="submit" value="S'inscrire" class="mt-3 btn btn-dark align-self-center btn-submit-form">

    </form>
</section>