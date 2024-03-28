<?php
include 'php/pokemon_api.php';
session_start();

?>


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
    <title>Accueil Pokemon</title>
</head>
<body>
    <header class="fondheader">
        
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
        <?php
        
                function login($login, $collectorId) {
                    $collector = get_collector_by_id($collectorId);
                    
                    if ($collector != null) {
                        if ($collector["collector_name"] == $login) {
                            $_SESSION['collector_id'] = $collectorId;
                            echo '<p class="feedback_success">Bien joué ! Vous êtes connecté.</p>';
                            $tech = true;
                        }
                        else {
                            echo '<p class="ferror">Mauvais Nom ! Essayez à nouveau</p>';
                            $tech = false;
                        }
                    }
                    else {
                       echo '<p class="ferror">Mauvaise ID ! Essayez à nouveau</p>';
                       $tech = false;
                    }
                    return $tech;
                }
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']) && isset($_POST['collectorId'])) {
                    $is_login = login($_POST['login'], $_POST['collectorId']);
                 }
                 else {
                    $is_login = false;
                 }
               
                

                ?>
        

        <div class="bienvenue">
            <aside class="partiebienvenue">
                <h1>Bienvenue <?php  
                
                if ($is_login == true) {
                    $collectornom = get_collector_by_id($_POST['collectorId']);
                    echo '<h1>'.$collectornom["collector_name"].'</h1>';
                }
                else {
                    echo '<h2>Connectez vous</h2>';
                }
                ?></h1>
            </aside>

            <div class="login-container">
                <h2>Connexion</h2>
                <form method="post">
                    <label for="username">Nom d'utilisateur :</label>
                    <input type="text" id="login" name="login" required>
        
                    <label for="password">id</label>
                    <input type="text" id="collectorId" name="collectorId" required>
        
                    <button type="submit"><strong>Se connecter</strong></button>
                </form>
               
            
            </div>
        </div>
    </header>
    <hr>
    <main class="infoaccueil">
        <section class="info_pokemon">
            <article class="art_pokedex">
                <img src="assets/images/pokedex2.png" alt="pokedex" title="pokedex">
                <div class="texte">
                    <h2>Pokedex reserver pour vos pokémons</h2>
                    <p> Ici vous trouverez le pokedex qui vous permettra de rajouter, enlever et renommer vos pokémon. Ce site va devenir votre référence pour le stockage de pokemon.
                        Connectez-vous et appuyer sur le bouton pour commencer votre aventure pokémon !
                    </p>
                    <a href="vospokemon.php" class="start"><h2>Commencer dès maintenant -></h2></a>
                </div>
            </article>
            <section class="info_cote">
                <article class="art_jeu">
                    <img src="assets/images/share-tw.jpg" alt="jeu pokemon" title="jeu pokemon">
                        <h2>Découvre une nouvelle aventure sur pokémon Ecarlate et Violet</h2>
                </article>
                <a href="pokemondetail.php?id=200"><article class="art_nouv">
                    <img src="assets/images/full/200.png" alt="Feuforêve" title="Feuforêve">
                        <h2>Profiter du tout Nouvelle ajout à la collection pokémon : Feuforêt</h2>
                </article></a>
            </section>
        </section>
        <article class="pokemonpopu">
            <h2>Pokémon Populaire</h2>
            <div class="slider-container">
                <div class="nav-btn prev" id="btnPrev"> < </div>
                <div class="slider">
                    <ul class="liste">
                        <a href="pokemondetail.php?id=8"><li class="pokemon pokemon-inactif">
                            <img src="assets/images/full/8.png" alt="carabaffe" title="carabaffe">
                            <h3>Carabaffe</h3>
                        </li></a>

                        <a href="pokemondetail.php?id=9"><li class="pokemon pokemon-inactif">
                            <img src="assets/images/full/9.png" alt="tortank" title="tortank">
                            <h3>Tortank</h3>
                        </li></a>
                        
                        <a href="pokemondetail.php?id=1"><li class="pokemon pokemon-actif" id="pokemon1">
                            <img src="assets/images/full/1.png" alt="bulbizar" title="bulbizar">
                            <h3>Bulbizar</h3>
                        </li></a>

                        <a href="pokemondetail.php?id=2"><li class="pokemon pokemon-inactif" id="pokemon2">
                            <img src="assets/images/full/2.png" alt="Herbizarre" title="Herbizarre">
                            <h3>Herbizarre</h3>
                        </li></a>

                        <a href="pokemondetail.php?id=3"><li class="pokemon pokemon-inactif" id="pokemon3">
                            <img src="assets/images/full/3.png" alt="florizarre" title="florizarre">
                            <h3>Florizarre</h3>
                        </li></a>

                        <a href="pokemondetail.php?id=4"><li class="pokemon pokemon-inactif" id="pokemon4">
                            <img src="assets/images/full/4.png" alt="salameche" title="salameche">
                            <h3>Salameche</h3>
                        </li></a>
                        <a href="pokemondetail.php?id=5"><li class="pokemon pokemon-inactif" id="pokemon5">
                            <img src="assets/images/full/5.png" alt="reptincel" title="reptincel">
                            <h3>Reptincel</h3>
                        </li></a>

                        <a href="pokemondetail.php?id=6"><li class="pokemon pokemon-inactif" id="pokemon6">
                            <img src="assets/images/full/6.png" alt="dracaufeu" title="dracaufeu">
                            <h3>Dracaufeu</h3>
                        </li></a>

                        <a href="pokemondetail.php?id=7"><li class="pokemon pokemon-inactif" id="pokemon7">
                            <img src="assets/images/full/7.png" alt="carapuce" title="carapuce">
                            <h3>Carapuce</h3>
                        </li></a>
                        <a href="pokemondetail.php?id=8"><li class="pokemon pokemon-inactif" id="pokemon8">
                            <img src="assets/images/full/8.png" alt="carabaffe" title="carabaffe">
                            <h3>Carabaffe</h3>
                        </li></a>
                        <a href="pokemondetail.php?id=9"><li class="pokemon pokemon-inactif" id="pokemon9">
                            <img src="assets/images/full/9.png" alt="tortank" title="tortank">
                            <h3>Tortank</h3>
                        </li></a>
                        <a href="pokemondetail.php?id=1"><li class="pokemon pokemon-inactif">
                            <img src="assets/images/full/1.png" alt="bulbizar" title="bulbizar">
                            <h3>Bulbizar</h3>
                        </li></a>
                        <a href="pokemondetail.php?id=2"><li class="pokemon pokemon-inactif">
                            <img src="assets/images/full/2.png" alt="Herbizarre" title="Herbizarre">
                            <h3>Herbizarre</h3>
                        </li></a>
                    </ul>
                </div>
                <div class="nav-btn next" id="btnNext"> > </div>
            </div>
        </article>
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
<script>
    var currentPokemon = 1;
    var prev = function(){
        var slider = document.querySelector('.slider');
        document.getElementById('pokemon'+currentPokemon).classList.remove('pokemon-actif');
        document.getElementById('pokemon'+currentPokemon).classList.add('pokemon-inactif');
        currentPokemon--;
        if(currentPokemon >= 1) {
            slider.style.left = slider.offsetLeft + 200 + 'px';
        } else {
            currentPokemon = 9;
            slider.style.left = -1600 + 'px';
        }
        document.getElementById('pokemon'+currentPokemon).classList.add('pokemon-actif');
        document.getElementById('pokemon'+currentPokemon).classList.remove('pokemon-inactif');
        console.log(currentPokemon,slider.offsetLeft);
    }
    var next = function(){
        var slider = document.querySelector('.slider');
        document.getElementById('pokemon'+currentPokemon).classList.remove('pokemon-actif');
        document.getElementById('pokemon'+currentPokemon).classList.add('pokemon-inactif');
        currentPokemon++;
        if(currentPokemon <= 9) {
            slider.style.left = slider.offsetLeft - 200 + 'px';
        } else {
            currentPokemon = 1;
            slider.style.left = 0;
        }
        document.getElementById('pokemon'+currentPokemon).classList.add('pokemon-actif');
        document.getElementById('pokemon'+currentPokemon).classList.remove('pokemon-inactif');
        console.log(currentPokemon,slider.offsetLeft);
    }
    document.getElementById('btnPrev').addEventListener('click', prev);
    document.getElementById('btnNext').addEventListener('click', next);
</script>

</html>


