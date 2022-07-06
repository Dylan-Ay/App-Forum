<?php
    $topics = $result['data']['topics'];
    $category = $result['data']['category'];
    $messages = $result['data']['messages'];
    $session = $result['data']['session'];
    $message = $result['data']['message'];
    
    $title = "Liste des sujets de la catégorie ". $category->getTitle();
    $h1 = $category->getTitle();

    echo $session->getFlash('error-new-topic');
?>

<section id="detail-topic" class="pb-5 pt-3 px-3">
    <table class="table mb-5">
        <thead>
            <tr>
            <th scope="col">Sujet</th>
            <th scope="col">Auteur</th>
            <th scope="col">Nombre de messages</th>
            <th scope="col">Date de création</th>
            <th scope="col">Dernier Message</th>
            </tr>
        </thead>
        <?php if (!empty($topics)): foreach($topics as $topic): ?>
            <tbody>
                <tr>
                    <td> 
                        <a href="index.php?ctrl=forum&action=detailTopic&id=<?= $topic->getId();?>"> <?= $topic->getTitle(); ?> </a>
                    </td>

                    <td> 
                        <a href="index.php?ctrl=user&action=detailUser&id=<?= $topic->getUser()->getId() ?>"> 
                        
                        <?= $topic->getUser()->getNickname();?>
                        </a>
                       
                    </td>

                    <td>
                        <?= $topic->getNb(); ?>
                    </td>

                    <td> 
                        <?= $topic->getCreationDate(); ?>
                    </td>
                    <td> 
                        "<?=$message->getLastMessageByTopic($topic->getId())?>" par
                        
                        <a href="index.php?ctrl=user&action=detailUser&id=<?= $message->getLastMessageByTopic($topic->getId())->getUser()->getId() ?>">

                            <?= $message->getLastMessageByTopic($topic->getId())->getUser()->getNickname() ?>
                        </a>                        
                        
                    </td>
                </tr>
            </tbody>
        <?php endforeach; endif;?>
    </table>
    <?php if ($session->getUser()): ?>
        <span class="answer mb-3 d-block almost-bold">Nouveau Sujet</span>

        <form action="index.php?ctrl=forum&action=addTopic&id=<?= $category->getId() ?>" method="post">
            <input type="text" name="title" id="title" placeholder="Saisir le titre du sujet" class="mb-3 form-control">
            <textarea name="message" id="message" cols="30" rows="7" class="w-100 form-control mb-3" placeholder="Insérez votre message ici"></textarea>
            <input type="submit" class="btn btn-warning" value="Créer">
        </form>
    <?php else:?>
        <span class="answer mb-3 d-block almost-bold">Nouveau Sujet</span>
        
        <form action="index.php?ctrl=forum&action=addTopic" method="post">
            <input type="text" name="title" id="title" placeholder="Saisir le titre du sujet" class="mb-3 form-control disable" disabled>
            <textarea name="message" id="message" cols="30" rows="7" class="w-100 form-control mb-3 disable" placeholder="Insérez votre message ici" disabled></textarea>

            <div class="info-msg">
                Merci de vous <a href="index.php?ctrl=security&action=login">connecter</a> pour créer un nouveau sujet.
            </div>
        </form>
    <?php ;endif;?>
</section>

