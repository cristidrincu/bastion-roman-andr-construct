<?  
	require_once("classes/class.ocrcaptcha.php");
	$captcha = new ocr_captcha();

    if(isset($_POST['submitBtn']) && $_POST['submitBtn']=="trimite") {   

		require_once("classes/auxiliary.php");
		require_once("classes/class.htmlMimeMail.php");
	  
		$contactErrorMessage = "";
		$firstname          = $_POST['firstname'];
		$lastname           = $_POST['lastname'];
		$phone              = $_POST['phone'];
		$city               = $_POST['city'];
		$type               = $_POST['type'];
		$finishingType      = $_POST['finishingType'];
		$materials          = $_POST['materials'];
		$squareMeters       = $_POST['squareMeters'];		
		$email         = $_POST['email'];
		$message       = $_POST['message'];
		
		if($captcha->check_captcha($_POST['public_key'],$_POST['private_key']))	 { 
				$contactErrorMessage = checkCerereForm($_POST); 
				if($contactErrorMessage=="") {
					
					$htmlText="";
					$htmlText .=   '<table align="center" width="99%" style="font-weight:bold;" border="1">';
					$htmlText .=   '<tr style="font-weight:bold">';
					$htmlText .=   '    <td colspan="2">Cerere Contact</td>';
					$htmlText .=   '</tr>';
					$htmlText .=   '<tr>';
					$htmlText .=   '    <td width="200">Nume:&nbsp;</td>';
					$htmlText .=   '    <td>'.$firstname." ".$lastname.'</td>';
					$htmlText .=   '</tr>';
					$htmlText .=   '<tr>';                                        
					$htmlText .=   '    <td>Telefon:&nbsp;</td>';
					$htmlText .=   '    <td>'.$phone.'</td>';
					$htmlText .=   '</tr>';
					$htmlText .=   '<tr>';                                        
					$htmlText .=   '    <td>Email:&nbsp;</td>';
					$htmlText .=   '    <td>'.$email.'</td>';
					$htmlText .=   '</tr>';
					$htmlText .=   '<tr>';                                        
					$htmlText .=   '    <td>Localiate:&nbsp;</td>';
					$htmlText .=   '    <td>'.$city.'</td>';
					$htmlText .=   '</tr>';
					$htmlText .=   '<tr>';                                        
					$htmlText .=   '    <td>Tipul constructiei:&nbsp;</td>';
					$htmlText .=   '    <td>'.$type.'</td>';
					$htmlText .=   '</tr>';
					$htmlText .=   '<tr>';                                        
					$htmlText .=   '    <td>Tipul de finisare:&nbsp;</td>';
					$htmlText .=   '    <td>'.$finishingType.'</td>';
					$htmlText .=   '</tr>';
					$htmlText .=   '<tr>';                                        
					$htmlText .=   '    <td>Cine va oferi materialele de constructie:&nbsp;</td>';
					$htmlText .=   '    <td>'.$materials.'</td>';
					$htmlText .=   '</tr>';
					$htmlText .=   '<tr>';                                        
					$htmlText .=   '    <td>Nr. metri patrati suprafata construita:&nbsp;</td>';
					$htmlText .=   '    <td>'.$squareMeters.'</td>';
					$htmlText .=   '</tr>';
					$htmlText .=   '<tr>';
					$htmlText .=   '    <td>Mesaj:&nbsp;</td>';
					$htmlText .=   '    <td>'.nl2br($message).'</td>';
					$htmlText .=   '</tr>';
					$htmlText .=   '</table>';
					
					$text  =   'Cerere Contact\r\n';
					$text .=   'Nume:'.$firstname." ".$lastname.'\r\n';
					$text .=   'Phone:'.$phone.'\r\n';
					$text .=   'Email:'.$email.'\r\n';
					$text .=   'Tipul constructiei:'.$type.'\r\n';
					$text .=   'Tipul de finisare:'.$finishingType.'\r\n';
					$text .=   'Cine va oferi materialele de constructie::'.$materials.'\r\n';
					$text .=   'Nr. metri patrati suprafata construita::'.$squareMeters.'\r\n';					
					$text .=   'Mesaj:'.nl2br($message).'\r\n';
		
					$to="office@roman-construct.ro";                                                            
					$from = "vizitator@roman-construct.ro";
					$subject = "Cerere Contact";    
					$html = "<HTML><HEAD></HEAD><BODY>".$htmlText."</BODY></HTML>";
		
					$mail=new htmlMimeMail();
					$mail->setHtml($htmlText, $text);
					$mail->setReturnPath($to);
					$mail->setFrom($from);
					$mail->setSubject($subject);
					$mail->setHeader("X-Mailer","roman-construct.ro.ro");
					$mail->setHeader("X-Priority","1");
					$mail->setHeader("X-Sender","<www.roman-construct.ro.ro>");
					
					$result = @$mail->send(array($to));
					
            		unset($firstname);
            		unset($lastname);
            		unset($phone);
            		unset($city);
            		unset($type);
            		unset($finishingType);
            		unset($materials);
            		unset($squareMeters);		
            		unset($email);
            		unset($message);
					
					if (!$result){
						  $contactErrorMessage .= "Eroarea in cadrul operatiunii de trimitere a mesajului. Va rugam reveniti mai tarziu. Va multumim!";	  
					}
					else {
						  $contactErrorMessage .= "Mesajul dumneavoastra a fost trimis. Va multumim!";	  
					}  
				} 
		} else {  // else captcha
			$contactErrorMessage .= "Codul din imagine nu corespunde cu cel introdus de dumneavoastra";		
		}
    }                                                           
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="description" content="SC Roman ANDR Construct SRL este o societate cu capital privat romanesc, infiintata in anul 1997 in zona de nord a Italiei si care are ca domeniu de activitate lucrarile de Reabilitarea monumentelor istorice, constructii de case si blocuri la cheie, amenajari interioare, lucrari agro-zootehnice si demolari."/>
<meta name="keywords" content="restaurare bastion theresia timisoara, reabilitare monumente istorice, constructii de case si blocuri, amenajari interioare, lucrari agro-zootehnice, obtinere documentatii tehnice, proiecte executie, avize, autorizatii, demolari, materiale, instalatii electrice, instalatii incalzire, instalaltii sanitare, instalatii aer conditionat, finisaje, gleturi, zugraveli albe si colorate, tencuieli, gresie, faianta, sape, pardoseli piatra sau marmura, gips carton, parchet din lemn sau laminat, termosistem, termosistem fatada, acoperisuri, mansarde si fatade"/>

