<?php

$categories = $result["data"]['categories'];
$session = $result['data']['session'];
$h1 = "Liste des Catégories";
$title = "Liste des Catégories";
?>

<section id="categories-list">
    <div class="row list-section justify-content-center justify-content-lg-start pt-3 pb-5">
        <?php foreach($categories as $category): ?>

            <div class="col-sm-5 col-lg-3 mb-4 mb-sm-0 img-container align-items-center postion-relative">
                <figure>
                    <a href="index.php?ctrl=forum&action=listTopics&id=<?=$category->getId()?>">   
                        <img class="img-fluid" src="<?= $category->getImg(); ?>" alt="Image catégorie <?= $category->getTitle() ?>">
                        <figcaption> 
                            <h5> <?= $category->getTitle()?> </h5>
                        </figcaption>
                    </a>
                </figure>
            </div>

        <?php endforeach;?>
    </div>
</section>
