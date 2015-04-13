<?php
require_once("./include/membersite_config.php");
	$method = $_POST['method'];

	if ($method == "UpdateTeamMember") {
		$parameters['ProjID'] = $_POST['ProjID'];
		$parameters['TeamMemberID'] = $_POST['TeamMemberID'];
		$parameters['userID'] = $_POST['userID'];

		if (true == $fgmembersite->UpdateTeamMember($parameters)) {
			echo "Team Member has been Updated Successfully";
	    }
	}
	elseif ($method == "UpdateStatus") {
		$parameters['ProjID'] = $_POST['ProjID'];
		$parameters['StatusID'] = $_POST['StatusID'];
		$parameters['userID'] = $_POST['userID'];

		if (true == $fgmembersite->UpdateProjectStatus($parameters)) {
			echo "Project Status has been Updated Successfully";
	    }
	}
	elseif ($method == "ProjectStatus") {
		$parameters['ProjID'] = $_POST['ProjID'];
		$parameters['pStatus'] = $_POST['pStatus'];
		$parameters['userID'] = $_POST['userID'];

		if (true == $fgmembersite->UpdateProjectPaymentStatus($parameters)) {
			echo "Payment Status has been Updated Successfully";
	    }
	}

?>