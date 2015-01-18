<?php
    function checkEmailAdress($email) { 
        if( (preg_match('/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/', $email)) || 
            (preg_match('/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?)$/',$email)) ) { 
            return true;
        }
        return false;
    }
    
    function checkContactForm($values){
        $error = "";
        if(isset($values)){
                if(trim($values['firstname'])=="")
                    $error .= "Campul Nume nu poate fi vid!<br/>";
                if(trim($values['lastname'])=="")
                    $error .= "Campul Prenume nu poate fi vid!<br/>";
                if(trim($values['phone'])=="")
                    $error .= "Campul Telefon nu poate fi vid!<br/>";                    
                if(trim($values['email'])=="" && !checkEmailAdress($values['email']))
                    $error .= "Campul Email nu poate fi vid!<br/>";
                if(trim($values['message'])=="")
                    $error .= "Campul Mesaj nu poate fi vid!<br/>";
        }
    return $error;
    }

    function checkCerereForm($values){
        $error = "";
        if(isset($values)){
                if(trim($values['firstname'])=="")
                    $error .= "Campul Nume nu poate fi vid!<br/>";
                if(trim($values['lastname'])=="")
                    $error .= "Campul Prenume nu poate fi vid!<br/>";
                if(trim($values['phone'])=="")
                    $error .= "Campul Telefon nu poate fi vid!<br/>";                    
                if(trim($values['city'])=="")
                    $error .= "Campul Localitate nu poate fi vid!<br/>";                    
                if(trim($values['type'])=="-1")
                    $error .= "Campul Tipul constructiei nu poate fi vid!<br/>";                    
                if(trim($values['finishingType'])=="-1")
                    $error .= "Campul Tipul de finisare nu poate fi vid!<br/>";      
                if(trim($values['squareMeters'])=="-1")
                    $error .= "Campul Nr. metri patrati suprafata construita nu poate fi vid!<br/>";                                       
                if(trim($values['email'])=="" && !checkEmailAdress($values['email']))                
                    $error .= "Campul Email nu poate fi vid!<br/>";
                if(trim($values['message'])=="")
                    $error .= "Campul Mesaj nu poate fi vid!<br/>";
        }
    return $error;
    }
    
?>