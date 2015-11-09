<?php
$table = inval($_GET['tbl']);
$subj = $_GET(['subj']);
$subsubj = $_GET(['subsubj']);
$tut = $_GET(['tut']);

$servername = "qsctutorqueue.uwb.edu";
$username   = "root";
$password   = "W9gB9ZaN";
$dbname     = "qscQueue";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die('Could not connect: ' . mysqli_error($conn));
}

$sql = "INSERT INTO tblRequests
  (tableNo, subject, subSubject, tutorRequested, serviceState)
  VALUES ($table, $subj, $subsubj, $tut, 'wait')";

if (mysqli_query($conn, $sql)) {
  echo "Record added = success.";
} else {
  echo "Error: " . $sql "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
