<?php
error_reporting(-1);
ini_set('display_errors', 'On');

include('wp-config.php');

$DB_NAME		= constant("DB_NAME");
$DB_USER		= constant("DB_USER");
$DB_PASSWORD	= constant("DB_PASSWORD");
$DB_HOST		= constant("DB_HOST");
$arrAPIKEY		= constant("MW_APIKEY");

$CHARLEN = 3;	//一個中文字的長度 byte

libxml_use_internal_errors(false);   //supress warning messages
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

//----------- Usage ----------------------
//http://menswalk.prjlife.com/mw_addcnt01.php?apikey=cat&id=C1_315081500H_000009&date=20200504&count=4
$apikey = $_GET["apikey"];
$aid = $_GET["id"];
$adate = $_GET["date"];
$acount = $_GET["count"];

//------ Global variables
$arrCount = array(1, 2, 3, 4);

$arrRegion = array(
"南投縣",
"嘉義市",
"嘉義縣",
"基隆市",
"宜蘭縣",
"屏東縣",
"彰化縣",
"新北市",
"新竹市",
"新竹縣",
"桃園市",
"澎湖縣",
"臺中市",
"臺北市",
"臺南市",
"臺東縣",
"花蓮縣",
"苗栗縣",
"連江縣",
"金門縣",
"雲林縣",
"高雄市"	
);

//============================
if (in_array($apikey, $arrAPIKEY) && in_array($acount, $arrCount)) {
	doInsert($apikey, $aid, $adate, $acount);
} else {
	echo "Invalid call.";
}
?>

<?
//---------- Housekeeping

die();

function doInsert($apikey, $aid, $adate, $acount) {
	global $link;

	//----- Prepare Statement
	$stmtMain  = mysqli_prepare($link, "INSERT INTO mw_mencount_detail (id, cdate, mencount, apikey) VALUES (?,?,?,?)");
	mysqli_stmt_bind_param($stmtMain, "ssds", $aid, $adate, $acount, $apikey);					
	mysqli_stmt_execute($stmtMain);	
	
	if (mysqli_stmt_errno($stmtMain)!=0) {
		printf("Error #%d: %s.\n", mysqli_stmt_errno($stmtMain), mysqli_stmt_error($stmtMain));
	} else {
		echo "Insert done.";
	}
	//---------- House keeping
	mysqli_stmt_close($stmtMain);
}
?>
