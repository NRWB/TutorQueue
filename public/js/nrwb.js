/**
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

function postRequest() {
  var btn = document.getElementById('studentSubmit');
  btn.onchange = function() {
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var tableNo = 1;
    var subject = document.getElementById('subjectDropDownID');
    var subSubj = document.getElementById('subSubjectDropDownID');
    var tutorPr = document.getElementById('requestedTutorID');
    xmlhttp.open("POST", "serviceRequest.php?tbl="+tableNo
    +"&subj="+subject
    +"&subsubj="+subSubj
    +"&tut="+tutorPr,
    true);
    xmlhttp.send();
  }
}
*/
