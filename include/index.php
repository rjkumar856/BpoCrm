<?php 
ob_start();
if (!isset($_SESSION['userSession'])) {
 header('location:login');
}
include("header.php");

$u = 0;
$y = 0;
?>
<?php

 $open_t_stmt = $reg_user->runQuery("SELECT count(*) as total from lead_allocation where `status` = 'open'");
    $open_t_stmt->execute();
    $result_t = $open_t_stmt->fetchAll();
  	 foreach($result_t as $rowt)
    {
    	 $open = $rowt['total'];
    }
        $close_t_stmt = $reg_user->runQuery("SELECT count(*) as total from lead_allocation where `status` = 'close'");
    $close_t_stmt->execute();
    $result_c = $close_t_stmt->fetchAll();
  	 foreach($result_c as $rowc)
    {
    	 $close = $rowc['total'];
    }
          $leads_stmt = $reg_user->runQuery("SELECT count(*) as total from `add_leads`");
    $leads_stmt->execute();
    $result_l = $leads_stmt->fetchAll();
  	 foreach($result_l as $rowl)
    {
    	 $leads = $rowl['total'];
    }
    
$totalVisitors = $open+$close;
$newVsReturningVisitorsDataPoints = array(
	array("y"=> $open, "name"=> "Open Tickets", "color"=> "#E7823A"),
	array("y"=> $close, "name"=> "Closed Tickets", "color"=> "#546BC1")
);
 
$newVisitorsDataPoints = array(
	array("x"=> 1420050600000 , "y"=> 33000),
	array("x"=> 1422729000000 , "y"=> 35960),
	array("x"=> 1425148200000 , "y"=> 42160),
	array("x"=> 1427826600000 , "y"=> 42240),
	array("x"=> 1430418600000 , "y"=> 43200),
	array("x"=> 1433097000000 , "y"=> 40600),
	array("x"=> 1435689000000 , "y"=> 42560),
	array("x"=> 1438367400000 , "y"=> 44280),
	array("x"=> 1441045800000 , "y"=> 44800),
	array("x"=> 1443637800000 , "y"=> 48720),
	array("x"=> 1446316200000 , "y"=> 50840),
	array("x"=> 1448908200000 , "y"=> 51600)
);
 
$returningVisitorsDataPoints = array(
	array("x"=> 1420050600000 , "y"=> 22000),
	array("x"=> 1422729000000 , "y"=> 26040),
	array("x"=> 1425148200000 , "y"=> 25840),
	array("x"=> 1427826600000 , "y"=> 23760),
	array("x"=> 1430418600000 , "y"=> 28800),
	array("x"=> 1433097000000 , "y"=> 29400),
	array("x"=> 1435689000000 , "y"=> 33440),
	array("x"=> 1438367400000 , "y"=> 37720),
	array("x"=> 1441045800000 , "y"=> 35200),
	array("x"=> 1443637800000 , "y"=> 35280),
	array("x"=> 1446316200000 , "y"=> 31160),
	array("x"=> 1448908200000 , "y"=> 34400)
);
 
?>
<?php
    $open_count_stmt = $reg_user->runQuery("select count(la.user_id) ticketCount,u.first_name,u.middel_name,u.last_name,la.`status` from lead_allocation la, user u where la.`status`='open' and u.id=la.`user_id` group by la.user_id");
    $open_count_stmt->execute();
    $result_count = $open_count_stmt->fetchAll();
    $statusDataPoints = array();
    foreach($result_count as $rowCount)
    {
        echo $name = $rowCount["first_name"].$rowCount["middel_name"].$rowCount["last_name"];
        echo $status = $rowCount["status"];
        echo $ticket = $rowCount["ticketCount"];
        $ticketCount = (int)$ticket;
 		$statusDataPoints[$u] = array(label=> $name , y=> $ticketCount);
        $D = json_encode($statusDataPoints);  
     $u++;
    }

    ?>
    
    <?php
    $close_count_stmt = $reg_user->runQuery("select count(la.user_id) ticketCount,u.first_name,u.middel_name,u.last_name,la.`status` from lead_allocation la, user u where la.`status`='close' and u.id=la.`user_id` group by la.user_id");
    $close_count_stmt->execute();
    $result_close = $close_count_stmt->fetchAll();
    $closeDataPoints = array();
    foreach($result_close as $rowCountClose)
    {
        $name = $rowCountClose["first_name"].$rowCountClose["middel_name"].$rowCountClose["last_name"];
        $status = $rowCountClose["status"];
        $ticketClose = $rowCountClose["ticketCount"];
        $ticketCloseCount = (int)$ticketClose;
 		$closeDataPoints[$y] = array(label=> $name , y=> $ticketCloseCount);
        $closedTickets = json_encode($closeDataPoints);  
     $y++;
    }

    ?>
