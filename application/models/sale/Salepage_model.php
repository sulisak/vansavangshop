<?php

class Salepage_model extends CI_Model {



        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->library('session');


        }

 public function Getrunnolast()
        {

$query = $this->db->query('SELECT sale_runno
    FROM sale_list_header
    WHERE owner_id="'.$_SESSION['owner_id'].'"
    ORDER BY ID DESC LIMIT 1');
$encode_data = $query->result_array();
return $encode_data;


        }




	 public function Getrunnolast_quo()
        {

$query = $this->db->query('SELECT sale_runno
    FROM quotation_list_header
    WHERE owner_id="'.$_SESSION['owner_id'].'"
    ORDER BY ID DESC LIMIT 1');
$encode_data = $query->result_array();
return $encode_data;


        }




        public function Getnumforcuslast()
               {

       $query = $this->db->query('SELECT number_for_cus
           FROM branch
           WHERE branch_id="'.$_SESSION['branch_id'].'" LIMIT 1');
       $encode_data = $query->result_array();
       return $encode_data;


               }



// query correct ==============
           public function Getproductlist()
        {

$query1 = $this->db->query('SELECT
    wl.product_id as product_id,
    wl.product_code as product_code,
    wl.product_name as product_name,
    wl.product_des as product_des,
    wl.product_score as product_score,
    wl.product_image as product_image,
    wl.product_price as product_price,
    wl.product_wholesale_price as product_wholesale_price,
	wl.product_price3 as product_price3,
	wl.product_price4 as product_price4,
	wl.product_price5 as product_price5,
  e.e_id,
  e.title_name,
  e.rate,
    wl.product_price_discount as product_price_discount,
    IFNULL((SELECT s.product_stock_num FROM stock as s WHERE s.product_id=wl.product_id AND s.branch_id="'.$_SESSION['branch_id'].'" LIMIT 1), "0") as product_stock_num,
    wl.product_price_value as product_price_value,
    wc.product_category_id as product_category_id,
    wc.product_category_name as product_category_name,
    wl.product_rank as product_rank
    FROM wh_product_list  as wl
    LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
    LEFT JOIN exchangerate as e on e.e_id=wl.e_id
    WHERE wl.owner_id="'.$_SESSION['owner_id'].'" AND wl.product_rank !="0"
    ORDER BY wl.product_rank ASC');
	
	// query correct ==============
	
	$query2 = $this->db->query('SELECT
    wl.product_id as product_id,
    wl.product_code as product_code,
    wl.product_name as product_name,
    wl.product_des as product_des,
    wl.product_score as product_score,
    wl.product_image as product_image,
    wl.product_price as product_price,
    wl.product_wholesale_price as product_wholesale_price,
	wl.product_price3 as product_price3,
	wl.product_price4 as product_price4,
	wl.product_price5 as product_price5,
    wl.product_price_discount as product_price_discount,
    IFNULL((SELECT s.product_stock_num FROM stock as s WHERE s.product_id=wl.product_id AND s.branch_id="'.$_SESSION['branch_id'].'" LIMIT 1), "0") as product_stock_num,
    wl.product_price_value as product_price_value,
    wc.product_category_id as product_category_id,
    wc.product_category_name as product_category_name,
    wl.product_rank as product_rank,
    wl.e_id,
    e.title_name,
    e.rate
    FROM wh_product_list  as wl
    LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
    LEFT JOIN exchangerate as e on e.e_id=wl.e_id
    WHERE wl.owner_id="'.$_SESSION['owner_id'].'"
    ORDER BY wl.product_id ASC LIMIT 17');
	
	if($query1->num_rows() > 0){
		$qq = $query1;
	}else{
		$qq = $query2;
	}
	
$encode_data = json_encode($qq->result(),JSON_UNESCAPED_UNICODE );

return $encode_data;

}
// query correct ===============

          public function Getproductlistcat($data)
        {

$query = $this->db->query('SELECT
    wl.product_id as product_id,
    wl.product_code as product_code,
    wl.product_name as product_name,
    wl.product_des as product_des,
    wl.product_score as product_score,
    wl.product_image as product_image,
    wl.product_price as product_price,
	wl.product_wholesale_price as product_wholesale_price,
	wl.product_price3 as product_price3,
	wl.product_price4 as product_price4,
	wl.product_price5 as product_price5,
    wl.product_price_discount as product_price_discount,
    IFNULL((SELECT s.product_stock_num FROM stock as s WHERE s.product_id=wl.product_id AND s.branch_id="'.$_SESSION['branch_id'].'" LIMIT 1), "0") as product_stock_num,
    wl.product_price_value as product_price_value,
    wc.product_category_id as product_category_id,
    wc.product_category_name as product_category_name,
    wl.product_rank as product_rank,
    wl.e_id,
    e.title_name,
    e.rate
    FROM wh_product_list  as wl
    LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
    LEFT JOIN exchangerate as e on e.e_id=wl.e_id
    WHERE wl.owner_id="'.$_SESSION['owner_id'].'" AND wc.product_category_id="'.$data['product_category_id'].'"
    ORDER BY wl.product_id ASC');
$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }
// correct =============

public function Searchproductlist($data)
        {

$query = $this->db->query('SELECT
    wl.product_id as product_id,
    wl.product_code as product_code,
    wl.product_name as product_name,
    wl.product_des as product_des,
    wl.product_score as product_score,
    wl.product_image as product_image,
    wl.product_price as product_price,
    wl.product_wholesale_price as product_wholesale_price,
	wl.product_price3 as product_price3,
	wl.product_price4 as product_price4,
	wl.product_price5 as product_price5,
    wl.product_price_discount as product_price_discount,
    IFNULL((SELECT s.product_stock_num FROM stock as s WHERE s.product_id=wl.product_id AND s.branch_id="'.$_SESSION['branch_id'].'" LIMIT 1), "0") as product_stock_num,
    wl.product_price_value as product_price_value,
    wc.product_category_id as product_category_id,
    wc.product_category_name as product_category_name,
    wl.product_rank as product_rank,
    e.e_id,
    e.title_name,
    e.rate
    FROM wh_product_list  as wl
    LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
    LEFT JOIN exchangerate as e on e.e_id=wl.e_id
    WHERE wl.owner_id="'.$_SESSION['owner_id'].'" AND wl.product_name LIKE "%'.$data['searchproduct'].'%" OR wl.owner_id="'.$_SESSION['owner_id'].'" AND wl.product_code LIKE "%'.$data['searchproduct'].'%"
    ORDER BY LENGTH(wl.product_code) ASC ,CONVERT( wl.product_name USING tis620 ) ASC');
$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }

// ok =======

        public function Findproduct($data)
        {

$cansale = '0';

// origin =========
// $queryfirst = $this->db->query('SELECT * FROM wh_product_list WHERE product_code="'.$data['product_code'].'"');
// update ======

// $queryfirst = $this->db->query('SELECT wh.*, e.e_id, e.title_name, e.rate
// FROM wh_product_list AS wh
// LEFT JOIN exchangerate AS e ON e.e_id = wh.e_id WHERE wh.product_code="'.$data['product_code'].'"');

$queryfirst = $this->db->query('SELECT wh.*, e.e_id, e.rate,e.title_name
FROM wh_product_list AS wh
LEFT JOIN exchangerate AS e ON e.e_id = wh.e_id WHERE wh.product_code="'.$data['product_code'].'"');
$count_row_queryfirst = $queryfirst->num_rows();
$sn = 0;
// origin =======
$query_sn = $this->db->query('SELECT * 
FROM serial_number as sn 
LEFT JOIN wh_product_list as wl on wl.product_id=sn.product_id
WHERE sn_code="'.$data['product_code'].'" AND sn.status="0" 
AND sn.branch_id="'.$_SESSION['branch_id'].'"
ORDER BY sn_id DESC LIMIT 1');
$count_row_query_sn = $query_sn->num_rows();

// update ============
// $query_sn = $this->db->query('SELECT sn.*,e.title_name,e.rate,wl.e_id
// FROM serial_number as sn 
// LEFT JOIN wh_product_list as wl on wl.product_id=sn.product_id
// LEFT JOIN exchangerate as e on e.e_id=wl.e_id
// WHERE sn.sn_code="'.$data['product_code'].'" AND sn.status="0" 
// AND sn.branch_id="'.$_SESSION['branch_id'].'"
// ORDER BY sn.sn_id DESC LIMIT 1');
// $count_row_query_sn = $query_sn->num_rows();
// update ============

if($count_row_queryfirst == 0){

if($count_row_query_sn==1){

foreach ($query_sn->result() as $row)
{	
$data['product_code'] = $row->product_code;
$sn = $row->sn_code;
}

}

}

if($count_row_queryfirst == 0 && $count_row_query_sn == 0){
$querydws = $this->db->query('SELECT * FROM wh_product_dws');

foreach ($querydws->result() as $row)
{
	$barcode_start = $row->barcode_start;
	$barcode_end = $row->barcode_end;
	$w_start = $row->w_start;
	$w_end = $row->w_end;
	$w_dc = $row->w_dc;
	$price_start = $row->price_start;
	$price_end = $row->price_end;
	$price_dc = $row->price_dc;
    $barcode_dws = substr($data['product_code'], $barcode_start-1 ,$barcode_end-$barcode_start+1);
	
}

//echo $barcode_dws;

// original ---------------------

// $queryfirst2 = $this->db->query('SELECT * FROM wh_product_list WHERE product_code="'.$barcode_dws.'"');
// ---------------------
// update --------------------
$queryfirst2 = $this->db->query('SELECT w.*,e.title_name FROM wh_product_list as w join exchangerate as e 
on e.e_id=w.e_id WHERE w.product_code="'.$barcode_dws.'"');
// update --------------------
$count_row_queryfirst2 = $queryfirst2->num_rows();	

if($count_row_queryfirst2 == 0){
$w_dws = 0;
}else{

if($w_start != 0){
	$w_dws = number_format((int)substr($data['product_code'], $w_start-1 ,$w_end-$w_start+1)/(int)str_pad(1,$w_dc+1,0),$w_dc);
	}else{

foreach ($queryfirst2->result() as $row)
{	

	if($row->product_price!="0.00"){
	$price_dws = (int)substr($data['product_code'], $price_start-1 ,$price_end-$price_start+1)/(int)str_pad(1,$price_dc+1,0);
	$w_dws = $price_dws/$row->product_price;
	}else{
	$w_dws = "price not have 0.00";	
	}
}

	}	
	
	$data['product_code'] = $barcode_dws;
}

}else{
	$w_dws = 0;
}
	
// --- origin --------------------------- 
// $query_p_cus = $this->db->query('SELECT *
//     FROM product_price_cus
//     WHERE owner_id="'.$_SESSION['owner_id'].'" AND cus_id="'.$data['cus_id'].'" AND product_code="'.$data['product_code'].'"
//     ORDER BY product_id DESC');
// ---- origin -----------------
// update -----------------------

$query_p_cus = $this->db->query('SELECT pc.*,e.title_name FROM product_price_cus as pc 
left join wh_product_list as w
 on pc.product_code=w.product_code 

join exchangerate as e on e.e_id=w.e_id
    WHERE pc.owner_id="'.$_SESSION['owner_id'].'" AND pc.cus_id="'.$data['cus_id'].'" AND pc.product_code="'.$data['product_code'].'"
    ORDER BY pc.product_id DESC');

// update ------------------------------------
// origin -------------------------------------------------

    // $query_p_cus_group = $this->db->query('SELECT *
    //     FROM product_price_cus_group as pg
    //     LEFT JOIN customer_owner as co on co.customer_group_id=pg.customer_group_id
    //     WHERE pg.owner_id="'.$_SESSION['owner_id'].'"
    //     AND co.cus_id="'.$data['cus_id'].'"
    //     AND pg.product_code="'.$data['product_code'].'"
    //     ORDER BY pg.product_id DESC');
// origin -------------------------------------------------

// update ---------------------------------
    $query_p_cus_group = $this->db->query('SELECT pg.*,e.title_name FROM product_price_cus_group as pg 
    LEFT JOIN wh_product_list as w on pg.product_code=w.product_code
    LEFT JOIN exchangerate as e on e.e_id=w.e_id
    LEFT JOIN customer_owner as co on co.customer_group_id=pg.customer_group_id
    
    WHERE pg.owner_id="'.$_SESSION['owner_id'].'"
        AND co.cus_id="'.$data['cus_id'].'"
        AND pg.product_code="'.$data['product_code'].'"
        ORDER BY pg.product_id DESC');

// update ---------------------------------

// ok ==========

$query = $this->db->query('SELECT
    wl.product_id as product_id,
    wl.product_code as product_code,
    wl.product_name as product_name,
	wl.product_pricebase as product_pricebase,
    wl.popup_pricenum as popup_pricenum,
    wl.product_image as product_image,
    wl.product_des as product_des,
    wl.product_score as product_score,
    wl.product_price as product_price,
    wl.product_wholesale_price as product_wholesale_price,
	wl.product_price3 as product_price3,
	wl.product_price4 as product_price4,
	wl.product_price5 as product_price5,
    wl.product_price_discount as product_price_discount,
    IFNULL((SELECT s.product_stock_num FROM stock as s WHERE s.product_id=wl.product_id AND s.branch_id="'.$_SESSION['branch_id'].'" LIMIT 1), "0") as product_stock_num,
    wl.product_price_value as product_price_value,
    wl.product_num_min as product_num_min,
    wc.product_category_id as product_category_id,
    wc.product_category_name as product_category_name,
    wu.product_unit_name as product_unit_name,
	wl.count_stock as count_stock,
  wl.e_id,
  e.title_name,
  e.rate
    FROM wh_product_list  as wl
    LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
    LEFT JOIN wh_product_unit as wu on wu.product_unit_id=wl.product_unit_id
    LEFT JOIN exchangerate  as e on e.e_id=wl.e_id
    WHERE wl.owner_id="'.$_SESSION['owner_id'].'" AND  wl.product_code="'.$data['product_code'].'"
    ORDER BY wl.product_id DESC');
	
	// ok =========
// ok ==========

$query_p = $this->db->query('SELECT
    wl.product_id as product_id,
    wl.product_code as product_code,
    wl.product_name as product_name,
		wl.product_pricebase as product_pricebase,
		wl.popup_pricenum as popup_pricenum,
    wl.product_image as product_image,
    wl.product_des as product_des,
    wl.product_score as product_score,
    pc.product_price_cus as product_price,
    wl.product_wholesale_price as product_wholesale_price,
	wl.product_price3 as product_price3,
	wl.product_price4 as product_price4,
	wl.product_price5 as product_price5,
    wl.product_price_discount as product_price_discount,
    IFNULL((SELECT s.product_stock_num FROM stock as s WHERE s.product_id=wl.product_id AND s.branch_id="'.$_SESSION['branch_id'].'" LIMIT 1), "0") as product_stock_num,
    wl.product_price_value as product_price_value,
    wc.product_category_id as product_category_id,
    wc.product_category_name as product_category_name,
wu.product_unit_name as product_unit_name,
	wl.count_stock as count_stock,
	wl.e_id,
  e.title_name,
  e.rate
    FROM wh_product_list  as wl
    LEFT JOIN product_price_cus as pc on pc.product_id=wl.product_id
LEFT JOIN wh_product_unit as wu on wu.product_unit_id=wl.product_unit_id    
LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
LEFT JOIN exchangerate as e on e.e_id=wl.e_id
    WHERE wl.owner_id="'.$_SESSION['owner_id'].'" AND  wl.product_code="'.$data['product_code'].'" AND pc.cus_id="'.$data['cus_id'].'"
    ORDER BY wl.product_id DESC');

// ok =======

    $query_g = $this->db->query('SELECT
        wl.product_id as product_id,
        wl.product_code as product_code,
        wl.product_name as product_name,
			wl.product_pricebase as product_pricebase,
			wl.popup_pricenum as popup_pricenum,
        wl.product_image as product_image,
        wl.product_des as product_des,
        wl.product_score as product_score,
        pc.product_price_cus_group as product_price,
        wl.product_wholesale_price as product_wholesale_price,
		wl.product_price3 as product_price3,
	wl.product_price4 as product_price4,
	wl.product_price5 as product_price5,
        wl.product_price_discount as product_price_discount,
        IFNULL((SELECT s.product_stock_num FROM stock as s WHERE s.product_id=wl.product_id AND s.branch_id="'.$_SESSION['branch_id'].'" LIMIT 1), "0") as product_stock_num,
        wl.product_price_value as product_price_value,
        wc.product_category_id as product_category_id,
        wc.product_category_name as product_category_name,
wu.product_unit_name as product_unit_name,
		wl.count_stock as count_stock,
		wl.e_id,
    e.title_name,
    e.rate
        FROM wh_product_list  as wl
        LEFT JOIN product_price_cus_group as pc on pc.product_id=wl.product_id
        LEFT JOIN customer_owner as co on co.customer_group_id=pc.customer_group_id
        LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
LEFT JOIN wh_product_unit as wu on wu.product_unit_id=wl.product_unit_id
LEFT JOIN exchangerate as e on e.e_id=wl.e_id
        WHERE wl.owner_id="'.$_SESSION['owner_id'].'" AND  wl.product_code="'.$data['product_code'].'" AND co.cus_id="'.$data['cus_id'].'"
        ORDER BY wl.product_id DESC');

// ok ===

// origin =============================================================
// $query_s_step = $this->db->query('SELECT *
//         FROM product_price_step
//         WHERE product_code="'.$data['product_code'].'"');

// update ---------------------------------------------------------------------------------
        
$query_s_step = $this->db->query('SELECT ps.*,e.title_name FROM  product_price_step as ps join wh_product_list as wh on ps.product_code=wh.product_code
join exchangerate as e on e.e_id=wh.e_id WHERE ps.product_code="'.$data['product_code'].'"');

// update ---------------------------------------------------------------------------------------------------------

$slc_num = $this->db->query('SELECT product_sale_num+0 as product_sale_num
        FROM sale_list_cus2mer
        WHERE product_code="'.$data['product_code'].'"');

$slc_num_row = $slc_num->num_rows();

if($slc_num_row > 0){
foreach($slc_num->result() as $row){
	$num = $row->product_sale_num+1;
}

}else{
$num = 1;
}

// ok =======
$query_step = $this->db->query('SELECT
        wl.product_id as product_id,
        wl.product_code as product_code,
        wl.product_name as product_name,
			wl.product_pricebase as product_pricebase,
			wl.popup_pricenum as popup_pricenum,
        wl.product_image as product_image,
        wl.product_des as product_des,
        wl.product_score as product_score,
        ps.product_price as product_price,
        wl.product_wholesale_price as product_wholesale_price,
		wl.product_price3 as product_price3,
	wl.product_price4 as product_price4,
	wl.product_price5 as product_price5,
        wl.product_price_discount as product_price_discount,
        IFNULL((SELECT s.product_stock_num FROM stock as s WHERE s.product_id=wl.product_id AND s.branch_id="'.$_SESSION['branch_id'].'" LIMIT 1), "0") as product_stock_num,
        wl.product_price_value as product_price_value,
        wc.product_category_id as product_category_id,
        wc.product_category_name as product_category_name,
wu.product_unit_name as product_unit_name,
		wl.count_stock as count_stock,
    wl.e_id,
    e.title_name,
    e.rate
        FROM wh_product_list  as wl
        LEFT JOIN product_price_cus_group as pc on pc.product_id=wl.product_id
        LEFT JOIN customer_owner as co on co.customer_group_id=pc.customer_group_id
        LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
LEFT JOIN wh_product_unit as wu on wu.product_unit_id=wl.product_unit_id
		LEFT JOIN product_price_step as ps on ps.product_code=wl.product_code
		LEFT JOIN exchangerate as e on e.e_id=wl.e_id
        WHERE wl.owner_id="'.$_SESSION['owner_id'].'"
		AND  wl.product_code="'.$data['product_code'].'"
		AND ps.qty_more<="'.$num.'"
		AND ps.qty_less>="'.$num.'"
        ORDER BY wl.product_id DESC');

// ok =========

$query_p_cus_num_rows = $query_p_cus->num_rows();
$query_p_cus_group_num_rows = $query_p_cus_group->num_rows();
$query_s_step_num_rows = $query_s_step->num_rows();


if($query_p_cus_num_rows > 0){

  $encode_data = json_encode($query_p->result(),JSON_UNESCAPED_UNICODE );

}else if($query_p_cus_group_num_rows > 0){
  $encode_data = json_encode($query_g->result(),JSON_UNESCAPED_UNICODE );
}else{
	if($query_s_step_num_rows > 0 && $slc_num_row > 0){
  $encode_data = json_encode($query_step->result(),JSON_UNESCAPED_UNICODE );
}else{
   $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
}

}

// original
// $queryproduct = $this->db->query('SELECT * FROM wh_product_list WHERE product_code="'.$data['product_code'].'"');

// update ========
$queryproduct = $this->db->query('SELECT wh.*,e.e_id,e.title_name,e.rate FROM wh_product_list as wh 
LEFT JOIN exchangerate as e on e.e_id=wh.e_id WHERE wh.product_code="'.$data['product_code'].'" and e.e_id=wh.e_id');
foreach ($queryproduct->result() as $row)
{	
$querystock = $this->db->query('SELECT IFNULL((SELECT product_stock_num FROM stock WHERE product_id="'.$row->product_id.'" LIMIT 1),"0") as product_stock_num');
$querysalelistcus = $this->db->query('SELECT sum(product_sale_num) as product_sale_num FROM sale_list_cus2mer WHERE product_id="'.$row->product_id.'"');
$retstock = $querystock->row();
$retsalelistcus = $querysalelistcus->row();

if($retstock->product_stock_num-$retsalelistcus->product_sale_num > $_SESSION['stock_nosale']){
	$cansale = '1';
}else{
$cansale = '0';
}

}


if($data['product_code']==''){
	$cansale = '1';
}

$encode_data2 = '{"list":'.$encode_data.',"w":"'.$w_dws.'","sn":"'.$sn.'","cansale":"'.$cansale.'"}';

return $encode_data2;

        }





  public function Customer($data)
        {

$query = $this->db->query('SELECT  co.cus_id as cus_id,
  co.cus_name as cus_name, co.cus_tel as cus_tel,
  co.cus_address as cus_address, co.cus_address_postcode as cus_address_postcode,
   co.cus_add_time as cus_add_time,
   co.product_score_all as product_score_all,
   cg.customer_group_id as customer_group_id,
   cg.customer_group_name as customer_group_name,
   IFNULL(cg.customer_group_discountpercent,"0") as customer_group_discountpercent,
   co.credit_limit,
   co.taxnumber,
  IFNULL((SELECT co.credit_limit+SUM(money_changeto_customer) FROM sale_list_header as sh WHERE sh.cus_id=co.cus_id AND pay_type="4"),"") as credit_limit_foruse
    FROM customer_owner as co
    LEFT JOIN owner as ow on ow.owner_id=co.owner_id
    LEFT JOIN customer_group as cg on cg.customer_group_id=co.customer_group_id
    WHERE ow.owner_id="'.$_SESSION['owner_id'].'" and co.cus_name LIKE "%'.$data['cus_name'].'%"
    OR ow.owner_id="'.$_SESSION['owner_id'].'" and co.cus_add_time LIKE "%'.$data['cus_name'].'%"
    OR ow.owner_id="'.$_SESSION['owner_id'].'" and co.cus_tel LIKE "%'.$data['cus_name'].'%"
    ORDER BY co.cus_id DESC LIMIT 20');

$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }
		
		
		
		
		  public function Allcuscourse($data)
        {

$query = $this->db->query('SELECT  
sd.*,sh.cus_id,sh.cus_name,
SUM(uc.used_course_num) AS used_course_num
FROM sale_list_detail as sd
    LEFT JOIN sale_list_header as sh on sh.sale_runno=sd.sale_runno
    LEFT JOIN wh_product_list as wl on wl.product_id=sd.product_id
	LEFT JOIN used_course as uc on uc.product_id=sd.product_id
    WHERE sh.cus_id="'.$data['cus_id'].'" AND wl.is_course="1"
	GROUP BY sd.product_name
	ORDER BY sd.ID DESC');

$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }
		
		
		


        public function Savethiscuscourse($data)
        {

$data['name'] = $_SESSION['name'];
$data['user_id'] = $_SESSION['user_id'];
$data['branch_id'] = $_SESSION['branch_id'];
$data['shift_id'] = $_SESSION['shift_id'];
$data['adddate'] = time();
$this->db->insert("used_course", $data);
}





public function Cuscourse($data)
        {

$query = $this->db->query('SELECT  co.cus_id as cus_id,
  co.cus_name as cus_name, co.cus_tel as cus_tel,
  co.cus_address as cus_address, co.cus_address_postcode as cus_address_postcode,
   co.cus_add_time as cus_add_time,
   co.product_score_all as product_score_all,
   cg.customer_group_id as customer_group_id,
   cg.customer_group_name as customer_group_name,
   IFNULL(cg.customer_group_discountpercent,"0") as customer_group_discountpercent,
   co.credit_limit,
   IFNULL((SELECT sum(wl.is_course) as sc FROM sale_list_header as sh 
   LEFT JOIN sale_list_detail as sd on sd.sale_runno=sh.sale_runno
   LEFT JOIN wh_product_list as wl on wl.product_id=sd.product_id 
   WHERE sh.cus_id=co.cus_id and wl.is_course="1"),"0") as sumcourse,
   IFNULL((SELECT co.credit_limit+SUM(money_changeto_customer) FROM sale_list_header as sh WHERE sh.cus_id=co.cus_id AND pay_type="4"),"") as credit_limit_foruse
    FROM customer_owner as co
    LEFT JOIN owner as ow on ow.owner_id=co.owner_id
    LEFT JOIN customer_group as cg on cg.customer_group_id=co.customer_group_id
    WHERE ow.owner_id="'.$_SESSION['owner_id'].'" and co.cus_name LIKE "%'.$data['cus_name'].'%"
    OR ow.owner_id="'.$_SESSION['owner_id'].'" and co.cus_add_time LIKE "%'.$data['cus_name'].'%"
    OR ow.owner_id="'.$_SESSION['owner_id'].'" and co.cus_tel LIKE "%'.$data['cus_name'].'%"
    ORDER BY co.cus_id DESC LIMIT 20');

$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }



        public function Openbillclosedaylista($data)
                {

        //$dayfrom = strtotime($data['daynow']);
        //$dayto = strtotime($data['daynow'])+86400;

        $query = $this->db->query('SELECT
            wc.product_category_name as product_category_name2,
            sum(sd.product_sale_num*(sd.product_price-sd.product_price_discount)) as product_price2,
            sum(sd.product_sale_num) as product_sale_num2,
            sum(sd.product_price_discount) as product_price_discount2
            FROM wh_product_category  as wc
            LEFT JOIN wh_product_list as wl on wl.product_category_id=wc.product_category_id
            LEFT JOIN sale_list_detail as sd on sd.product_id=wl.product_id

             WHERE sd.shift_id="'.$_SESSION['shift_id_old'].'"
             GROUP BY wc.product_category_name
             ');


        $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );

        return $encode_data;

                }




                public function Openbillclosedaylistb($data)
                {
        //$dayfrom = strtotime($data['daynow']);
        //$dayto = strtotime($data['daynow'])+86400;

        $query2 = $this->db->query('SELECT
            sum(sumsale_price) as sumsale_price2,
            sum(sumsale_discount) as sumsale_discount2,
            sum(sumsale_num) as sumsale_num2,
            sum(discount_last) as discount_last2,
			sum(money_changeto_customer) as money_changeto_customer,
			(SELECT SUM(pr.sumsale_price) FROM product_return_header2 as pr WHERE pr.shift_id="'.$_SESSION['shift_id_old'].'") as money_from_customer
            FROM sale_list_header
        WHERE shift_id="'.$_SESSION['shift_id_old'].'"
             ');

        $encode_data2 = json_encode($query2->result(),JSON_UNESCAPED_UNICODE );
        return $encode_data2;

                }





             public function Openbillclosedaylistc($data)
                {
        //$dayfrom = strtotime($data['daynow']);
        //$dayto = strtotime($data['daynow'])+86400;

        $query3 = $this->db->query('SELECT
            m.pay_type,
            sum(m.money) as sumsale_price2
            FROM morepay as m
            WHERE m.shift_id="'.$_SESSION['shift_id_old'].'"
             GROUP BY m.pay_type ORDER BY m.pay_type ASC
             ');

        $encode_data3 = json_encode($query3->result(),JSON_UNESCAPED_UNICODE );

        return $encode_data3;

                }

                public function Openbillclosedaylistproduct($data)
                {

              $query4 = $this->db->query('SELECT
              sd.product_id,
              sd.product_name,
              sum(sd.product_sale_num*(sd.product_price-sd.product_price_discount)) as product_sale_price,
              sum(sd.product_sale_num) as product_sale_num
              FROM sale_list_detail as sd
              LEFT JOIN wh_product_list as wl on wl.product_id=sd.product_id

              WHERE sd.shift_id="'.$_SESSION['shift_id_old'].'"
              GROUP BY sd.product_name
              ');

              $encode_data4 = json_encode($query4->result(),JSON_UNESCAPED_UNICODE );

              return $encode_data4;

                }




// ---------- original --------------------------------------------------------------
// public function Adddetail($data)
// {
//     $query = $this->db->query('SELECT have_vat
//         FROM wh_product_list
//         WHERE product_id = "'.$data['product_id'].'" LIMIT 1');

//     $querystock = $this->db->query('SELECT * FROM stock
//         WHERE product_id = "'.$data['product_id'].'" 
//         AND branch_id = "'.$_SESSION['branch_id'].'" LIMIT 1');

//     foreach ($querystock->result() as $row) {
//         $data['product_stock_num'] = $row->product_stock_num;
//     }

//     foreach ($query->result() as $row) {
//         $have_vat = $row->have_vat;
//     }

//     $product_price_sale = ($data['product_price'] - $data['product_price_discount']) * $data['product_sale_num'];

//     if ($have_vat == '0') {
//         $price_vat = ($product_price_sale * 100) / ($_SESSION['vat'] + 100) * ($_SESSION['vat'] / 100);
//     } else {
//         $price_vat = 0;
//     }

//     $data['price_vat'] = $price_vat;
//     $data['owner_id'] = $_SESSION['owner_id'];
//     $data['user_id'] = $_SESSION['user_id'];
//     $data['store_id'] = $_SESSION['store_id'];
//     $data['shift_id'] = $_SESSION['shift_id'];
//     $data['branch_id'] = $_SESSION['branch_id'];
//     unset($data['title_name']); // Remove the 'title_name' column from data
//     unset($data['rate']); // Remove the 'title_name' column from data
//     // $data['sumsale_price_kip']=$data['product_price_kip']*$data['product_sale_num'];
//     $this->db->insert('sale_list_detail', $data);


//     $this->db->query('UPDATE sale_list_header
//         SET price_vat_all = price_vat_all + '.$price_vat.'
//         WHERE sale_runno = "'.$data['sale_runno'].'"');
// }
// ---------- original --------------------------------------------------------------
// ------------------ update ------------------------------------------------------

public function Adddetail($data)
{
    $query = $this->db->query('SELECT have_vat
        FROM wh_product_list
        WHERE product_id = "'.$data['product_id'].'" LIMIT 1');

    $querystock = $this->db->query('SELECT * FROM stock
        WHERE product_id = "'.$data['product_id'].'" 
        AND branch_id = "'.$_SESSION['branch_id'].'" LIMIT 1');

    foreach ($querystock->result() as $row) {
        $data['product_stock_num'] = $row->product_stock_num;
    }

    foreach ($query->result() as $row) {
        $have_vat = $row->have_vat;
    }

    $product_price_sale = ($data['product_price'] - $data['product_price_discount']) * $data['product_sale_num'];

    if ($have_vat == '0') {
        $price_vat = ($product_price_sale * 100) / ($_SESSION['vat'] + 100) * ($_SESSION['vat'] / 100);
    } else {
        $price_vat = 0;
    }

    // ----------- try add new ------------------------------

    // $data['sumsale_price_kip'] = $data['product_price_kip']*$data['product_sale_num']; // Assign the value to 'sumsale_price_kip'
    

    $data['product_price_kip'] = $data['product_price_kip']; // Assigning a sample value of 1000, replace it with the appropriate value
    $data['product_sale_num']=$data['product_sale_num'];
$data['sumsale_price_kip'] = $data['product_price_kip'] * $data['product_sale_num'];


    $data['price_vat'] = $price_vat;
    $data['owner_id'] = $_SESSION['owner_id'];
    $data['user_id'] = $_SESSION['user_id'];
    $data['store_id'] = $_SESSION['store_id'];
    $data['shift_id'] = $_SESSION['shift_id'];
    $data['branch_id'] = $_SESSION['branch_id'];
    unset($data['title_name']); // Remove the 'title_name' column from data
    unset($data['rate']); // Remove the 'title_name' column from data
    unset($data['e_id']); // Remove the 'e_id' column from data

    // Additional query to retrieve data from 'sale_list_detail' table
    $query = $this->db->query('SELECT sd.*, from_unixtime(sd.adddate,"%d-%m-%Y %H:%i:%s") as adddate,
    wl.product_weight*sd.product_sale_num as product_weight,e.title_name,e.rate,sd.sumsale_price_kip
        FROM sale_list_detail as sd
      LEFT JOIN wh_product_list as wl on wl.product_id=sd.product_id
      LEFT JOIN exchangerate as e on e.e_id=wl.e_id
    
        WHERE  sd.sale_runno="'.$data['sale_runno'].'"
        ORDER BY sd.ID ASC');

        $data_sumsale_price_kip = $query->result_array();


       // ------------- zone add new --------------------------------------------------------
    
$this->db->insert('sale_list_detail', $data);
    // $this->db->insert('sale_list_detail', $data);

    $this->db->query('UPDATE sale_list_header
        SET price_vat_all = price_vat_all + '.$price_vat.'
        WHERE sale_runno = "'.$data['sale_runno'].'"');
}
// ------------------------------------------------------------------------



      public function Addheader($data,$morepaynum)
        {
          $data2['cmp'] = $morepaynum;	
          $data2['saleremark'] = $data['saleremark'];	
          $data2['showremarkonslip'] = $data['showremarkonslip'];
        $data2['cus_name'] = $data['cus_name'];
            $data2['cus_id'] = $data['cus_id'];
            $data2['cus_address_all'] = $data['cus_address_all'];
            $data2['sumsale_discount'] = $data['sumsale_discount'];
            $data2['sumsale_num '] = $data['sumsale_num'];
            $data2['sumsale_price'] = $data['sumsale_price'];
            // add new -------------------------------
            $data2['sumsale_price_kip'] = $data['sumsale_price_kip'];
             // add new -------------------------------
    
            // add more column ----------------------------------
            $data2['money_from_customer'] =  $data['money_from_customer'];
            $data2['money_changeto_customer'] = $data['money_changeto_customer'];
            $data2['vat'] = $data['vat'];
            $data2['product_score_all'] = $data['product_score_all'];
            $data2['sale_runno'] = $data['sale_runno'];
            $data2['adddate'] = $data['adddate'];
          $data2['savedate'] = $data['savedate'];
        
            $data2['sale_type'] = $data['sale_type'];
            $data2['pay_type'] = $data['pay_type'];
            $data2['reserv'] = $data['reserv'];
            $data2['discount_last'] = $data['discount_last'];
        
        $data2['owner_id'] = $_SESSION['owner_id'];
        $data2['user_id'] = $_SESSION['user_id'];
        $data2['store_id'] = $_SESSION['store_id'];
        $data2['shift_id'] = $_SESSION['shift_id'];
        $data2['branch_id'] = $_SESSION['branch_id'];
        
        $data2['number_for_cus'] = $data['number_for_cus'];

$this->db->insert("sale_list_header", $data2);

$this->db->query('UPDATE customer_owner
    SET product_score_all=product_score_all + '.$data2['product_score_all'].' WHERE cus_id="'.$data2['cus_id'].'" and  owner_id="'.$_SESSION['owner_id'].'"');


    $this->db->query('UPDATE branch
        SET number_for_cus=number_for_cus + "1" WHERE branch_id="'.$_SESSION['branch_id'].'"');


        // $dlsd = $this->db->query('DELETE FROM sale_list_detail
        //   WHERE sale_runno="'.$data['sale_runno'].'"
        // AND adddate!="'.$data['adddate'].'"
        //   ');

//delete all from showcus2mer
$this->db->query('DELETE FROM sale_list_cus2mer WHERE user_id="'.$_SESSION['user_id'].'"');


if($data['round_money'] !=''){
$data_round['sale_runno'] = $data['sale_runno'];
$data_round['round_money'] = $data['round_money'];
$data_round['round_money_is'] = $data['round_money_is'];
$this->db->insert("log_round", $data_round);
}

if($data2['cus_id']!='0'){

$query_mpr = $this->db->query('SELECT * FROM money_to_point_rule ORDER BY id DESC');
$data_mpr = $query_mpr->result_array();


$cusaddpoint = (floor(($data2['sumsale_price']-$data2['discount_last'])/$data_mpr[0]['cus_money_if'])*$data_mpr[0]['point_will']);

$this->db->query('UPDATE customer_owner
    SET product_score_all=product_score_all + '.floor($cusaddpoint).'
    WHERE cus_id="'.$data2['cus_id'].'" and  owner_id="'.$_SESSION['owner_id'].'"');
	
$this->db->query('UPDATE sale_list_header
    SET product_score_all=product_score_all + '.floor($cusaddpoint).',
    sumsale_price_kip = '.$data2['sumsale_price_kip'].'
    WHERE sale_runno="'.$data['sale_runno'].'"');


}

}

// ----------------quotation--------------------------
public function Adddetailquotation($data)
        {

          // add new------------------------------
          if (isset($data['product_price_kip'], $data['product_sale_num'])) {
            $product_price_kip = $data['product_price_kip'];
            $product_sale_num = $data['product_sale_num'];
            echo "product_price_kip: $product_price_kip<br>";
            echo "product_sale_num: $product_sale_num<br>";
            $data['sumsale_price_kip'] = $product_price_kip * $product_sale_num;
        }
     // add new------------------------------
     $data['sumsale_price_kip'] = $data['product_price_kip']*$data['product_sale_num']; // Assign the value to 'sumsale_price_kip'
        $data['owner_id'] = $_SESSION['owner_id'];
        $data['user_id'] = $_SESSION['user_id'];
        $data['store_id'] = $_SESSION['store_id'];
        $data['shift_id'] = $_SESSION['shift_id'];
        $data['branch_id'] = $_SESSION['branch_id'];
    
        // Additional query to retrieve data from 'sale_list_detail' table
        $query = $this->db->query('SELECT sd.*, from_unixtime(sd.adddate,"%d-%m-%Y %H:%i:%s") as adddate,
    wl.product_weight*sd.product_sale_num as product_weight,e.title_name,e.rate,sd.sumsale_price_kip
        FROM sale_list_detail as sd
      LEFT JOIN wh_product_list as wl on wl.product_id=sd.product_id
      LEFT JOIN exchangerate as e on e.e_id=wl.e_id
    
        WHERE  sd.sale_runno="'.$data['sale_runno'].'"
        ORDER BY sd.ID ASC');

        $data_sumsale_price_kip = $query->result_array();
    // ---------------------------------------------------------------
    unset($data['e_id']); // Remove 'e_id' field from data array
    unset($data['title_name']); // Remove 'e_id' field from data array
    unset($data['rate']); // Remove 'e_id' field from data array
$this->db->insert("quotation_list_datail", $data);

  $query = $this->db->query('DELETE FROM sale_list_cus2mer  WHERE sc_ID="'.$data['sc_ID'].'"'); //delete all from showcus2mer


  }

      public function Addheaderquotation($data)
        {
// add new ---------------------------------

// add new ---------------------------------
         
$data2['cus_name'] = $data['cus_name'];
    $data2['cus_id'] = $data['cus_id'];
    $data2['cus_address_all'] = $data['cus_address_all'];
    $data2['sumsale_discount'] = $data['sumsale_discount'];
    $data2['sumsale_num '] = $data['sumsale_num'];
    $data2['sumsale_price'] = $data['sumsale_price'];
    $data2['sumsale_price_kip'] = $data['sumsale_price_kip'];
    $data2['money_from_customer'] =  $data['money_from_customer'];
    $data2['money_changeto_customer'] = $data['money_changeto_customer'];
    $data2['vat'] = $data['vat'];
    $data2['product_score_all'] = $data['product_score_all'];
    $data2['sale_runno'] = $data['sale_runno'];
    $data2['adddate'] = $data['adddate'];

    $data2['sale_type'] = $data['sale_type'];
    $data2['pay_type'] = $data['pay_type'];
    $data2['reserv'] = $data['reserv'];
    $data2['discount_last'] = $data['discount_last'];

    $data2['owner_id'] = $_SESSION['owner_id'];
    $data2['user_id'] = $_SESSION['user_id'];
    $data2['store_id'] = $_SESSION['store_id'];
    $data2['shift_id'] = $_SESSION['shift_id'];
    $data2['branch_id'] = $_SESSION['branch_id'];

    $data2['number_for_cus'] = $data['number_for_cus'];
// add new -------------------------------------------------------

  $this->db->insert("quotation_list_header", $data2);


$this->db->query('DELETE FROM sale_list_cus2mer WHERE user_id="'.$_SESSION['user_id'].'"');

}
// ----------------quotation--------------------------

public function Getproductformat($data)
        {

$query = $this->db->query('SELECT product_id_relation,product_num_relation FROM wh_product_relation_list
    WHERE product_id="'.$data['product_id'].'"');
return $query->result_array();

        }
public function Productmaterialaddstock($product_id,$num)
                {

        $query = $this->db->query('UPDATE stock
            SET product_stock_num=product_stock_num + '.$num.'
            WHERE product_id="'.$product_id.'" AND branch_id="'.$_SESSION['branch_id'].'"');
        return true;

                }

public function Cususepoint($data)
                {

        $query = $this->db->query('UPDATE customer_owner
            SET product_score_all=product_score_all - '.$data['customer_usepoint'].'
            WHERE cus_id="'.$data['cus_id'].'"');
        return true;

                }


public function Addmoneychange($m,$mc,$pc)
  {

$this->db->query('UPDATE owner
SET money_change_showcus='.$m.',money_from_cus_showcus='.$mc.',price_value_showcus='.$pc.' WHERE owner_id="'.$_SESSION['owner_id'].'"');


}



public function Updatemoneychange()
  {

$this->db->query('UPDATE owner
SET money_change_showcus="0.01" WHERE owner_id="'.$_SESSION['owner_id'].'"');


}




public function Showmoneychange($data)
  {

    $query = $this->db->query('SELECT money_change_showcus,money_from_cus_showcus,price_value_showcus FROM owner
        WHERE owner_id="'.$_SESSION['owner_id'].'" LIMIT 1');

    $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
    return $encode_data;

}







public function Openshiftnow($data)
               {


			    $querycheck = $this->db->query('SELECT
                   shift_end_time
                   FROM shift WHERE user_id="'.$_SESSION['user_id'].'" 
				   ORDER BY shift_id DESC LIMIT 1 ');

$shift_end_time_num = $querycheck->num_rows();
$shift_end_time = $querycheck->result_array();

if($shift_end_time_num > 0){
if($shift_end_time[0]['shift_end_time']==''){
	exit();
}
}


                 $data['shift_start_time'] = time();
                 $data['user_id'] = $_SESSION['user_id'];
                 $data['user_name'] = $_SESSION['name'];
				 $data['branch_id'] = $_SESSION['branch_id'];
				 
				 
                 if ($this->db->insert("shift", $data)){

                   $query = $this->db->query('SELECT
                   shift_id,shift_money_start,shift_start_time,shift_end_time,user_id
                   FROM shift WHERE shift_start_time="'.$data['shift_start_time'].'" LIMIT 1 ');

                  //print_r($query->result_array());
                  $shift_id = $query->result_array();
//echo $shift_id[0]['shift_id'];

                  $newdata = array(
                    'shift_id' => $shift_id[0]['shift_id'],
'shift_money_start' => $shift_id[0]['shift_money_start'],                    
'shift_start_time' => $shift_id[0]['shift_start_time'],
                    'shift_end_time' => $shift_id[0]['shift_end_time'],
                    'shift_user_id' => $shift_id[0]['user_id']
                  );

                  $this->session->set_userdata($newdata);


                     }


               }







               public function Closeshiftnowconfirm($data)
                            {
                    $query = $this->db->query('UPDATE shift
                        SET shift_end_time='.time().',shift_money_end="'.$data['shift_money_end'].'"
                        WHERE shift_id="'.$_SESSION['shift_id'].'" ');



               $queryshiftend = $this->db->query('SELECT
               shift_id,shift_start_time,shift_end_time,shift_money_start,shift_money_end
              FROM shift WHERE shift_id="'.$_SESSION['shift_id'].'" LIMIT 1 ');
              $shift_end = $queryshiftend->result_array();



                        $newdata = array(
                          'shift_id_old' => $shift_end[0]['shift_id'],
                          'shift_start_time_old' => date('d/m/Y H:i:s', $shift_end[0]['shift_start_time']),
                          'shift_end_time_old' => date('d/m/Y H:i:s', $shift_end[0]['shift_end_time']),
                          'shift_money_start_old' => $shift_end[0]['shift_money_start'],
                          'shift_money_end_old' => $shift_end[0]['shift_money_end'],
                        );

                        $this->session->set_userdata($newdata);


                    $this->session->unset_userdata('shift_id','shift_start_time','shift_end_time');



                    $this->db->query('UPDATE branch
                        SET number_for_cus="0" WHERE branch_id="'.$_SESSION['branch_id'].'"');




                            }






         public function Updateproductdeletestock($data2)
        {
$price_value = $data2['product_sale_num'] * $data2['product_price'];

// ===== original ======================================

$query_ss = $this->db->query('SELECT * FROM stock WHERE product_id="'.$data2['product_id'].'" and  branch_id="'.$_SESSION['branch_id'].'"');
$num_rows_ss = $query_ss->num_rows();

if($num_rows_ss == 0){
$data_ss['product_id'] = $data2['product_id'];
$data_ss['branch_id'] = $_SESSION['branch_id'];
$data_ss['product_stock_num'] = '0';
$this->db->insert("stock", $data_ss);

// ===== original =====================================

// ===== add new 06-04-2022 ===============================

$query = $this->db->query('UPDATE wh_product_list
    SET product_stock_num=product_stock_num - '.$data2['product_sale_num'].'
    WHERE product_id="'.$data2['product_id'].'" and  owner_id="'.$_SESSION['owner_id'].'" and branch_id="'.$_SESSION['branch_id'].'"');
return true;
// ===== add new 06-04-2022 ===============================

}





$query = $this->db->query('UPDATE stock
    SET product_stock_num=product_stock_num - '.$data2['product_sale_num'].'
    WHERE product_id="'.$data2['product_id'].'" and  branch_id="'.$_SESSION['branch_id'].'"');
	
	
$query = $this->db->query('UPDATE serial_number
    SET status="1"
    WHERE product_id="'.$data2['product_id'].'" 
	and  branch_id="'.$_SESSION['branch_id'].'"
	AND sn_code="'.$data2['sn_code'].'"');
	
	
return true;

        }







 public function Addproductranksave($data)
        {

 $queryrank = $this->db->query('SELECT product_rank FROM wh_product_list
			WHERE product_rank!="0"
            ORDER BY product_rank DESC LIMIT 1');
      
$num_rows = $queryrank->num_rows();

if($num_rows==0){
	$product_rank = 1;
}else{
foreach ( $queryrank->result_array() as $key => $value) {
$product_rank = $value['product_rank']+1;
  }
  
}


$query = $this->db->query('UPDATE wh_product_list
    SET product_rank='.$product_rank.'
    WHERE product_id="'.$data['product_id'].'" ');
return true;

        }



 public function Delproductranksave($data)
        {

$query = $this->db->query('UPDATE wh_product_list
    SET product_rank="0"
    WHERE product_id="'.$data['product_id'].'" ');
return true;

        }



public function Savemorepay($data)
        {

$this->db->insert("morepay", $data);



}





public function Gettoday($data)
        {


 $perpage = $data['perpage'];

            if($data['page'] && $data['page'] != ''){
$page = $data['page'];
            }else{
          $page = '1';
            }


            $start = ($page - 1) * $perpage;

$today = date('d-m-Y',time());

$dayfrom = strtotime($today);
$dayto = strtotime($today)+86400;


$querynum = $this->db->query('SELECT *,
    sh.product_score_all as product_score_all,cw.product_score_all as cus_score, from_unixtime(adddate,"%d-%m-%Y %H:%i:%s") as adddate
    FROM sale_list_header as sh
    LEFT JOIN customer_owner as cw on cw.cus_id=sh.cus_id
    WHERE
    sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND sh.owner_id="'.$_SESSION['owner_id'].'" AND sh.shift_id="'.$_SESSION['shift_id'].'" AND sh.cus_name LIKE "%'.$data['searchtext'].'%"
    OR sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND sh.owner_id="'.$_SESSION['owner_id'].'"  AND sh.shift_id="'.$_SESSION['shift_id'].'" AND sh.sale_runno LIKE "%'.$data['searchtext'].'%"
    OR sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND sh.owner_id="'.$_SESSION['owner_id'].'"  AND sh.shift_id="'.$_SESSION['shift_id'].'" AND cw.cus_name LIKE "%'.$data['searchtext'].'%"
	OR sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND sh.owner_id="'.$_SESSION['owner_id'].'"  AND sh.shift_id="'.$_SESSION['shift_id'].'" AND sh.saleremark LIKE "%'.$data['searchtext'].'%"
    ORDER BY ID DESC');


$query = $this->db->query('SELECT *,
    sh.product_score_all as product_score_all,cw.product_score_all as cus_score, 
	cw.taxnumber,
	from_unixtime(adddate,"%d-%m-%Y %H:%i:%s") as adddate,
	from_unixtime(savedate,"%d-%m-%Y %H:%i:%s") as savedate
FROM sale_list_header as sh
    LEFT JOIN customer_owner as cw on cw.cus_id=sh.cus_id
    WHERE
    sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND sh.owner_id="'.$_SESSION['owner_id'].'"  AND sh.shift_id="'.$_SESSION['shift_id'].'" AND sh.cus_name LIKE "%'.$data['searchtext'].'%"
    OR sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND sh.owner_id="'.$_SESSION['owner_id'].'"  AND sh.shift_id="'.$_SESSION['shift_id'].'" AND sh.sale_runno LIKE "%'.$data['searchtext'].'%"
    OR sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND sh.owner_id="'.$_SESSION['owner_id'].'"  AND sh.shift_id="'.$_SESSION['shift_id'].'" AND cw.cus_name LIKE "%'.$data['searchtext'].'%"
    OR sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND sh.owner_id="'.$_SESSION['owner_id'].'"  AND sh.shift_id="'.$_SESSION['shift_id'].'" AND sh.saleremark LIKE "%'.$data['searchtext'].'%"
	ORDER BY sh.ID DESC LIMIT '.$start.' , '.$perpage.' ');
$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );


$num_rows = $querynum->num_rows();

$pageall = ceil($num_rows/$perpage);


$json = '{"list": '.$encode_data.',
"numall": '.$num_rows.',"perpage": '.$perpage.', "pageall": '.$pageall.'}';


return $json;


        }


        public function Getquotation($data)
                {


        $query = $this->db->query('SELECT *,
            sh.product_score_all as product_score_all,cw.product_score_all as cus_score, from_unixtime(adddate,"%d-%m-%Y %H:%i:%s") as adddate
            FROM quotation_list_header as sh
            LEFT JOIN customer_owner as cw on cw.cus_id=sh.cus_id
			WHERE sh.branch_id="'.$_SESSION['branch_id'].'" AND sh.user_id="'.$_SESSION['user_id'].'"
            ORDER BY sh.ID ASC ');
        $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );



        return $encode_data;


                }
          

public function update_customer_group_discountpercent($data)
                {
				
$percent =	$data['customer_group_discountpercent']/100;
				
	$this->db->query('UPDATE sale_list_cus2mer
  SET product_price_discount=product_price*'.$percent.',
  product_price_discount_percent='.$data['customer_group_discountpercent'].'
  WHERE user_id="'.$_SESSION['user_id'].'"');				
	return true;
				}




        public function Saveshowcus($data)
                {
// echo 'ok..';
	
$querystock = $this->db->query('SELECT IFNULL((SELECT product_stock_num FROM stock 
WHERE product_id="'.$data['product_id'].'" LIMIT 1),"0") as product_stock_num');


// test more update for sumsale_price_kip, sum sale price thb------------------------------
$querysalelistcus = $this->db->query('SELECT sc.sc_ID, 
sc.product_id, 
sc.product_name,
sc.product_image, 
sc.product_unit_name, 
sc.product_des,
sc.product_code, 
sc.product_price,
sc.product_price_kip,
sc.sumsale_price_kip,
sc.product_pricebase, 
sc.product_stock_num, 
sc.product_sale_num, 
sc.product_price_discount,
sc.product_price_discount_percent, 
sc.product_score,
sc.adddate,
sc.owner_id, 
sc.user_id, 
sc.store_id, 
sc.sn_code, 
sc.product_sale_num,
e.title_name, 
e.rate
,sum(sc.product_sale_num) 
as product_sale_num,
(
    SELECT SUM(DISTINCT sc2.product_price * sc2.product_sale_num)
    FROM sale_list_cus2mer AS sc2
    JOIN wh_product_list AS wh2 ON sc2.product_id = wh2.product_id
    JOIN exchangerate AS e2 ON e2.e_id = wh2.e_id
    WHERE wh2.e_id = 2 AND  sc2.product_code="'.$data['product_code'].'"
) AS sum_product_price_thb,
(
  SELECT SUM(DISTINCT sc3.product_price_kip * sc3.product_sale_num)
  FROM sale_list_cus2mer AS sc3
  JOIN wh_product_list AS wh3 ON sc3.product_id = wh3.product_id
  JOIN exchangerate AS e3 ON e3.e_id = wh3.e_id
  WHERE wh3.e_id = 1 AND  sc3.product_code="'.$data['product_code'].'"
) AS totalkip,
(
  SELECT SUM(sc4.product_sale_num)
  FROM sale_list_cus2mer AS sc4
  JOIN wh_product_list AS wh4 ON sc4.product_id = wh4.product_id
  JOIN exchangerate AS e4 ON e4.e_id = wh4.e_id
  WHERE sc4.product_code="'.$data['product_code'].'"
) AS sumqty

FROM sale_list_cus2mer AS sc
LEFT JOIN wh_product_list as wh on wh.product_code=sc.product_code
LEFT JOIN exchangerate as e on e.e_id=wh.e_id
WHERE sc.product_code="'.$data['product_code'].'"');
// update ===================

$retstock = $querystock->row();
$retsalelistcus = $querysalelistcus->row();
$rate = $retsalelistcus->rate; // Fetch the rate value from the query result
$product_sale_num = $retsalelistcus->product_sale_num; // Fetch the product_sale_num value from the query result

if($retstock->product_stock_num-$retsalelistcus->product_sale_num > $_SESSION['stock_nosale']){
	$cansale = '1';
}else{
$cansale = '0';
}

        $data['owner_id'] = $_SESSION['owner_id'];
        $data['user_id'] = $_SESSION['user_id'];
        $data['store_id'] = $_SESSION['store_id'];
        $data['adddate'] = time();

// update ============
$query1 = $this->db->query('SELECT sc.*,e.e_id,e.rate, e.title_name FROM sale_list_cus2mer as sc 
JOIN wh_product_list as w ON w.product_id = sc.product_id
JOIN exchangerate as e ON e.e_id = w.e_id
WHERE sc.product_name = "'.$data['product_name'].'" AND sc.user_id = "'.$_SESSION['user_id'].'"');
$num_rows = $query1->num_rows();
// $rate = $query1->rate; 
// $product_sale_num = $query1->product_sale_num; 
// $product_price_kip = $query1->product_price_kip; 


if ($cansale == '1') {
    if ($num_rows == 1) {


 $this->db->query('UPDATE sale_list_cus2mer
      

        SET product_sale_num=product_sale_num+"'.$data['product_sale_num'].'",
    product_price = "'.$data['product_price'].'",
    product_price_kip = product_price * '.$rate.', 
    sumsale_price_kip = product_price * '.$rate.' * product_sale_num
      WHERE product_name = "'.$data['product_name'].'" AND product_code = "'.$data['product_code'].'" 
      AND product_id = "'.$data['product_id'].'" AND user_id = "'.$_SESSION['user_id'].'"');
// -----------------------

    }
    
    
    else {
        if (isset($data['e_id'])) {
            $selectedExchangeRateId = $data['e_id'];
            $queryRate = $this->db->query('SELECT rate FROM exchangerate WHERE e_id = '.$data['e_id']);
            $resultRate = $queryRate->row();
            $rate = $resultRate->rate;

            if ($rate !== null) {
              $data['e_id'] = $data['e_id'];
              $data['product_sale_num']=$data['product_sale_num'];
              $data['product_price_kip'] = $data['product_price'] * $rate;
              $data['sumsale_price_kip'] = $data['product_price_kip'] * $data['product_sale_num'];
              $this->db->insert("sale_list_cus2mer", $data);
          }
            
            else {
                echo "Error: Rate is not available for the selected product.";
            }
        } else {
            echo "Error: 'e_id' is not set in the data array.";
        }
    }





    $query = $this->db->query('SELECT  sum(sc.product_sale_num) as product_sale_num,
    sc.sc_ID,
    sc.product_id,
    sc.product_name,
    sc.sn_code,
    sc.product_unit_name,
    sc.product_des,
    sc.product_code,
    sc.product_price,
    sc.product_price * e.rate as product_price_kip,
    sc.product_pricebase,
    sc.product_stock_num,
    sc.product_price_discount,
    sc.product_price_discount_percent,
    sc.product_score,
    e.title_name,
    e.rate
        FROM sale_list_cus2mer as sc 
        LEFT JOIN wh_product_list AS wh on sc.product_id=wh.product_id
        LEFT JOIN exchangerate as e on e.e_id=wh.e_id
        WHERE sc.user_id="'.$_SESSION['user_id'].'"
        GROUP BY sc.product_name
      ORDER BY sc.sc_ID ASC
      ');

    $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
    return $encode_data;

    }

  }
          public function Updateproductnumber($data)
                  {

if($data['product_sale_num']!=''){


$querystock = $this->db->query('SELECT IFNULL((SELECT product_stock_num FROM stock 
WHERE product_id="'.$data['product_id'].'" LIMIT 1),"0") as product_stock_num');
$retstock = $querystock->row();



if($retstock->product_stock_num-$data['product_sale_num'] >= $_SESSION['stock_nosale']){
	$cansale = '1';
	$data['product_sale_num'] = $data['product_sale_num'];
}else{
$cansale = '0';
$data['product_sale_num'] = '1';
}


          $data['owner_id'] = $_SESSION['owner_id'];
          $data['user_id'] = $_SESSION['user_id'];
          $data['store_id'] = $_SESSION['store_id'];
          $data['adddate'] = time();


$query_step = $this->db->query('SELECT
        product_price
        FROM  product_price_step
        WHERE product_code="'.$data['product_code'].'"
		AND qty_more<="'.$data['product_sale_num'].'"
		AND qty_less>="'.$data['product_sale_num'].'"
        ');


foreach ($query_step->result() as $row)
{
        $product_price = $row->product_price;

}

if(!isset($product_price)){
  $product_price = $data['product_price'];
}



          $this->db->query('UPDATE sale_list_cus2mer
          SET product_sale_num="'.$data['product_sale_num'].'",product_price="'.$product_price.'"
          WHERE user_id="'.$_SESSION['user_id'].'" AND product_name="'.$data['product_name'].'"');

}else{

$cansale = '1';
}


            $query = $this->db->query('SELECT  sum(sc.product_sale_num) as product_sale_num,
            sc.sc_ID,
            sc.product_id,
            sc.product_name,
            sc.sn_code,
            sc.product_unit_name,
            sc.product_des,
            sc.product_code,
            sc.product_price,
            sc.product_pricebase,
            sc.product_stock_num,
            sc.product_price_discount,
            sc.product_price_discount_percent,
            sc.product_score,
            e.title_name,
            e.rate
                FROM sale_list_cus2mer as sc 
                LEFT JOIN wh_product_list as wh on wh.product_id=sc.product_id
                LEFT JOIN exchangerate  as e on e.e_id=wh.e_id
                WHERE sc.user_id="'.$_SESSION['user_id'].'"
                GROUP BY sc.product_name
              ORDER BY sc.sc_ID ASC
              ');

              

            $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
			
			$encode_data2 = '{"list":'.$encode_data.',"cansale":"'.$cansale.'"}';

return $encode_data2;

            }
			
			
			
			
			
			
			
			
			// original ==============================

			//       public function Updateproductprice($data)
      //             {

      //     $this->db->query('UPDATE sale_list_cus2mer
      //     SET product_price="'.$data['product_price'].'"
		  // WHERE user_id="'.$_SESSION['user_id'].'" AND product_name="'.$data['product_name'].'"');


      //       $query = $this->db->query('SELECT  sum(product_sale_num) as product_sale_num,
      //       sc_ID,
      //     product_id,
      //       product_name,
			// sn_code,
      //       product_unit_name,
      //       product_des,
      //       product_code,
      //       product_price,
			// product_pricebase,
      //       product_price_discount,
      //       product_price_discount_percent,
      //       product_score
      //           FROM sale_list_cus2mer
      //           WHERE user_id="'.$_SESSION['user_id'].'"
      //           GROUP BY product_name
      //         ORDER BY sc_ID ASC
      //         ');

      //       $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
      //       return $encode_data;


      //       }

      // end original ==============================
      // update new refer to exchange rate ===========================================
			      public function Updateproductprice($data)
                  {

          $this->db->query('UPDATE sale_list_cus2mer
          SET product_price="'.$data['product_price'].'"
		  WHERE user_id="'.$_SESSION['user_id'].'" AND product_name="'.$data['product_name'].'"');


            $query = $this->db->query('SELECT  sum(sc.product_sale_num) as product_sale_num,
            sc.sc_ID,
            sc.product_id,
            sc.product_name,
            sc.sn_code,
            sc.product_unit_name,
            sc.product_des,
            sc.product_code,
            sc.product_price,
            sc.product_pricebase,
            sc.product_price_discount,
            sc.product_price_discount_percent,
            sc.product_score,
            e.e_id,
            e.title_name,
            e.rate
                FROM sale_list_cus2mer as sc
                LEFT JOIN wh_product_list as wh on wh.product_id=sc.product_id
                LEFT JOIN exchangerate  as e on e.e_id=wh.e_id
                WHERE sc.user_id="'.$_SESSION['user_id'].'"
                GROUP BY sc.product_name
              ORDER BY sc.sc_ID ASC
              ');

            $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
            return $encode_data;


            }
			
			  // update new refer to exchange rate ===========================================





            public function Price_discount_percent($data)
                    {

            $data['owner_id'] = $_SESSION['owner_id'];
            $data['user_id'] = $_SESSION['user_id'];
            $data['store_id'] = $_SESSION['store_id'];
            $data['adddate'] = time();


            $this->db->query('UPDATE sale_list_cus2mer
            SET product_price_discount="'.$data['product_price_discount'].'",
            product_price_discount_percent="'.$data['product_price_discount_percent'].'"
            WHERE user_id="'.$_SESSION['user_id'].'" AND product_name="'.$data['product_name'].'"');




              $query = $this->db->query('SELECT  sum(sc.product_sale_num) as product_sale_num,
              sc.sc_ID,
              sc.product_id,
              sc.product_name,
              sc.sn_code,
              sc.product_unit_name,
              sc.product_des,
              sc.product_code,
              sc.product_price,
              sc.product_pricebase,
              sc.product_stock_num,
              sc.product_price_discount,
              sc.product_price_discount_percent,
              sc.product_score,
              e.e_id,
              e.title_name,
              e.rate
    
                  FROM sale_list_cus2mer as sc 
                  LEFT JOIN wh_product_list as wh on wh.product_id=sc.product_id
                  LEFT JOIN exchangerate as e on e.e_id=wh.e_id
                  WHERE sc.user_id="'.$_SESSION['user_id'].'"
                  GROUP BY sc.product_name
                ORDER BY sc.sc_ID ASC
                ');

              $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
              return $encode_data;


              }

 public function Savepopup_num($data)
                    {

	$this->db->query('UPDATE sale_list_cus2mer
  SET product_sale_num="'.$data['product_sale_num'].'"
  WHERE product_name="'.$data['product_name'].'" and  user_id="'.$_SESSION['user_id'].'"');

              }
			  


 public function Savepopup_price($data)
                    {

	$this->db->query('UPDATE sale_list_cus2mer
  SET product_price="'.$data['product_price'].'"
  WHERE product_name="'.$data['product_name'].'" and  user_id="'.$_SESSION['user_id'].'"');

              }
			  
			  


              // (SELECT sc.*,"'.$_SESSION['name'].'","'.time().'","'.$_SESSION['name'].'","'.$_SESSION['shift_id'].'"
              // FROM sale_list_cus2mer as sc LEFT JOIN wh_product_list as wh on wh.product_id=sc.product_id
              // LEFT JOIN exchangerate as e on e.e_id=wh.e_id
              // WHERE sc.user_id="'.$_SESSION['user_id'].'"');


              // --------------
//               SELECT sc.*,"'.$_SESSION['name'].'","'.time().'","'.$_SESSION['name'].'","'.$_SESSION['shift_id'].'"
// FROM sale_list_cus2mer as sc LEFT JOIN wh_product_list as wh on wh.product_id=sc.product_id
// WHERE sc.product_name="'.$data['product_name'].'" and  sc.user_id="'.$_SESSION['user_id'].'"');
// -----------------------

// orgin ------------------------------------------------------------------------------------------------------

//           public function Delshowcus($data)
//                   {

// if($data['product_name']==''){
// $this->db->query('INSERT INTO log_delete_order(sc_ID,product_id,
// product_name,product_image,
// product_unit_name,product_des,product_code,
// 	product_price,product_pricebase,product_stock_num,
//   product_sale_num,product_price_discount,
//   product_price_discount_percent,product_score,adddate,
// 	owner_id,user_id,store_id,sn_code,delname,deltime,name,shift_id
// 	)


//   (SELECT sc.*,"'.$_SESSION['name'].'","'.time().'","'.$_SESSION['name'].'","'.$_SESSION['shift_id'].'"
//       FROM sale_list_cus2mer as sc LEFT JOIN wh_product_list as wh on wh.product_id=sc.product_id
//     LEFT JOIN exchangerate as e on e.e_id=wh.e_id
//     WHERE sc.user_id="'.$_SESSION['user_id'].'"');



// $this->db->query('DELETE FROM sale_list_cus2mer  WHERE user_id="'.$_SESSION['user_id'].'" ');
// }else{
// $this->db->query('INSERT INTO log_delete_order(sc_ID,product_id,product_name,
// product_image,product_unit_name,product_des,product_code,
// 	product_price,product_pricebase,product_stock_num,product_sale_num,
// 	product_price_discount,product_price_discount_percent,product_score,adddate,
// 	owner_id,user_id,store_id,sn_code,delname,deltime,name,shift_id
// 	)


//   (SELECT sc.*,"'.$_SESSION['name'].'","'.time().'","'.$_SESSION['name'].'","'.$_SESSION['shift_id'].'"
// FROM sale_list_cus2mer as sc LEFT JOIN wh_product_list as wh on wh.product_id=sc.product_id
//  WHERE sc.product_name="'.$data['product_name'].'" and  sc.user_id="'.$_SESSION['user_id'].'"');


// $this->db->query('DELETE FROM sale_list_cus2mer  WHERE product_name="'.$data['product_name'].'" AND user_id="'.$_SESSION['user_id'].'"');
// }
	
	
	
	
// $query = $this->db->query('SELECT  sum(sc.product_sale_num) as product_sale_num,
// sc.sc_ID,
// sc.product_id,
// sc.product_name,
// sc.sn_code,
// sc.product_unit_name,
// sc.product_des,
// sc.product_code,
// sc.product_price,
// sc.product_pricebase,
// sc.product_stock_num,
// sc.product_price_discount,
// sc.product_price_discount_percent,
// sc.product_score,
// wh.e_id,
// e.e_id,
// e.title_name,
// e.rate

//     FROM sale_list_cus2mer as sc
//     LEFT JOIN wh_product_list as wh on wh.product_id=sc.product_id
//     LEFT JOIN exchangerate as e on e.e_id=wh.e_id
//     WHERE sc.user_id="'.$_SESSION['user_id'].'"
//     GROUP BY sc.product_name
//   ORDER BY sc.sc_ID ASC
//   ');

//             $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
//             return $encode_data;

// }

// orgin ------------------------------------------------------------------------------------------------------

// update ------------------------------------------------------------------------------------------
          public function Delshowcus($data){
                  {

                  
                      $this->db->query('DELETE FROM sale_list_cus2mer WHERE product_name="'.$data['product_name'].'" 
                      AND user_id="'.$_SESSION['user_id'].'" and sc_ID="'.$data['sc_ID'].'"');


                  }
              
                  $query = $this->db->query('SELECT  
                  sum(sc.product_sale_num) as product_sale_num,
                  sc.sumsale_price_kip as sumsale_price_kip,
                  sc.sc_ID,
                  sc.product_id,
                  sc.product_name,
                  sc.sn_code,
                  sc.product_unit_name,
                  sc.product_des,
                  sc.product_code,
                  sc.product_price,
                  sc.product_pricebase,
                  sc.product_stock_num,
                  sc.product_price_discount,
                  sc.product_price_discount_percent,
                  sc.product_score,
                  e.title_name,
                  e.rate
                  FROM sale_list_cus2mer AS sc
                  LEFT JOIN wh_product_list AS wh ON wh.product_id = sc.product_id
                  LEFT JOIN exchangerate AS e ON e.e_id = wh.e_id
                  WHERE sc.user_id="'.$_SESSION['user_id'].'"
                  GROUP BY sc.product_name
                  ORDER BY sc.sc_ID ASC');
              
                  $encode_data = json_encode($query->result(), JSON_UNESCAPED_UNICODE);
                  return $encode_data;

}
			
	// end update ------------------------------------------------------------------------------------------		
			
			
			
			public function Delshowcus_pass($data)
                  {



$querypass =  $this->db->get_where('user_owner' , array('user_password' => $data['orderpass']));

    $count_row = $querypass->num_rows();

    if ($count_row > 0) {
$querycheck = $this->db->query('SELECT pg.permission_rule,uo.name
FROM user_owner  as uo 
LEFT JOIN permission_group as pg on uo.user_type=pg.group_id
WHERE uo.user_password="'.$data['orderpass'].'" LIMIT 1');
foreach ($querycheck->result() as $row) {

 $arr_permission_rule =  json_decode($row->permission_rule);
 $arr_name =  $row->name;

}




if(!isset($arr_permission_rule) || $arr_permission_rule[19]->status==true){
	
	

if($data['product_name']==''){
	$this->db->query('INSERT INTO log_delete_order(sc_ID,product_id,product_name,
	product_image,product_unit_name,product_des,product_code,product_price,product_pricebase,product_stock_num,
	product_sale_num,product_price_discount,product_price_discount_percent,product_score,adddate,owner_id,user_id,
	store_id,sn_code,delname,deltime,name,shift_id
	)
SELECT *,"'.$arr_name.'","'.time().'","'.$_SESSION['name'].'","'.$_SESSION['shift_id'].'"
FROM sale_list_cus2mer
WHERE user_id="'.$_SESSION['user_id'].'"');
$this->db->query('DELETE FROM sale_list_cus2mer  WHERE user_id="'.$_SESSION['user_id'].'"');
}else{
$this->db->query('INSERT INTO log_delete_order(sc_ID,product_id,product_name,
	product_image,product_unit_name,product_des,product_code,product_price,product_pricebase,product_stock_num,
	product_sale_num,product_price_discount,product_price_discount_percent,product_score,adddate,owner_id,user_id,
	store_id,sn_code,delname,deltime,name,shift_id
	)
SELECT *,"'.$arr_name.'","'.time().'","'.$_SESSION['name'].'","'.$_SESSION['shift_id'].'"
FROM sale_list_cus2mer
WHERE product_name="'.$data['product_name'].'" and  user_id="'.$_SESSION['user_id'].'"');
$this->db->query('DELETE FROM sale_list_cus2mer  WHERE product_name="'.$data['product_name'].'" AND user_id="'.$_SESSION['user_id'].'"');
}

}else{
	return 'no';
	}



	}else{
	return 'no';
	}




$query = $this->db->query('SELECT  sum(sc.product_sale_num) as product_sale_num,
sc.sc_ID,
sc.product_id,
sc.product_name,
sc.sn_code,
sc.product_unit_name,
sc.product_des,
sc.product_code,
sc.product_price,
sc.product_pricebase,
sc.product_stock_num,
sc.product_price_discount,
sc.product_price_discount_percent,
sc.product_score,
e.e_id,
e.title_name,
e.rate

    FROM sale_list_cus2mer as sc 
    LEFT JOIN wh_product_list as wh on wh.product_id=sc.product_id
    LEFT JOIN exchangerate as e on e.e_id=wh.e_id
    WHERE sc.user_id="'.$_SESSION['user_id'].'"
    GROUP BY sc.product_name
  ORDER BY sc.sc_ID ASC
  ');

            $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
            return $encode_data;

}


            public function Showlistorder($data)
                    {

              $query = $this->db->query('SELECT  sum(sc.product_sale_num) as product_sale_num,
              sc.sc_ID,
              sc.product_id,
              sc.product_name,
              sc.sn_code,
              sc.product_unit_name,
              sc.product_des,
              sc.product_code,
              sc.product_price,
              sc.product_pricebase,
              sc.product_stock_num,
              sc.product_price_discount,
              sc.product_price_discount_percent,
              sc.product_score,
              e.e_id,
              e.title_name,
              e.rate
                  FROM sale_list_cus2mer as sc 
                  LEFT JOIN wh_product_list as wh on wh.product_id=sc.product_id
                   LEFT JOIN exchangerate as e on e.e_id=wh.e_id
                  WHERE sc.user_id="'.$_SESSION['user_id'].'"
                  GROUP BY sc.product_name
                ORDER BY sc.sc_ID ASC
                ');

              $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
              return $encode_data;



              }

////////////////////////////////////////////////////////////



public function Saveshowcusnotsum($data)
        {

$data['owner_id'] = $_SESSION['owner_id'];
$data['user_id'] = $_SESSION['user_id'];
$data['store_id'] = $_SESSION['store_id'];
$data['adddate'] = time();
// add
// $data['rate'] = ['rate'];
// $data['sumsale_price_kip'] = ['product_price']*['rate']*['product_sale_num'];
if ($this->db->insert("sale_list_cus2mer", $data)){


  $query = $this->db->query('SELECT  sc.product_sale_num as product_sale_num,
  sc.sc_ID,
  sc.product_id,
  sc.product_name,
  sc.sn_code,
  sc.product_unit_name,
  sc.product_des,
  sc.product_code,
  sc.product_price,
  sc.product_pricebase,
  sc.product_stock_num,
  sc.product_price_discount,
  sc.product_price_discount_percent,
  sc.product_score,
  e.e_id,
  e.title_name,
  e.rate

      FROM sale_list_cus2mer as sc 
      LEFT JOIN wh_product_list as wh on wh.product_id=sc.product_id
      LEFT JOIN exchangerate as e on e.e_id=wh.e_id
      WHERE sc.user_id="'.$_SESSION['user_id'].'"
      GROUP BY sc.product_name
    ORDER BY sc.sc_ID ASC
    ');

  $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
  return $encode_data;

    }
  }

  public function Delshowcusnotsum($data)
          {


$query = $this->db->query('DELETE FROM sale_list_cus2mer  WHERE sc_ID="'.$data['sc_ID'].'"');

$query = $this->db->query('SELECT  sc.product_sale_num as product_sale_num,
sc.sc_ID,
sc.product_id,
sc.product_name,
sc.sn_code,
sc.product_unit_name,
sc.product_des,
sc.product_code,
sc.product_price,
sc.product_pricebase,
sc.product_stock_num,
sc.product_price_discount,
sc.product_price_discount_percent,
sc.product_score,
e.e_id,
e.title_name,
e.rate

    FROM sale_list_cus2mer as sc 
    LEFT JOIN wh_product_list as wh on wh.product_id=sc.product_id
    LEFT JOIN exchangerate as e on e.e_id=wh.e_id
    WHERE sc.user_id="'.$_SESSION['user_id'].'"
    GROUP BY sc.product_name
  ORDER BY sc.sc_ID ASC
');

    $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
    return $encode_data;



    }





    public function Showlistordernotsum($data)
            {

      $query = $this->db->query('SELECT sc.product_sale_num as product_sale_num,
      sc.sc_ID,
      sc.product_id,
      sc.product_name,
      sc.sn_code,
      sc.product_unit_name,
      sc.product_des,
      sc.product_code,
      sc.product_price,
      sc.product_pricebase,
      sc.product_stock_num,
      sc.product_price_discount,
      sc.product_price_discount_percent,
      sc.product_score,
      e.e_id,
      e.title_name,
      e.rate

          FROM sale_list_cus2mer as sc 
          LEFT JOIN wh_product_list as wh on wh.product_id=sc.product_id
      LEFT JOIN exchangerate as e on e.e_id=wh.e_id
          WHERE sc.user_id="'.$_SESSION['user_id'].'"
          GROUP BY sc.product_name
        ORDER BY sc.sc_ID ASC
        ');

      $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
      return $encode_data;



      }





      public function Updateshowcusnotsum($data)
              {



  $this->db->query('UPDATE sale_list_cus2mer
  SET product_name="'.$data['product_name'].'",
  product_price="'.$data['product_price'].'"
  WHERE sc_ID="'.$data['sc_ID'].'"');



        $query = $this->db->query('SELECT sum(sc.product_sale_num) as product_sale_num,
        sc.sc_ID,
        sc.product_id,
        sc.product_name,
        sc.sn_code,
        sc.product_unit_name,
        sc.product_des,
        sc.product_code,
        sc.product_price,
        sc.product_pricebase,
        sc.product_stock_num,
        sc.product_price_discount,
        sc.product_price_discount_percent,
        sc.product_score,
        e.e_id,
        e.title_name,
        e.rate

            FROM sale_list_cus2mer as sc 
            LEFT JOIN wh_product_list as wh on wh.product_id=sc.product_id
      LEFT JOIN exchangerate as e on e.e_id=wh.e_id
            WHERE sc.user_id="'.$_SESSION['user_id'].'"
            GROUP BY sc.product_name
          ORDER BY sc.sc_ID ASC
                ');

        $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
        return $encode_data;



        }







        public function Getrelationlist($product_id)
        {

        $query = $this->db->query('SELECT
        *
        FROM wh_product_relation_list
        WHERE product_id="'.$product_id.'"');
        return $query->result_array();

        }

        public function Updateproductdeletestock_relation($sale_runno,$product_id,$product_name,$numnow,$product_id_relation,$product_type_relation)
        {


$query1 = $this->db->query('SELECT * FROM stock WHERE product_id="'.$product_id.'" and  branch_id="'.$_SESSION['branch_id'].'"');
$num_rows = $query1->num_rows();

if($num_rows == 1){
	    $query2 = $this->db->query('UPDATE stock
        SET product_stock_num=product_stock_num - '.$numnow.'
        WHERE product_id="'.$product_id.'" and  branch_id="'.$_SESSION['branch_id'].'"');
			
}else{ 
$data2['product_id'] = $product_id;
$data2['branch_id'] = $_SESSION['branch_id'];
$data2['product_stock_num'] = 0-$numnow;
$this->db->insert("stock", $data2);
}

	$data['sale_runno'] = $sale_runno;
  $data['product_id'] = $product_id;
  $data['product_name'] = $product_name;
  $data['product_stock_num'] = $numnow;
  $data['product_id_relation'] = $product_id_relation;
  $data['user_id'] = $_SESSION['user_id'];
  $data['shift_id'] = $_SESSION['shift_id'];
  $data['branch_id'] = $_SESSION['branch_id'];
  $data['adddate'] = time();

         $this->db->insert("log_from_relation_when_sale", $data);

        return true;

        }

        public function Runnonotreset()
               {

       $query = $this->db->query('UPDATE owner
           SET reset_runno="0"
           WHERE owner_id="'.$_SESSION['owner_id'].'" ');
       return true;

               }

          public function Useproductpoint($data)
                  {

          $data['user_id'] = $_SESSION['user_id'];
          $data['shift_id'] = $_SESSION['shift_id'];
		  $data['branch_id'] = $_SESSION['branch_id'];
          $data['add_time'] = time();

          if ($this->db->insert("customer_use_point_gift_list", $data)){

            $this->db->query('UPDATE customer_owner
                SET product_score_all=product_score_all - '.$data['point_use'].'
                WHERE cus_id="'.$data['cus_id'].'" and  owner_id="'.$_SESSION['owner_id'].'"');
                  return true;
              }

            }

public function Addshiftmoneystart($data)
               {

       $this->db->query('UPDATE shift
           SET shift_money_start=shift_money_start+"'.$data['addshiftmoneystart'].'"
           WHERE shift_id="'.$_SESSION['shift_id'].'" ');
		   
		   
		   $queryshiftend = $this->db->query('SELECT
shift_id,shift_start_time,shift_money_start,shift_end_time,user_id
FROM shift WHERE shift_id="'.$_SESSION['shift_id'].'" ');
$shift_end = $queryshiftend->result_array();

$newdatashift = array(
           'shift_id' => $shift_end[0]['shift_id'],
		   'shift_money_start' => $shift_end[0]['shift_money_start'],
           'shift_user_id' => $shift_end[0]['user_id']
         );

$this->session->set_userdata($newdatashift);

       return true;

               }

    }