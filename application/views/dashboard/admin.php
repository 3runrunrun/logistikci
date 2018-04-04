<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

          <!-- jQuery -->

          <!-- Show Province and City -->
          <script>
            function changeCity ()
            {
              var selected = $('#province option:selected').val();
              // console.log(selected);
              $('#city').empty();
              $('#city').append("<option value=''>Pilih Kota</option>");
              $.ajax({
                type: 'POST',
                url: "<?php echo site_url('ControllerSystem/showCityByProvince'); ?>",
                data:{
                  idprovince: selected
                },
                dataType: 'json',
                cache: false,
                success: function (result) {
                  // console.log(result);
                  $.each(result.city, function (key, value) {
                    var option = document.createElement("option");
                    option.text = value.city;
                    option.value = value.idcity;
                    $('#city').append(option);
                  })
                }
              });
             }

            $(document).ready(function() {
              $.ajax({
                url: "<?php echo site_url('ControllerSystem/showAllProvince'); ?>",
                dataType: 'json',
                cache: false,
                success: function (result) {
                  $.each(result.province, function (k, v) {
                    // console.log(k, v);
                    var option = document.createElement("option");
                    option.text = v.province;
                    option.value = v.idprovince;
                    $('#province').append(option);
                  })
                }
              });
            });
          </script>

          <!-- Branch Panel Value -->
          <script>
            function changePanel ()
            {
              var selectedcity = $('#city option:selected').val();

              // Ajax Branch
              $.ajax({
                type: 'POST',
                url: "<?php echo site_url('ControllerSystem/showBranchTotalByCity'); ?>",
                data:{
                  idcity: selectedcity
                },
                dataType: 'json',
                cache: false,
                success: function (result) {
                  $.each(result.total, function (key, value) {
                    $('#branch-total').html("<strong>" + value.total + "</strong>");
                  })
                  $.each(result.inactive, function (key, value) {
                    $('#branch-inactive').html("<strong>" + value.inactive + "</strong>");
                  })
                  $.each(result.onvacation, function (key, value) {
                    $('#branch-on-vacation').html("<strong>" + value.onvacation + "</strong>");
                  })
                  $.each(result.active, function (key, value) {
                    $('#branch-active').html("<strong>" + value.active + "</strong>");
                  })
                }
              });

              // Ajax Agent
              $.ajax({
                type: 'POST',
                url: "<?php echo site_url('ControllerSystem/showAgentTotalByCity'); ?>",
                data:{
                  idcity: selectedcity
                },
                dataType: 'json',
                cache: false,
                success: function (result) {
                  $.each(result.total, function (key, value) {
                    $('#agent-total').html("<strong>" + value.total + "</strong>");
                  })
                  $.each(result.inactive, function (key, value) {
                    $('#agent-inactive').html("<strong>" + value.inactive + "</strong>");
                  })
                  $.each(result.onvacation, function (key, value) {
                    $('#agent-on-vacation').html("<strong>" + value.onvacation + "</strong>");
                  })
                  $.each(result.active, function (key, value) {
                    $('#agent-active').html("<strong>" + value.active + "</strong>");
                  })
                }
              });

              // Ajax Reservation
              $.ajax({
                url: "<?php echo site_url('ControllerSystem/showReservationTotalByCity') ?>",
                type: 'POST',
                dataType: 'json',
                data: {idcity: selectedcity},
                cache: false,
                success: function (result) {
                  $.each(result.total, function (key, value) {
                    $('#rsv-total').html("<strong>" + value.total + "</strong>");
                  })
                  $.each(result.rejected, function (key, value) {
                    $('#rsv-rejected').html("<strong>" + value.rejected + "</strong>");
                  })
                  $.each(result.reserved, function (key, value) {
                    $('#rsv-reserved').html("<strong>" + value.reserved + "</strong>");
                  })
                  $.each(result.validated, function (key, value) {
                    $('#rsv-validated').html("<strong>" + value.validated + "</strong>");
                  })
                }
              });
              
             }
          </script>
          <!-- /jQuery -->
    
          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Dashboard</h1>
 
            <div class="wrapper-sm">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="col-lg-2 control-label">Provinsi</label>
                    <div class="col-lg-10">
                    <select id="province" name="account" onchange="changeCity()" class="form-control m-b">
                      <!-- Filled by jQuery -->
                      <option value="">Pilih Kota</option>
                    </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="col-lg-2 control-label">Kota</label>
                    <div class="col-lg-10">
                    <select id="city" name="account" onchange="changePanel()" class="form-control m-b">
                      <!-- Filled by jQuery -->
                      <option value="">Pilih Kota</option>
                    </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <br>

            <div class="wrapper-sm bg-dark">
              <div class="row">
               <div class="col-lg-12">
                <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title text-center">
                        Branch
                      </h4>
                    </div>
                    <div class="panel-body text-center">
                      <div class="row">
                        <div class="col-xs-12 col-lg-4 m-b-md">
                         <h2 id="branch-total" class="font-bold text-info">0</h2>
                         <small class="label m-b-sm btn-info btn-sm">Jumlah Kantor Cabang</small>
                        </div>
                        <div class="col-xs-4 col-lg-2 col-lg-offset-1 m-b-md">
                          <h3 id="branch-inactive" class="text-danger">0</h3>
                          <small class="label m-b-sm btn-danger btn-sm">Inactivated</small>
                        </div>
                        <div class="col-xs-4 col-lg-2">
                          <h3 id="branch-on-vacation" class="text-warning">0</h3>
                          <small class="label m-b-sm btn-warning btn-sm">On Vacation</small>
                        </div>
                        <div class="col-xs-4 col-lg-2">
                          <h3 id="branch-active" class="text-success">0</h3>
                          <small class="label m-b-sm btn-success btn-sm">Activated</small>
                        </div>
                      </div>
                    <div class="panel-footer"></div>
                  </div>
                  </div>
                </div>
               </div>
              </div>
            </div>

            <div class="row">
             <div class="col-lg-6">
              <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">
                  <a data-toggle="collapse" href="#collapse1">
                    <h4 class="panel-title text-center">
                      Agent
                    </h4></a>
                  </div>
                <div id="collapse1" class="panel-collapse collapse">
                  <div class="panel-body text-center">
                    <div class="row">
                      <div class="col-xs-12 col-lg-3 m-b-md" >
                       <h2 id="agent-total" class="font-bold text-info">0</h2>
                       <small class="label m-b-sm btn-info btn-sm">Agents</small>
                      </div>
                      <div class="col-xs-4 col-lg-2 col-lg-offset-1 m-b-md">
                        <h3 id="agent-inactive" class="text-danger">0</h3>
                        <small class="label m-b-sm btn-danger btn-sm">Inactivated</small>
                      </div>
                      <div class="col-xs-4 col-lg-2">
                        <h3 id="agent-onvacation" class="text-warning">0</h3>
                        <small class="label m-b-sm btn-warning btn-sm">On Vacation</small>
                      </div>
                      <div class="col-xs-4 col-lg-2">
                        <h3 id="agent-active" class="text-success">0</h3>
                        <small class="label m-b-sm btn-success btn-sm">Activated</small>
                      </div>
                    </div>
                  </div>
                  <div class="panel-footer"></div>
                </div>
                </div>
              </div>
             </div>
             <div class="col-lg-6">
              <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">
                  <a data-toggle="collapse" href="#collapse2">
                    <h4 class="panel-title text-center">
                      Reservation
                    </h4></a>
                  </div>
                <div id="collapse2" class="panel-collapse collapse">
                  <div class="panel-body text-center">
                    <div class="row">
                      <div class="col-xs-12 col-lg-3 m-b-md" >
                       <h2 id="rsv-total" class="font-bold text-info"><strong>0</strong></h2>
                       <small class="label m-b-sm btn-info btn-sm">Reservation Total</small>
                      </div>
                      <div class="col-xs-4 col-lg-3 m-b-md">
                        <h3 id="rsv-rejected" class="text-danger">0</h3>
                        <small class="label m-b-sm btn-danger btn-sm">Rejected</small>
                      </div>
                      <div class="col-xs-4 col-lg-3">
                        <h3 id="rsv-reserved" class="text-warning">0</h3>
                        <small class="label m-b-sm btn-warning btn-sm">Reserved</small>
                      </div>
                      <div class="col-xs-4 col-lg-3">
                        <h3 id="rsv-validated" class="text-success">0</h3>
                        <small class="label m-b-sm btn-success btn-sm">Validated</small>
                      </div>
                    </div>
                  </div>
                  <div class="panel-footer"></div>
                </div>
                </div>
              </div>
             </div>
            </div>

            <div class="row">
             <div class="col-lg-4">
              <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">
                  <a data-toggle="collapse" href="#collapse3">
                    <h4 class="panel-title text-center">
                      Complaint
                    </h4></a>
                  </div>
                <div id="collapse3" class="panel-collapse collapse">
                  <div class="panel-body text-center">
                    <div class="row">
                      <div class="col-xs-12 col-lg-3 m-b-md" >
                       <h2 id="info0" class="font-bold text-info"><strong>14</strong></h2>
                       <small class="label m-b-sm btn-info btn-sm">Complaint</small>
                      </div>
                      <div class="col-xs-4 col-lg-3 m-b-md">
                        <h3 id="info1" class="text-danger">1</h3>
                        <small class="label m-b-sm btn-danger btn-sm" style="white-space:normal">Not yet responded</small>
                      </div>
                      <div class="col-xs-4 col-lg-3">
                        <h3 id="info2" class="text-warning">1</h3>
                        <small class="label m-b-sm btn-warning btn-sm">On process</small>
                      </div>
                      <div class="col-xs-4 col-lg-3">
                        <h3 id="info3" class="text-success">12</h3>
                        <small class="label m-b-sm btn-success btn-sm">Responded</small>
                      </div>
                    </div>
                  </div>
                  <div class="panel-footer"></div>
                </div>
                </div>
              </div>
             </div>
             <div class="col-lg-4">
              <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">
                  <a data-toggle="collapse" href="#collapse4">
                    <h4 class="panel-title text-center">
                      Courier
                    </h4></a>
                  </div>
                <div id="collapse4" class="panel-collapse collapse">
                  <div class="panel-body text-center">
                    <div class="row">
                      <div class="col-xs-12 col-lg-3 m-b-md" >
                       <h2 id="info0" class="font-bold text-info"><strong>10</strong></h2>
                       <small class="label m-b-sm btn-info btn-sm">Couriers</small>
                      </div>
                      <div class="col-xs-4 col-lg-3 m-b-md">
                        <h3 id="info1" class="text-danger">1</h3>
                        <small class="label m-b-sm btn-danger btn-sm">Inactivated</small>
                      </div>
                      <div class="col-xs-4 col-lg-3">
                        <h3 id="info2" class="text-warning">1</h3>
                        <small class="label m-b-sm btn-warning btn-sm">On Vacation</small>
                      </div>
                      <div class="col-xs-4 col-lg-3">
                        <h3 id="info3" class="text-success">12</h3>
                        <small class="label m-b-sm btn-success btn-sm">Activated</small>
                      </div>
                    </div>
                  </div>
                  <div class="panel-footer"></div>
                </div>
                </div>
              </div>
             </div>
             <div class="col-lg-4">
              <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">
                  <a data-toggle="collapse" href="#collapse5">
                    <h4 class="panel-title text-center">
                      Armada
                    </h4></a>
                  </div>
                <div id="collapse5" class="panel-collapse collapse">
                  <div class="panel-body text-center">
                    <div class="row">
                      <div class="col-xs-12 col-lg-3 m-b-md" >
                       <h2 id="info0" class="font-bold text-info"><strong>14</strong></h2>
                       <small class="label m-b-sm btn-info btn-sm">Armadas</small>
                      </div>
                      <div class="col-xs-4 col-lg-3 m-b-md">
                        <h3 id="info1" class="text-danger">1</h3>
                        <small class="label m-b-sm btn-danger btn-sm">Inactivated</small>
                      </div>
                      <div class="col-xs-4 col-lg-3">
                        <h3 id="info2" class="text-warning">1</h3>
                        <small class="label m-b-sm btn-warning btn-sm">On Vacation</small>
                      </div>
                      <div class="col-xs-4 col-lg-3">
                        <h3 id="info3" class="text-success">12</h3>
                        <small class="label m-b-sm btn-success btn-sm">Activated</small>
                      </div>
                    </div>
                  </div>
                  <div class="panel-footer"></div>
                </div>
                </div>
              </div>
             </div>
            </div>

            <!-- Tables -->
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead><h4><strong>Statistic Per Branch</strong></h4>
                  <tr>
                    <th>ID</th>
                    <th>Branch</th>
                    <th>Reserved</th>
                    <th>Booked</th>
                    <th>On-Process</th>
                    <th>On-Transit</th>
                    <th><a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Received On Destination">RoD</a></th>
                    <th><a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Received by Recipient">RbR</a></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>JKT001</td>
                    <td>Jakarta Timur 001</td>
                    <td>20</td>
                    <td>18</td>
                    <td>8</td>
                    <td>2</td>
                    <td>4</td>
                    <td>4</td>
                  </tr>
                  <tr>
                    <td>JKT002</td>
                    <td>Jakarta Timur 002</td>
                    <td>20</td>
                    <td>18</td>
                    <td>8</td>
                    <td>2</td>
                    <td>4</td>
                    <td>4</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /Tables -->

         </div>
        </div>
      </div>
    </div>
  </div>
</div>
