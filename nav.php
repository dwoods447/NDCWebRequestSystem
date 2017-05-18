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
</style>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#"><img src="<?php echo $siteroot; ?>images/logo-top.png" alt="logo"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="#">Home</a></li>
        
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Login</a></li>
      </ul>
    </div>
  </div>
</nav>