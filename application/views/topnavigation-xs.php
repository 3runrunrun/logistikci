<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!-- topnavigation-xs -->
<nav class="navbar navbar-inverse navbar-fixed-top visible-xs">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo site_url('Admins') ?>">LogOn</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li>
          <form class="navbar-form" role="form" style="width:100%">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
          </li>
          <li><a href="<?php echo site_url('Admins') ?>"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Data Management <span class="caret"></span></a>
            <ul class="dropdown-menu dropdown-primary">
             <li><a href="<?php echo site_url('Branch/showBranchDataManagement') ?>">Branch</a></li>
             <li><a href="<?php echo site_url('Agent/showAgentDataManagement') ?>">Agent</a></li>
             <li><a href="<?php echo site_url('Courier/showCourierDataManagement') ?>">Courier</a></li>
             <li><a href="<?php echo site_url('Armada/showArmadaDataManagement') ?>">Armada</a></li>
            </ul>
          </li>
          <li><a href="<?php echo site_url('Admins/showMonitoring') ?>"><i class="glyphicon glyphicon-blackboard"></i> Monitoring</a></li>
          <li><a href="<?php echo site_url('Admins/showHistory') ?>"><i class="glyphicon glyphicon-time"></i> History</a></li>
          <li><a href="<?php echo site_url('Admins/showReport') ?>"><i class="glyphicon glyphicon-list"></i> Report</a></li>
          <li role="separator" class="divider"></li>
          <li class="dropdown-header">Settings</li>
          <li><a href="<?php echo site_url('Agent/showProfil') ?>"><span class="glyphicon glyphicon-user"></span> Profil</a></li>
          <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
      </div>
    </div>
</nav>
<!-- /topnavigation-xs -->
