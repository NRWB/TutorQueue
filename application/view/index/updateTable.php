<?php
  $database = DatabaseFactory::getFactory()->getConnection();
  $query = $database->prepare("SELECT * FROM qscQueue.tblRequests WHERE serviceState = 'wait'");
  $query->execute();
  $result = $query->fetchAll();
  echo "<thead><tr><th>Table Number</th><th>Subject</th><th>Sub-Subject</th><th>Requested Tutor</th></tr></thead>";
  foreach ($result as $record) {
    echo "<tr><td>";
    echo $record->tableNo;
    echo "</td><td>";
    echo $record->subject;
    echo "</td><td>";
    echo $record->subSubject;
    echo "</td><td>";
    echo $record->tutorRequested;
    echo "</td></tr>";
  }
?>

