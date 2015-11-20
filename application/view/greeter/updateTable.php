<?php
  $database = DatabaseFactory::getFactory()->getConnection();
  $query = $database->prepare("SELECT * FROM qscQueue.tblRequests WHERE serviceState IN ('wait', 'progress')");
  $query->execute();
  $result = $query->fetchAll();
  $count = 0;
  echo "<thead><tr><th>Table Number</th><th>Subject</th><th>Sub-Subject</th><th>Requested Tutor</th><th>Time In</th><th>Wait Time Elapsed</th><th>Help Time Elapsed</th><th>Responding Tutor</th></tr></thead>";
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
    echo substr($record->tsRequest,10);
    echo "</td><td>";

    $orig = substr($record->tsRequest,10);
    $hh = substr($orig, 0, 3);
    $mm = substr($orig, 4, 2);
    $ss = substr($orig, 7, 2);

    $curr = date("h:i:s");
    $hd = substr($curr, 0, 3);
    $md = substr($curr, 4, 2);
    $sd = substr($curr, 7, 2);

    $v1 = intval($hd) - intval($hh);
    $v2 = abs(intval($md) - intval($mm));
    $v3 = abs(intval($sd) - intval($ss));
    echo $v1;
    echo ":";
    echo $v2;
    echo ":";
    echo $v3;

    echo "</td><td>";
    echo "-";
    echo "</td><td>";
    echo $record->helpingTutor;
    echo "</td></tr>";
  }
?>

