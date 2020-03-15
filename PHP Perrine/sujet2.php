<?php 
    session_start();
    include_once("include/header.php");
    
    include_once("data/Utilisateur.php");
    include_once("dataManagers/DatabaseLinker.php");
    include_once("dataManagers/UtilisateurManager.php");
    include_once("dataManagers/ConnexionManager.php");
    include_once("dataManagers/DiscussionManager.php");
    include_once("dataManagers/MessageManager.php");
    include_once("dataManagers/CategorieManager.php");
?>
    
            
 <?php
    date_default_timezone_set('Europe/Paris');
    $currentUser = new Utilisateur();
    
    if(isset($_SESSION["login"]))
    {
        echo "Vous êtes connecté en tant que ".$_SESSION["login"];
        $currentUser = UtilisateurManager::findUser($_SESSION["login"]); //user connecté
?>
        <a href="index.php?deco=true">Déconnexion</a>
<?php
    }
    
    //AFFICHAGE DISCUSSIONS
    $idCategorie = 2;
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
                    <button type="submit">Supprimer</button> 
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
                            <button type="submit">Clore la discussion</button>
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
        <?php if($discussion->getIsClosed()==0){ echo "Statut : ouvert"; }else if($discussion->getIsClosed()==1){ echo "Statut : fermé";}?>
        <div class="discussion-date"><?php echo "Créé le ".$discussion->getDateDiscussion(); ?></div>
        <div class="discussion-texte"><?php echo "Texte: ".$discussion->getTexteDiscussion(); ?></div>
        <div class="discussion-user"><?php echo "Par ".$user->getPseudo(); ?></div>
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
                <form method="POST" action="insertMsg.php">
                    <div class="new-message-contenu">
                        <input type="text" name="texteMsg" placeholder="Contenu"/> <?php //texteMsg => texteMessage ? ?>
                    </div>
                        <input type="hidden" name="idUser" value="<?php echo $currentUser->getIdUser(); ?>"/>
                        <input type="hidden" name="nomCategorie" value="<?php echo $categorie->getNomCategorie(); ?>"/>
                        <input type="hidden" name="idDiscussion" value="<?php echo $discussion->getIdDiscussion(); ?>"/>
                    <div class="new-discussion-button">
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

            //AFFICHAGE BOUTON DELETE MESSAGE
            if(isset($_SESSION["login"]))
            {
                if((($currentUser->getIdUser()==$user->getIdUser() && $discussion->getIsClosed()==0) || ($currentUser->getIsAdmin()==1))==true)
                {
?>        
                    <form method="POST" action="deleteMsg.php">
                        <input type="hidden" name="idDiscussion" value="<?php echo $message->getIdDiscussion(); ?>"/>
                        <input type="hidden" name="idMessage" value="<?php echo $message->getIdMessage() ;?>"/>
                        <button type="submit">Supprimer</button> 
                    </form>
        
                    
<?php
                }
            }
?>
            <div class="message-container">
                <div class="message-user"><?php echo "de ".$user->getPseudo(); ?></div>
                <div class="message-date"><?php echo "posté le ".$message->getDateMessage(); ?></div>
                <div class="message-texte"><?php echo $message->getTexteMessage(); 
                    if(isset($_SESSION["login"]))
                    {
                        if($currentUser->getIdUser()==$user->getIdUser() && $discussion->getIsClosed()==0)
                        {
                            /*if(isset($_POST["texteMessage"])) //affichage de la date de la modofication du message marche pas
                            {
                                echo "modifié le ".date("Y-m-d");
                            }*/
                            
                            //BOX MODIFIER MESSAGE
?>
                            <form method="POST" action="modifMsg.php">
                                <input type="hidden" name="idDiscussion" value="<?php echo $message->getIdDiscussion(); ?>"/>
                                <input type="hidden" name="idMessage" value="<?php echo $message->getIdMessage(); ?>"/>
                                <input type="text" name="texteMessage" placeholder="Contenu"/>
                                <button type="submit">Modifier</button> 
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

