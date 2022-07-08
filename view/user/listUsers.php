<?php

$users = $result['data']['users'];
$session = $result['data']['session'];
$message = $result['data']['message'];

$title = "Listes des utilisateurs";
$h1 = "Listes des utilisateurs";
?>

<section id="list-users" class="pb-5 pt-3 px-3">
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Photo</th>
            <th scope="col">Pseudo</th>
            <th scope="col">Role</th>
            <th scope="col">Nombre de messages</th>
            <th scope="col">Date de création de compte</th>
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
                        <?php if($user->getRoles()[0] === 'ROLE_USER'): echo "Utilisateur"; else: echo "Admin"; endif;?>
                    </td>

                    <td>
                        <?= $user->getNb(); ?>
                    </td>
                        
                    <td>
                        <?= $user->getRegisterDate()->format("d/m/Y à H:i:s"); ?>
                    </td>
                
                    <td>
                        
                        <?php if((!empty($message->getLastMessageByUser($user->getId())))):?>

                            <a class="me-2" href="index.php?ctrl=forum&action=detailTopic&id=<?= $message->getLastMessageByUser($user->getId())->getTopic()->getId() ?>">

                                <?=$message->getLastMessageByUser($user->getId())?>
                            </a>
                            
                            <span> dans la catégorie <?= $message->getLastMessageByUser($user->getId())->getTopic()->getCategory()->getTitle()?></span>
                        <?php else: echo "Aucun message n'a été posté"; endif;?>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; endif;?>
    </table>
<?php
