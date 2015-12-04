<?php

/**
 * The admin controller class
 */
class AdminController extends Controller {

  /**
   * Constructs AdminController object by extending the basic Controller class.
   * Checks for the proper admin authentication for entire controller.
   * All methods inside this controller are only accessible for admin users (users of role type/level 7).
   */
  public function __construct() {
    parent::__construct();
    Auth::checkAdminAuthentication();
  }

  /**
   * The index method
   * If moved to /admin or /admin/index, will render following view.
   */
  public function index() {
    $this->View->render('admin/index');
  }

  /**
   * The panel method
   * If moved to /admin/panel, will render following view.
   */
  public function panel() {
    $this->View->renderWithoutHeaderAndFooter('admin/panel');
  }

  /**
   * The editAccounts method
   * If moved to /admin/editAccounts, will render following view.
   */
  public function editAccounts() {
    $this->View->render('admin/editAccounts',
      array('users' => UserModel::getPublicProfilesOfAllUsers())
    );
  }

  /**
   * The editDropDowns method
   * If moved to /admin/editDropDowns, will render following view.
   */
  public function editDropDowns() {
    $this->View->renderWithoutHeaderAndFooter('admin/editDropDowns',
      array('quicknotes' => AdminModel::getQuickNotes())
    );
  }


  public function editPageTimeouts() {
    $this->View->renderWithoutHeaderAndFooter('admin/editPageTimeouts');
  }


  /**
   * The uploadSchedule method
   * If moved to /admin/uploadSchedule, will render following view.
   */
  public function uploadSchedule() {
    $this->View->render('admin/uploadSchedule');
  }

  /**
   * The dataDump method
   * If moved to /admin/dataDump, will render following view.
   */
  public function dataDump() {
    $this->View->renderWithoutHeaderAndFooter('admin/dataDump');
  }

  /**
   *
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
   * The actionAccountSettings method
   * Posts info from user to delete a specific user.
   */
  public function actionAccountSettings() {
    AdminModel::setAccountDeletionStatus(
      Request::post('softDelete'),
      Request::post('user_id')
    );
    Redirect::to("admin/editAccounts");
  }
}
