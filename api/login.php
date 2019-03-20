<?php
//include 'res/logger.php';
$GLOBALS['timeout']['connection']=15;
$GLOBALS['timeout']['operation']=20;
$GLOBALS['result']['error']=false;
$GLOBALS['result']['errorCode']="";
$GLOBALS['result']['errorMessage']="";
function dataCleaner($dirty){
	$clean=htmlspecialchars(strip_tags(addslashes(trim(filter_var($dirty, FILTER_SANITIZE_STRING)))));
	return $clean;
}

function checkHeaders(){
	$GLOBALS['headers']=getallheaders();
	if (isset($GLOBALS['headers']['reqty'])&&!empty($GLOBALS['headers']['reqty'])){
		if ($GLOBALS['headers']['reqty']=='login') {
			return true;
		}
	}
	return false;
}

function getArgs(){
	$argsMissing=false;
	if (isset($_POST['email'])&&!empty($_POST['email'])
	&&isset($_POST['pass'])&&!empty($_POST['pass'])) {
		$GLOBALS['args']['email']=dataCleaner($_POST['email']);
		$GLOBALS['args']['pass']=dataCleaner($_POST['pass']);
	}else{
		$argsMissing=true;
	}
	return !$argsMissing;
}
function authenticateUser(){
	require $_SERVER['DOCUMENT_ROOT']."/api/nxcon/qnicgfwu.php";
	$stmtAuthenticateUser->execute();
	$stmtAuthenticateUser->setFetchMode(PDO::FETCH_ASSOC);
	$result=$stmtAuthenticateUser->fetchAll();
	$con=null;
	if (count($result)>0) {
		 $GLOBALS['intermediates']['teamid']=$result[0]['teamid'];
		 $GLOBALS['result']['users']['current']=$result[0];
			return TRUE;
		}else{
			return FALSE;
	}
	return FALSE;
}

function getTeammates(){
	require $_SERVER['DOCUMENT_ROOT']."/api/nxcon/qnicgfwu.php";
	$stmtGetTeammates->execute();
	$stmtGetTeammates->setFetchMode(PDO::FETCH_ASSOC);
	$result=$stmtGetTeammates->fetchAll();
	$con=null;
	if (count($result)>0) {
		$GLOBALS['result']['users']['team']=$result;
			return TRUE;
		}else{
			return FALSE;
	}
	return FALSE;
}


if (checkHeaders()) {
	if (getArgs()) {
		if(authenticateUser()){
			getTeammates();
		}else{
			$GLOBALS['result']['error']=true;
			$GLOBALS['result']['errorCode']="IEP";
			$GLOBALS['result']['errorMessage']="Wrong Email or Password";
		}

	}else{
		$GLOBALS['result']['error']=true;
		$GLOBALS['result']['errorCode']="IAE";
		$GLOBALS['result']['errorMessage']="Invalid Argument types";
	}
}else{

	$GLOBALS['result']['error']=true;
	$GLOBALS['result']['errorCode']="IHE";
	$GLOBALS['result']['errorMessage']="Invalid Headers";
}

echo json_encode($GLOBALS['result']);
