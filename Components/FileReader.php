<?php
/**
 * File reader, reads directory and outputs it in an array
 */
class FileReader {

	public function __construct(
		public string $root
    ) {}
	
    /**
     * @param string $path 
     */
    public function removeRootFromPath( $path) {
        $path = preg_replace('/' . preg_quote($this->root, '/') . '/', '', $path);
        $path = $this->cleanPath($path);
        return DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
    }

    /**
     * @param string $path
     */
    public function addRootToPath( $path) {
        $path = $this->removeRootFromPath($path);
        $path = ltrim($path, DIRECTORY_SEPARATOR);
        $root = rtrim($this->root, DIRECTORY_SEPARATOR);
        return $root . DIRECTORY_SEPARATOR . $path;
    }

    /**
     * @param string $dir Directory to load
     */
    public function cleanPath( $dir) {
        $sep = preg_quote(DIRECTORY_SEPARATOR, '/');
        return preg_replace('/\.\.' . $sep . '|\.' . $sep . '/', '', $dir);
    }

    /**
     * @param string $dir Directory to load
     * @return FilesystemIterator|null
     */
    public function readDirectory( $dir) {
        $dir = $this->addRootToPath($dir);

        try {
            return new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS);
        } catch (UnexpectedValueException $exception) {
            return null;
        }
    }

	/** 
	* @param string $size File size in bytes
	* @param int $precision File size conversion precision
	* @return string round($size, $precision).$units[$i] 
	*/

	public function humanFilesize($size, $precision = 1) {
		$units = array(' B',' kB',' MB',' GB',' TB',' PB',' EB',' ZB',' YB');
		$step = 1024;
		$i = 0;
		while (($size / $step) > 0.9) {
			$size = $size / $step;
			$i++;
		}
		return round($size, $precision).$units[$i];
	}

	/** 
	* @param string $file File to load
	* @return string $type <- File type
	* @return string $image <- File image
	*/
	public function returnFileExtensionAndImage($file) {

		$val = strtolower($file);
		switch($val) {
		case "avi":
			$type = "Video file";
			$image = "avi.png";
			break;
		case "bat":
			$type = "Batch file";
			$image = "bat.png";
			break;
		case "css":
			$type = "Cascading Style Sheet";
			$image = "txt.png";
			break;
		case "exe":
			$type = "Executable file";
			$image = "exe.png";
			break;
		case "fla":
			$type = "Flash file";
			$image = "fla.png";
			break;
		case "gif":
			$type = "GIF Image";
			$image = "gif.png";
			break;
		case "html":
			$type = "HTML file";
			$image = "html.png";
			break;
		case "htm":
			$type = "HTM file";
			$image = "html.png";
			break;
		case "jpg":
			$type = "JPEG Image";
			$image = "jpg.png";
			break;
		case "mp3":
			$type = "Music File";
			$image = "mp3.png";
			break;
		case "msg":
			$type = "Email message";
			$image = "msg.png";
			break;
		case "pdf":
			$type = "PDF file";
			$image = "pdf.png";
			break;
		case "psd":
			$type = "Photoshop file";
			$image = "psd.png";
			break;
		case "php":
			$type = "PHP file";
			$image = "php.png";
			break;
		case "ppt":
			$type = "PowerPoint presentation";
			$image = "ppt.png";
			break;
		case "pptx":
			$type = "PowerPoint presentation";
			$image = "ppt.png";
			break;
		case "swf":
			$type = "SWF Flash file";
			$image = "swf.png";
			break;
		case "txt":
			$type = "Text file";
			$image = "txt.png";
			break;
		case "csv":
			$type = "CSV file";
			$image = "txt.png";
			break;

		case "wma":
			$type = "Windows Media Audio";
			$image = "wma.png";
			break;
		case "xls":
			$type = "Excel file";
			$image = "xls.jpg";
			break;
		case "xlsx":
			$type = "Excel file";
			$image = "xls.jpg";
			break;
		case "zip":
			$type = "Zip file";
			$image = "zip.png";
			break;
		case "7zip":
			$type = "Zip file";
			$image = "zip.png";
			break;
		case "zip":
			$type = "Zip file";
			$image = "zip.png";
		case "7z":
			$type = "7Zip file";
			$image = "rar.png";
			break;
		case "doc":
			$type = "Word document";
			$image = "doc.png";
			break;
		case "docx":
			$type = "Word document";
			$image = "doc.png";
			break;
		case "docs":
			$type = "Word document";
			$image = "doc.png";
			break;
		case "rar":
			$type = "Rar file";
			$image = "rar.png";
			break;
		case "log":
			$type = "Log File";
			$image = "txt.png";
			break;
		//--- New Here---//
		default:
			$type = "Unknown file";
			$image = "unknown.jpg";
		}
		return $type . "?" . $image;
	}
}
?>
