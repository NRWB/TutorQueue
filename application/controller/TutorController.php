<?php

class TutorController extends Controller {

  /**
   * Construct this object by extending the basic Controller class
   */
  public function __construct() {
    parent::__construct();
    // special authentication check for the entire controller:
    //   Note the check-Tutor-authentication!
    // All methods inside this controller are only
    //   accessible for Tutor (= users that have role type 2)
    Auth::checkTutorAuthentication();
  }

  public function index() {
    $this->View->renderWithoutHeaderAndFooter('tutor/index');
  }

  /**
   * This method controls what happens when you move to /tutor or /admin/index in your app.
   */
  public function helpPanel() {
    if (TutorModel::confirmTutorCode()) {
      self::index();
//      Redirect::to('tutor/index');
    } else {
//      self::index();
//      $this->View->renderWithoutHeaderAndFooter('student/index');
      Redirect::to('student/index');
    }
  }

  public function leaveHelpPanel() {
    TutorModel::logoutTimeoutTutor();
      Redirect::to('index/index');
  }

  public function updateTableTutors() {
    $this->View->renderWithoutHeaderAndFooter('tutor/updateTableTutors');
  }

}
