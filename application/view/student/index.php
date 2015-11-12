<div class="container">
  <h1>Student View</h1>
  <div class="box">
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="text-center">
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">

            <div class="panel-heading">Create a Requests Panel</div>

            <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-default">

                  <div class="panel-body">
                    <div class="table-responsive">

                       <form method="post" action="<?php echo Config::get('URL');?>HelpRequest/create">

                       <table class="table table-bordered table-hover">

                        <tr>
                          <td>Subject (Required)</td>
                          <td>
                            <select name="subj_DD">
                              <!-- this PHP will initially populate the DropDown when the page loads. -->
                              <?php foreach (StudentModel::getSubjects() as $subj) { ?>
                                <option value="<?= $subj->name; ?>"><?= $subj->name; ?></option>
                              <?php } ?>
                            </select>
                          </td>
                        </tr>

                        <tr>
                          <td>Sub-Subject (Optional)</td>
                          <td>
                            <select name="sub_subj_DD">
                            </select>
                          </td>
                        </tr>

                        <tr>
                          <td>Tutor (Optional)</td>
                          <td>
                            <select name="req_tutor_DD">
                            </select>
                          </td>
                        </tr>

                        <tr align="center">
                          <td colspan="2">
                            <input id="student_submit" type="submit" value="submit">
                          </td>
                        </tr>

                      </table>

                      </form>

                    </div> <!-- End "table-responsive" -->
                  </div> <!-- End "panel-body" -->

                  <div align="right">
                    <div class="panel-body">
                      <div class="col-xs-12">Enter Tutor Code:</div>
                      <div class="col-xs-4 col-xs-offset-8"><input type="text" class="form-control" id="tutorcode"></div>
                      <div class="col-xs-12"><button type="button" class="btn btn-default">Enter Tutor Portal</button></div>
                    </div>
                  </div>

                </div> <!-- end "panel panel-default" -->
              </div> <!-- end "col-lg-12" -->
            </div> <!-- end "row" -->

          </div> <!-- end "panel panel-default" -->
        </div> <!-- end "col-lg-12" -->
      </div> <!-- end "row" -->
    </div> <!-- end "text-center" -->


  </div> <!-- end "box" -->
</div> <!-- end "container" -->
