<?php
    session_name("PPE01");
    session_start();
    
    include_once("include/header.php");
    include_once("data/Utilisateur.php");
    include_once("dataManagers/DatabaseLinker.php");
    include_once("dataManagers/UtilisateurManager.php");
    include_once("dataManagers/ConnexionManager.php");
    
    
    
    if(!empty($_POST["pseudo"]) && !empty($_POST["password"]))
    {
        if((ConnexionManager::testConnexionUser($_POST["pseudo"]))==true)
        {
            $_SESSION["login"]=$_POST["pseudo"];
            
            ?>
                <a href="index.php?deco=true"> Deconnexion </a>
            <?php
        }
    }
    else
    {
        echo "<a href='connexion.php'> Connexion </a>";
        echo "<a href='inscription.php'> Inscription </a>";
    }

    
    
    
    if(!empty($_GET["deco"]) && $_GET["deco"] == true)
    {
        /*$user = UtilisateurManager::findUser($_POST["pseudo"]);
        ConnexionManager::updateConnexionOnline($user->getPseudo());*/
        
        session_unset();
        session_destroy();
    }
    
    

     include("include/footer.php")
?>

