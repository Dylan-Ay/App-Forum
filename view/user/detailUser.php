<?php 

$user = $result['data']['user'];
$title = "Profil de ". $user->getNickname();

?>

<section class="pb-5 pt-3 px-3">

    <div class="title-user d-flex align-items-center mb-5">
        <img src="<?= $user->getPicture();?>" alt="Photo de profil de l'utilisateur <?= $user->getNickname();?> ">
        <h1 class="ps-4">Profil de <?= $user->getNickname(); ?></h1>
    </div>
    
    <div class="infos-user">
        <h4 class="pb-2">Infos</h4>
        <ul>
            <li>
                <span class="almost-bold">Age :</span>
                <span class="info-value"> <?= $user->getAge(); ?> </span> 
            </li>
            <li>
                <span class="almost-bold">Genre :</span> 
                <span class="info-value"> <?= $user->getGender(); ?> </span> 
            </li>

            <li>
                <span class="almost-bold">Pays :</span>
                <span class="info-value"> <?= $user->getCountry(); ?> </span>
            </li>

            <li>
                <span class="almost-bold">Membre depuis :</span>
                <span class="info-value"> <?= $user->getRegisterDateFull(); ?> </span>
            </li>

            <li>
                <span class="almost-bold">Nombres total de messages :</span> 
                <span class="info-value"> <?= $user->getNb(); ?> </span>
            </li>
        </ul>
    </div>

</section>