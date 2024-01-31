# PHP---File-browser
Simple file browser created using PHP 8
- List all files inside of folders
- Download files 

------ HOW TO USE ? ------
1. Place files into the htdocs if you are using Apache server
2. Place your files into -> src directory
3. (optional) Before use, Please delete the .txt file in the src directory

------ USAGE ------
1. Click on file name to start download, if file is in PDF format the file will open in new window
2. To prevent files (Hide - files/folders) from being displayed, add the name of the file/folder into the $filesToIgnore array inside FileTable.php
   (File - Name of File + extension, Folder - Name of the folder )
4. To change/add file icons put them inside the icons folder located in the Components directory
5. To add file extensions/images add them inside the returnFileExtensionAndImage($dir) inside the FileReader.php located in the Components directory
6. To scan the current directory the index.php is currently located in replace $directoryToScan = 'src' with $directoryToScan = './'; 
7. To scan a directory of your choosing replace $directoryToScan = 'src' with $directoryToScan = 'Name of directory to scan'
  
  
!!! WARNING !!!
DUE TO CODE INCOMPATABILITY DO NOT USE ON PHP OLDER THAN PHP 8 (Unless you modify the files)

![browser1](https://user-images.githubusercontent.com/81091191/145600990-822b05ea-e6e8-453f-a055-cf941007ea17.PNG)
![browser2](https://user-images.githubusercontent.com/81091191/145600998-6e6a30cf-5490-44a7-af15-72d6a6c20161.PNG)
![browser4](https://user-images.githubusercontent.com/81091191/145601009-70712dfd-1dba-47b0-81b4-1f9cd0441267.PNG)
![browser5](https://user-images.githubusercontent.com/81091191/145601017-4260f9f9-352a-415a-b8e5-63c9f22f8087.PNG)
