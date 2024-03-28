

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;900&display=swap" rel="stylesheet">  
    <title>Pokemon detail</title>
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

    
    <?php

    include 'php/pokemon_api.php';
    session_start();
    if (isset($_GET['association_id'])) {
        $associationIdp = $_GET['association_id'];
    }
    $pokemonId= $_GET['id'];
    
    $pok = get_pokemon_by_id($pokemonId);
    $collectorId = get_current_id();
    $pokemonAssociations = list_all_pokemon_from_collector($collectorId);

    $PokemonCount = 0;
    $encounteredPokemonIds = [];

    foreach ($pokemonAssociations as $association) {
        $currentPokemonId = $association['pokemon_id'];
        $currentCollectorId = $association['collector_id'];
        $associationId = $association['association_id'];

        if ($currentPokemonId == $pokemonId && $currentCollectorId == $collectorId && !in_array($associationId, $encounteredPokemonIds)) { 
            $PokemonCount++;
            $encounteredPokemonIds[] = $associationId;
        }
    }

    ?>
    <main class="pokedetailmain">
        
    <article class="pokemondetail">
            <div class="titredetail">
             <?php  
             if(isset($_POST["new_nickname"])){
                $name = $_POST["new_nickname"];
             }
             elseif (isset($_GET["name"])) {
                $name = $_GET["name"];
             }
             else {
                $name = "";
             }

            if (empty($name)){
                echo "<h1>".ucfirst($pok['identifier'])."</h1>";
            }
            else {
                echo "<h1>".$name."</h1>";
            }
            ?>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'change_nickname') {
    
    $new_nickname = $_POST['new_nickname'];

    change_pokemon_nickname($associationIdp, $new_nickname);

}
?>
<?php if (isset($_GET["association_id"])) {
echo '<form method="post">
    <input type="hidden" name="action" value="change_nickname">
    <input type="hidden" name="association_id" value="'.$associationIdp.'">

    <label for="new_nickname">Nouveau surnom :</label>
    <input type="text" name="new_nickname" id="new_nickname" required>

    <button type="submit">Renommer</button>
</form>';
}
?>
                <h1>N°<?php echo $pokemonId; ?></h1>
            </div>
            <div class="fondpokemon">
                <?php  
                        echo '<li><img class="relatif" src="assets/images/fond_pokemon/'.$pok['types'][0].'.png" alt="'.$pok['types'][0].'" title="'.$pok['types'][0].'"></li>';
                        echo '<img src="assets/images/full/'.$pokemonId.'.png" alt="'.$pokemonId.'" title="'.$pokemonId.'">';
                ?>
            </div>
            <ul class="descdetail">
                <li><h3>Taille</h3></li>
                <li><?php echo $pok['height']; ?> cm</li>
                <div class="vlinedetail"></div> 
                <li><h3>Poids</h3></li>
                <li><?php echo $pok['weight']; ?> kg</li>
                <div class="vlinedetail"></div> 
                <li><h3>Base expérience</h3></li>
                <li><?php echo $pok['base_experience']; ?></li>
                <div class="vlinedetail"></div> 
                <li><h3>Type</h3></li>
                <?php
                foreach($pok['types'] as $type){
                    echo '<li><img src="assets/images/types/'.$type.'.png" alt="'.$type.'" title="'.$type.'"></li>';
                }
                ?>
            </ul>
        </article>
            <aside class="ajouterpokeplus">
                <form method="post" action="vospokemon.php">
                    <input type="hidden" name="pokemon_id" value="<?php echo $pokemonId; ?>">
                    <input type="hidden" name="action" value="remove">
                    
                    <button type="submit" class="ajouter" name="add_pokemon">
                        <img class="ajouter" src="assets/images/ajouter.svg" alt="ajouter" title="ajouter">
                    </button>

                    <span class="nbpokemon"><?php echo $PokemonCount;?></span>

                    
                    <?php 
                    if (isset($_GET["association_id"])) {
                        echo '<input type="hidden" name="association_id" value="'.$associationIdp.'">';
                        echo '<button type="submit" class="moins" name="remove_pokemon">
                        <img class="moins" src="assets/images/moins.svg" alt="moins" title="moins">
                    </button>';
                    }
                    
                    ?>
                </form>
            </aside>




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
                <p>Petite dédicace à  : Jonas (le détoureur d'images)</p>
                <p>Site réaliser dans le cadre de la SAE 105</p>
                <p>Copyright 2023. Tous droits réservés</p>
            </div>
    </footer>
</body>
</html>