<?php
    session_name("PPE01");
    session_start();
    
    include_once("include/header.php");
    include_once("data/Utilisateur.php");
    include_once("dataManagers/DatabaseLinker.php");
    include_once("dataManagers/UtilisateurManager.php");
    include_once("dataManagers/ConnexionManager.php");
    
    
    if(empty($_POST["pseudo"]) && empty($_POST["password"]))
    {
        echo "<a href='inscription.php'> Inscription </a>";
        
        ?>

            <div class="connexion-box">

                <h1> Connexion </h1>

                <form method="POST" action="index.php">

                    <label> Pseudo </label>
                    <input type="text" id="idPseudo" name="pseudo"/>
                    <label> Mot de passe </label>
                    <input type="password" id="idPassword" name="password"/>
                    <input type="submit" value="Connexion"/>

                </form>

            </div>

        <?php
    
        
    }
    
    $tabErreurs=array();
    
    if(!empty($_POST))
    {
        if(empty($_POST["pseudo"]))
        {
            $tabErreurs["pseudo"]= "Veuillez saisir un pseudo.";
        }

        if(empty($_POST["password"]))
        {
            $tabErreurs["password"]= "Veuillez saisir un mot de passe.";
        }

        foreach($tabErreurs as $error)
        {
            echo $error;
        }

        if(empty($tabErreurs))
        {
            if((ConnexionManager::testConnexionUser($_POST["pseudo"]))==true)
            {
                $user = UtilisateurManager::findUser($_POST["pseudo"]);
                $user->setIsConnected(1);
                UtilisateurManager::updateConnexion($user);

                $_SESSION["login"]=$_POST["pseudo"];

                echo '<a href="index.php?online=0"> Deconnexion </a>';
            
                if(!empty($_GET["online"]) && $_GET["online"]==0)
                {
                    $user->setIsConnected(0);
                    UtilisateurManager::updateConnexion($user);
                    //echo $user->getIsConnected();

                    session_unset();
                    session_destroy();
                }
            }
            else
            {
                echo "Utilisateur ou mot de passe erroné, veuillez vous inscrire.";
                echo "<a href='inscription.php'> OK </a>";
            }
        }
    }
    
    
    
    

     include("include/footer.php")
?>

