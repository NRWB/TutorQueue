<form name="import" method="post" enctype="multipart/form-data">
  <input type="file" name="file" /><br />
  <input type="submit" name="submit" value="Submit" />
</form>

<?php
  include("uploadSchedule.php");
  if (isset($_POST["submit"])) {
    $file = $FILES['file']['tmp_name'];
    $handle = fopen($file, "r");
    while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
      $name = $filesop[0];
      $email = $filesop[1];
      $sql = mysql_query("INSERT INTO tblTutorShiftSchedule (name, email) VALUES ('$name', '$email')");
    }
    if ($sql) {
    } else {
      echo "Upload Tutor Schedule Error";
    }
  }
?>
