
<nav class="navbar navbar-inverse" id="header" >
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">
       NavBrand
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo site_url('Call_Import');?>">IMPORT FILE</a></li>
<!--        <li><a href="<?php //echo site_url('Call_EditData')?>">EDIT DATA</a></li>-->
        <li><a href="<?php echo site_url('Call_EditData/MainEdit')?>">EDIT DATA</a></li>
        <li><a href="<?php echo site_url('Call_ShowLog/MainShow')?>">SHOW LOG</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <? if($this->session->userdata('IDEmp') == '') {?>
        <li><a href="<?echo site_url('Call_Login')?>"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <?} else {?>
          <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;<? echo iconv('tis-620//ignore','utf-8//ignore',$this->session->userdata("NameEmp"));?></a></li>
          <li><a href="<?echo site_url('Call_Login/logout')?>"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        <?}?>
       
      </ul>
    </div>
  </div>
</nav>
