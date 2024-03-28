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
    <title>Collection</title>
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
                <h2>Collection de pokemon</h2>
                <p>
                    Ici vous pouvez consulter les pokemon disponible et les ajouter dans votre liste de pokemon
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
                    include 'php/pokemon_api.php';
                    $pokemonData =  list_all_pokemon();
                    foreach($pokemonData as $pokemonId => $pok){
                        echo '<a href="pokemondetail.php?id='.$pokemonId.'">';
                        echo '<li class="collecpokemon">';
                        echo '<form method="post" action="vospokemon.php">';
                        echo '<input type="hidden" name="action" value="add">';
                        echo '<input type="hidden" name="pokemon_id" value="' . $pokemonId . '">';
                        echo '<img src="assets/images/full/'.$pokemonId.'.png" alt="'.$pokemonId.'" title="'.$pokemonId.'">';
                        echo '<div class="desc">';
                        echo "<h2>" . ucfirst($pok['identifier']) . "</h2>";
                        echo '<div class="type">';
                        foreach($pok['types'] as $type){
                            echo '<img src="assets/images/types/'.$type.'.png" alt="'.$type.'" title="'.$type.'">';
                        }
                        echo '</div>';
                        echo '<div class="plusoumoins">';
                        echo '<button type="submit" class="ajouter" name="add_pokemon">';
                        echo '<img class="ajouter" src="assets/images/ajouter.svg" alt="ajouter" title="ajouter">';
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
                <p>Site réaliser dans le cadre de la SAE 105</p>
                <p>Copyright 2023. Tous droits réservés</p>
            </div>
    </footer>
</body>
</html>