<?php
// Standard GPL and phpdocs
namespace local_cohortbulkupload\output;                                                                                                         
 
use renderable;                                                                                                                     
use renderer_base;                                                                                                                  
use templatable;                                                                                                                    
use stdClass;                                                                                                                       

class index_page implements renderable, templatable {     
                                                                          
    /** @var string $sometext Some text to show how to pass data to a template. */                                                  
    var $cohort_details;                                                                                                           

    public function __construct($cohort_details=null) {                                                                                        
        $this->cohort_details = $cohort_details;  
	                                                                                            
    }
 
    /**                                                                                                                             
     * Export this data so it can be used as the context for a mustache template.                                                   
     *                                                                                                                              
     * @return stdClass                                                                                                             
     */                                                                                                                             
    public function export_for_template(renderer_base $output) {     
               
        $data = new stdClass(); 
        if($this->cohort_details != false) {
            $data->empty = 0;
            $data->cohorts                  =   array_values($this->cohort_details->cohorts);
            $data->returnurl                       =   $this->cohort_details->returnurl;
            $data->siteUrl                       =   $this->cohort_details->siteUrl;
        } else {
           $data->empty = 1;
        }
        return $data;                                                                                                               
    }
}
