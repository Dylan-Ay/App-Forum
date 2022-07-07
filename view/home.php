<?php 
    $session = $result['data']['session'];
    $topics = $result['data']['topics'];
    $h1 = "Bienvenue sur le Forum";
    $title = "Accueil - Forum";
?>

<div id="last-topics">
    <h4 class="mb-3">Derniers sujets crées:</h4>
    <ul class="list-unstyled">
        <?php foreach ($topics as $topic): ?>
            <li>
                <a href="index.php?ctrl=forum&action=detailTopic&id=<?= $topic->getId()?>">
                    <?= $topic->getTitle() ?>
                </a>
                dans <?= $topic->getCategory()->getTitle() ?>
            </li>
        <?php endforeach;?>
    </ul>
</div>