<link rel="stylesheet" type="text/css" href="css/roman_construct.css" media="screen"/>

<!--[if lt IE 7]>
        <script type="text/javascript" src="js/unitpngfix.js"></script>
<![endif]-->

<title>Roman Construct - Cerere de oferta</title>


<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-2956369-7");
pageTracker._trackPageview();
</script>

</head>

<body>
<div class="boxBackground">
	<div class="mainBox">
    	<div class="leftColumn">
        	<div class="containerLogo">
            	<img src="images/pic_logo_roman_andr_construct/logo_roman_andr.jpg" alt="" border="0" width="269" height="120"/>
            </div><!--ends containerLogo-->
            
            <div class="containerMenu">
            
            	<div class="wrapperButton">
                	<h3>
                    	<a href="index.html" target="_self">acasa</a>                    
                    </h3>
              </div><!--ends wrapperButtonActive-->
                
                <div class="wrapperButton">
                	<h3>
                    	<a href="despre_noi.html" target="_self">despre noi</a>                    
                    </h3>
              </div><!--ends wrapperButton-->
                
                <div class="wrapperButton">
                	<h3>
                    	<a href="noutati.html" target="_self">noutati</a>                    </h3>
              </div><!--ends wrapperButton-->
                
                <div class="wrapperButton">
                	<h3>
                    	<a href="portofoliu_lucrari.html" target="_self">lucrari</a>                    
                    </h3>
              </div><!--ends wrapperButton-->
                
                
                <div class="wrapperButton">
                	<h3>
                    	<a href="servicii.html" target="_self">servicii</a>                    </h3>
              </div><!--ends wrapperButton-->
                
                 <div class="wrapperButton">
                	<h3>
                    	<a href="galerie_foto.html" target="_self">galerie foto</a>                    
                    </h3>
              </div><!--ends wrapperButton-->
              
              <div class="wrapperButtonActive">
                	<h3>
                    	<a href="cerere_oferta.php" target="_self">cerere oferta</a>
                    </h3>
                </div><!--ends wrapperButton-->
                
                <div class="wrapperButton">
                	<h3>
                    	<a href="contact.php" target="_self">contact</a>
                    </h3>
                </div><!--ends wrapperButton-->
            
            </div><!--ends containerMenu-->
            
            <div class="containerUltimaLucrareInfoContact">
            	<div class="headerUltimaLucrare">
                	<h3>
                    	Ultima lucrare
                    </h3>
                </div><!--ends headerUltimaLucrare-->
                
                <div class="containerPicUltimaLucrare">
                	<img src="images/pic_ultima_lucrare/pic_ultima_lucrare.jpg" alt="" border="0" width="250" height="188"/>
                    
                   
                    
                </div><!--ends containerPicUltimaLucrare-->
                
                <div class="containerDescriereUltimaLucrare">
                	<p>
                    	<strong>Amenajare apartamente pe str. I. Dragalina nr.32, Timisoara</strong>
                    </p>
                		
                	<br/>
                
                	 <p>
						Lucrarile au inceput in ianuarie 2008 si au fost finalizate in martie 2008 constand in demolari, instalatii electrice, de incalzire si sanitare, gips-carton, glet, zugraveli, sape, tencuieli, gresie, faianta, parchet.                    
                     </p>
                </div><!--ends containerDescriereUltimaLucrare-->
                
                <div class="containerMaiMulteDetaliiLeftColumn">
                	<ul>
                    	<li>
                        	<img src="images/arrow_left_column/arrow_left_column.jpg" alt="" border="0" width="8" height="9"/>
                        </li>
                        
                        <li>
                        	<a href="noutati.html" target="_self">mai multe detalii aflati aici</a>                        </li>
                        
                    </ul>
                </div><!--ends containerMaiMulteDetaliiLeftColumn-->
                
                <div class="headerInformatiiContact">
                	<h3>
                    	Informatii contact
                    </h3>
                </div><!--ends headerInformatiiContact-->
                
                <div class="containerTextContact">
                	<address>
                    	Adresa: <strong>Str Maresal C-tin Prezan, nr. 121, bl.52 ap.20, 300480, Timisoara, Romania</strong>
                        <br/><br/>
                    	Telefon: <strong>+40(0)731.327.433, +40(0)731.327.432, +40(0)731.327.430</strong>
						<br/><br/>
                        Fax: <strong>+40(0)356.458.966</strong>
                        <br/><br/>
                        E-mail: <strong>office@roman-construct.ro</strong>
                        <br/>
                        Web: <strong>www.roman-construct.ro</strong>
                    </address>
                </div><!--ends containerTextContact-->
                
                
            </div><!--ends containerUltimaLucrareInfoContact-->
            
        </div><!--ends leftColumn-->
        
        
        
        <div class="rightColumn">
        	
            
            <div class="containerHeaderGalerieFotoLucrari">
            	<h3>
                	Cerere oferta
                </h3>
            </div><!--ends containerHeaderGalerieFotoLucrari-->
            
            
            
            <div class="containerPhotosGalerieFoto">
            	<div class="containerDenumireServiciu">
                	<div class="containerForm">
            <form name="contactForm" method="post" action="cerere_oferta.php">
            	<div class="fieldsFormContact">
                            <?
                                if(isset($contactErrorMessage)) {
                            ?>
                        	<p class="captchaText">
                                <?
                                    echo $contactErrorMessage;
                                ?>
                                <br class="clearFloats"/>
                            </p>
                            <?
                            }
                            ?>
                            
                             <p>
                            	<label class="labelTitle">Nume*:</label>                            
                            	<input type="text" id="campContact" name="firstname" value="<?=(isset($firstname) ? $firstname : "")?>"/>                            
                            	<br class="clearFloats"/>                            
                            </p>
                            
                            <p>
                            	<label class="labelTitle">Prenume*:</label>                            
                            	<input type="text" id="campContact" name="lastname" value="<?=(isset($lastname) ? $lastname : "")?>"/>                            
                            	<br class="clearFloats"/>                            
                            </p>
                            
                            <p>
                            	<label class="labelTitle">Telefon*:</label>                            
                            	<input type="text" id="campContact" name="phone" value="<?=(isset($phone) ? $phone : "")?>"/>                            
                            	<br class="clearFloats"/>                            
                            </p>
                            
                            <p>
                            	<label class="labelTitle">E-mail*:</label>
                            	<input type="text" id="campContact" name="email" value="<?=(isset($email) ? $email : "")?>"/>
                            	<br class="clearFloats"/>
                            </p>								
							                	
                            <p>
                            	<label class="labelTitle">Localitatea*:</label>                            
                            	<input type="text" id="campContact" name="city" value="<?=(isset($city) ? $city : "")?>"/>                            
                            	<br class="clearFloats"/>                            
                            </p>
                            
                            <p>
                            	<label class="labelTitle">Tipul constructiei*:</label>
                            	<label>
                            	<select name="type" id="select" >
                            	  <option value="-1"                 <?=(isset($type) ? $type=="-1"? "selected":"" : "")?>>-</option>
                            	  <option value="casa"				 <?=(isset($type) ? $type=="casa"? "selected":"" : "")?>>casa</option>
                            	  <option value="bloc"				 <?=(isset($type) ? $type=="bloc"? "selected":"" : "")?>>bloc</option>
                            	  <option value="hala industriala"   <?=(isset($type) ? $type=="hala industriala"? "selected":"" : "")?>>hala industriala</option>
                            	  <option value="monument istoric"   <?=(isset($type) ? $type=="monument istoric"? "selected":"" : "")?>>monument istoric</option>
                            	  <option value="pavaje"			 <?=(isset($type) ? $type=="pavaje"? "selected":"" : "")?>>pavaje</option>
                          	      </select>
                            	</label>                            
                            	<br class="clearFloats"/>                            
                            </p>
                        
   	  <p>
                            	<label class="labelTitle">Tipul de finisare*:</label>
                            	<label>
                            	<select name="finishingType" id="select2">
                            	  <option value="-1"       <?=(isset($finishingType) ? $finishingType=="-1"? "selected":"" : "")?>>-</option>
                            	  <option value="la rosu"  <?=(isset($finishingType) ? $finishingType=="la rosu"? "selected":"" : "")?>>la rosu</option>
                            	  <option value="la cheie" <?=(isset($finishingType) ? $finishingType=="la cheie"? "selected":"" : "")?>>la cheie</option>
                          	    </select>
                            	</label>                            
                            	<br class="clearFloats"/>                            
                            </p>
                        
	  <p>
                            	<label class="labelTitle">Nr. metri patrati suprafata construita*:</label>
                            	<input type="text" id="campContact" name="squareMeters" value="<?=(isset($squareMeters) ? $squareMeters : "")?>"/>
                            	<br class="clearFloats"/>
                            </p>
                        
                        	<p>
                                <label class="labelTitle">Cine va oferi materialele de constructie:</label>
                                <label>
                                <select name="materials" id="select3">
                            	  <option value="-1"									<?=(isset($materials) ? $materials=="-1"? "selected":"" : "")?>>-</option>
                                  <option value="Materiale oferite de Roman Construct"  <?=(isset($materials) ? $materials=="Materiale oferite de Roman Construct"? "selected":"" : "")?>>Materiale oferite de Roman Construct</option>
                                  <option value="Materiale oferite de client"			<?=(isset($materials) ? $materials=="Materiale oferite de client"? "selected":"" : "")?>>Materiale oferite de client</option>
                                </select>
                                </label>
                                <br class="clearFloats"/>
                            </p>
                            
     
                            
                            <p>
                                <label class="labelTitle">Mesaj*:</label>
                                <textarea id="campMesaj" name="message"><?=(isset($message) ? $message : "")?></textarea>
                                <br class="clearFloats"/>
                            </p>
                            
                            <p>
                            	<label class="labelTitle">&nbsp;</label>
                                        <table cellpadding="0" cellspacing="2" border="0" width="95%">
                                            <tr>
                                                <td colspan="2" align="center">
                                                    <span class="captchaText">
                                                    Va rugam introduceti codul din imagine
                                                    </span><br/>
                                                    <a href="contact.php">
                                                        Daca nu vedeti imaginea de mai jos dati click aici
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" colspan="2" valign="middle">
                                                    <?
                                                        echo $captcha->display_captcha(true);                                                                            
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                            </tr>
                                        </table>                            
                            	<br class="clearFloats"/>
                            </p>
                            
                            <div class="btnTrimite">
                            	<input type="submit" name="submitBtn" value="trimite" id="btnSendMessage"/>
                            </div><!--ends btnTrimite-->
                            
                            <div class="atentieFormular">
                            	<p>
                                	(*) Nota: Campurile marcate cu * sunt obligatorii si trebuie completate.
                                </p>
                            </div><!--ends atentieFormular-->
                    
                </div>
            </form>
            </div><!--ends containerForm-->
                </div><!--ends containerDenumireServiciu-->
            </div><!--ends containerPhotosGalerieFoto-->

            
            <div class="containerDevelopedBy">
            	<a href="http://www.globe-studios.com" target="_blank"><img src="images/pic_developed_by/pic_developed_by.png" alt="" border="0" width="200" height="44"/></a>
            </div><!--ends containerDevelopedBy-->
            
        </div><!--ends rightColumn-->
        
        <br class="clearFloats"/>
        
    </div><!--ends mainBox-->
</div>

</body>
</html>
