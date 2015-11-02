/*
  function selSubSubj() {
    var e = document.getElementById("subject");
    var idNum = parseInt(e.options[e.selectedIndex].value);

    document.getElementById("subsubject").options.length = 0;

    <?php foreach (StudentModel::getSubSubjects($idNum) as $ss) {?>
      var opt = document.getElementById("subsubject").options;
      opt[opt.length] = new Option(<?php $ss->exactName; ?>, <?php $ss->exactName; ?>);
    <?php } ?>

  }
*/

function selectSS() {
  var e = document.getElementById("subjectDD");
  var idNo = parseInt(e.options[e.selectedIndex].value);
  <?php foreach (StudentModel::getSubSubjects($idNo) as $ss) { ?>
    var optToAdd = document.getElementById("subSubjectID").options;
    optToAdd[optToAdd.length] = new Option(<?php $ss->exactName; ?>, <?php $ss->id; ?>);
  <?php } ?>
}
