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

/*
+function ($) {
  'use strict';

  function selectSS() {
    var e = document.getElementById("subjectDropDownID");
    var idNo = parseInt(e.options[e.selectedIndex].value);
    <?php foreach (StudentModel::getSubSubjects($idNo) as $ss) { ?>
      var d = document.getElementById("subSubjectDropDownID");
      d.options[d.options.length] = new Option(<?php $ss->exactName; ?>, <?php $ss->id; ?>);
    <?php } ?>
  };

}
*/

function selectSS() {
  var doc = document.getElementById("subjectDropDownID");
  var idNo = parseInt(doc.options[doc.selectedIndex].value);
  var subs = document.getElementById("subSubjectDropDownID");
  subs.options.length = 0;
  <?php foreach (StudentModel::getSubSubjects($idNo) as $ss) { ?>
    var opt = document.createElement("option");
    opt.text = <?php $ss->exactName; ?>;
    opt.value = <?php $ss->id; ?>;
    var sel = subs.options[subs.options.length];
    subs.add(opt, sel);
  <?php> } ?>
  return subs.options;
}

function postRequest(tableNumber, subject, subSubject, tutorPreference) {

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
  } else {
    // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.open("POST", "serviceRequest.php?tbl="+tableNumber
  +"&subj="+subject
  +"&subsubj="+subSubject
  +"&tut="+tutorPreference,
  true);
  xmlhttp.send();
}
