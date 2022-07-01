<?php
include("session.php");


if($login_session == 'admin')
{
	echo '<script>location.href = "adminviewrequest.php" </script>';
}
else
{
	echo '<script>location.href = "viewrequest.php"</script>';
}

?>