<!DOCTYPE html>
<!-- sidebar menu -->
<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <li class="active dropdown"><a href="<?php echo site_url('Admins') ?>"><i class="glyphicon glyphicon-home"></i> Dashboard <span class="sr-only">(current)</span></a></li>
    <li role="presentation" href="employees.php">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> Data Management</a>
      <ul class="dropdown-menu">
        <li><a href="<?php echo site_url('Branch/showBranchDataManagement') ?>">Branch</a></li>
        <li><a href="<?php echo site_url('Agent/showAgentDataManagement') ?>">Agent</a></li>
        <li><a href="<?php echo site_url('Courier/showCourierDataManagement') ?>">Courier</a></li>
        <li><a href="<?php echo site_url('Armada/showArmadaDataManagement') ?>">Armada</a></li>
      </ul>
    </li>
    <li><a href="<?php echo site_url('Admins/showMonitoring') ?>"><i class="glyphicon glyphicon-blackboard"></i> Monitoring</a></li>
    <li><a href="<?php echo site_url('Admins/showHistory') ?>"><i class="glyphicon glyphicon-time"></i> History</a></li>
    <li><a href="<?php echo site_url('Admins/showReport') ?>"><i class="glyphicon glyphicon-list"></i> Report</a></li>
  </ul>
</div>
<!-- /sidebar menu -->
