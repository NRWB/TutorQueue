<html>
<body>

<?php
  $c = $_GET['c'];
  $database = DatabaseFactory::getFactory()->getConnection();
  $sql = "SELECT * FROM qscSubjects.tblTutorSubSubjects WHERE id = '".$c."'";
  $query = $database->prepare($sql);
  $query->execute();
  echo $query->rowCount();
?>

</body>
</html>
