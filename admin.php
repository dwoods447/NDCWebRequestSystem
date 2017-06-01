<?php include 'header.php';?>		
<?php include 'nav.php';?>	 
<style>
.switchboard-container{

background-color: #fff;
}
.switchboard{
	display: block;
	max-width: 345px;
	margin: 0px;
	padding: 0px;
  text-decoration: none;
}

.switchboard-header{
	height: 55px;
	background-color: #2e84c8;
	padding: 1em;
	max-width: 345px;
	color: #fff;
	text-align: center;
}

.switchboard li{
	text-align: center;
	display: block;
	margin: 0.1em;
	padding: 1em;
	max-width: 345px;
	height: 50px;
	list-style-type: none;
	color: #000;
}
.switchboard li:hover{
  background-color: #3f92a8;
}

.main-container{
	
	min-width: 1035px;
	
  overflow: hidden;
}

.sitewrapper{
	
	margin: 1.5em;
	background-color: #fff;
	overflow-x: scroll;
	overflow-y: scroll;
}
.all{
	
}

.shortCell{
  	white-space: nowrap; 
  	text-overflow: ellipsis !important; 
  	overflow: hidden; 
  	max-width: 210px;
  }
  th{
      color: #fff;
     font-weight: 600;
     background-color: #2e83c7;
     min-width: 150px;
     }
	table{
    font-size: 0.8em !important;
    padding:  0.2em !important;

  }

  table td{
    font-size: 1em !important;
    padding:  0.5em !important;
    text-align: center;

  }

  .menu-text{
  	font-size: 1.2em;
  }

  /*Stats*/

  .stats{

  }

  .stat-box{
  	width: 255px;
  	height: 140px;
  	display: inline-block;
  	margin: 2.5em;
  	padding: 1em;
  	background-color: #aecfec;


  }
  .stat{
  	  text-align: center;
     color: #fff;
  	font-weight: 900;
  	font-weight: 2em;
  }

 #leftwrapper{
 
 	margin-left: -15px;
 }
 #rightwrapper{
  
 	margin-right: -15px;
 
 }

 .tab-pane{
  display: none;
 }
.adminform{
              max-width: 550px; 
              margin: 0.5em auto; 
              padding: 0.5em; 
              
            }
            .form-input{
              width: 90%;
              height: 45px;
              margin: 0.5em auto;
              padding: 0.5em;
            }
            .form-submit{
              width: 90%;
              height: 60px;
              margin: 0.5em auto;
            }

            .coordinatorwrapper{
              
              height: 100%;
              margin: 0 auto;
              overflow-x: scroll;
              overflow-y: scroll;
            }

</style>

<div class="row">
<div class="all">
	<div class="col-lg-3 col-md-3 col-sm-3" id="rightwrapper">
		<div class="switchboard-container"  style="border: 1px solid #eee;">
		  <div class="switchboard-header"><i class="fa fa-tachometer fa-2x" aria-hidden="true"></i>&nbsp;<span class="menu-text">Dashboard</span>
      </div>
			  <?php include'dashboard-menu.inc.php';?>
		</div>
	</div>

	<div class="col-lg-9 col-md-9 col-sm-9" id="leftwrapper">
		 <div class="main-container">
          <div class="row">

              <?php include'coordinators.inc.php';?>


              <?php include'developers.inc.php';?>
              
              <?php include'completed-requests.inc.php';?>
			    </div>
		 </div>
	</div>
   </div>
</div>
<script src="./js/tabs.js"></script>
<script type="text/javascript">
  $(function() {
        $(document).tooltip();
  });

</script>
<script>

$(window).on("scroll", function(){

  var bodyObj = $('body');
var switchboard =$('.switchboard-container');
var windowHeight = $(bodyObj).height();

if(windowHeight <= 1348){
  $(switchboard).height(windowHeight);
}else{
    $(switchboard).height(648);
}


});
</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>