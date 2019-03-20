<?php
$servername="localhost";
$username="root";
$password="";
$dbname="dscappathon";

$con=NULL;
try{
	$con=new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


	$stmtEmailIsUnique=$con->prepare("SELECT email FROM participant where email=:var_email LIMIT 1");
	$stmtEmailIsUnique->bindParam(':var_email', $GLOBALS['args']['email']);

	$stmtTeamNameIsUnique=$con->prepare("SELECT teamid FROM teams where teamid=:var_teamid LIMIT 1");
	$stmtTeamNameIsUnique->bindParam(':var_teamid', $GLOBALS['args']['teamid']);


	$stmtCreateTeam=$con->prepare("INSERT INTO teams values(:var_teamid,:var_pass, '1')");
	$stmtCreateTeam->bindParam(':var_teamid', $GLOBALS['args']['teamid']);
	$stmtCreateTeam->bindParam(':var_teampass', $GLOBALS['result']['teampass']);

	$stmtInsertUser=$con->prepare("INSERT INTO participant values(:var_name,:var_email,:var_phone,:var_institute,:var_city,:var_acmd,:var_trans,:var_teamid,'',:var_leader,:var_pass)");
	$stmtInsertUser->bindParam(':var_name', $GLOBALS['args']['name']);
	$stmtInsertUser->bindParam(':var_email', $GLOBALS['args']['email']);
	$stmtInsertUser->bindParam(':var_phone', $GLOBALS['args']['phone']);
	$stmtInsertUser->bindParam(':var_institute', $GLOBALS['args']['institute']);
	$stmtInsertUser->bindParam(':var_city', $GLOBALS['args']['city']);
	$stmtInsertUser->bindParam(':var_acmd', $GLOBALS['args']['acmd']);
	$stmtInsertUser->bindParam(':var_trans', $GLOBALS['args']['trans']);
	$stmtInsertUser->bindParam(':var_teamid', $GLOBALS['args']['teamid']);
	$stmtInsertUser->bindParam(':var_leader', $GLOBALS['args']['leader']);
	$stmtInsertUser->bindParam(':var_pass', $GLOBALS['args']['pass']);
	$stmtInsertUser->bindParam(':var_teampass', $GLOBALS['result']['teampass']);

	$stmtAuthenticateForTeam=$con->prepare("SELECT teamid FROM teams where teamid=:var_teamid AND pass=:var_teampass AND count<5 LIMIT 1");
	$stmtAuthenticateForTeam->bindParam(':var_teamid', $GLOBALS['args']['teamid']);
	$stmtAuthenticateForTeam->bindParam(':var_teampass', $GLOBALS['args']['teampass']);

	$stmtAuthenticateUser=$con->prepare("SELECT 	name,email,phone,institute,city,acmd,trans,teamid,leader FROM participant where email=:var_email AND pass=:var_pass  LIMIT 1");
	$stmtAuthenticateUser->bindParam(':var_email', $GLOBALS['args']['email']);
	$stmtAuthenticateUser->bindParam(':var_pass', $GLOBALS['args']['pass']);

	$stmtGetTeammates=$con->prepare("SELECT name,email,phone,leader FROM participant where teamid=:var_teamid  LIMIT 4");
	$stmtGetTeammates->bindParam(':var_teamid', $GLOBALS['intermediates']['teamid']);
}catch(PDOException $e){
	echo "Connection Failed".$e;
}
?>
