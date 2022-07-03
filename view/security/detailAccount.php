<?php

$user = $result['data']['user'];
$session = $result['data']['session'];

$title = "Profil de ". $user->getNickname();

if ($session->getUser()){
    $h1 = "Bienvenue sur votre compte ". $user->getNickname();
}else{
    header('Location: index.php?ctrl=security&action=login');
};

// var_dump($user);

