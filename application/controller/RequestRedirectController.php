<?php

/**
 * @author Nick B.
 * @class RequestRedirect
 * @classdesc The RequestRedirect class.
 * @extends Controller
 * @license GNU GENERAL PUBLIC LICENSE
 * @todo NONE
 */
class RequestRedirect extends Controller {

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
    Auth::checkAuthentication();
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
  public function index() {
    $this->View->render('student/RequestRedirect');
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
  public function RequestRedirect() {
    $this->View->render('student/RequestRedirect');
  }

}
