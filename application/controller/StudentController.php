<?php

/**
 * @author Nick B.
 * @class StudentController
 * @classdesc The StudentController class.
 * @extends Controller
 * @license GNU GENERAL PUBLIC LICENSE
 * @todo NONE
 */
class StudentController extends Controller {

  /**
   * Construct this object by extending the basic Controller class
   */
  /**
   * @function 
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
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
  /**
   * @function 
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
  public function index() {
//    $this->View->render('student/index',
    $this->View->renderWithoutHeaderAndFooter('student/index',
      array('subjs' => StudentModel::getSubjects())
//      array('subsubjs' => StudentModel::getSubSubjects()),
//      array('activeTutors' => StudentModel::getActiveTutors())
    );
  }


  /**
   function name: 
   description: 
  */
  /**
   * @function 
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
  public function populateSubSubj() {
    $this->View->renderWithoutHeaderAndFooter('student/populateSubSubj');
  }

  /**
   * @function 
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
  public function updateDropDowns() {
    $this->View->render('student/updateDropDowns');
  }

  /**
   * @function 
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
  public function tableSetup() {
    if (intval(Session::get('table_number')[0]) < 0) {
      $this->View->renderWithoutHeaderAndFooter('student/TableSetup');
    } else {
      self::index();
    }
  }

  /**
   * @function 
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
   * @example NONE
   */
  public function table_setup() {
    $verify_table_num = StudentModel::table_num_setup();
    if ($verify_table_num) {
//      self::index();
      Redirect::to('index/index');
    } else {
      Session::add('feedback_negative', 'please enter a different table number');
      self::tableSetup();
    }
  }

}
