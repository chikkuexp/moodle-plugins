<?php
require('../../../config.php');
global $USER, $DB, $CFG;
// require_once($CFG->libdir.'/excel_reader2.php');
// require_once($CFG->libdir.'/SimpleXLSX.php');
require_once("$CFG->dirroot/cohort/lib.php");

// $cohort_id      =   required_param('cohort',  PARAM_INT);  //user_course_id
$name           =   required_param('name', PARAM_TEXT);
$email          =   required_param('email', PARAM_EMAIL);
$phone          =   optional_param('phone', array(), PARAM_TEXT);
$city           =   optional_param('city', array(), PARAM_TEXT);
$street         =   optional_param('street', array(), PARAM_TEXT);
$country        =   optional_param('country', array(), PARAM_TEXT);
$state          =   optional_param('state', array(), PARAM_TEXT);
$zip            =   optional_param('zip', array(), PARAM_TEXT);
$state          =   optional_param('state', array(), PARAM_TEXT);

$returnurl      =   new moodle_url('/local/organization/index.php');

$data = array ( 
    "name"      => $name,
    "email"     => $email,
    "phone"     => $phone,
    "city"      => $city,
    "street"    => $street,
    "country"   => $country,
    "state"     => $state,
    "zip"       => $zip,
    "state"     => $state
);

/*$file           = $_FILES["file_cohort"];
$fileTmp        = $file['tmp_name'];
$fileName       = $file['name'];
$mimeType       = mime_content_type($fileTmp);

$allowedMimeTypes = array('application/vnd.ms-excel ','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if(!in_array($mimeType,$allowedMimeTypes)) {
    $msg = " Invalid file type... Please upload files in xls, xlsx format. ";
    \core\notification::add($msg, \core\output\notification::NOTIFY_ERROR);
    redirect($returnurl);
}

$file_ext   =   strtolower(end(explode('.',$file['name'])));

$filePath   =   $CFG->dataroot."/cohortUpload/".explode('.',$file['name'])[0].time().'.'.$file_ext;
if(move_uploaded_file($fileTmp,$filePath)) {    
    if(!is_readable($filePath)) {
        $msg = ' File is not readable ';
        \core\notification::add($msg, \core\output\notification::NOTIFY_ERROR);
        redirect($returnurl);
    }

    $dataArray = [];
    if ( $xlsx = SimpleXLSX::parse($filePath)) { // For XLSX file type
        list( $num_cols, $num_rows ) = $xlsx->dimension();        
        foreach ( $xlsx->rows( 0 ) as $r ) {            
            for ( $i = 0; $i < $num_cols; $i ++ ) {
                if(! empty($r[$i]))
                    $dataArray[] = $r[$i];                
            }
        }
    } else { // For XLS file type
        $xls        = new Spreadsheet_Excel_Reader($filePath);
        for ($row=1;$row<=$xls->rowcount();$row++) { 
            for ($col=1;$col<=$xls->colcount();$col++) { 
                if(! empty($xls->val($row,$col)))
                $dataArray[] = $xls->val($row,$col);
            }
        }
    }
    $dataArray = array_values(array_unique($dataArray)); // Avoid duplicate email ids
    // echo '<pre>';
    // print_r($dataArray);
    // die('count - valid '.count($dataArray));
    $invalidEmails = [];
    $users = [];
    foreach( $dataArray as $email ) {
        if(!is_email($email)) {
            $invalidEmails[] = $email;
            continue;
        }
        $user = getUser($email);
        if(!$user) {
            $deletedEmails[] = $email;
            continue;
        }
        $users[] = array('id'=>$user->id,'email'=>$user->email,'username'=>$user->username);
    }
    foreach ($users as $user) {
        if (!$DB->record_exists('cohort_members', array('cohortid' => $cohort_id, 'userid' => $user['id']))) {
            cohort_add_member($cohort_id, $user['id']);
        }
    }
    $invalidEmail_notification = '';
    $deletedEmail_notification = '';
    if(count($invalidEmails) > 0 ) {
        $invalidEmail_notification = '<p><strong>Invalid emails are : <br/></strong>'.implode('<br/>',$invalidEmails).'</p>';
    }

    if(count($deletedEmails) > 0 ) {
        $deletedEmail_notification = '<p><strong>Deleted emails are : <br/></strong>'.implode('<br/>',$deletedEmails).'</p>';
    }

    $msg = " Users are successfully assigned to cohort ";
    $msg .= $invalidEmail_notification.$deletedEmail_notification;
    \core\notification::add($msg, \core\output\notification::NOTIFY_SUCCESS);
    redirect($returnurl);
} */
$DB->insert_record('organization', $data, $returnid=true, $bulk=false);

$msg = "Organization added successfully!";
// $msg .= $invalidEmail_notification.$deletedEmail_notification;
\core\notification::add($msg, \core\output\notification::NOTIFY_SUCCESS);
redirect($returnurl);
