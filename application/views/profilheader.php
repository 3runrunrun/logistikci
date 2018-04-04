<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Logistik Online</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('dashboardassets/assets/css/bootstrap.css'); ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('dashboardassets/dist/css/dashboard.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('dashboardassets/dist/css/sticky-footer.css'); ?>" rel="stylesheet">
    <!-- Custom Theme Style -->
    <!-- <link href="dist/css/custom.min.css" rel="stylesheet"> -->

    <style type="text/css">
      /* USER PROFILE PAGE */
   .card {
      margin-top: 20px;
      padding: 30px;
      background-color: rgba(214, 224, 226, 0.2);
      -webkit-border-top-left-radius:5px;
      -moz-border-top-left-radius:5px;
      border-top-left-radius:5px;
      -webkit-border-top-right-radius:5px;
      -moz-border-top-right-radius:5px;
      border-top-right-radius:5px;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
  }
  .card.hovercard {
      position: relative;
      padding-top: 0;
      overflow: hidden;
      text-align: center;
      background-color: #fff;
      background-color: rgba(255, 255, 255, 1);
  }
  .card.hovercard .card-background {
      height: 130px;
  }
  .card-background img {
      -webkit-filter: blur(25px);
      -moz-filter: blur(25px);
      -o-filter: blur(25px);
      -ms-filter: blur(25px);
      filter: blur(25px);
      margin-left: -100px;
      margin-top: -200px;
      min-width: 130%;
  }
  .card.hovercard .useravatar {
      position: absolute;
      top: 15px;
      left: 0;
      right: 0;
  }
  .card.hovercard .useravatar img {
      width: 100px;
      height: 100px;
      max-width: 100px;
      max-height: 100px;
      -webkit-border-radius: 50%;
      -moz-border-radius: 50%;
      border-radius: 50%;
      border: 5px solid rgba(255, 255, 255, 0.5);
  }
  .card.hovercard .card-info {
      position: absolute;
      bottom: 14px;
      left: 0;
      right: 0;
  }
  .card.hovercard .card-info .card-title {
      padding:0 5px;
      font-size: 20px;
      line-height: 1;
      color: #262626;
      background-color: rgba(255, 255, 255, 0.1);
      -webkit-border-radius: 4px;
      -moz-border-radius: 4px;
      border-radius: 4px;
  }
  .card.hovercard .card-info {
      overflow: hidden;
      font-size: 12px;
      line-height: 20px;
      color: #737373;
      text-overflow: ellipsis;
  }
  .card.hovercard .bottom {
      padding: 0 20px;
      margin-bottom: 17px;
  }
  .btn-pref .btn {
      -webkit-border-radius:0 !important;
  }
    </style>

  </head>

  <body>
