<?php

class AdminController extends Controller {

  /**
   * Construct this object by extending the basic Controller class
   */
  public function __construct() {
    parent::__construct();
    // special authentication check for the entire controller:
    //   Note the check-ADMIN-authentication!
    // All methods inside this controller are only
    //   accessible for admins (= users that have role type 7)
    Auth::checkAdminAuthentication();
  }

  /**
   * This method controls what happens when you move to /admin or /admin/index in your app.
   */
  public function index() {
    $this->View->render('admin/index');
  }

  public function panel() {
    $this->View->renderWithoutHeaderAndFooter('admin/panel');
  }

  public function editAccounts() {
    $this->View->render('admin/editAccounts',
      array('users' => UserModel::getPublicProfilesOfAllUsers())
    );
  }

  public function editDropDowns() {
    $this->View->renderWithoutHeaderAndFooter('admin/editDropDowns',
      array('quicknotes' => AdminModel::getQuickNotes())
    );
  }

  public function uploadSchedule() {
    $this->View->render('admin/uploadSchedule');
  }

  public function dataDump() {
    $this->View->render('admin/dataDump');
  }

  public function actionAccountSettings() {
    AdminModel::setAccountDeletionStatus(
      Request::post('softDelete'),
      Request::post('user_id')
    );
    Redirect::to("admin/editAccounts");
  }
}
