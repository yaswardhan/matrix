
<?php
require_once("./include/membersite_config.php");



$record_id = $_POST['data'];

$ProjDetails = array();
$TeamID = "";
$SBUTeam = array();
$projStatus = array();
$paymentStatus = array();

    if(true == $fgmembersite->GetRecordDetails($record_id,$ProjDetails)){
      $ProjDetails = $ProjDetails[0];
      $TeamID = $ProjDetails['Team'];
    }

    if (true == $fgmembersite->GetTeamMembers($SBUTeam,$TeamID)) {

    }

    if (true == $fgmembersite->GetStatusList($projStatus)) {
         
    }
    if(true == $fgmembersite->GetTeamName($TeamID)){ 
    }

    if(true == $fgmembersite->GetPaymentStatus($paymentStatus)){ 
    }

?>

<html>
<head>
<style type="text/css">
fieldset {
    border: 1px solid black;
  width: 500px;
  margin:auto;
}
legend {
    margin: 0 30%;
}
</style>
</head>
<body>
  
<fieldset >
  <legend >Edit Project Details</legend>

    <font size = 5>Sl.No : <?php echo $ProjDetails['id']; ?>        |</font>
    <font size = 5>Project Name : <strong><?php echo $ProjDetails['ProjectName']; ?></strong><br/><br/>

    Assigned to Team : <strong> <?php echo $TeamID; ?></strong> </br></br>

    <label for='TeamMember' >Assigned to :  </label> 
    <select name='TeamMember' id='TeamMember' disabled >
    </select>
    <input onclick="editTeamMember()" type="button" value="Change" id="Edit" /></br></br>

    <label for='ProjectStatus' >Project Status :  </label> 
    <select name='ProjectStatus' id='ProjectStatus' disabled >
    </select>
    <input onclick="editStatus()" type="button" value="Change" id="Status" /></br></br>

    <label for='PaymentStatus' >Payment Status :  </label> 
    <select name='PaymentStatus' id='PaymentStatus' disabled >
    </select>
    <input onclick="editPaymentStatus()" type="button" value="Change" id="PaymentStatusButton" />
    </font>
</fieldset>
<p id="Result"></p>
</body>
</html>

<script type="text/javascript">

document.getElementById('TeamMember').innerHTML = '<?php
  $resultString = "<strong>";
  foreach ($SBUTeam as $key => $value) {
  $resultString = $resultString."<option value=".$value["id"];
  if ($value["id"]==$ProjDetails["tmid"]) {
    $resultString = $resultString." selected";
  };
  $resultString = $resultString.">".$value["name"]."</option>";
  }
  echo $resultString."</strong>";
?>';

document.getElementById('ProjectStatus').innerHTML = '<?php
  $resultString = "<strong>";
  foreach ($projStatus as $key => $value) {
  $resultString = $resultString."<option value=".$value["id"];
  if ($value["id"]==$ProjDetails["projStatus"]) {
    $resultString = $resultString." selected";
  };
  $resultString = $resultString.">".$value["status_name"]."</option>";
  }
  echo $resultString."</strong>";
?>';

document.getElementById('PaymentStatus').innerHTML = '<?php
  $resultString = "<strong>";
  foreach ($paymentStatus as $key => $value) {
  $resultString = $resultString."<option value=".$value["name"];
  if ($value["name"]==$ProjDetails["payment"]) {
    $resultString = $resultString." selected";
  };
  $resultString = $resultString.">".$value["name"]."</option>";
  }
  echo $resultString."</strong>";
?>';


 function editTeamMember(){

    if (document.getElementById("TeamMember").disabled) {
      document.getElementById("TeamMember").disabled = false;
      document.getElementById("Edit").value="Update";
    }
    else
    {      
      document.getElementById("TeamMember").disabled = true;
      document.getElementById("Edit").value="Edit";

      var xmlhttp;
      if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }
      else
        {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
      xmlhttp.onreadystatechange=function()
      {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
            //alert(xmlhttp.responseText);
         document.getElementById("Result").innerHTML=xmlhttp.responseText;
          }
      }
      xmlhttp.open("POST","updatedetails.php",true);
      xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      var parameters = "method=UpdateTeamMember&ProjID="+<?php echo $record_id;?>+"&userID=*****"+"&TeamMemberID="+document.getElementById("TeamMember").value;
      xmlhttp.send(parameters);
    }
  }

  function editStatus(){
    if (document.getElementById("ProjectStatus").disabled) {
    document.getElementById("ProjectStatus").disabled = false;
    document.getElementById("Status").value="Update";
    }
    else
    {
    document.getElementById("ProjectStatus").disabled = true;
    document.getElementById("Status").value="Change";

    var xmlhttp;
      if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }
      else
        {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
      xmlhttp.onreadystatechange=function()
      {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
            //alert(xmlhttp.responseText);
         document.getElementById("Result").innerHTML=xmlhttp.responseText;
          }
      }
      xmlhttp.open("POST","updatedetails.php",true);
      xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      var parameters = "method=UpdateStatus&ProjID="+<?php echo $record_id;?>+"&userID=*****"+"&StatusID="+document.getElementById("ProjectStatus").value;
      xmlhttp.send(parameters);
    }
  }

  function editPaymentStatus(){
    if (document.getElementById("PaymentStatus").disabled) {
    document.getElementById("PaymentStatus").disabled = false;
    document.getElementById("PaymentStatusButton").value="Update";
    }
    else
    {
    document.getElementById("PaymentStatus").disabled = true;
    document.getElementById("PaymentStatusButton").value="Change";

    var xmlhttp;
      if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }
      else
        {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
      xmlhttp.onreadystatechange=function()
      {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
            //alert(xmlhttp.responseText);
         document.getElementById("Result").innerHTML=xmlhttp.responseText;
          }
      }
      xmlhttp.open("POST","updatedetails.php",true);
      xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      var parameters = "method=ProjectStatus&ProjID="+<?php echo $record_id;?>+"&userID=*****"+"&pStatus="+document.getElementById("PaymentStatus").value;
      xmlhttp.send(parameters);
    }
  }

</script>
