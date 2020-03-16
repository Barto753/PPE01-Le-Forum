<?php
    session_start();
    include_once("include/header.php");
    
    include_once("dataManagers/UtilisateurManager.php");
    include_once("data/Utilisateur.php");
    include_once("data/Bannissement.php");
    
    
    
    if(isset($_SESSION["login"]))
    {
        
        date_default_timezone_set('Europe/Paris');
        $ban = null;
        //echo $user->getIdUser();
        
        if(empty($_POST["motif-ban"]) && empty($_POST["duree-bannissement"]))
        {
            $user = UtilisateurManager::findUserWithId($_POST["idUser"]);
?>
            <form method="POST" action="updateBanni.php">
                <SELECT name="duree-ban" size="1">
                    <option>1h
                    <option>24h
                    <option>48h
                    <option>Indeterminee
                </SELECT>
                <input type="text" name="motif-ban" placeholder="motif du bannissement"/> 
                <input type="hidden" name="idUser" value="<?php echo $user->getIdUser(); ?>"/>
                <input type="submit" value="Bannir"/>
            </form>
<?php
        }
        
        
        if(!empty($_POST["duree-ban"]) && !empty($_POST["motif-ban"]) && !empty($_POST["idUser"]))
        {
            //$ban = UtilisateurManager::findBannissement($_POST["idUser"]);
            $ban = new Bannissement();
            $ban->setMotif($_POST["motif-ban"]);
            $ban->setIdUser($_POST["idUser"]);
            
            if($_POST["duree-ban"]==("1h"))
            {
                $ban->setDateFin(date('d/m/Y H:i:s',time()+60));
            }
            else if($_POST["duree-ban"]==("24h"))
            {
                $ban->setDateFin(date('d/m/Y H:i:s',time()+86400));

            }
            else if($_POST["duree-ban"]==("48h"))
            {
                $ban->setDateFin(date('d/m/Y H:i:s',time()+172800));
            }
            else if($_POST["duree-ban"]==("Indeterminee"))
            {
                $ban->setDateFin(date('d/m/Y H:i:s',time()+630720000));//20ans
            }
            UtilisateurManager::insertBannissement($ban);
            
            header('Location: administration.php');
            exit;
            
        }
    }

    
    include_once("include/footer.php");
?>