<?php
require_once ('../config.php');
require_once ('functions.php');
$options = array();

if ($_POST) {
  $kv = array();
  foreach ($_POST as $key => $value) {
     if ($key == 'controller'){
            $controller = $value;
    } elseif($key == 'action'){
        $action = $value;
         //echo($value);
    }else{
       if ($key == 'admin_request'){
            //send email to admin
           /* $subject = "DoC Cardbuilder: admin user request"; 
            $text = "Fyi,".$_POST['useranme']."has requested ability to create his/her own events."; 
            mail(ADMIN_EMAIL, $subject, $text);*/
        } else{
            if ($key == 'start'||$key=='end'){
                $value = round($value / 1000);
            }
           $options[$key]=$value;
       }
  }
  }
  }
  $myURL = $controller.'/'.$action.'?'; 
  $myURL .= http_build_query($options,'','&');
  //die;
  $myjson = callAPI($myURL);
  if ($myjson!=''){
       $mydata = json_decode($myjson);
       if ($controller=='event'){
            echo "Event saved.";
       } else{
            if ($controller=='username'){
                if ($mydata->id){echo 'false';}else{echo 'true';}
            } else{
                if ($controller=='user'&&$action=='post'){
                    $_SESSION['from_reg']="true";
                }
                echo($myjson);
            }
         die;
       }
    }else{
        if ($action=='delete'){
            echo 'false';
        }else{
        echo "There was a problem saving your $controller, please try again later.";
    }
        die;
    }
  
?>