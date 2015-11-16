<?php

$id_val = $_GET['subject_ID'];
$result = StudentModel::getSubSubjects(intval($id_val));
foreach ($result as $record) {
  echo "<option>";
  echo $record->["exactName"];
  echo "</option>";
}

?>

<!--
<?php

echo StudentModel::getSubSubjects(Request::post('hidden_subj_DD_ID'));

?>

<?php
  $c = Request::post('subj_DD');
  $database = DatabaseFactory::getFactory()->getConnection();
  $sql = "SELECT * FROM qscSubjects.tblTutorSubSubjects WHERE id = ".$c;
  $results = $query->query($sql);

  foreach ($results as $row) {
    echo "<option>"
    echo $row->["exactName"];
    echo "</option>"
  }
?>
-->
