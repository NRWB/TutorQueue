<?php
  $database = DatabaseFactory::getFactory()->getConnection();
  $query = $database->prepare("SELECT * FROM qscQueue.tblRequests WHERE serviceState IN ('wait', 'progress', 'done')");
  $query->execute();
  $result = $query->fetchAll();
  $q2 = $database->prepare("SELECT * FROM qscQueue.tblTutorQuickNotes");
  $q2->execute();
  $r2 = $q2->fetchAll();

  echo "
    <thead>
      <tr><th>Table<br>Number</th>
          <th>Subject</th>
          <th>Sub-Subject</th>
          <th>Requested<br>Tutor</th>
          <th>In<br>Queue</th>
          <th>Being<br>Helped</th>
          <th>Done</th>
          <th>Notes</th>
          <th>Responding<br>Tutor</th>
          <th>Remove</th>
          <th>Add to<br>front <b>(disabled<sup>1</sup>)</b></th>
      </tr>
    </thead>
  ";

  foreach ($result as $record) {

    if (intval($record->tableNo) <= 0) {
      continue;
    }

    echo "<tr><td>";

    echo $record->tableNo;

    echo "</td><td>";

    echo $record->subject;

    echo "</td><td>";

    echo $record->subSubject;

    echo "</td><td>";

    echo $record->tutorRequested;

    echo "</td><td>";

    if ($record->serviceState == "wait") {
      echo "<input type='radio' name='$record->id' value='wait' checked='checked'>";
    } else {
      echo "<input type='radio' name='$record->id' value='wait'>";
    }

    echo "</td><td>";

    if ($record->serviceState == "progress") {
      echo "<input type='radio' name='$record->id' value='progress' checked='checked'>";
    } else {
      echo "<input type='radio' name='$record->id' value='progress'>";
    }

    echo "</td><td>";

    // Because done can mean notes still need to be added
    if ($record->serviceState == "done") {
      echo "<input type='radio' name='$record->id' value='done' checked='checked'>";
    } else {
      echo "<input type='radio' name='$record->id' value='done'>";
    }

    echo "</td><td>";

    echo "<input type='text' name='customNotes' title='Notes are saved upon removal'>";
    echo "<select>";
    echo "<option selected='selected'></option>";

    foreach ($r2 as $rec2) {
      echo "<option value='$rec2->qNoteReason'>$rec2->qNoteReason</option>";
    }

    echo "</select>";
    echo "</td><td>";
    echo $record->helpingTutor;
    echo "</td><td>";
    echo "<input type='checkbox' name='removeChkBox' id='$record->id'>";
    echo "</td><td>";
    echo "<input type='checkbox' name='addTopChkBox' id='$record->id' disabled>";
    echo "</td></tr>";
  }
?>
