<?php
  $database = DatabaseFactory::getFactory()->getConnection();
  $query = $database->prepare("SELECT * FROM qscQueue.tblRequests WHERE serviceState IN ('wait', 'progress')");
  $query->execute();
  $result = $query->fetchAll();
  echo "<thead><tr><th>Table<br>Number</th><th>Subject</th><th>Sub-Subject</th><th>Requested<br>Tutor</th><th>In<br>Queue</th><th>Being<br>Helped</th><th>Done</th><th>Notes</th><th>Responding<br>Tutor</th><th>Remove</th><th>Add to<br>front</th></tr></thead>";
  foreach ($result as $record) {
    echo "<tr><td>";
    echo $record->tableNo;
    echo "</td><td>";
    echo $record->subject;
    echo "</td><td>";
    echo $record->subSubject;
    echo "</td><td>";
    echo $record->tutorRequested;
    echo "</td><td>";
    echo "<input type='radio' name='prog' value='wait'>";
    echo "</td><td>";
    echo "<input type='radio' name='prog' value='progress'>";
    echo "</td><td>";
    echo "<input type='radio' name='prog' value='done'>";
    echo "</td><td>";
    echo "<input type='text' name='customNotes' title='Notes are saved upon removal'>";
    echo "</td><td>";
    echo $record->helpingTutor;
    echo "</td><td>";
    echo "<input type='checkbox' name='remove' id='rmChkBx'>";
    echo "</td><td>";
    echo "<input type='checkbox' name='addToTop' id='rmAndAddTop'>";
    echo "</td></tr>";
  }
?>

