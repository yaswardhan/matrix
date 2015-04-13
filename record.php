<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
  
  $fgmembersite->RedirectToURL("login.php");
    exit;
}

/* Need to be modified here */

if(isset($_POST['submitted']))
{
  $missing = "";
  foreach ($_POST as $key => $value)
  {
    if ( strlen($value)==0 || $value == "0") {
      $missing = "true";
      echo '<font color="red">Failur!</font> missing '.$key."</br>";
      //return false;
    }
     //echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
  }
  if ($missing != "true") {
     if($fgmembersite->AddProjectDetails())
     {
        //  $fgmembersite->RedirectToURL("thank-you.html");
     }
  }
   
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>Add New Project Name</title>
    <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
    <script type="text/javascript">
function TeamSelected (){ 
  
document.getElementById('TeamMember').innerHTML = "";
var string = "";

if (document.getElementById('SelectTeam').value == 1){
  
      string = "<?php
        $resultString = "";
       $Options = array();
        if(true == $fgmembersite->GetTeamMembers($Options,"1")){
          foreach ($Options as $key => $value) {
            $resultString = $resultString."<option value=".$value["id"].">".$value[name]."</option>";
          }
        }
        echo $resultString;
          ?>";
  }
  else if (document.getElementById('SelectTeam').value == 2){
      string = "<?php
        $resultString = "";
       $Options = array();
        if(true == $fgmembersite->GetTeamMembers($Options,"2")){
          foreach ($Options as $key => $value) {
            $resultString = $resultString."<option value=".$value["id"].">".$value[name]."</option>";
          }
        }
        echo $resultString;
          ?>";
  }
  else if (document.getElementById('SelectTeam').value == 3){
      string = "<?php
        $resultString = "";
       $Options = array();
        if(true == $fgmembersite->GetTeamMembers($Options,"3")){
          foreach ($Options as $key => $value) {
            $resultString = $resultString."<option value=".$value["id"].">".$value[name]."</option>";
          }
        }
        echo $resultString;
          ?>";
  }
  else if (document.getElementById('SelectTeam').value == 4){
      string = "<?php
        $resultString = "";
       $Options = array();
        if(true == $fgmembersite->GetTeamMembers($Options,"4")){
          foreach ($Options as $key => $value) {
            $resultString = $resultString."<option value=".$value["id"].">".$value[name]."</option>";
          }
        }
        echo $resultString;
          ?>";
  }
  else if (document.getElementById('SelectTeam').value == 5){
      string = "<?php
        $resultString = "";
       $Options = array();
        if(true == $fgmembersite->GetTeamMembers($Options,"5")){
          foreach ($Options as $key => $value) {
            $resultString = $resultString."<option value=".$value["id"].">".$value[name]."</option>";
          }
        }
        echo $resultString;
          ?>";
  }


document.getElementById('TeamMember').innerHTML = string;

}

function ITSelected(){

if (document.getElementById('IT').value == 0)
{
  return false;
}
  document.getElementById('ITMember').innerHTML = "<?php
        $resultString = "";
       $Options1 = array();
        if(true == $fgmembersite->GetTeamMembers($Options1,"4")){
          foreach ($Options1 as $key => $value) {
            $resultString = $resultString."<option value=".$value["id"].">".$value[name]."</option>";
          }
        }
		
		$Options2 = array();
        if(true == $fgmembersite->GetTeamMembers($Options2,"5")){
          foreach ($Options2 as $key => $value) {
            $resultString = $resultString."<option value=".$value["id"].">".$value[name]."</option>";
          }
        }
		$merge = array_merge($Options1, $Options2); 
        echo $resultString;
          ?>";
}
    </script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#ClientTAT").datepicker();
    $( "#QuotationDate" ).datepicker();
    $( "#PODate" ).datepicker();
  });
  </script>
</head>
<body>

<!-- Form Code Start -->
<div align="center" id='fg_membersite' >
<form id='AddNewProjectName' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Add New Project</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* required fields</div></br>

<div class='container' align="left">
    <label for='ProjectName' >Project Name*: </label>
    <input type='text' name='ProjectName' id='ProjectName' maxlength="50" /><br/>
</div>
<div class='container' align="left">
    <label for='SelectTeam' >Select Team* :  </label> 
    <select  name='SelectTeam' id='SelectTeam' onchange="TeamSelected()">
      <option value="0" selected="selected">Choose SBU</option>
  <?php 
  $Options = array();
  if(true == $fgmembersite->GetTeams($Options)){
      foreach ($Options as $key => $value) {
        echo "<option value='".$value['id']."'>".$value['name']."</option>";
      }  
    }
  ?>
