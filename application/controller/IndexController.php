<?php

/**
 * @author Nick B.
 * @class IndexController
 * @classdesc The IndexController class.
 * @extends Controller
 * @license GNU GENERAL PUBLIC LICENSE
 * @todo NONE
 */
class IndexController extends Controller {

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
    Auth::checkStudentAuthentication();
  }

  /**
   * Handles what happens when user moves to
   *  URL/index/index - or - as this is the default controller, also
   *   when user moves to /index or enter your application at base level
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
    $this->View->renderWithoutHeaderAndFooter(
//    $this->View->render(
      'index/index'
    );
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
    $this->View->renderWithoutHeaderAndFooter('index/updateTable');
  }
}
