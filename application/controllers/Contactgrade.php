<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactgrade extends MY_Controller {

 public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('contactgrade_model');

     if(!isset($_SESSION['owner_id'])){
            header( "location: ".$this->base_url );
        }
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		

$data['tab'] = 'contactgrade';
$data['title'] = 'Contact Grade';
		$this->ownerlayout('ownerbody/contactgrade',$data);



	}





function Add()
    {
 
$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
}		

		$success = $this->contactgrade_model->Add($data);
      
}



 function Update()
    {
 
$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
}		

		$success = $this->contactgrade_model->Update($data);
      
}



    function Get()
    {


 $list = $this->contactgrade_model->Get();
				
		
		if($list)
		{
			echo '{ "list" : '.$list.'}';
		}
		else{
			echo 'no';
		}
      
}






    function Delete()
    {
 
$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
}

$success = $this->contactgrade_model->Delete($data);
      if($success){
      	return true;
      }else{
      	return false;
      }

}


}
