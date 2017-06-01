<?php $siteroot = "./"?>
<style type="text/css">
	.navbar {
	 height: 98px;	
    border-radius: 0px !important;
    margin-bottom: 0px!important;
}
.navbar-brand {
	vertical-align: 0!important;
	height: 90px;
}
.navbar-brand img{

	margin-top: -10px;
}
.navbar-nav > li > a{
  display:  inline-block;
  padding: 1em !important;
  font-size: 1em;
  width: 160px;
  height: 75px;
  text-transform: uppercase;
  text-align: center;

}

.nav li{
  padding: 1em;
}
</style>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="./index.php"><img src="<?php echo $siteroot; ?>images/logo-top.png" alt="logo"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
         <li><a href="./web_form.php">New Request</a></li>
         <li><a href="./requests.php">View Requests...</a></li>
         <li><a href="./login.php">Admin Panel</a></li>
        
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>&nbsp;</li>
      </ul>
    </div>
  </div>
</nav>