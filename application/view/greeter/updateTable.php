<?php
  $database = DatabaseFactory::getFactory()->getConnection();
  $query = $database->prepare("SELECT * FROM qscQueue.tblRequests WHERE serviceState IN ('wait', 'progress')");
  $query->execute();
  $result = $query->fetchAll();
  $count = 0;
  echo "
    <thead>
      <tr>
        <th>Table Number</th>
        <th>Subject </th>
        <th>Sub-Subject </th>
        <th>Requested Tutor</th>
        <th>Time In</th>
        <th>Wait Time Elapsed</th>
        <th>Help Time Elapsed</th>
        <th>Responding Tutor</th>
      </tr>
    </thead>
  ";
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

    // More info on MySQL timestap = http://dev.mysql.com/doc/refman/5.7/en/datetime.html

    // time in (time stamp)
    echo substr($record->tsRequest, 10);
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

/*
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
*/

    echo "</td><td>";
    echo "-";
    echo "</td><td>";
    echo $record->helpingTutor;
    echo "</td></tr>";
  }
?>
