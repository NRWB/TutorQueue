<?php

class HelpRequestController extends Controller {

  public function __construct() {
    parent::__construct();
    Auth::checkAuthentication();
  }

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
    Redirect::toDelay('student', '3');
  }
}
