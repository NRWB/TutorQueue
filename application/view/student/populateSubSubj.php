<?php
  $main_subject = intval($_GET['subject']);
  $database = DatabaseFactory::getFactory()->getConnection();
  $sql = "SELECT * FROM qscSubjects.tblTutorSubSubjects WHERE id = main_subject";
  $query = $database->prepare($sql);
  $query->execute();
  $results = $query->fetchAll();
  foreach ($results as $entry) {
    echo "<option>";
    echo $entry;
    echo "</option>";
  }
?>
