<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zone extends MY_Controller {


 public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('warehouse/zone_model');

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
		

$data['tab'] = 'zone';
$data['title'] = 'Zone ขาย';
		$this->warehouselayout('warehouse/zone',$data);
}





 function Add()
    {
 
if(!isset($_POST['zone_name']) || $_POST['zone_name']==''){
exit();
}  
$data['zone_name'] = $_POST['zone_name'];
$success = $this->zone_model->Add($data);     
}



 function Update()
    {
 
if(!isset($_POST['zone_name']) || $_POST['zone_name']==''){
exit();
}  
$data['zone_id'] = $_POST['zone_id'];
$data['zone_name'] = $_POST['zone_name'];
$success = $this->zone_model->Update($data);
      
}



    function Get()
    {

$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
}
echo  $this->zone_model->Get($data);

}


 function Getlist()
    {
echo  $this->zone_model->Getlist();

}



	






    function Delete()
    {
 
$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
}

$success = $this->supplier_model->Delete($data);
      if($success){
      	return true;
      }else{
      	return false;
      }

}





	}

