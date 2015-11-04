<script>
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
}
</script>
