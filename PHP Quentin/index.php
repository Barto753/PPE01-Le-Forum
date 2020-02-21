<?php

    include_once("include/header.php");
    include_once("dataManager/discussion.php");
    include_once("dataManager/message.php");
?>
    <div class="page-container">
        
        <div class="page-content">

<?php

    $tabDiscussion = discussionManager::findDiscussion();

    foreach($tabDiscussion as $lineResultat)
    {
        $dateDiscussion = new DateTime($discussion->getDatePublicationDiscussion());

        $tabMessage = discussionManager:: 
    }
?>




        </div>
    </div>

<?php

    include_once("include/footer.php");
?>