<?php 
    include_once("include/header.php");
    
    include_once("dataManagers/data/Utilisateur.php");
    include_once("dataManagers/DatabaseLinker.php");
    include_once("dataManagers/UtilisateurManager.php");
    include_once("dataManagers/ConnexionManager.php");
    include_once("dataManagers/DiscussionManager.php");
    include_once("dataManagers/MessageManager.php");
    include_once("dataManagers/CategorieManager.php");

       //si la session n'est pas définie 
    //NON CONNECTE
    if(!isset($_SESSION["login"]))
    {
?>
        <div class="inscription-connexion-box">
            
            <div class="button">
                <a href="inscription.php">Inscription</a>
            </div>

            <div class="connexion-box">
                <form method="POST" action="index.php">
                    <label> Pseudo </label>
                    <input type="text" name="pseudo"/>
                    <label> Mot de passe </label>
                    <input type="password" name="password"/>
                    <input type="submit" value="Connexion"/>
                </form>
            </div>
            
        </div> 
<?php
    }
            

    date_default_timezone_set('Europe/Paris');
    $currentUser = new Utilisateur();
    
    if(isset($_SESSION["login"]))
    {
?>
        <div class="session-container">
<?php
            echo "Vous êtes connecté en tant que ".$_SESSION["login"];
            $currentUser = UtilisateurManager::findUser($_SESSION["login"]); //user connecté
?>
            <div class="deco-bouton"> <a href="index.php?deco=true">Déconnexion</a> </div> 
            
            <div class="account-icone">
                <a href="account.php">
                    <img class="session-settings-img" src="images-general/navigation-menu-horizontal-1.png"/>

                    <input type="hidden" name="idUser" value="<?php $currentUser->getIdUser();?>">
                </a>
                <div class="session-settings-text"> Compte </div>
            </div>
        </div>
<?php
    }
    
    //AFFICHAGE DISCUSSIONS
    $idCategorie = $_GET["idCateg"];
    $tabDiscussions = CategorieManager::getDiscussions($idCategorie);
    $categorie = CategorieManager::findCategorie($idCategorie);
    $user = new Utilisateur();
    
    foreach($tabDiscussions as $discussion)
    {
?>
        <div class="discussion-container">
<?php
        $user = UtilisateurManager::findUserWithId($discussion->getIdUser()); //user associé à la discussion
        $tabMessages = DiscussionManager::getMessages($discussion->getIdDiscussion());
        
        //AFFICHAGE BOUTON DELETE DISCUSSION
        if(isset($_SESSION["login"]))
        {
            if((($currentUser->getIdUser()==$user->getIdUser() && $discussion->getIsClosed()==0) || ($currentUser->getIsAdmin()==1))==true)
            {
?>        
            
                <form method="POST" action="deleteDiscu.php">
                    <input type="hidden" name="idDiscussion" value="<?php echo $discussion->getIdDiscussion(); ?>"/>
                    <div class="bouton-discussion"><button type="submit">Supprimer la discussion</button> </div>
                </form>
                
<?php
                if($currentUser->getIsAdmin()==1)
                {
                    if($discussion->getIsClosed()==0)
                    {
?>
                        <form method="POST" action="updateIsClosedDiscu.php">
                            <input type="hidden" name="idDiscussion" value="<?php echo $discussion->getIdDiscussion(); ?>"/>
                            <input type="hidden" name="isClosed" value="<?php echo $discussion->getIsClosed(); ?>"/>
                            <div class="bouton-discussion"> <button type="submit">Clore la discussion</button> </div>
                        </form>
<?php
                    }
                    else if($discussion->getIsClosed()==1)
                    {
?>
                        <form method="POST" action="updateIsClosedDiscu.php">
                            <input type="hidden" name="idDiscussion" value="<?php echo $discussion->getIdDiscussion(); ?>"/>
                            <input type="hidden" name="isClosed" value="<?php echo $discussion->getIsClosed(); ?>"/>
                            <button type="submit">Réouvrir la discussion</button>
                        </form>
<?php
                    }
                }
            }
        }
?>  
        <div class="discussion-titre"><?php echo $discussion->getTitreDiscussion(); ?></div>
        <div class="discussion-statut"><?php if($discussion->getIsClosed()==0){ echo "Statut : ouvert"; }else if($discussion->getIsClosed()==1){ echo "Statut : fermé";}?></div>
        <div class="discussion-date"><?php echo "Créé le ".$discussion->getDateDiscussion(); ?></div>
        <div class="discussion-user-texte">
            <div class="discussion-user">
                <img class="discussion-avatar" src="images/<?php echo $user->getCheminAvatar();?>"/>
                <div class="discussion-pseudo">
<?php 
                    if($currentUser->getIdUser()==$user->getIdUser())
                    { 
?>
                        <a href="account.php"><?php echo $currentUser->getPseudo(); ?></a>
<?php
                    }
                    else
                    {
                        echo $user->getPseudo(); 
                    }
?>
                </div>
            </div>
            <div class="discussion-texte"><?php echo $discussion->getTexteDiscussion(); ?></div>
        </div>
        
        <div class="message-nombre"><?php echo "Messages (".sizeof($tabMessages).")"; ?></div>
<?php 
        //AFFICHAGE BOX NEW MESSAGE
        if(isset($_SESSION["login"]))
        {
            if($discussion->getIsClosed()==0)
            {
?>
                <div class="new-message-container">
                    <div class="new-message-entete">Réagir à la discussion</div>
                    <div class="new-message-contenu-titre">Nouveau message :</div>
                    <form method="POST" action="insertMsg.php">

                        <div class="new-message-contenu">

                            <input type="text" name="texteMsg" placeholder="Contenu" required/>
                        </div>
                        <input type="hidden" name="idUser" value="<?php echo $currentUser->getIdUser(); ?>"/>
                        <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>"/>
                        <input type="hidden" name="nomCategorie" value="<?php echo $categorie->getNomCategorie(); ?>"/>
                        <input type="hidden" name="idDiscussion" value="<?php echo $discussion->getIdDiscussion(); ?>"/>
                        <div class="new-message-button">
                            <button type="submit">Poster</button>
                        </div>
                    </form>
                </div>
<?php
            }
        }
        
        //AFFICHAGE MESSAGES
        foreach($tabMessages as $message)
        {
            $user= UtilisateurManager::findUserWithId($message->getIdUser()); //user associé au message

            
            
            //AFFICHAGE MESSAGES
?>
            <div class="message-container">
                <div class="message-block-gauche">
                    <img class="message-avatar" src="images/<?php echo $user->getCheminAvatar();?>"/>
                    <div class="message-user"><?php echo $user->getPseudo(); ?></div>
                    <div class="message-date"><?php echo "posté le ".$message->getDateMessage(); ?></div>
                    
                </div>
                <div class="message-block-droite">
                    <div class="message-texte"><?php echo $message->getTexteMessage(); ?></div>
<?php
                        if(isset($_SESSION["login"]))
                        {
                            //AFFICHAGE BOUTON DELETE MESSAGE

                            if((($currentUser->getIdUser()==$user->getIdUser() && $discussion->getIsClosed()==0) || ($currentUser->getIsAdmin()==1))==true)
                            {
            ?>        

                                <form method="POST" action="deleteMsg.php">
                                    <input type="hidden" name="idDiscussion" value="<?php echo $message->getIdDiscussion(); ?>"/>
                                    <input type="hidden" name="idCategorie" value="<?php echo $idCategorie;?>"/>
                                    <input type="hidden" name="idMessage" value="<?php echo $message->getIdMessage() ;?>"/>
                                    <div class="message-bouton-delete"><button type="submit">Supprimer</button> </div>
                                </form>
            <?php
                            }


                            if($currentUser->getIdUser()==$user->getIdUser() && $discussion->getIsClosed()==0)
                            {
                                /*if(isset($_POST["texteMessage"])) //affichage de la date de la modofication du message marche pas
                                {
                                    echo time(date('Y/m/d H:i:s'));
                                }*/

                                //BOX MODIFIER MESSAGE
    ?>
                                <form method="POST" action="modifMsg.php">
                                    <input type="hidden" name="idDiscussion" value="<?php echo $message->getIdDiscussion(); ?>"/>
                                    <input type="hidden" name="idMessage" value="<?php echo $message->getIdMessage(); ?>"/>
                                    <div class="message-bouton-modif">
                                        <input type="text" name="texteMessage" placeholder="Modifier le message" required/>
                                        <button type="submit">Modifier</button> 
                                    </div>
                                </form>  
    <?php   
                            }
                        }
    ?>   
                    
                </div>
            </div>
<?php
        }
?>
        </div>
<?php
    }
    
    include("include/footer.php")
?>

