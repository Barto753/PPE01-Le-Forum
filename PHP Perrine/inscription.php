<?php
    include_once("C:/UwAmp/www/PPE01-Le-Forum/PHP Perrine/include/header.php");
    include_once("C:/UwAmp/www/PPE01-Le-Forum/PHP Perrine/data/Utilisateur.php");
    include_once("C:/UwAmp/www/PPE01-Le-Forum/PHP Perrine/dataManagers/DatabaseLinker.php");
    include_once("C:/UwAmp/www/PPE01-Le-Forum/PHP Perrine/dataManagers/UtilisateurManager.php");
?>

<div class="inscription-box">
        
    <div class="inscription-box-titre"> Inscription </div>

    <form method="POST" action="inscription.php">
        <input type="text" name="pseudo" placeholder="Pseudo"/>
        <input type="text" name="email" placeholder="Email"/>
        <input type="password" name="password" placeholder="Mot de passe"/>
        <input type="radio" name="genre" value="femme"> Femme
        <input type="radio" name="genre" value="homme"> Homme
        <input type="submit" value="Valider"/>
    </form> 
       
</div>

<?php
    
    $tabErreurs=array();
    
    //on verfifie si tous les champs sont remplis
    if(!empty($_POST))
    {
        if(empty($_POST["pseudo"]))
        {
            $tabErreurs["pseudo"]= "Veuillez saisir un pseudo.";
        }
        
        if(empty($_POST["email"]))
        {
            $tabErreurs["email"]= "Veuillez saisir un email.";
        }
        
        if(empty($_POST["password"]))
        {
            $tabErreurs["password"]= "Veuillez saisir un mot de passe.";
        }
        
        if(empty($_POST["genre"]))
        {
            $tabErreurs["genre"]= "Veuillez sélectionner un genre.";
        }
        
        foreach($tabErreurs as $error)
        {
            echo $error;
        }
        
        //si tous les champs sont remplis, on insert les donnees dans la bdd
        if(empty($tabErreurs))
        {
            $user = new Utilisateur();

            $user->setPseudo($_POST["pseudo"]);
            $user->setEmail($_POST["email"]);
            $user->setPassword($_POST["password"]);
            if($_POST["genre"]=="homme")
            {
                $user->setCheminAvatar("single-man-circle.png");
            }
            else if($_POST["genre"]=="femme")
            {
                $user->setCheminAvatar("single-woman-circle.png");
            }
            $user->setIsAdmin(0);
            $user->setIsConnected(0);
            $user->setIsBanned(0);
            $user->setMotifBan("null");
            $user->setDateFinBan("2000-01-01");
            
            UtilisateurManager::insertUser($user);
            
            if(UtilisateurManager::findUser($_POST["pseudo"])!=null)
            {
                //echo "Inscription réussie";
                header('Location: index.php');
                exit;
            }
        }
    }
    
    include("include/footer.php")
?>
