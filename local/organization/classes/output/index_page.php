<?php
// Standard GPL and phpdocs
namespace local_organization\output;                                                                                                         
 
use renderable;                                                                                                                     
use renderer_base;                                                                                                                  
use templatable;                                                                                                                    
use stdClass;                                                                                                                       

class index_page implements renderable, templatable {     
                                                                          
    /** @var string $sometext Some text to show how to pass data to a template. */                                                  
    var $organization_details;                                                                                                           

    public function __construct($organization_details=null) {                                                                                        
        $this->organization_details = $organization_details;  
	                                                                                            
    }
 
    /**                                                                                                                             
     * Export this data so it can be used as the context for a mustache template.                                                   
     *                                                                                                                              
     * @return stdClass                                                                                                             
     */                                                                                                                             
    public function export_for_template(renderer_base $output) {     
               
        $data = new stdClass(); 
        if($this->organization_details != false) {
            $data->empty = 0;
            $data->organizations                  =   array_values($this->organization_details->organizations);
            $data->returnurl                       =   $this->organization_details->returnurl;
            $data->siteUrl                       =   $this->organization_details->siteUrl;
        } else {
           $data->empty = 1;
        }
        return $data;                                                                                                               
    }
}
