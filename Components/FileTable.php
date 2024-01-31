<?php 
include_once(__DIR__ . "../consts.php");

$cleanPath = $target;

/**
 * CURRENT DIRECTORY LOCATION DISPLAY FIX
 */
switch (strlen($cleanPath)) {
	case 1:
		$cleanPath[0] = " ";
		break;

	case 2:
		if($cleanPath[0] == "\\" && $cleanPath[1] == "/"){
			$cleanPath[0] = " ";
			$cleanPath[1] = " ";
			$cleanPath[2] = " ";
			break;
		}else {
			$cleanPath[0] = " ";
			break;
		}
	default:
		$cleanPath[0] = " ";
		break;
}

/**
 * HERE WRITE ALL FILES YOU WANT FileReader TO IGNORE
 * - WRITE file + its extension
 * - FOR DIRECTORY WRITE THE NAME OF THE DIRECTORY TO IGNORE
 */
$filesToIgnore = [
	'index.php',
	'index.css',
	'index.html',
	'Restricted',
	'PUT YOUR FILES HERE.txt'
];
?>

<?php if(strlen($target) != 0): ?>
	<p class="CurrentFolderLocation"><?= $cleanPath; ?></p>
<?php else: ?>
	<p class="CurrentFolderLocation"></p>
<?php endif ?>

<table class="FileTable" id="myTable">
    <thead class="TableHead">
        <tr>
			<th>
				<a class="ReturnImg"  href="?path=<?= urlencode($reader->removeRootFromPath(dirname($target))); ?>">
				<img src= "<?=BASE_URL?>/Components/icons/levelup.png" alt="level up"/>
				</a> 
			</th>
            <th>File name</th>
        	<th>File size</th>
			<th>File type</th>
			<th>Last file modification date</th>
        </tr>
		
    </thead>
    <tbody id="tableBody" class="TableBody">			
		<?php if ($results = $reader->readDirectory($target)): ?>
			<?php foreach($results as $result): ?>
				<?php
					$currentFileToCheck = explode("\\",$result);
					$currentFileToCheck = $currentFileToCheck[array_key_last($currentFileToCheck)];
				?>
				<?php if(!in_array($currentFileToCheck,$filesToIgnore)): ?>
					<tr>
						<?php

						// Make the full path user friendly by removing the root directory.
						$user_friendly = $reader->removeRootFromPath($result->getFileInfo());

						//File information
						$fileName = pathinfo($result,PATHINFO_BASENAME);
						$fileInfo = explode("?",($reader->returnFileExtensionAndImage(pathinfo($result,PATHINFO_EXTENSION))),2);
						$fileExtension = $fileInfo[0];
						$fileIcon = ICONS_Path . $fileInfo[1];
						$fileDateModified = explode(" ",date("F d.Y - H:i:s",filemtime($result)),4);
						$fileDateModified = implode(" ",$fileDateModified);

						$type = $result->getType();
							if($type !== 'dir'){
								$fileSize = $reader->humanFilesize(filesize($result));
							}
						?>
	
						<?php if($type === 'dir'): ?>
						<td><img class="FileImage" src="<?=BASE_URL?>/Components/icons/folder.jpg"></td>
							<td>
								<a href="?path=<?= urlencode($user_friendly); ?>"><?= $fileName; ?></a>
							</td>
							<td></td>
							<td></td>
							<td></td>
						<?php else: ?>	
							<td><img class="FileImage" src=<?= $fileIcon; ?> alt="Ikonka souboru"></td>

							<?php if(pathinfo($result,PATHINFO_EXTENSION) == "pdf"): ?>
								<td><a target="_blank" href="<?=$directoryToScan?>/<?= $user_friendly; ?>"><?= $fileName; ?></a></td>
							<?php else: ?>
								<td><a download="<?=$user_friendly?>" href="<?= "?file=$fileName&id=$dir_id"; ?>"><?= $fileName; ?></a></td>
							<?php endif ?>

							<td><?= $fileSize; ?></td>
							<td><?= $fileExtension; ?></td>
							<td><?= $fileDateModified; ?></td>

						<?php endif ?>
					</tr>
				<?php endif ?>
			<?php endforeach ?>
		<?php else: ?>
			<tr>
				<td></td>
				<td>Directory/File doesn't exist</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		<?php endif ?>
    </tbody>
</table>

<script>
	function filterTable() {
	// Declare variables
	let input = document.getElementById("filterInput"),
		filter = input.value.toUpperCase(),
		table = document.getElementById("tableBody"),
		tr = table.getElementsByTagName("tr"),
		td, 
		i, 
		txtValue;


	// Loop through all table rows, and hide those who don't match the search query
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[1];
			if (td) {
				txtValue = td.textContent || td.innerText;
				if (txtValue.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			}
		}
	}
	$(document).ready( function () {
		$('#myTable').DataTable({
		responsive: true,
		"columnDefs": [
	{ "width": "40%", "targets": 1 },
	{ "width": "40%", "targets": 4 },
			{ "orderDataType": "dom-text", "targets": [ 2, 3 ] },

		],
	});
	} );
</script>
