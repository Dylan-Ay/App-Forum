<?php 
    $user = $result['data']['user'];
    $session = $result['data']['session'];
    $title = "Modifier mon profil";
    $h1 = "Modifier mon profil";
?>
<section id="modify-account">
    <form action="index.php?ctrl=security&action=modifyAccountSubmit" method="post" class="d-flex flex-column w-50 m-auto">

        <label for="nickname">Pseudo:</label>
            <input type="text" name="nickname" id="nickname" value=" <?= $user->getNickname() ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value=" <?= $user->getEmail() ?>" required>

            <label for="gender">Genre: <small><em>facultatif</em></small></label>
            <input type="text" name="gender" id="gender" value=" <?= $user->getGender() ?>">
            
            <label for="gender">Pays: <small><em>facultatif</em></small></label>
            <input type="text" name="country" id="country" value=" <?= $user->getCountry() ?>">

            <label for="birthdate">Date de naissance:</label>
            <input type="date" name="birthdate" id="birthdate" value=" <?= $user->getBirthdate()->format('d/m/y') ?>">

            <input type="submit" value="Valider" class="mt-3 btn btn-outline-dark align-self-center">

    </form>
</section>