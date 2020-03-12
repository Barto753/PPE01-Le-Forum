<?php
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
    //AFFICHAGE DISCUSSIONS
 
    $tabDiscussions = CategorieManager::getDiscussions(3);
    $user= new Utilisateur();

    foreach($tabDiscussions as $discussion)
    {
?>
        <div class="discussion-container">
<?php
        $user= UtilisateurManager::findUserWithId($discussion->getIdUser());
        $tabMessages = DiscussionManager::getMessages($discussion->getIdDiscussion());
?>
    
        <div class="discussion-titre"><?php echo $discussion->getTitreDiscussion(); ?></div>
        <div class="discussion-date"><?php echo "Créé le ".$discussion->getDateDiscussion(); ?></div>
        <div class="discussion-texte"><?php echo "Texte: ".$discussion->getTexteDiscussion(); ?></div>
        <div class="discussion-user"><?php echo "Par ".$user->getPseudo(); ?></div>

<?php
        foreach($tabMessages as $message)
        {
            $user= UtilisateurManager::findUserWithId($message->getIdUser())
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

