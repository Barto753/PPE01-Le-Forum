<?php
    session_name("PPE01");
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
    <!--NOUVELLE DISCUSSION
    <div class="new-discussion-container">  
    <div class="new-discussion-button">Créer un nouveau fil de discussion</div>
    <form action="insertDiscussion.php">
        <SELECT name="categorie-discussion" size="1">
            <option>CSS
            <option>PHP
            <option>Java
        </SELECT>
        <button type="submit">Créer un nouveau fil de discussion</button>
    </form> 
    </div> 
    -->
    <?php
    //AFFICHAGE DISCUSSIONS
    echo "<br>";
    $tabDiscussions = CategorieManager::getDiscussions(1);
           
    foreach($tabDiscussions as $discussion)
    {
        $tabMessages = DiscussionManager::getMessages($discussion->getIdDiscussion());
?>
    <div class="discussion-container">
        <div class="discussion-titre"><?php echo $discussion->getTitreDiscussion(); ?></div>
        <div class="discussion-date"><?php echo "Créé le ".$discussion->getDateDiscussion(); ?></div>
        <div class="discussion-texte"><?php echo "Texte: ".$discussion->getTexteDiscussion(); ?></div>
        <div class="discussion-user"><?php echo "Par ".$discussion->getIdUser(); ?></div>

<?php
        foreach($tabMessages as $message)
        {
?>
            <div class="message-container">
                <div class="message-user"><?php echo $message->getIdUser(); ?></div>
                <div class="message-date"><?php echo $message->getDateMessage(); ?></div>
                <div class="message-texte"><?php echo $message->getTexteMessage(); ?></div>
            </div>
<?php
        }
    }
?>
    </div>
<?php
    
    include("include/footer.php")
?>

