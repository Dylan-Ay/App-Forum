<?php
    $user = $result['data']['user'];
    if (!empty($result['data']['messages'])): $messages = $result['data']['messages']; endif;
    $session = $result['data']['session'];

    $title = "Profil de ". $user->getNickname();

    if ($session->getUser()){
        $h1 = "Bienvenue sur votre compte ". $user->getNickname();
    }else{
        header('Location: index.php?ctrl=security&action=login');
    };
?>

<section id="user-details" class="py-3 px-3 mb-5">
    <div class="header-user-details d-flex justify-content-between align-items-center">
        <h4>Informations détaillées</h4>
        <span>
            <a href="index.php?ctrl=security&action=modifyAccount">Modifier mon profil</a>
        </span>
    </div>

    <ul class="list-unstyled ps-4">
        <li> 
            <img src="<?= $user->getPicture()?>" alt="Photo de profil de <?= $user->getNickname()?>"> 
        </li>
        <li> 
            <span class="almost-bold user-data">Pseudo:</span>  <?= $user->getNickname() ?> 
        </li>
        <li>
            <span class="almost-bold user-data">Date de naissance:</span> <?= $user->getBirthdate()->format('d/m/y') ?>
        </li>
        <li> 
            <span class="almost-bold user-data">Adresse email:</span>  <?= $user->getEmail()?> 
        </li>
        <li class="password-content d-flex justify-content-between align-items-center">
            <div>
                <span class="almost-bold user-data">Mot de passe:</span> **********
            </div> 
            <a href="index.php?ctrl=security&action=modifyPassword">Modifier mon mot de passe</a>
        </li>
        <li>
            <span class="almost-bold user-data">Genre:</span> <?= $user->getGender() ?>
        </li>
        <li>
            <span class="almost-bold user-data">Pays: </span> <?= $user->getCountry() ?>
        </li>
        <li> 
            <span class="almost-bold user-data">Role:</span> <?php if($user->getRoles()[0] === 'ROLE_USER'): echo "Utilisateur"; else: echo "Admin"; endif;?> 
        </li>
        <li> 
            <span class="almost-bold user-data">Date de création de compte:</span> <?= $user->getRegisterDate()->format("d/m/Y à H:i:s") ?> 
        </li>

        <li>
            <span class="almost-bold user-data">Nombre total de messages:</span> <?= $user->getNb() ?>
        </li>
    </ul>
</section>

<section id="last-user-messages" class="py-3 px-3 mb-5 d-flex flex-column">
    <h4>Derniers messages</h4>
    <?php if(!empty($messages)): foreach ($messages as $message):?>

        <div id="message-container" class="d-flex justify-content-between">
            <a href="index.php?ctrl=forum&action=detailTopic&id=<?= $message->getTopic()->getId()?>"><?= $message->getContent() ?></a> <span class="text-end">Le <?= $message->getCreationDate();?></span> 
        </div>

        <?php endforeach; else:?>
        <span>Vous n'avez posté encore aucun message.</span>
    <?php endif;?>
</section>