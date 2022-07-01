<?php
include("connect.php");
include("session.php");
$act = $_POST['act'];

switch($act){
	case "addaccount":
		
		$username = $_POST['username'];
		$pass = $_POST['pass'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];
		$sql = "INSERT INTO tbl_admin(username, pass, fname, mname, lname) VALUES('$username', '$pass', '$fname', '$mname', '$lname')";
		$conn->query($sql);
		
		echo "<script>alert('Account has been added!')</script><script>window.location.href = 'addaccount.php';</script>";
	break;
	case "editadmin":
		$id = $_POST['id'];
		$username = $_POST['username'];
		$pass = $_POST['pass'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];
		$sql = "UPDATE tbl_admin SET username = '$username', pass = '$pass', fname = '$fname', mname = '$mname', lname = '$lname' WHERE id = '$id'";
		$conn->query($sql);
		echo "<script>alert('Admin has been Edited!')</script><script>window.location.href = 'editadmin.php';</script>";
	break;
	case "deleteaccount":
		$id = $_POST['id'];
		$sql = "DELETE FROM tbl_admin WHERE id = '$id'";
		$conn->query($sql);
		echo "<script>window.location.href = 'deleteaccount.php';</script>";
	break;
	case "addman":
		$name = $_POST['name'];
		$pos = $_POST['pos'];
		$con = $_POST['con'];
		$sql = "INSERT INTO tbl_manpower(name, position, contact) VALUES('$name', '$pos', '$con')";
		$conn->query($sql);
		echo "<script>alert('Profile has been added!')</script><script>window.location.href = 'addman.php';</script>";
	break;
	case "editman":
		$id = $_POST['id'];
		$name = $_POST['name'];
		$pos = $_POST['pos'];
		$con = $_POST['con'];
		$sql = "UPDATE tbl_manpower SET name = '$name', position = '$pos', contact = '$con' WHERE id = '$id'";
		$conn->query($sql);
		echo "<script>alert('Profile has been Edited!')</script><script>window.location.href = 'editman.php';</script>";
	break;
	case "deleteman":
		$id = $_POST['id'];
		$sql = "DELETE FROM tbl_manpower WHERE id = '$id'";
		$conn->query($sql);
		echo "<script>alert('Profile has been Removed!')</script><script>window.location.href = 'deleteman.php';</script>";
	break;
	case "addp":
		$pname = $_POST['pname'];
		$sdate = $_POST['sdate'];
		$edate = $_POST['edate'];
		$lat = $_POST['lat'];
		$lon = $_POST['lon'];
		$loc = $_POST['loc'];
		$man = $_POST['man'];
		$sql = "INSERT INTO tbl_projects(pname, sdate, edate, lat, lon, loc, manpower) VALUES('$pname', '$sdate', '$edate', '$lat', '$lon', '$loc', '$man')";
		$conn->query($sql);
		echo "<script>alert('Project has been added!')</script><script>window.location.href = 'main.php';</script>";
	break;
	case "editp":
		$id = $_POST['id'];
		$pname = $_POST['pname'];
		$sdate = $_POST['sdate'];
		$edate = $_POST['edate'];
		$lat = $_POST['lat'];
		$lon = $_POST['lon'];
		$loc = $_POST['loc'];
		$man = $_POST['man'];
		$sql = "UPDATE tbl_projects SET pname='$pname', sdate='$sdate', edate='$edate', lat='$lat', lon='$lon', loc='$loc', manpower='$man' WHERE id='$id'";
		$conn->query($sql);
		echo "<script>alert('Project has been Edited!')</script><script>window.location.href = 'main.php';</script>";
	break;
	case "deletep":
		$id = $_POST['id'];
		$sql = "DELETE FROM tbl_projects WHERE id = '$id'";
		$conn->query($sql);
		echo "<script>alert('Project has been Removed!')</script><script>window.location.href = 'deletep.php';</script>";
	break;

	case "addkit":
		date_default_timezone_set('Asia/Manila');
		if ($login_session == 'admin')
		{
			$barcode = $_POST['barcode'];
			$kitname = $_POST['kitname'];
			$packsize = $_POST['packsize'];
			$location = $_POST['location'];
			$remarks = $_POST['remarks'];
			$status = $_POST['status'];
			$date = date("F j, Y, g:i a");
			$sql = "INSERT INTO tbl_inventory (barcode, kitname, pack_size, location, status, remarks, date_added) VALUES ('$barcode', '$kitname', '$packsize', '$location', '$remarks', '$status', '$date')";
			$conn->query($sql);
			echo "<script>alert('Successfully added to database!')</script><script>window.location.href = 'addkit.php';</script>";	
		}
		else
		{
			echo "<script>alert('You have no permission to Add Kit!!')</script><script>window.location.href = 'addkit.php';</script>";
		}
		
	break;

	case "kitrequest":
		date_default_timezone_set('Asia/Manila');
		$barcode = $_POST['barcode'];
		$kitname = $_POST['kitname'];
		$location = $_POST['location'];
		$remarks = $_POST['remarks'];
		$reqdate = date("F j, Y, g:i a");
		$sql = "INSERT INTO tbl_requests (barcode, kit_name, location, req_date, requestor, remarks) VALUES ('$barcode', '$kitname', '$location', '$reqdate', '$login_session', '$remarks')";
			$conn->query($sql);
		echo "<script>alert('Request Sent!')</script><script>window.location.href = 'addrequest.php';</script>";
	break;

	case "appdec":
		$apprej = $_POST['apprej'];
		if ($apprej == "APPROVE") {
			$status = "APPROVED";
		}
		elseif ($apprej == "REJECT") {
			$status = "REJECTED";
		}

		$id = $_POST['reqid'];
		$remarks = $_POST['remarks'];
		$sql = "UPDATE tbl_requests SET status='$status', remarks='$remarks' WHERE id='$id'";
		$conn->query($sql);
		echo "<script>window.location.href = 'request.php';</script>";
	break;

	case "delreq":
		$id = $_POST['delid'];
		$sql = "SELECT requestor FROM tbl_requests WHERE id='$id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if ($login_session == $row['requestor'] || $login_session == 'admin') {
			$sql = "DELETE FROM tbl_requests WHERE id = '$id'";
			$conn->query($sql);
		}
		else
		{
			echo "<script>alert('You are not allowed to delete this request')</script><script>window.location.href = 'deleterequest.php';</script>";
		}
		
		
		echo "<script>window.location.href = 'deleterequest.php';</script>";
	break;
}
?>