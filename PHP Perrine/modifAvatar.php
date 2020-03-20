<?php
    include_once("include/header.php");
    
    include_once("dataManagers/UtilisateurManager.php");
    include_once("dataManagers/data/Utilisateur.php");
    
    if(!empty($_POST["idUser"]))
    {
        $user = UtilisateurManager::findUserWithId($_POST["idUser"]);
        
        if(isset($_POST['upload'])) // si formulaire soumis
        {
            $content_dir = 'images/'; // dossier où sera déplacé le fichier

            $tmp_file = $_FILES['newAvatar']['tmp_name'];

            if( !is_uploaded_file($tmp_file) )
            {
                echo "Le fichier est introuvable";
                exit;
            }

            // on vérifie maintenant l'extension
            $type_file = $_FILES['newAvatar']['type'];

            if(!strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'png') && !strstr($type_file, 'gif') && !strstr($type_file, 'bmp'))
            {
                echo "Le fichier n'est pas une image";
                exit;
            }

            // on copie le fichier dans le dossier de destination
            $name_file = $_FILES['newAvatar']['name'];

            if(!move_uploaded_file($tmp_file, $content_dir . $name_file))
            {
                echo "Impossible de copier le fichier dans $content_dir";
                exit;
            }

            echo "Le fichier a bien été uploadé";
        }
        
        
        
        
        
        /*$nomOrigine = $_FILES['newAvatar']['name'];
        $elementsChemin = pathinfo($nomOrigine);
        $extensionFichier = $elementsChemin['extension'];
        $extensionsAutorisees = array("jpeg", "jpg", "gif", "png");
        
        if (!(in_array($extensionFichier, $extensionsAutorisees))) 
        {
            echo "Le fichier n'a pas l'extension attendue";    
        } 
        else 
        {    
            // Copie dans le repertoire du script avec un nom
            // incluant l'heure a la seconde pres 
            $repertoireDestination = dirname(__FILE__)."/";
            $nomDestination = "fichier_du_".date("YmdHis").".".$extensionFichier;
        }

        if (move_uploaded_file($_FILES["newAvatar"]["tmp_name"], $repertoireDestination.$nomDestination)) 
        {
            echo "Le fichier temporaire ".$_FILES["newAvatar"]["tmp_name"]." a été déplacé vers ".$repertoireDestination.$nomDestination;
        } 
        else 
        {
            echo "Le fichier n'a pas été uploadé (trop gros ?) ou "."Le déplacement du fichier temporaire a échoué"." vérifiez l'existence du répertoire ".$repertoireDestination;
        }

        
        //<a href="account.php">Retour vers le compte</a>*/

        $user->setCheminAvatar($_FILES['newAvatar']['name']);
        $user = UtilisateurManager::updateAvatar($user);
        echo "Modification de l'avatar réussie.";
        
        header('Location: account.php');
        exit;
        
    }
    
    include_once("include/footer.php");

?>