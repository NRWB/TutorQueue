<?php

/**
 * @author Nick B.
 * @class HelpRequestController
 * @classdesc The HelpRequestController class.
 * @extends Controller
 * @license GNU GENERAL PUBLIC LICENSE
 * @todo NONE
 */
class HelpRequestController extends Controller {

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
  public function create() {
/*
    HelpRequestModel::createHelpRequest(
      Request::post('subj_DD'),
      Request::post('sub_subj_DD'),
      Request::post('req_tutor_DD')
    );
*/
    if (HelpRequestModel::createHelpRequest(Request::post('hidden_tbl_num'), Request::post('subj_DD'), Request::post('sub_subj_DD'), Request::post('req_tutor_DD'))) {
      $this->View->render('student/RequestRedirect');
    }
    Redirect::toDelay('index', '3');
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
  public function update() {
    HelpRequestModel::updateEntry(Request::post('name_entry'), Request::post('progress_state'));
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
  public function remove() {
    HelpRequestModel::removeEntry(Request::post('the_id'));
  }

}
