<?php
    $topic = $result['data']['topic'];
    $messages = $result['data']['messages'];
    $session = $result['data']['session'];

    $title = $topic->getTitle();
    $h1 = "Sujet : ". $topic->getTitle(); 

    echo $session->getFlash('success-new-topic');
    echo $session->getFlash('error-topic-message');
    echo $session->getFlash('success-topic-message');
?>

<section id="detail-topic" class="pb-5 pt-3 px-3">
    <?php if (!empty($messages)): foreach ($messages as $message): ?>

    <article id="detail-message" class="p-3 mb-5">
        <small id="autor-container" class="d-flex flex-column pb-3">
            <div class="d-flex align-items-center">
                <img src="<?= $message->getUser()->getPicture(); ?>" alt="photo de profil" class="me-3">
                <p class="mb-0"> 
                    Auteur : <a href="index.php?ctrl=user&action=detailUser&id=<?= $message->getUser()->getId()?>"><?= $message->getUser()->getNickname(); ?></a>
                    <br>
                    Le <?= $message->getCreationdate();?>
                </p>
            </div>
            
        </small>
        <div class="message-content mt-3">
            <span class="bold">Message:</span> 
            <p> <?= $message->getContent(); ?> </p>
        </div>
    </article>
    <?php endforeach; endif;?>

    <?php if ($session->getUser()): ?>
        <span class="answer mb-3 d-block almost-bold">Répondre</span>
        <form action="index.php?ctrl=forum&action=addMessage&id=<?= $topic->getId() ?>" method="post">
            <textarea name="message" id="message" class="w-100 form-control mb-3" cols="30" rows="5" placeholder="Insérez votre message ici"></textarea>
            <input type="submit" class="btn btn-warning" value="Poster">
        </form>

    <?php else:?>
        <span class="answer mb-3 d-block almost-bold">Répondre</span>
        <form action="index.php?ctrl=forum&action=addMessage&id=<?= $topic->getId() ?>" method="post">
            <textarea name="message" id="message" class="w-100 disable form-control mb-3" cols="30" rows="5" placeholder="Insérez votre message ici" disabled></textarea>

            <div class="info-msg">
                Merci de vous <a href="index.php?ctrl=security&action=login">connecter</a> pour répondre au sujet.
            </div>
        </form>
    <?php endif;?>

    <a class="btn btn-dark mt-5 d-block m-auto btn-return" href="index.php?ctrl=forum&action=listTopics&id=<?=$topic->getCategory()->getId() ?>">Revenir à la liste des sujets de la catégorie <?= $topic->getCategory()->getTitle() ?></a>
</section>