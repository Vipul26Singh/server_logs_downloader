<?php
include_once(__DIR__. "/consts.php");

if(isset($_GET['id']) && !empty($_GET['id'])) {
	if(isset($_GET['file']) && !empty($_GET['file'])) {
		readfile(DIRS[$_GET['id']] . "/" .$_GET['file']);
		exit();
	}
}


$path = "/var/www/html/browse_log";

$componentPath = $path . "/Components/";
$componentFileReader = $componentPath . "FileReader.php";
define("COMPONENT_FILE_TABLE", $componentPath . "FileTable.php");

$cssStyle = "./Components/index.css";

include($componentFileReader);
?>


<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

	        <link rel="stylesheet" href=<?=$cssStyle; ?>>
		        <title>File browser</title>
			        <script src="./js/jquery.min.js"></script>
        <link rel="stylesheet" href="./css/jquery.dataTables.min.css">
	        <script src="./js/jquery.dataTables.min.js"></script>

</head>

<?php


if(isset($_GET['id']) && !empty($_GET['id'])) {
	showFiles($_GET['id']);
} else {
	showDirs();
}

function showDirs() {
	foreach(DIRS as $k=>$v) {
		echo "<a href='". BASE_URL . "?id=$k'>$k</a><br/>";
	}
}

function showFiles($id) {
	$directoryToScan = DIRS[$id];
	$dir_id = $id;
	$reader = new FileReader($directoryToScan);
	$target = $reader->removeRootFromPath(!empty($_GET['path']) ? $_GET['path'] : '/');
?>

<body>
    <main class="PageBodyy flex-columnn">
	    <?php include(COMPONENT_FILE_TABLE) ?>
    </main>
</body>
<?php
}

?>

</html>