<link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>css/imgareaselect.css">
<style>
.u-img.img-cover{background: #cecece center; height:19.35em;}
.shadow-white {-webkit-box-shadow: 0 0 0 1px #fff !important;box-shadow: 0 0 0 1px #fff !important;padding: 10px;background: #d4d4d4;}
.zc-ref {display: none;}
.nav-tabs>li>a {border-color: #014373;color:#000000;padding: 10px;}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {color: #fff;background-color: #014373;border: 1px solid #014373;padding: 10px;}
ul.nav.nav-tabs li {background: #99d1f9;}
.nav-tabs>li>a:hover {border-color: #014373;background-color: #014373;color:white;}
.nav-tabs > li, .nav-pills > li {float:none;display:inline-block;*display:inline; /* ie7 fix */zoom:1;padding: 10px 0 10px 0;}
.nav-tabs, .nav-pills {text-align:center;}
.nav-tabs {border-bottom: 2px solid #014373;}
.img-center {margin:0 auto;padding: 15px;}
.col-md-6 {padding: 15px;}
.new-row {clear: left;}
.tab-content {padding: 20px;}
.no-title-col {padding-top: 30px;}
a.btn.btn-primary {padding: 10px 25px 10px 25px;font-size: 15px;background: #014373;}
</style>
<title>Home</title>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script>

    window.onload = function () {
    
        var options = {
        
        	animationEnabled: true,
        
        	title: {
        
        		text: "Open Tickets Status"
        
        	},
        
        	axisY: {
        
        		title: "Open Tickets (in %)",
        
        		suffix: "%",
        
        		includeZero: false
        
        	},
        
        	axisX: {
        
        		title: "Assigned Users"
        
        	},
        
        	data: [{
        
        		type: "column",
        
        		yValueFormatString: "#,##0.0#"%"",
        
        		dataPoints: <?php echo $D; ?>
        
        	}]
        
        };
        
        $("#chartContainer").CanvasJSChart(options);
        
        var options2 = {
        
        	animationEnabled: true,
        
        	title: {
        
        		text: "Closed Tickets Status"
        
        	},
        
        	axisY: {
        
        		title: "Closed Tickets (in %)",
        
        		suffix: "%",
        
        		includeZero: false
        
        	},
        
        	axisX: {
        
        		title: "Assigned Users"
        
        	},
        
        	data: [{
        
        		type: "column",
        
        		yValueFormatString: "#,##0.0#"%"",
        
        		dataPoints: <?php echo $closedTickets; ?>
        		
        	}]
        
        };
        
        $("#chartContainer2").CanvasJSChart(options2);
        
        var totalVisitors = <?php echo $totalVisitors ?>;
        var visitorsData = {
        	"Open vs Closed Tickets": [{
        
        		cursor: "pointer",
        		explodeOnClick: false,
        		innerRadius: "75%",
        		legendMarkerType: "square",
        		name: "Open vs Closed Tickets",
        		radius: "100%",
        		showInLegend: true,
        		startAngle: 90,
        		type: "doughnut",
        		dataPoints: <?php echo json_encode($newVsReturningVisitorsDataPoints, JSON_NUMERIC_CHECK); ?>
        	}],
        	"Open Tickets": [{
        		color: "#E7823A",
        		name: "Open Tickets",
        		type: "column",
        		xValueType: "dateTime",
        		dataPoints: <?php echo json_encode($newVisitorsDataPoints, JSON_NUMERIC_CHECK); ?>
        	}],
        	"Closed Tickets": [{
        		color: "#546BC1",
        		name: "Closed Tickets",
        		type: "column",
        		xValueType: "dateTime",
        		dataPoints: <?php echo json_encode($returningVisitorsDataPoints, JSON_NUMERIC_CHECK); ?>
        	}]
        };
         
        var newVSReturningVisitorsOptions = {
        	animationEnabled: true,
        	theme: "light2",
        	title: {
        		text: "Open vs Closed Tickets"
        	},
        	
        	legend: {
        		fontFamily: "calibri",
        		fontSize: 14,
        		itemTextFormatter: function (e) {
        			return e.dataPoint.name + ": " + Math.round(e.dataPoint.y / totalVisitors * 100) + "%";  
        		}
        	},
        	data: []
        };
         
        var visitorsDrilldownedChartOptions = {
        	animationEnabled: true,
        	theme: "light2",
        	axisX: {
        		labelFontColor: "#717171",
        		lineColor: "#a2a2a2",
        		tickColor: "#a2a2a2"
        	},
        	axisY: {
        		gridThickness: 0,
        		includeZero: false,
        		labelFontColor: "#717171",
        		lineColor: "#a2a2a2",
        		tickColor: "#a2a2a2",
        		lineThickness: 1
        	},
        	data: []
        };
         
        var chart = new CanvasJS.Chart("chartContainer1", newVSReturningVisitorsOptions);
        chart.options.data = visitorsData["Open vs Closed Tickets"];
        chart.render();
         
        function visitorsChartDrilldownHandler(e) {
        	chart = new CanvasJS.Chart("chartContainer1", visitorsDrilldownedChartOptions);
        	chart.options.data = visitorsData[e.dataPoint.name];
        	chart.options.title = { text: e.dataPoint.name }
        	chart.render();
        	$("#backBtton").toggleClass("invisible");
        }
         
        $("#backButon").click(function() { 
        	$(this).toggleClass("invisible");
        	chart = new CanvasJS.Chart("chartContainer1", newVSReturningVisitorsOptions);
        	chart.options.data = visitorsData["Open vs Closed Tickets"];
        	chart.render();
        });
    
    }

</script>

<style>
  #backButton {
	border-radius: 4px;
	padding: 8px;
	border: none;
	font-size: 16px;
	background-color: #2eacd1;
	color: white;
	position: absolute;
	top: 10px;
	right: 10px;
	cursor: pointer;
  }
  .invisible {
    display: none;
  }
</style>
<div class="site-content">
<!-- Content -->
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="row row-md mb-2">
                <div class="col-md-6">
                    <div class="box bg-white user-1">
                        <div class="u-img img-cover" style="background-image: url(images/opentickets.png);">
                            <div id="chartContainer" style="height: 250px; width: 100%;"></div>
                            <div class="u-content">
                            <div class="avatar box-64">
                            </div>
                            </div>
                        </div>
                                
                    </div>
                </div> 
                        
                <div class="col-md-6">
                    <div class="box bg-white user-1">
                        <div class="u-img img-cover" style="background-image: url(images/opentickets.png);">
                            <div id="chartContainer2" style="height: 250px; width: 100%;"></div>
                            <div class="u-content">
                            <div class="avatar box-64">
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                        
                <div class="col-md-6">
                    <div class="box bg-white user-1">
                        <div class="u-img img-cover" style="background-image: url(images/newclients.png);">
                            <div class="u-content">
                            <div class="avatar box-64">
                            </div>
                            <h3><i class="fa fa-sort-asc" aria-hidden="true"></i><p class="text-white pb-0-5" style="text-transform:uppercase"><?php echo $leads; ?>
                            </p></h3>
                            <h5><a class="text-white" href="#">Total Leads</a></h5>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="col-md-6">
                    <div class="box bg-white user-1">
                        <div class="u-img img-cover" style="background-image: url(images/opentickets.png);">
                            <div id="chartContainer1" style="height: 250px; width: 100%;"></div>
                            <button class="btn invisible" id="backButton">&lt; Back</button>
                            <div class="u-content">
                            <div class="avatar box-64">
                            </div>
                            </div>
                         </div>
                    </div>
                </div> 
        
        </div>
    <hr/>
    </div>
<?php include("footer.php"); ?>
</body>


</html>