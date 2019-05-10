<?php

require_once '../../config.php';
require_once './locallib.php';
$PAGE->set_pagelayout('admin');
//check the context level of the user and check weather the user is login to the system or not
$PAGE->set_context($systemcontext);
require_login();
//require_capability('local/organization:view', $systemcontext);
if ($CFG->forcelogin) {
    require_login();
} else {
    user_accesstime_log();
}
$PAGE->set_url('/local/organization/index.php');
$baseurl = new moodle_url('/local/organization/index.php');
$PAGE->set_title(get_string('pluginname', 'local_organization'));
//Header and the navigation bar
$PAGE->set_heading(get_string('pluginname', 'local_organization'));
$PAGE->navbar->add(get_string('pluginname', 'local_organization'),new moodle_url('/local/organization/'));

echo $OUTPUT->header();
require_login();

if (isguestuser()) {
	//echo $OUTPUT->header();
	print_error('forgotteninvalidurl');
	die;
}
else {

        $locallib = new local_organization();
        $results     = new stdClass();
        $results->organizations = $locallib->get_organization_list();
        $results->siteUrl = $CFG->wwwroot;
        $results->returnurl = $baseurl->out_as_local_url();   
        $output = $PAGE->get_renderer('local_organization');        
        $renderable = new \local_organization\output\index_page($results);
        echo $output->render($renderable);
}
echo $OUTPUT->footer();