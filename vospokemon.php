<?php
include 'php/pokemon_api.php';
session_start();
$collectorId = get_current_id();
$pokemonCollector =  list_all_pokemon_from_collector($collectorId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;900&display=swap" rel="stylesheet">  
    <title>Vos Pokemon</title>
</head>
<body>
    <header>
            
        <nav class="menu">
            <a href="index.php"><img src="assets/images/logo.png" alt="logo"></a>
            <ul>
                <a href="collection.php"><li>Collections</li></a>
                <a href="vospokemon.php"><li>Vos Pokémon</li></a>
                <?php $chef = rand(1,200);
                echo '<a href="pokemondetail.php?id='.$chef.'">';
                echo '<li>Découvrir un Pokémon</li>';
                echo '</a>';
                ?>
            </ul>
            <img src="assets/images/profile.png" alt="photo de profile" title="photo de profile">
        </nav>
    </header>
    <main class="collection">
        <section class="topnav">
            <div class="textecolpoke">
                <h2>Votre collection de pokémon</h2>
                <p>
                    Actuellement vous avez <span class="nbpokemon"><?php  echo count($pokemonCollector);?></span> pokémon dans votre liste.
                </p>
            </div>
            <nav class="recherche">
                <p>Rechercher ...</p>
                <div class="fondloupe">
                    <img src="assets/images/loupe.svg" alt="loupe" title="loupe">
                </div>
            </nav>
        </section>
        <ul class="listecollection">
        <?php

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $pokemonId = $_POST['pokemon_id'];
                $association_id= $_POST['association_id'];
                if (isset($_POST['add_pokemon'])) {
                    add_pokemon_to_collector($collectorId, $pokemonId);
                } elseif(isset($_POST['remove_pokemon'])){
                    delete_pokemon_from_collector($association_id);
                }
            

                header('Location: vospokemon.php');
                exit();
            }

foreach($pokemonCollector as $pok){
    $pokemon = get_pokemon_by_id($pok["pokemon_id"]);
    echo '<a href="pokemondetail.php?id='.$pok["pokemon_id"].'&association_id='.$pok["association_id"].'&name='.$pok["pokemon_nickname"].'">';
    echo '<li class="collecpokemon">';
    echo '<form method="post" action="vospokemon.php">';
    echo '<input type="hidden" name="action" value="add">';
    echo '<input type="hidden" name="pokemon_id" value="' .$pok["pokemon_id"]. '">';
    echo '<input type="hidden" name="association_id" value="' .$pok["association_id"]. '">';
    echo '<img src="assets/images/full/'.$pok["pokemon_id"].'.png" alt="'.$pok["pokemon_id"].'" title="'.$pok["pokemon_id"].'">';
    echo '<div class="desc">';
    if (empty($pok["pokemon_nickname"])){
        echo "<h2>" . ucfirst($pokemon['identifier']) . "</h2>";  
    }
    else {
        echo "<h2>" . $pok['pokemon_nickname'] . "</h2>";
    }
    echo '<div class="type">';
        foreach($pokemon['types'] as $type){
        echo '<img src="assets/images/types/'.$type.'.png" alt="'.$type.'" title="'.$type.'">';
        }
    echo '</div>';
    echo '<div class="plusoumoins">';
    echo '<button type="submit" class="ajouter" name="add_pokemon">';
    echo '<img class="ajouter" src="assets/images/ajouter.svg" alt="ajouter" title="ajouter">';
    echo '</button>';
    echo '<button type="submit" class="moins" name="remove_pokemon">';
    echo '<img class="moins" src="assets/images/moins.svg" alt="moins" title="moins">';
    echo '</button>';
    echo '</div>';
    echo '</div>';
    echo '</form>';
    echo '</li>';
    echo'</a>';


}
?>
        </ul>

    </main>
    <footer>
        <img src="assets/images/logo.png" alt="logo" title="logo">
        <div class="v-line"></div>        
            <ul>
                <a href="collection.php"><li>Collection</li></a>
                <a href="vospokemon.php"><li>Vos Pokemon</li></a>
                <a href="pokemondetail.php"><li>Découvrir un pokemon</li></a>
            </ul>
            <div class="v-line"></div>   
            <div class="dedi">
                <p>Petite dédicace à  : - Jonas (le détoureur d'images)</p>
                <p>- Lefacher (le rajouteur de type)</p>
                <p>Site réaliser dans le cadre de la SAE 105</p>
                <p>Copyright 2023. Tous droits réservés</p>
            </div>
    </footer>
</body>
</html>