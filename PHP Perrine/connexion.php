<?php
    include_once("C:/UwAmp/www/TestPPE01/include/header.php");
    include_once("C:/UwAmp/www/TestPPE01/data/Utilisateur.php");
    include_once("C:/UwAmp/www/TestPPE01/dataManagers/DatabaseLinker.php");
    include_once("C:/UwAmp/www/TestPPE01/dataManagers/UtilisateurManager.php");
    include_once("C:/UwAmp/www/TestPPE01/dataManagers/ConnexionManager.php");
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
                //Ne modifie pas "isConnected"
                $user = UtilisateurManager::findUser($_POST["pseudo"]);
                ConnexionManager::updateConnexionOnline($user);
                
                header('Location: index.php?deco=false&online=true');
                exit;
            }
            else
            {
                echo "Utilisateur ou mot de passe erroné, veuillez vous inscrire.";
                echo "<a href='index.php'> OK </a>";
            }
        }
    }
    
    
    
    include("C:/UwAmp/www/TestPPE01/include/footer.php");
?>

