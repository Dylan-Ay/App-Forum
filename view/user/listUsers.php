<?php

$users = $result['data']['users'];
$title = "Listes des utilisateurs";
?>

<h1>Liste des Utilisateurs</h1>

<section id="list-users" class="pb-5 pt-3 px-3">
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Photo</th>
            <th scope="col">Pseudo</th>
            <th scope="col">Role</th>
            <th scope="col">Nombre de messages</th>
            <th scope="col">Date d'enregistrement</th>
            <th scope="col">Dernier Message</th>
            </tr>
        </thead>

        <?php if (!empty($users)): foreach($users as $user): ?>
            <tbody>
                <tr>
                    <td> 
                        <img src="<?= $user->getPicture(); ?>" alt="photo de profil de l'utilisateur <?= $user->getNickname(); ?>">
                    </td>

                    <td> 
                        <a href="index.php?ctrl=user&action=detailUser&id=<?= $user->getId(); ?>"> <?= $user->getNickname(); ?> </a>
                    </td>

                    <td>
                        <?= $user->getRole(); ?>
                    </td>

                    <td>
                        <?= $user->getNb(); ?>
                    </td>
                        
                    <td>
                        <?= $user->getRegisterDate()->format("d/m/Y à H:i:s"); ?>
                    </td>

                    <td>
                        En cours.. lastinsertid
                    </td>
                </tr>
            </tbody>
        <?php endforeach; endif;?>
    </table>
<?php
