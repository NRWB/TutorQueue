<?php
$servername = "qsctutorqueue.uwb.edu";
$username = "root";
$password = "W9gB9ZaN";
$dbname = "qscQueue";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die('Could not connect: ' . mysqli_error($conn));
}
  $sql = "SELECT * FROM qscQueue.tblRequests";
  $query_result = mysqli_query($conn, $sql);
  echo "<tr><th>table</th><th>subject</th><th>sub subject</th><th>tutor</th></tr>";
  while ($row = mysql_fetch_array($query_result)) {
    echo "<tr>";
    echo "<td>$row[tableNo]</td>";
    echo "<td>$row[subject]</td>";
    echo "<td>$row[subSubject]</td>";
    echo "<td>$row[tutorRequested]</td>";
    echo "</tr>";
  }

mysqli_close($conn);
?>
