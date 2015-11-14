

<?php
  $c = $_POST['subject'];
  $database = DatabaseFactory::getFactory()->getConnection();
  $sql = "SELECT * FROM qscSubjects.tblTutorSubSubjects WHERE id = ".$c;
  $results = $query->query($sql);

  foreach ($results as $row) {
    echo "<option>"
    echo $row->["exactName"];
    echo "</option>"
  }
?>

