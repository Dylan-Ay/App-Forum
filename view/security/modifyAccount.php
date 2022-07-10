<?php 
    $user = $result['data']['user'];
    $session = $result['data']['session'];
    $title = "Modifier mon profil";
    $h1 = "Modifier mon profil";

    echo App\Session::getFlash('update-info-message');
?>
<section id="modify-account">
    <form action="index.php?ctrl=security&action=modifyAccountSubmit" method="post" class="d-flex flex-column w-50 m-auto pb-5">

        <label for="nickname">Pseudo:</label>
            <input type="text" name="nickname" id="nickname" value=" <?= $user->getNickname() ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value=" <?= $user->getEmail() ?>" required>

            <label for="gender">Genre:</label>
            <input type="text" name="gender" id="gender" value=" <?= $user->getGender() ?>" required>
            
            <label for="gender">Pays:</label>
            <input type="text" name="country" id="country" value=" <?= $user->getCountry() ?>" required>

            <label for="birthdate">Date de naissance:</label>
            <input type="date" name="birthdate" id="birthdate" value="<?= $user->getBirthdate()->format('Y-m-d') ?>" required>

            <input type="submit" value="Valider" class="mt-3 btn btn-outline-dark align-self-center">

    </form>

    <a class="btn btn-dark mt-5 d-block m-auto btn-return" href="index.php?ctrl=security&action=detailAccount">Revenir à mon profil</a>
</section>