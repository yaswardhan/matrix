 

 function TeamSelected () 
 { 

var string =  "<?php
        require_once("./include/membersite_config.php");
        $resultString = "";
       $Options = array();
        if(true == $fgmembersite->GetTeamMembers($Options,"1")){
          foreach ($Options as $key => $value) {
            $resultString = $resultString."<option value=".$value["id"].">".$value[type_name]."</option>";
          }
        }
        echo $resultString;
          ?>";
        break;


document.getElementById('mySelect').innerHTML = string;

}