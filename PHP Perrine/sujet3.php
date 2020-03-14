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
    $idCategorie = 3;
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
            if($currentUser->getIdUser()==$user->getIdUser())
            {
?>        
                <form method="POST" action="deleteDiscu.php">
                    <input type="hidden" name="idDiscussion" value="<?php echo $discussion->getIdDiscussion(); ?>"/>
                    <button type="submit">Supprimer</button> 
                </form>
<?php
            }
        }
?>
    
        <div class="discussion-titre"><?php echo $discussion->getTitreDiscussion(); ?></div>
        <div class="discussion-date"><?php echo "Créé le ".$discussion->getDateDiscussion(); ?></div>
        <div class="discussion-texte"><?php echo "Texte: ".$discussion->getTexteDiscussion(); ?></div>
        <div class="discussion-user"><?php echo "Par ".$user->getPseudo(); ?></div>
        <div class="message-nombre"><?php echo "Messages (".sizeof($tabMessages).")";?></div>
        
<?php 
        //AFFICHAGE BOX NEW MESSAGE
        if(isset($_SESSION["login"]))
        {
?>
            <div class="new-message-container">
            <div class="new-message-entete">Réagir à la discussion</div>
            <form method="POST" action="insertMsg.php">
                <div class="new-message-contenu">
                    <input type="text" name="texteMsg" placeholder="Contenu"/>
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
        
        //AFFICHAGE MESSAGES
        foreach($tabMessages as $message)
        {
            $user= UtilisateurManager::findUserWithId($message->getIdUser()); //user associé au message
?>
            <div class="message-container">
                <div class="message-user"><?php echo "de ".$user->getPseudo(); ?></div>
                <div class="message-date"><?php echo "posté le ".$message->getDateMessage(); ?></div>
                <div class="message-texte"><?php echo $message->getTexteMessage(); ?></div>
            </div>
<?php
        }
?>
        </div>
<?php
    }
    
    include("include/footer.php")
?>
