<?php

require_once '../../config.php';
require_once './locallib.php';
$PAGE->set_pagelayout('admin');
//check the context level of the user and check weather the user is login to the system or not
$PAGE->set_context($systemcontext);
require_login();
//require_capability('local/cohortbulkupload:view', $systemcontext);
if ($CFG->forcelogin) {
    require_login();
} else {
    user_accesstime_log();
}
$PAGE->set_url('/local/cohortbulkupload/index.php');
$baseurl = new moodle_url('/local/cohortbulkupload/index.php');
$PAGE->set_title(get_string('pluginname', 'local_cohortbulkupload'));
//Header and the navigation bar
$PAGE->set_heading(get_string('pluginname', 'local_cohortbulkupload'));
$PAGE->navbar->add(get_string('pluginname', 'local_cohortbulkupload'),new moodle_url('/local/cohortbulkupload/'));

echo $OUTPUT->header();
require_login();

if (isguestuser()) {
	//echo $OUTPUT->header();
	print_error('forgotteninvalidurl');
	die;
}
else {

        $locallib = new local_cohortbulkupload();
        $results     = new stdClass();
        $results->cohorts = $locallib->get_cohort_details();
        $results->siteUrl = $CFG->wwwroot;
        $results->returnurl = $baseurl->out_as_local_url();   
        $output = $PAGE->get_renderer('local_cohortbulkupload');        
        $renderable = new \local_cohortbulkupload\output\index_page($results);
        echo $output->render($renderable);
}
echo $OUTPUT->footer();