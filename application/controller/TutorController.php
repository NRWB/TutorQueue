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

  /**
   * This method controls what happens when you move to /tutor or /admin/index in your app.
   */
  public function helpPanel() {
    $this->View->render('tutor/panel');
  }

}
