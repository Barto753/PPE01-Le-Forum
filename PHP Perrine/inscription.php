<?php
    include_once("include/header.php");
    include_once("dataManagers/data/Utilisateur.php");
    include_once("dataManagers/UtilisateurManager.php");
?>

<div class="inscription-box">
        
    <div class="inscription-box-titre"> Inscription </div>

    <form method="POST" action="inscription.php">
        <input type="text" name="pseudo" placeholder="Pseudo" required/>
        <input type="text" name="email" placeholder="Email" required/>
        <input type="password" name="password" placeholder="Mot de passe" required/>
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
            $tabUsers = UtilisateurManager::findAllUsers();
            
            $newUser = new Utilisateur();

            $newUser->setPseudo($_POST["pseudo"]);
            $newUser->setEmail($_POST["email"]);
            $newUser->setPassword($_POST["password"]);
            
            $inscriptionOk = 1;
            
            foreach($tabUsers as $user)
            {
                if($user->getPseudo()==$newUser->getPseudo())
                {
                    $inscriptionOk = 0;
                    echo "Pseudo déjà utilisé";
                }
                
                if($user->getEmail()==$newUser->getEmail())
                {
                    $inscriptionOk = 0;
                    echo "Email déjà utilisé";
                }
            }
            
            if($inscriptionOk == 1)
            {
                if($_POST["genre"]=="homme")
                {
                    $newUser->setCheminAvatar("single-man-circle.png");
                }
                else if($_POST["genre"]=="femme")
                {
                    $newUser->setCheminAvatar("single-woman-circle.png");
                }
                
                $newUser->setIsAdmin(0);
                $newUser->setIsConnected(0);
                $newUser->setIsBanned(0);
                $newUser->setMotifBan("null");
                $newUser->setDateFinBan("2000-01-01");

                UtilisateurManager::insertUser($newUser);

                if(UtilisateurManager::findUser($_POST["pseudo"])!=null)
                {
                    //echo "Inscription réussie";
                    header('Location: index.php');
                    exit;
                }
            } 
        }
    }
    
    include("include/footer.php")
?>
