<?php

class StudentController extends Controller {

  /**
   * Construct this object by extending the basic Controller class
   */
  public function __construct() {
    parent::__construct();
    // special authentication check for the entire controller:
    //   Note the check-ADMIN-authentication!
    // All methods inside this controller are only
    //   accessible for admins (= users that have role type 7)
    Auth::checkStudentAuthentication();
  }

  /**
   * This method controls what happens when you move to /admin or /admin/index in your app.
   */
  public function index() {
//    $this->View->render('student/index',
    $this->View->renderWithoutHeaderAndFooter('student/index',
      array('subjs' => StudentModel::getSubjects())
//      array('subsubjs' => StudentModel::getSubSubjects()),
//      array('activeTutors' => StudentModel::getActiveTutors())
    );
  }

  public function populateSubSubj() {
    $this->View->renderWithoutHeaderAndFooter('student/populateSubSubj');
  }

  public function updateDropDowns() {
    $this->View->render('student/updateDropDowns');
  }

}
