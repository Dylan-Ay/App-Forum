<?php

$categories = $result["data"]['categories'];
$session = $result['data']['session'];
$title = "Liste des Catégories";
?>

<h1>Liste des Catégories</h1>

<?php 


foreach($categories as $category): ?>
    <p> 
        <a href="index.php?ctrl=forum&action=listTopics&id=<?= $category->getId()?>"><?=$category->getTitle()?></a>

        
            <!-- <a href="index.php?ctrl=security&action=deleteTopic&id=<?= $category->getId()?>">Supprimer cette catégorie</a> -->
        
            
    </p>
<?php endforeach;

