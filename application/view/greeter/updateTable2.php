<?php
  $database = DatabaseFactory::getFactory()->getConnection();
  $query = $database->prepare("SELECT * FROM qscQueue.tblRequests WHERE serviceState IN ('wait', 'progress')");
  $query->execute();
  $result = $query->fetchAll();
  $count = 0;
  echo "<thead>
          <tr>
            <th>Select</th>
            <th>Table Number</th>
            <th>Subject</th>
            <th>Sub-Subject</th>
            <th>Requested Tutor</th>
            <th>Time In</th>
            <th>Wait Time Elapsed</th>
            <th>Help Time Elapsed</th>
            <th>Responding Tutor</th>
          </tr>
        </thead>";

  foreach ($result as $record) {

    // The unique ID (hidden)
    $theID = $record->id;
    echo "<input name='hid_id' type='hidden' value='$theID'>";

    // Determine if this entry is to be updated
    echo "<tr><td>";
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

    // wait time (counter)
    $orig = substr($record->tsRequest, 10);
    $hh1 = substr($orig, 0, 3); $mm1 = substr($orig, 4, 2); $ss1 = substr($orig, 7, 2);

    $curr = new DateTime("now");
    $str = substr(date_format($curr, 'Y-m-d H:i:s'), 10);
    $hh2 = substr($str, 0, 3); $mm2 = substr($str, 4, 3); $ss2 = substr($str, 7, 3);

    $v1 = intval($hh2) - intval($hh1); // since requests are day by day, no problem here with subtracting values
    $v2 = intval($mm2) - intval($mm1);
    if (intval($v2) < 0) {
      $v2 = intval($v2) + 60;
    }
    $v3 = intval($ss2) - intval($ss1);
    if (intval($v3) < 0) {
      $v3 = intval($v3) + 60;
    }
    echo $v1 . ":" . $v2 . ":" . $v3;

    echo "</td><td>";
    echo "-";
    echo "</td><td>";
    echo $record->helpingTutor;
    echo "</td></tr>";
  }
?>

