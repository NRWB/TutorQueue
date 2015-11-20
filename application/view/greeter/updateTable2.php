<?php
  $database = DatabaseFactory::getFactory()->getConnection();
  $query = $database->prepare("SELECT * FROM qscQueue.tblRequests WHERE serviceState IN ('wait', 'progress')");
  $query->execute();
  $result = $query->fetchAll();
  $count = 0;
  echo "<thead><tr><th>Select</th><th>Table Number</th><th>Subject</th><th>Sub-Subject</th><th>Requested Tutor</th><th>Time In</th><th>Wait Time Elapsed</th><th>Help Time Elapsed</th><th>Responding Tutor</th></tr></thead>";
  foreach ($result as $record) {
    echo "<tr><td>";
    $theID = $record->id;
    echo "<input name='hid_id' type='hidden' value='$theID'>";
    echo "<input name='is_checked' type='checkbox'>";
    echo "</td><td>";

    $aaa = $record->tableNo;
    echo "<input name='tbl_no' type='text' placeholder='$aaa' size='3'>";
    echo "</td><td>";

    $bbb = $record->subject;
    echo "<input name='the_subj' type='text' placeholder='$bbb' size='8'>";
    echo "</td><td>";

    $ccc = $record->subSubject;
    echo "<input name='the_sub_subj' type='text' placeholder='$ccc' size='8'>";
    echo "</td><td>";

    $ddd = $record->tutorRequested;
    echo "<input name='the_tut' type='text' placeholder='$ddd' size='8'>";
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

    $v1 = (intval($hd) - intval($hh));
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

