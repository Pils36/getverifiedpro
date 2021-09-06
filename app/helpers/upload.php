<?php
function uploadPhoto()
{
	$dbh = Database::getInstance();
	$myResponse = new Response();
	$newName = genFilename($_FILES["file"]["name"]);
	if (isset($_FILES["file"]["type"])) {
		$validextensions = array("jpeg", "jpg", "png", "PNG", "JPEG", "JPG");
		$temporary = explode(".", $_FILES["file"]["name"]);
		$file_extension = end($temporary);
		if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/JPEG") || ($_FILES["file"]["type"] == "image/PNG") || ($_FILES["file"]["type"] == "image/JPG")) && ($_FILES["file"]["size"] < 10000000)//Approx. 100kb files can be uploaded.
			&& in_array($file_extension, $validextensions)) {
			if ($_FILES["file"]["error"] > 0) {

				//echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
				$myResponse->status = "failed";
				$myResponse->message = $_FILES["file"]["error"];
				return json_encode($myResponse);
			} else {
				//if (file_exists("../resources/pics/" . $_FILES["file"]["name"])) {
				if (file_exists("../resources/pics/" . $newName)) {

					//echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
					$myResponse->status = "failed";
					$myResponse->message = $_FILES["file"]["name"] . " already exists";
					return json_encode($myResponse);
				} else {
					$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
					$targetPath = "../resources/pics/" . $newName;

					

					//$targetPath = "../resources/pics/".$_FILES['file']['name']; // Target path where file is to be stored
					$dd = move_uploaded_file($sourcePath, $targetPath);

					 // Moving Uploaded file
					// echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
					// echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
					// echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
					// echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
					// echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
					$dbh->exec("update tbl_account_individual set photo = '" . $newName . "' where login_id = {$_SESSION['login_id']}");
					$myResponse->status = "success";
					$myResponse->message = "Upload Successful";
					$myResponse->data = array("photo" => $targetPath);
					return json_encode($myResponse);
				}
			}
		} else {
			$myResponse->status = "failed";
			$myResponse->message = "Invalid file Size or Type";
			return json_encode($myResponse);
			//echo "<span id='invalid'>***Invalid file Size or Type***<span>";
		}
	} else {
		return json_encode($myResponse);
	}
}

function genFilename($filename)
{
	//$newName = substr(base64_encode(mcrypt_create_iv(32)), 24);
	$newName = uniqid().time();
	$filename = explode(".", $filename);
	

	//$ext = count($filename);
	$ext = end($filename);
	return $newName . "." . $ext;
}

