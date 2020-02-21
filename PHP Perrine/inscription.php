<?php
    
    include_once("C:/UwAmp/www/TestPPE01/include/header.php");
    include_once("C:/UwAmp/www/TestPPE01/data/Utilisateur.php");
    include_once("C:/UwAmp/www/TestPPE01/dataManagers/DatabaseLinker.php");
    include_once("C:/UwAmp/www/TestPPE01/dataManagers/UtilisateurManager.php");
?>

<div class="inscription-box">
        
    <h1> Inscription </h1>

    <form method="POST" action="inscription.php">

        <label> Pseudo </label>
        <input type="text" id="idPseudo1" name="pseudo1"/>
        <label> E-mail </label>
        <input type="text" id="idEmail1" name="email1"/>
        <label> Mot de passe </label>
        <input type="password" id="idPassword1" name="password1"/>
        <input type="submit" value="Valider"/>

    </form> 
       
</div>

<?php
    
    $tabErreurs=array();
    
    //on verfifie si tous les champs sont remplis
    if(!empty($_POST))
    {
        if(empty($_POST["pseudo1"]))
        {
            $tabErreurs["pseudo1"]= "Veuillez saisir un pseudo.";
        }
        
        if(empty($_POST["email1"]))
        {
            $tabErreurs["email1"]= "Veuillez saisir un email.";
        }
        
        if(empty($_POST["password1"]))
        {
            $tabErreurs["password1"]= "Veuillez saisir un mot de passe.";
        }
        
        foreach($tabErreurs as $error)
        {
            echo $error;
        }
        
        //si tous les champs sont remplis, on insert les donnees dans la bdd
        if(empty($tabErreurs))
        {
            $user = new Utilisateur();

            $user->setPseudo($_POST["pseudo1"]);
            $user->setEmail($_POST["email1"]);
            $user->setPassword($_POST["password1"]);
            $user->setCheminAvatar("null");
            $user->setIsAdmin(0);
            $user->setIsConnected(0);
            
            UtilisateurManager::insertUser($user);
            
            if(UtilisateurManager::findUser($_POST["pseudo1"])!=null)
            {
                echo "Inscription réussie";
                header('Location: index.php');
                exit;
            }
        }
    }
    
    
    include("C:/UwAmp/www/TestPPE01/include/footer.php")
?>
