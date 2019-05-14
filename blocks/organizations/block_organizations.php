<?php	
class block_organizations extends block_base {
	
    public function init() {
        $this->title = get_string('pluginname', 'block_organizations');
    }
    public function instance_allow_multiple() {
        return true;
    }

    function has_config() {
        return false;
    }

    function applicable_formats() {
        return array('all' => true);
    }

    function instance_allow_config() {
        return true;
    }
	
    public function get_content() {
        global $CFG,$USER,$OUTPUT;
        $this->content->text = '';
        $icon = '<img src="'.$OUTPUT->image_url('t/edit ') . '" class="icon" alt="" />';
        
        $this->content->text .= '<tr><td>'.html_writer::tag('a',$icon.'Manage Organizations',array('href'=> $CFG->wwwroot.'/local/organization/index.php')).'</td></tr><br/>';        
        return $this->content;
    }
}
 




 
