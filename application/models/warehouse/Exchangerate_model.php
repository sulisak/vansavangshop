<?php

class Exchangerate_model extends CI_Model {



        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->library('session');


        }

//         public function Add($data)
//         {

// $data['owner_id'] = $_SESSION['owner_id'];
// $data['user_id'] = $_SESSION['user_id'];
// $data['store_id'] = $_SESSION['store_id'];
// if ($this->db->insert("zone", $data)){
// 		return true;
// 	}

//   }


//            public function Update($data)
//         {


// $where = array(
//         'owner_id' => $_SESSION['owner_id'],
//         'zone_id'  => $data['zone_id']
// );

// $this->db->where($where);
// if ($this->db->update("zone", $data)){
//         return true;
//     }

// }



      



           public function Get($data)
        {

            $perpage = $data['perpage'];

            if($data['page'] && $data['page'] != ''){
$page = $data['page'];
            }else{
          $page = '1';      
            }


            $start = ($page - 1) * $perpage;

$querynum = $this->db->query('SELECT *
    
    FROM exchangerate
    WHERE title_name LIKE "%'.$data['searchtext'].'%"
    ORDER BY e_id ASC');


$query = $this->db->query('SELECT *
     FROM exchangerate
    WHERE  title_name LIKE "%'.$data['searchtext'].'%"
    ORDER BY e_id DESC  LIMIT '.$start.' , '.$perpage.'  ');

$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );


$num_rows = $querynum->num_rows();

$pageall = ceil($num_rows/$perpage);




$json = '{"list": '.$encode_data.',
"numall": '.$num_rows.',"perpage": '.$perpage.', "pageall": '.$pageall.'}';

return $json;

        }




        public function Getlist()
        {


$query = $this->db->query('SELECT e_id,title_name
     FROM exchangerate order by e_id ASC');

$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );


$json = '{"list": '.$encode_data.'}';

return $json;

        }

    public function Delete($data)
        {

$query = $this->db->query('DELETE FROM exchangerate  WHERE e_id="'.$data['e_id'].'"');
return true;

        }




    }