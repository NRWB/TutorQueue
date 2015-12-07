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
    Auth::checkGreeterAuthentication();
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
    $this->View->renderWithoutHeaderAndFooter('greeter/index');
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
  public function updateTable() {
    $this->View->renderWithoutHeaderAndFooter('greeter/updateTable');
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
  public function updateTable2() {
    $this->View->renderWithoutHeaderAndFooter('greeter/updateTable2');
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
  public function editView() {
    $this->View->renderWithoutHeaderAndFooter('greeter/editView');
  }

 // EDIT for use in the editing of REQUESTS in the tutor queue.
  /**
   * @function 
   * @public
   * @static
   * @returns NONE
   * @desc
   * @param {string} foo Use the 'foo' param for bar.
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
