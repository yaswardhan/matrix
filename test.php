<?PHP
require_once("./include/membersite_config.php");
function ShowHTMLString($resultString){
  $Options = array();
  if(true == $fgmembersite->GetUserTypes($Options)){
      foreach ($Options as $key => $value) {
              $resultString = $resultString."<option value='".$value['id']."'>".$value['type_name']."</option>";
      }  
    } 
    echo $resultString;
    return true;
}

?>
<html>
<head>
<script type="text/javascript">  
      // notice the quotes around the ?php tag 
     function myFunction(){
      console.log   (document.getElementById('mySelect')); 
      alert(document.getElementById('mySelect'));     
      document.getElementById('mySelect').innerHTML = "<?php
        $resultString = "";
       $Options = array();
        if(true == $fgmembersite->GetUserTypes($Options)){
          foreach ($Options as $key => $value) {
            $resultString = $resultString."<option value=".$value["id"].">".$value[type_name]."</option>";
          }
           //$resultString = $resultString."</select>";
        }
        echo $resultString;
          ?>";
    }
    </script>
</head>
  <body>
    <select id="mySelect">
    
  </select>
<button onclick="myFunction()">Click me</button>
  </body>
</html>