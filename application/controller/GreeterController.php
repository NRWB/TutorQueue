<?php

/**
 * @author Nick B.
 * @class GreeterController
 * @classdesc The GreeterController class.
 * @extends Controller
 * @license GNU GENERAL PUBLIC LICENSE
 * @todo NONE
 */
class GreeterController extends Controller {

  /**
   * @function __construct
   * @public
   * @returns NONE
   * @desc Construct this object by extending the basic Controller class
   * @param NONE
   * @example NONE
   */
  public function __construct() {
    parent::__construct();
    // special authentication check for the entire controller:
    //   Note the check-ADMIN-authentication!
    // All methods inside this controller are only
    //   accessible for admins (= users that have role type 7)
    Auth::checkGreeterAuthentication();
  }

  /**
   * @function index
   * @public
   * @returns NONE
   * @desc This method controls what happens when you move to /admin or /admin/index in your app.
   * @param NONE
   * @example NONE
   */
  public function index() {
    $this->View->renderEx('greeter/index');
  }

  /**
   * @function updateTable
   * @public
   * @returns NONE
   * @desc NONE
   * @param NONE
   * @example NONE
   */
  public function updateTable() {
    $this->View->renderEx('greeter/updateTable');
  }

  /**
   * @function updateTable2
   * @public
   * @returns NONE
   * @desc NONE
   * @param NONE
   * @example NONE
   */
  public function updateTable2() {
    $this->View->renderEx('greeter/updateTable2');
  }

  /**
   * @function editView
   * @public
   * @returns NONE
   * @desc NONE
   * @param NONE
   * @example NONE
   */
  public function editView() {
    $this->View->renderEx('greeter/editView');
  }

  public function editViewSaver() {
    GreeterModel::editViewSaver(
      Request::post('rec_id'),
      Request::post('tbl_no'),
      Request::post('subj'),
      Request::post('sub_subj'),
      Request::post('tut_req')
    );
    Redirect::to("greeter/index");
  }


  /**
   * @function actionAccountSettings
   * @public
   * @returns NONE
   * @desc EDIT for use in the editing of REQUESTS in the tutor queue.
   * @param NONE
   * @example NONE
   */
  public function actionAccountSettings() {
    AdminModel::setAccountDeletionStatus(
      Request::post('softDelete'),
      Request::post('user_id')
    );
    Redirect::to("admin/editAccounts");
  }
}
