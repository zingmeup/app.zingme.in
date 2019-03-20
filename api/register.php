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
		if ($GLOBALS['headers']['reqty']=='reg') {
			return true;
		}
	}
	return false;
}

function getArgs(){
	$argsMissing=false;
	if (isset($_POST['name'])&&!empty($_POST['name'])
	&&isset($_POST['email'])&&!empty($_POST['email'])
	&&isset($_POST['phone'])&&!empty($_POST['phone'])
	&&isset($_POST['institute'])&&!empty($_POST['institute'])
	&&isset($_POST['city'])&&!empty($_POST['city'])
	&&isset($_POST['acmd'])&&!empty($_POST['acmd'])
	&&isset($_POST['trans'])&&!empty($_POST['trans'])
	&&isset($_POST['teamid'])&&!empty($_POST['teamid'])
	&&isset($_POST['teampass'])&&!empty($_POST['teampass'])
	&&isset($_POST['leader'])&&!empty($_POST['leader'])
	&&isset($_POST['password'])&&!empty($_POST['password'])) {
		$GLOBALS['args']['name']=dataCleaner($_POST['name']);
		$GLOBALS['args']['email']=dataCleaner($_POST['email']);
		$GLOBALS['args']['phone']=dataCleaner($_POST['phone']);
		$GLOBALS['args']['institute']=dataCleaner($_POST['institute']);
		$GLOBALS['args']['city']=dataCleaner($_POST['city']);
		$GLOBALS['args']['acmd']=dataCleaner($_POST['acdm']);
		$GLOBALS['args']['trans']=dataCleaner($_POST['trans']);
		$GLOBALS['args']['teamid']=dataCleaner($_POST['teamid']);
		$GLOBALS['args']['teampass']=dataCleaner($_POST['teampass']);
		$GLOBALS['args']['leader']=dataCleaner($_POST['leader']);
		$GLOBALS['args']['password']=dataCleaner($_POST['password']);
	}else{
		$argsMissing=true;
	}
	return !$argsMissing;
}

function emailIsUnique(){
	require $_SERVER['DOCUMENT_ROOT']."/api/nxcon/qnicgfwu.php";
	$stmtEmailIsUnique->execute();
	$stmtEmailIsUnique->setFetchMode(PDO::FETCH_ASSOC);
	$result=$stmtEmailIsUnique->fetchAll();
	$con=null;
	if (count($result)>0) {
			return FALSE;
		}else{
			return TRUE;
	}
	return FALSE;
}
function teamNameIsUnique(){
	require $_SERVER['DOCUMENT_ROOT']."/api/nxcon/qnicgfwu.php";
	$stmtTeamNameIsUnique->execute();
	$stmtTeamNameIsUnique->setFetchMode(PDO::FETCH_ASSOC);
	$result=$stmtTeamNameIsUnique->fetchAll();
	$con=null;
	if (count($result)>0) {
			return FALSE;
		}else{
			return TRUE;
	}
	return FALSE;
}
function createTeam(){
	require $_SERVER['DOCUMENT_ROOT']."/api/hosteler/cnxn/546956327.php";
	if($stmtCreateTeam->execute()){
		$con=null;
		return TRUE;
	}else{
		$con=null;
		return FALSE;
	}
}
function addUserToDatabase(){
	require $_SERVER['DOCUMENT_ROOT']."/api/hosteler/cnxn/546956327.php";
	if($stmtInsertUser->execute()){
		$con=null;
		return TRUE;
	}else{
		$con=null;
		return FALSE;
	}
}
function authForTeam(){
	require $_SERVER['DOCUMENT_ROOT']."/api/nxcon/qnicgfwu.php";
	$stmtAuthenticateForTeam->execute();
	$stmtAuthenticateForTeam->setFetchMode(PDO::FETCH_ASSOC);
	$result=$stmtAuthenticateForTeam->fetchAll();
	$con=null;
	if (count($result)>0) {
			return TRUE;
		}else{
			return FALSE;
	}
	return FALSE;
}

if (checkHeaders()) {
	if (getArgs()) {
		if (emailIsUnique()) {
			if($GLOBALS['args']['leader']=="1"){
				if(teamNameIsUnique()){
						createTeam();
						addUserToDatabase();
				}else{
					$GLOBALS['result']['error']=true;
					$GLOBALS['result']['errorCode']="TNE";
					$GLOBALS['result']['errorMessage']="Team name may not be unique.";
				}
			}else{
				if (authForTeam()) {
					addUserToDatabase();
					updateTeamCount();
				}else{
					$GLOBALS['result']['error']=true;
					$GLOBALS['result']['errorCode']="TAE";
					$GLOBALS['result']['errorMessage']="Team does not Authorize you, please contact Team leader.";
				}
			}
		}else{
			$GLOBALS['result']['error']=true;
			$GLOBALS['result']['errorCode']="EE";
			$GLOBALS['result']['errorMessage']="Email may not be unique.";
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
