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
    
 
    //$_SESSION["login"]=$_GET["pseudo"];
    if(isset($_SESSION["login"]))
    {
        echo "Vous êtes connecté en tant que ".$_SESSION["login"];
    }
    //AFFICHAGE DISCUSSIONS
    $tabDiscussions = CategorieManager::getDiscussions(1);
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
        <div class="message-nombre"><?php echo "Messages (".sizeof($tabMessages).")";?></div>
        
        <?php //$user=Util;?>
        <div class="new-message-container">
            <div class="new-message-entete">Réagir à la discussion</div>
            <form method="POST" action="insertMsg.php">
                <div class="new-message-contenu">
                    <input type="text" name="texteMsg" placeholder="Contenu"/>
                </div>
                    <input type="hidden" name="idUser" value="<?php //echo $user->getIdUser(); ?>"/>
                <div class="new-discussion-button">
                    <button type="submit">Poster</button>
                </div>
            </form>
        </div>
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

