<?php

/**
 * @author Nick B.
 * @class AdminController
 * @classdesc The AdminController class.
 * @extends Controller
 * @license GNU GENERAL PUBLIC LICENSE
 * @todo NONE
 */
class AdminController extends Controller {

  /**
   * @function __construct
   * @public
   * @returns NONE
   * @desc Constructs AdminController object by extending the basic Controller class. Checks for the proper admin authentication for entire controller. All methods inside this controller are only accessible for admin users (users of role type/level 7).
   * @param NONE
   * @example NONE
   */
  public function __construct() {
    parent::__construct();
    Auth::checkAdminAuthentication();
  }

  /**
   * @function index
   * @public
   * @returns NONE
   * @desc If moved to /admin or /admin/index, will render following view.
   * @param NONE
   * @example NONE
   */
  public function index() {
    $this->View->renderEx('admin/index');
  }

  /**
   * @function panel
   * @public
   * @returns NONE
   * @desc If moved to /admin/panel, will render following view.
   * @param NONE
   * @example NONE
   */
  public function panel() {
    $this->View->renderEx('admin/panel');
  }

  /**
   * @function editAccounts
   * @public
   * @returns NONE
   * @desc If moved to /admin/editAccounts, will render the following view.
   * @param NONE
   * @example NONE
   */
  public function editAccounts() {
    $this->View->renderEx('admin/editAccounts',
      array('users' => UserModel::getPublicProfilesOfAllUsers())
    );
  }

  /**
   * @function editDropDowns
   * @public
   * @returns NONE
   * @desc If moved to /admin/editDropDowns, will render following view.
   * @param NONE
   * @example NONE
   */
  public function editDropDowns() {
    $this->View->renderEx('admin/editDropDowns',
      array('quicknotes' => AdminModel::getQuickNotes())
    );
  }

  /**
   * @function editPageTimeouts
   * @public
   * @returns NONE
   * @desc If moved to /admin/editPageTimeouts, will render the following view.
   * @param NONE
   * @example NONE
   */
  public function editPageTimeouts() {
    $this->View->renderEx('admin/editPageTimeouts');
  }

  /**
   * @function uploadSchedule
   * @public
   * @returns NONE
   * @desc If moved to /admin/uploadSchedule, will render following view.
   * @param NONE
   * @example NONE
   */
  public function uploadSchedule() {
    $this->View->renderEx('admin/uploadSchedule');
  }

  /**
   * @function dataDump
   * @public
   * @returns NONE
   * @desc If moved to /admin/dataDump, will render the following view.
   * @param NONE
   * @example NONE
   */
  public function dataDump() {
    $this->View->renderEx('admin/dataDump');
  }

  /**
   * @function reqDataDump
   * @public
   * @returns NONE
   * @desc NONE
   * @param NONE
   * @example NONE
   */
  public function reqDataDump() {
    AdminModel::reqDataDump(
      Request::post('start_month_val'),
      Request::post('start_day_val'),
      Request::post('start_year_val'),
      Request::post('end_month_val'),
      Request::post('end_day_val'),
      Request::post('end_year_val')
    );
    Redirect::to("admin/dataDump");
  }

  /**
   * @function actionAccountSettings
   * @public
   * @returns NONE
   * @desc Posts info from user to delete a specific user.
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
