<?php
error_reporting(-1);
ini_set('display_errors', 'On');

include('wp-config.php');

$DB_NAME = constant("DB_NAME");
$DB_USER = constant("DB_USER");
$DB_PASSWORD = constant("DB_PASSWORD");
$DB_HOST = constant("DB_HOST");

$CHARLEN = 3;	//一個中文字的長度 byte

libxml_use_internal_errors(true);   //supress warning messages
//================= Ready for MySQL operation =================================
$link = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
if (!$link) {
	echo "error connect:[$DB_HOST][$DB_USER][$DB_PASSWORD][$DB_NAME]\n";
    die("Connection failed: " . mysqli_connect_error());
}

mb_internal_encoding ('utf8');
mysqli_query ($link, "SET CHARACTER SET 'utf8'");
mysqli_query ($link, "SET NAMES 'utf8'");
//================= Ready for MySQL operation =================================

//----------- For command line usage ----------------------
//php importspot.php iShell2Main scenic_spot_C_f.json
if (isset($argv[1])) {
	$_GET['fn'] = $argv[1];
	$infile = $argv[2];
}

//----------- For command line usage ----------------------

$fn = $_GET["fn"];
$cno = $_GET["cno"];

//------ Global variables

//============================
if (!strcmp($fn, "iShell2Main")) {
	$gcnt = 0;
	$d1 = date('m/d/Y h:i:s a', time());
	$t1 = time();

	$contnt = file_get_contents($infile);
	$gcnt += importMain($contnt);

	$t2 = time();
	$d2 = date('m/d/Y h:i:s a', time());	
	debugPrint("From ".date('m/d/Y h:i:s a', $t1)." to ".date('m/d/Y h:i:s a', $t2).", duration:".($t2-$t1), __LINE__);
	debugPrint($gcnt." json records were detected.", __LINE__);	
}
?>
==================================
<?
//---------- Housekeeping

die();

function importMain($json) {
	global $link;
	$value = json_decode($json);
	$cnt = 0;
	//----- Prepare Statement
	$stmtMain  = mysqli_prepare($link, "INSERT INTO mt_scenic_spot (id, name, address, zipcode, region, town, px, py) VALUES (?,?,?,?,?,?,?,?)");
	mysqli_stmt_bind_param($stmtMain, "ssssssdd", $vId, $vName, $vAdd, $vZipcode, $vRegion, $vTown, $vPx, $vPy);				
	//----- Main loop
	if($value) {
		$XMLHead = $value->XML_Head;
		$Infos = $XMLHead->Infos;
		//=========================================        
		// spots
		//=========================================        		
		foreach($Infos->Info as $rkey => $rvalue) {
			if ($rvalue) {
				$vId = $rvalue->Id;	//C1_382000000A_110206
				$vName = $rvalue->Name;	//蘭潭音樂噴泉
				$vAdd = $rvalue->Add;	//嘉義市東區嘉義市山仔頂249-1號
				$vZipcode = $rvalue->Zipcode;	//600
				$vRegion = $rvalue->Region;	//台北市
				$vTown = $rvalue->Town;	//松山區
				$vPx = $rvalue->Px;	//121.533161
				$vPy = $rvalue->Py;	//25.017524

				mysqli_stmt_execute($stmtMain);	
				if (mysqli_stmt_errno($stmtMain)!=0) {
					printf("Error #%d: %s.\n", mysqli_stmt_errno($stmtMain), mysqli_stmt_error($stmtMain));
				} else {
					++$cnt;
				}
			}
		}
	}

	//---------- House keeping
	mysqli_stmt_close($stmtMain);
	
	return $cnt;
}

function debugPrint($str, $lineno=0) {
	global $argv;

	$sLF = "";
	if (isset($argv[1])) {
		$sLF = "\n";
	} else {
		$sLF = "<BR/>";
	}
	if($lineno==0) {
		echo "[".$str."]".$sLF;
	} else {
		echo "(".$lineno.")[".$str."]".$sLF;
	}
}
?>
