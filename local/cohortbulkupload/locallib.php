<?php
require_once './cohort_object.php';

class local_cohortbulkupload {
    
    /*
     * to get enrolled course details of a particular user
     * based on the userID
     * @returns an array of course_object objects
     */
    public function get_cohort_details() {
        global $DB, $USER;
        $cohorts = array(''=>get_string('choosedots'));
        $allcohorts = $DB->get_records('cohort', null, 'name');
        $count = 0;
        foreach ($allcohorts as $c) {
            if (!empty($c->component)) {
                // external cohorts can not be modified
                continue;
            }
            $context = context::instance_by_id($c->contextid);
            if (!has_capability('moodle/cohort:assign', $context)) {
                continue;
            }
            if (empty($c->idnumber)) {
                $cohorts[$c->id] = format_string($c->name);
            } else {
                $cohorts[$c->id] = format_string($c->name) . ' [' . $c->idnumber . ']';
            }
            $cohortObj              = new stdClass();
            $count++;
            $cohortObj->id          = $count;
            $cohortObj->cohortId    = $c->id;
            $cohortObj->cohortName  = $c->name;
            $cohortObj->cohortMembers  = $DB->count_records('cohort_members', array('cohortid'=>$c->id));
            $cohortList[]           = $cohortObj;
        }
        return $cohortList;
    }
}