</select><br/>
</div>

<div class='container' align="left">
    <label for='TeamMember' >Select Team Member* :  </label> 
    <select  name='TeamMember' id='TeamMember' onchange="TeamMemberSelected()">
      
</select><br/>
</div>

<div class='container' align="left">
    <label for='IT' >Select IT(y/n)* :  </label> 
    <select  name='IT' id='IT' onchange="ITSelected()">
      <option value="0" selected="selected">N</option>
      <option value="1" >Y</option>
</select><br/>
</div>

<div class='container' align="left">
    <label for='ITMember' >Select IT Team Member :  </label> 
    <select  name='ITMember' id='ITMember' onchange="ITMemberSelected()">
      
</select><br/>
</div>

<div class='container' align="left">
    <label for='Speciality' >Select Speciality* :  </label> 
    <select  name='Speciality' id='Speciality' >
  <?php 
  $Options = array();
  if(true == $fgmembersite->GetSpecialities($Options)){
      foreach ($Options as $key => $value) {
        echo "<option value='".$value['id']."'>".$value['speciality_name']."</option>";
      }  
    }
  ?>
</select><br/>
</div>

<div class='container' align="left">
    <label for='Product' >Type of product * :  </label> 
    <select  name='Product' id='Product' >
  <?php 
  $Options = array();
  if(true == $fgmembersite->GetProducts($Options)){
      foreach ($Options as $key => $value) {
        echo "<option value='".$value['id']."'>".$value['product_name']."</option>";
      }  
    }
  ?>
</select><br/>
</div>

<div class='container'>
    <label for='ProjectSpecification' >Project Specification*: </label><br/>
    <textarea name='ProjectSpecification' id='ProjectSpecification' style='width:400px; max-width:400px; min-width:400px'> </textarea><br/>
</div></br>

<div class='container' align="left">
    <label for='CurrentStatus' >Current Status of Project * :  </label>
    <select  name='CurrentStatus' id='CurrentStatus' >
  <?php 
  $Options = array();
  if(true == $fgmembersite->GetStatusList($Options)){
      foreach ($Options as $key => $value) {
        echo "<option value='".$value['id']."'>".$value['status_name']."</option>";
      }  
    }
  ?>
</select><br/>
</div>

<div class='container' align="left">
    <label for='ClientTAT' >Client TAT*: </label>
    <input type='text' name='ClientTAT' id='ClientTAT' /><br/>
</div>

<div class='container' align="left">
    <label for='Company' >Company* :  </label>
    <select  name='Company' id='Company' >
  <?php 
  $Options = array();
  if(true == $fgmembersite->GetCompList($Options)){
      foreach ($Options as $key => $value) {
        echo "<option value='".$value['id']."'>".$value['company_name']."</option>";
      }  
    }
  ?>
</select><br/>
</div>

<div class='container' align="left">
    <label for='Region' >Region * :  </label>
    <select  name='Region' id='Region' >
  <?php 
  $Options = array();
  if(true == $fgmembersite->GetRegionsList($Options)){
      foreach ($Options as $key => $value) {
        echo "<option value='".$value['id']."'>".$value['region_name']."</option>";
      }  
    }
  ?>
</select><br/>
</div>

<div class='container' align="left">
    <label for='PMT' >PMT Name*: </label>
    <input type='text' name='PMT' id='PMT' /><br/>
</div>

<div class='container' align="left">
    <label for='JobCode' >Job Code*: </label>
    <input type='text' name='JobCode' id='JobCode' /><br/>
</div>

<div class='container' align="left">
    <label for='QuotationNo' >Quotation No *: </label>
    <input type='text' name='QuotationNo' id='QuotationNo' /><br/>
</div>

<div class='container' align="left">
    <label for='QuotationDate' >Quotation Date *: </label>
    <input type='text' name='QuotationDate' id='QuotationDate' /><br/>
</div>

<div class='container' align="left">
    <label for='QuotationAmount' >Quotation Amount *: </label>
    <input type='text' name='QuotationAmount' id='QuotationAmount' /><br/>
</div>

<div class='container' align="left">
    <label for='PONo' >PO No *: </label>
    <input type='text' name='PONo' id='PONo' /><br/>
</div>

<div class='container' align="left">
    <label for='PODate' >PO Date *: </label>
    <input type='text' name='PODate' id='PODate' /><br/>
</div>

<div class='container' align="left">
    <label for='MHSAmount' >Probable MHS Amount *: </label>
    <input type='text' name='MHSAmount' id='MHSAmount' /><br/>
</div>

<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>

</fieldset>
</form>


</body>
</html>