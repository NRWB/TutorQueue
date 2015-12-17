<?php

/**
 * @author Nick B.
 * @class TutorController
 * @classdesc The TutorController class.
 * @extends Controller
 * @license GNU GENERAL PUBLIC LICENSE
 * @todo NONE
 */
class TutorController extends Controller {

  /**
   * @function __construct
   * @public
   * @returns NONE
   * @desc Construct this object by extending the basic Controller class.
   * @param NONE
   * @example NONE
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
   * @function index
   * @public
   * @returns NONE
   * @desc NONE
   * @param NONE
   * @example NONE
   */
  public function index() {
    $this->View->renderEx('tutor/index');
  }

  /**
   * @function helpPanel
   * @public
   * @returns NONE
   * @desc This method controls what happens when you move to /tutor or /admin/index in your app.
   * @param NONE
   * @example NONE
   */
  public function helpPanel() {
    if (TutorModel::confirmTutorCode()) {
      self::index();
//      Redirect::to('tutor/index');
    } else {
//      self::index();
//      $this->View->renderWithoutHeaderAndFooter('student/index');
      Redirect::to('index/index');
    }
  }

  /**
   * @function leaveHelpPanel
   * @public
   * @returns NONE
   * @desc NONE
   * @param NONE
   * @example NONE
   */
  public function leaveHelpPanel() {
//    TutorModel::logoutTimeoutTutor();
    Redirect::to('index/index');
  }

  /**
   * @function updateTableTutors
   * @public
   * @returns NONE
   * @desc NONE
   * @param NONE
   * @example NONE
   */
  public function updateTableTutors() {
    $this->View->renderEx('tutor/updateTableTutors');
  }

}
