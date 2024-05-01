
<div class="col-md-10 col-sm-9" ng-app="firstapp" ng-controller="Index">

<div class="panel panel-default">
	<div class="panel-body">



 <!-- <div style="float: right;">
	<input type="checkbox" ng-model="showdeletcbut"> <?=$lang_showdel?>
</div> -->


<div class="form-group" style="float: left;">
<input type="text" ng-model="searchtext" class="form-control" placeholder="
<?=$lang_search?> <?php echo $lang_lgrd_1;?>" ng-change="getlist(searchtext,'1')" style="width:300px;">
</div>


<form class="form-inline">



<div class="form-group">
<input type="text" id="dayfrom" name="dayfrom" ng-model="dayfrom" class="form-control" placeholder="<?=$lang_fromday?>"> -
</div>
<div class="form-group">
<input type="text" id="dayto" name="dayto" ng-model="dayto" class="form-control" placeholder="<?=$lang_today?>">
</div>
<div class="form-group">
<button type="submit" ng-click="getlist()" class="btn btn-success" placeholder="" title="<?=$lang_search?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
</div>


<div class="form-group">
<button type="submit" ng-click="getlist('','1')" class="btn btn-default" placeholder="" title="<?=$lang_refresh?>"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>
</div>


<div class="form-group">
<button class="btn btn-primary" onClick="Openprintdiv_table()"><?=$lang_print?></button>
</div>


</form>
<br />


<center>
<img ng-if="!list" src="<?php echo $base_url;?>/pic/loading.gif">
</center>

<div id="openprint_table">
<table ng-if="list" id="headerTable" class="table table-hover table-bordered">
	<thead>
		<tr class="trheader">
			<th><?=$lang_rank?></th>
			
			<th><?=$lang_runno?></th>
			<th><?php echo $lang_lgrd_2;?></th>

			<th><?=$lang_cusname?></th>


<th><?php echo $lang_lgrd_3;?></th>

<th><?php echo $lang_lgrd_4;?></th>
<th><?php echo $lang_lgrd_5;?></th>


			<th><?php echo $lang_lgrd_6;?></th>
			<th><?php echo $lang_lgrd_7;?></th>
			<th><?php echo $lang_shift;?></th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="x in list">
			<td ng-if="selectpage=='1'" class="text-center">{{($index+1)}}</td>
			<td ng-if="selectpage!='1'" class="text-center">{{($index+1)+(perpage*(selectpage-1))}}</td>

<td><b>{{x.sale_runno}}</b></td>


<td>{{x.name}}</td>
	<td>{{x.cus_name}}</td>
<td align="right">{{x.round_money}}</td>
<td align="right">{{x.round_money_is}}</td>
<td align="right">

<span ng-if="x.round_money_is > x.round_money" style="color:green;font-weight:bold">
	+{{x.round_money_is-x.round_money | number:2}}
	</span>
	<span ng-if="x.round_money_is < x.round_money" style="color:red;font-weight:bold">
	{{x.round_money_is-x.round_money | number:2}}
	</span>

</td>

			



			<td>{{x.adddate}}</td>
			<td>{{x.savedate}}</td>
			
			<td align="center">{{x.shift_id}}</td>
		
		</tr>
		
		
		<tr>
		<td colspan="6" align="right"><b><?php echo $lang_sum;?></b></td>
		<td align="right"><b>
		{{Sumroundmoney() | number:2}}
			</b></td>
		
		</tr>
		
	</tbody>
</table>
</div>



<form class="form-inline">
<div class="form-group">
<?=$lang_show?>
<select class="form-control" name="" id="" ng-model="perpage" ng-change="getlist(searchtext,'1',perpage)">
	<option value="10">10</option>
	<option value="20">20</option>
	<option value="30">30</option>
	<option value="50">50</option>
	<option value="100">100</option>
	<option value="200">200</option>
	<option value="300">300</option>
	<option value="500">500</option>
	<option value="1000">1000</option>
	<option value="10000">10000</option>
	<option value="100000">100000</option>
	<option value="1000000">1000000</option>
</select>

<?=$lang_page?>
<select name="" id="" class="form-control" ng-model="selectthispage"  ng-change="getlist(searchtext,selectthispage,perpage)">
	<option  ng-repeat="i in pagealladd" value="{{i.a}}">{{i.a}}</option>
</select>
</div>


</form>


<hr />
<button id="btnExport" class="btn btn-default" onclick="fnExcelReport();"> <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
<?=$lang_downloadexcel?>
 </button>











	</div>


	</div>

	</div>


		<script>
var app = angular.module('firstapp', []);
app.controller('Index', function($scope,$http,$location) {


	$scope.ParsefloatFunc = function(data){
return parseFloat(data);
};





$("#dayfrom").datetimepicker({
    datetimepicker:false,
        format:'d-m-Y H:i',
    lang:'th'  // แสดงภาษาไทย
    //yearOffset:543  // ใช้ปี พ.ศ. บวก 543 เพิ่มเข้าไปในปี ค.ศ
    //inline:true

});

$("#dayto").datetimepicker({
    datetimepicker:false,
        format:'d-m-Y H:i',
    lang:'th'  // แสดงภาษาไทย
    //yearOffset:543  // ใช้ปี พ.ศ. บวก 543 เพิ่มเข้าไปในปี ค.ศ
    //inline:true

});

$scope.dayfrom = '<?php echo date('d-m-Y 00:01',time());?>';
$scope.dayto = '<?php echo date('d-m-Y 23:59',time());?>';





$scope.perpage = '10';
$scope.getlist = function(searchtext,page,perpage){
	$scope.list = false;
	
   if(!searchtext){
   	searchtext = '';
   }


    if(!page){
   var	page = '1';
   }

 if(!perpage){
   var	perpage = '10';
   }

   $http.post("Log_round/get",{
searchtext:searchtext,
page: page,
perpage: perpage,
dayfrom: $scope.dayfrom,
dayto: $scope.dayto
}).success(function(data){
$scope.list = data.list;
$scope.pageall = data.pageall;
$scope.numall = data.numall;

$scope.pagealladd = [];
           for(i=1;i<=$scope.pageall;i++){
$scope.pagealladd.push({a:i});
}

$scope.selectpage = page;
$scope.selectthispage = page;

        });

   };
$scope.getlist('','1');





$scope.Sumroundmoney = function(){
var total = 0;

 angular.forEach($scope.list,function(item){
total += parseFloat(item.round_money_is-item.round_money);
 });
    return total;
};




});
	</script>
