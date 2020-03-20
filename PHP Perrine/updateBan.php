<?php
    include_once("include/header.php");
    
    include_once("dataManagers/UtilisateurManager.php");
    include_once("data/Utilisateur.php");
    

    if(isset($_SESSION["login"]))
    {
        
        date_default_timezone_set('Europe/Paris');
        
        $user = UtilisateurManager::findUserWithId($_POST["idUser"]);
        
        if(empty($_POST["motifBan"]) && empty($_POST["duree-bannissement"]) && empty($_POST["isBanned"]))
        {       
?>
            <div class="bannissement-container">
                
                <div class="bannissement-titre">
                    Bannir un utilisateur
                </div>
                <div class="bannissement-texte">
                    Durée :
                    </div>
                <form method="POST" action="updateBan.php">
                    
                    <div class="bannissement-liste">
                        <SELECT name="duree-ban" size="1">
                            <option>1h
                            <option>24h
                            <option>48h
                            <option>Indeterminee
                        </SELECT>
                    </div>
                
                <div class="bannissement-texte">
                    Motif :
                </div>
                    <div class="bannissement-motif">
                        <input type="text" name="motifBan" placeholder="motif du bannissement"/> 
                    </div>
                    
                    <input type="hidden" name="idUser" value="<?php echo $user->getIdUser(); ?>"/>
                    
                    <div class="bannissement-bouton">
                        <input type="submit" value="Bannir"/>
                    </div>
                </form>
                
            </div>
<?php
        }
        
        if(!empty($_POST["duree-ban"]) && !empty($_POST["motifBan"]) && !empty($_POST["idUser"]))
        {

            $user->setMotifBan($_POST["motifBan"]);
            $user->setIsBanned(1);
            $timestamp=time(date('Y/m/d H:i:s'));
            //$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
            
            if($_POST["duree-ban"]==("1h"))
            {
                $user->setDateFinBan(date('Y/m/d H:i:s',$timestamp+3600));
            }
            else if($_POST["duree-ban"]==("24h"))
            {
                $user->setDateFinBan(date('Y/m/d H:i:s',$timestamp+86400));
            }
            else if($_POST["duree-ban"]==("48h"))
            {
                $user->setDateFinBan(date('Y/m/d H:i:s',$timestamp+172800));
            }
            else if($_POST["duree-ban"]==("Indeterminee"))
            {
                $user->setDateFinBan("2220-01-01");
                //mktime(0, 0, 0, date("m"), date("d"), date("Y")+15))); //A partir de 18ans bug et retombe à 1970
            }
            
            UtilisateurManager::updateBannissement($user);
            
            header('Location: administration.php');
            exit;
        }
        else if(!empty($_POST["isBanned"]))
        {
            $user->setIsBanned(0);
            $user->setMotifBan("null");
            $user->setDateFinBan("2000-01-01");
            
            UtilisateurManager::updateBannissement($user);
            
            header('Location: administration.php');
            exit; 
        }
    }

    
    include_once("include/footer.php");
?>