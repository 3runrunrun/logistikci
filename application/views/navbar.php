<nav class="navbar navbar-inverse navbar-fixed-top hidden-xs">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="glyphicon glyphicon-cog" style="color:#fff"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url('Admins') ?>">LogOn</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="" alt=""> Syarif Hidayat <i class="glyphicon glyphicon-cog"></i>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="<?php echo site_url('Agent/showProfil') ?>"><span class="glyphicon glyphicon-user"></span> Profil </a></li>
                  <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
                </ul>
            </li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
</nav>

<div class="container-fluid">
<div class="row">
<!-- Sidebar menu -->
