<?php

$categories = $result["data"]['categories'];
$session = $result['data']['session'];
$title = "Liste des Catégories";
?>

<h1>Liste des Catégories</h1>

<section id="categories-list">
    <div class="row list-section justify-content-center justify-content-lg-start pt-3 pb-5">
        <?php foreach($categories as $category): ?>

            <div class="col-sm-5 col-lg-3 mb-4 mb-sm-0 img-container align-items-center postion-relative">
                <figure>
                    <a href="index.php?ctrl=forum&action=listTopics&id=<?=$category->getId()?>">   
                        <img class="img-fluid" src="public/images/categories/sport.jpg" alt="Image catégorie <?= $category->getTitle() ?>">
                        <figcaption> 
                            <h5> <?= $category->getTitle()?> </h5>
                        </figcaption>
                    </a>
                </figure>
            </div>

        <?php endforeach;?>
    </div>
</section>
