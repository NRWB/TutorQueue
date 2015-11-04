<div class="container">
  <h1>Student View</h1>
  <div class="box">
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="text-center">
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">

            <div class="panel-heading">
              Create a Requests Panel
            </div>

            <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="table-responsive">

                        <table class="table table-bordered table-hover">
                          <tr>
                            <td>Subject (Required)</td>
                            <td>

                              <form action="updateDropDowns.php" method="post">
                                <select id="subjectDropDownID" onchange="selectSS()">
                                  <option></option>
                                  <?php foreach (StudentModel::getSubjects() as $subj) { ?>
                                    <option value=\"<?= $subj->id; ?>"><?= $subj->name; ?></option>
                                  <?php } ?>
                                </select>
                              </form>

                            </td>
                          </tr>
                          <tr>
                            <td>Sub-Subject (Optional)</td>
                            <td>

<!--
  Note: Cannot work in change to auto-update based off of subject ID
-->
                                <select id="subSubjectDropDownID">
                                  <option></option>
                                  <?php foreach (StudentModel::getSubSubjectsAll() as $subj) { ?>
                                    <option value=\"<?= $subj->id; ?>"><?= $subj->exactName; ?></option>
                                  <?php } ?>
                                </select>


                            </td>
                          </tr>
                          <tr>
                            <td>Tutor (Optional)</td>
                            <td>
                              <select name="requestedTutorID">
                                <option value="opt"></option>
                                <option value="john">John</option>
                                <option value="joe">Joe</option>
                                <option value="jim">Jim</option>
                              </select>
                            </td>
                          </tr>
                          <tr align="center">
                            <td colspan="2">

                      <form action="insertStudent.php" method="post">
                            <input type="submit" value="submit">
                      </form>


                            </td>
                          </tr>
                        </table>

                    </div>
                  </div>

                  <div align="right">
                    <div class="panel-body">

                      <div class="col-xs-12">
                        Enter Tutor Code:
                      </div>

                      <div class="col-xs-4 col-xs-offset-8">
                        <input type="text" class="form-control" id="tutorcode">
                      </div>

                      <div class="col-xs-12">
                        <button type="button" class="btn btn-default">Enter Tutor Portal</button>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>
