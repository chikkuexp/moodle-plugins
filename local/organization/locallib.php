<?php
require_once './cohort_object.php';

class local_organization {
    
    /*
     * to get enrolled course details of a particular user
     * based on the userID
     * @returns an array of course_object objects
     */
    public function get_organization_list() {
        global $DB, $USER;
        // $cohorts = array(''=>get_string('choosedots'));
        $organizations = $DB->get_records('organization', null, 'name');
        $count = 0;
        foreach ($organizations as $organization) {
            /*if (!empty($c->component)) {
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
            } */
            $orgObj              = new stdClass();
            // $count++;
            $orgObj->id             = $organization->id;
            $orgObj->name           = $organization->name;
            $orgObj->description    = $organization->description;
            $orgObj->email          = $organization->email; //$DB->count_records('cohort_members', array('cohortid'=>$c->id));
            $orgList[]              = $orgObj;
        }
        return $orgList;
    }
}