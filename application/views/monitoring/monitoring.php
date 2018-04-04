<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Refresh table -->
<script>
  $(document).on('click', '#val-refresh, #rsv-refresh, #exp-refresh, #fxd-refresh, #complaint-refresh', function () {
    var url = "<?php echo site_url('Admins/showMonitoring') ?>";
    if ($(this).attr('id') == 'val-refresh') {
      $('#validation').load(url + ' #validation');
    } else if ($(this).attr('id') == 'rsv-refresh') {
      $('#reservation').load(url + ' #reservation');
    } else if ($(this).attr('id') == 'exp-refresh') {
      $('#expedition').load(url + ' #expedition');
    } else if ($(this).attr('id') == 'fxd-refresh') {
      $('#fixed-booking').load(url + ' #fixed-booking');
    } else if ($(this).attr('id') == 'complaint-refresh') {
      $('#complaint').load(url + ' #complaint');
    } 
  });
</script>

<!-- Departure Branch -->
<script>
  $(document).ready(function() {
    var departure = "<?php echo site_url('ControllerSystem/showDeparturePoint') ?>";
    $.ajax({
      url: departure,
      dataType: 'json',
      cache: false,
      success: function(result) {
        $.each(result.results, function(k, v) {
          var option = document.createElement("option");
          option.text = v.city;
          option.value = v.departureidbranch;
          $('#origin-city, #origin-city-2, #origin-city-3').append(option);
        })
      }
    });
  });
</script>

<!-- Validation Function -->
<script>
  $(document).ready(function () {
    $.ajax({
      url: "<?php echo site_url('Admins/showNewCourier'); ?>",
      cache: false,
      dataType: 'json',
      success: function (result) {
        if (result.newcourier == false) {
          $('#new-courier-row-data').empty();
          $('#new-courier-row-data').append("<td colspan='5' class='text-center'>Tidak ada data kurir terbaru</td>");
        } else {
          $('#new-courier-row-data').empty();
          $.each(result.newcourier, function (k, v) {
          $('#new-courier-row-data').append("<tr data-id='"+v.idcourier+"'><td>1.</td><td>"+v.idcourier+"</td><td>"+v.couriername+"</td><td><a data-toggle='modal' href='#form_validation' class='btn btn-xs btn-info validation-btn' data-id='"+v.idcourier+"'>Validation</a></td><td><button type='button' class='btn btn-xs btn-danger'>Belum Divalidasi</button></td></tr>");
          });
        }
      }
    });
  });
</script>

<script>
  $(document).on('click', '.validation-btn', function () {
    var idcourier = $(this).data('id');
    console.log(idcourier);
    $.ajax({
      url: "<?php echo site_url('Admins/showDetailNewCourier/"+idcourier+"') ?>",
      cache: false,
      dataType: 'json',
      success: function (result) {
        $.each(result.courierdetail, function (k, v) {
        $('#courier-id').val(v.idcourier);
        $('#courier-name').val(v.couriername);
        $('#courier-address').val(v.courieraddress);
        $('#courier-phone').val(v.courierphone);
        $('#courier-email').val(v.courieremail);
        $('#owner-id').val(v.idowner);
        $('#owner-name').val(v.ownername);
        $('#owner-address').val(v.owneraddress);
        $('#owner-phone').val(v.ownerphone);
        $('#owner-email').val(v.owneremail);
        });
      }
    })
  });
</script>
<!-- /Validation Function -->

<!-- Reservation Function -->
<script>
  $(document).ready(function () {
    $('#reservation-status').change(function () {
      var reservationstatus = $('#reservation-status').val();
      $('#reservation-status #pilih-data').remove();
      $('#reservation-data tr:gt(0)').remove();
      $.ajax({
        url: "<?php echo site_url('Admins/showReservation') ?>",
        type: 'POST',
        dataType: 'json',
        cache: false,
        data: {reservationstatus: reservationstatus},
        success: function (result) {
          if (result.reservationlist == false) {
            $('#reservation-data tr:first').after("<tr><td colspan='7' class='text-center'>Data tidak ditemukan</td></tr>");
          } else {
            $.each(result.reservationlist, function(k, v) {
                var btnframe;

                if (v.reservationstatus == '1') {
                  btnframe = "<a href='#rsv-validation' data-toggle='modal' class='btn btn-warning btn-xs validate-btn' style='width:100%' data-id='" + v.reservationcode + "'>Reserved</a>";
                } else if (v.reservationstatus == '2'){
                  btnframe = "<span class='btn btn-success btn-xs' style='width:100%'>Validated</a>";
                } else if (v.reservationstatus == '3'){
                  btnframe = "<span class='btn btn-danger btn-xs' style='width:100%'>Rejected</a>";
                }
                
               $('#reservation-data tr:first').after("<tr><td>1.</td><td>" + v.reservationcode + "</td><td>" + v.sendername + "</td><td><p>" + v.departurecity + "</p><p>" + v.departuretime.substring(0, 5) + "</p></td><td><p>" + v.arrivalcity + "</p><p>" + v.arrivaltime.substring(0, 5) + "</p></td><td>" + v.deliverydate + "</td><td>" + btnframe + "</td></tr>");
            });
          }
        }
      });
    });
  });
</script>

<script>
  $(document).on('click', '.validate-btn', function () {
    var reservationcode = $(this).data('id');
    $.ajax({
      url: "<?php echo site_url('Admins/showReservationDetail') ?>",
      type: 'POST',
      dataType: 'json',
      cache: false,
      data: {reservationcode: reservationcode},
      success: function (result) { 
        $.each(result.reservationdetail, function(k, v) {

          if (v.insurance == '1') {
            $('#insured').prop('selected', true);
            $('#harga-barang').empty();
            $('#harga-barang').append("<label for='goods-value' style='font-size:0.8em'>Nilai Barang (Rp)</label><input type='text' name='goodsvalue' id='goods-value' class='form-control' placeholder='Nilai barang dalam Rupiah'>");
          } else {
            $('#non-insured').prop('selected', true);
          }

          $('#reservation-code').val(v.reservationcode);
          $('#departure-id-branch').val(v.departureidbranch);
          $('#arrival-id-branch').val(v.arrivalidbranch);
          $('#reservation-date').val(v.reservationdate);
          $('#delivery-date').val(v.deliverydate);
          $('#cargo-weight').val(v.cargoweight);
          $('#cargo-length').val(v.cargolength);
          $('#cargo-width').val(v.cargowidth);
          $('#cargo-height').val(v.cargoheight);
          $('#id-cargo-category').val(v.idcargocategory);
          $('#insurance').val(v.insurance);
          $('#sender-name').val(v.sendername);
          $('#sender-address').val(v.senderaddress);
          $('#sender-email').val(v.senderemail);
          $('#sender-phone').val(v.senderphone);
          $('#recipient-name').val(v.recipientname);
          $('#recipient-address').val(v.recipientaddress);
          $('#recipient-phone').val(v.recipientphone);
          $('#id-armada').val(v.idarmada);
          $('#fare').val(v.fare); 
        });
      }
    })
  });
</script>
<!-- /Reservation Function -->

<!-- Exepedition Function -->
<script>
  $(document).ready(function () {
    $('#expedition-status').change(function () {
      var expeditionstatus = $('#expedition-status').val();
      $('#expedition-status #pilih-data').remove();
      $('#expedition-data tr:gt(0)').remove();
      $.ajax({
        url: "<?php echo site_url('Admins/showExpedition') ?>",
        type: 'POST',
        dataType: 'json',
        cache: false,
        data: {expeditionstatus: expeditionstatus},
        success: function (result) {
          if (result.expeditionlist == false) {
            $('#expedition-data tr:first').after("<tr><td colspan='7' class='text-center'>Data tidak ditemukan</td></tr>");
          } else {
            $.each(result.expeditionlist, function(k, v) {
                var btnframe;
                var expcode = v.idarmada + '-' + v.departureidbranch + '-' + v.arrivalidbranch+ '-' + v.deliverydate;
                if (v.shipmentstatus == '1') {
                  btnframe = "<a href='#set-exp-status' data-toggle='modal' class='btn btn-primary btn-xs manifest-btn' style='width:100%' data-id='" + expcode + "'>Manifested</a>";
                } else if (v.shipmentstatus == '2'){
                  btnframe = "<a href='#set-arrived' data-toggle='modal' class='btn btn-warning btn-xs journey-btn' style='width:100%' data-id='" + expcode + "'>On-Journey</a>";
                } else if (v.shipmentstatus == '3'){
                  btnframe = "<span class='btn btn-danger btn-xs' style='width:100%'>Canceled</a>";
                } else if (v.shipmentstatus == '4' || v.shipmentstatus == '5'){
                  btnframe = "<span class='btn btn-success btn-xs' style='width:100%'>Arrived</a>";
                }
                
               $('#expedition-data tr:first').after("<tr><td>1.</td><td>" + v.idarmada + "</td><td>" + v.totalpackage + " Paket</td><td>" + v.departuretime.substring(0, 5) + "</td><td>" + v.arrivaltime.substring(0, 5) + "</td><td>" + v.deliverydate.substring(0, 10) + "</td><td>" + btnframe + "</td></tr>");
            });
          }
        }
      });
    });
  });
</script>

<script>
  $(document).on('click', '.manifest-btn', function () {
    var expcode = $(this).data('id');
    var rcpno = new Array();
    $('#receipt-list').empty();
    $('#set-exp-status #rcp-no').empty();
    $.ajax({
      url: "<?php echo site_url('Admins/showManifestedPackage') ?>",
      type: 'POST',
      dataType: 'json',
      cache: false,
      data: {expcode: expcode},
      success: function (result) { 
        $.each(result.manifestedpackage, function(k, v) {
          
          $.ajax({
            url: "<?php echo site_url('Admins/getLoadedDetail'); ?>",
            type: 'POST',
            dataType: 'json',
            data: {reservationcode: v.reservationcode},
            cahce: false,
            success: function (rslt) {

              $.each(rslt.loadeddetail, function(i, j) {
                 $('#receipt-list').append("<tr><td>1</td><td>" + j.receiptnumber + "</td><td>" + j.cargoweight + " Kg.</td></tr>");
                 rcpno.push(j.receiptnumber);
              });
              $('#set-exp-status #rcp-no').val(rcpno);
            }
          })
        });
      }
    })
  });
</script>

<script>
  $(document).on('click', '.journey-btn', function () {
    var expcode = $(this).data('id');
    var rcpno = new Array();
    $('#receipt-list-2').empty();
    $('#set-arrived #rcp-no-2').empty();
    $.ajax({
      url: "<?php echo site_url('Admins/showOnJourneyPackage') ?>",
      type: 'POST',
      dataType: 'json',
      cache: false,
      data: {expcode: expcode},
      success: function (result) { 
        $.each(result.onjourneypackage, function(k, v) {
          $('#receipt-list-2').append("<tr><td>1</td><td>" + v.receiptnumber + "</td><td>" + v.cargoweight + " Kg.</td></tr>");
          rcpno.push(v.receiptnumber);
        });
        $('#set-arrived #rcp-no-2').val(rcpno);
      }
    })
  });
</script>
<!-- /Exepedition Function -->

<!-- Fixed Booking Function -->
<script>
  $(document).ready(function () {
    $('#shipment-status').change(function () {
      var shipmentstatus = $('#shipment-status').val();
      $('#shipment-status #pilih-data').remove();
      $('#fixed-booking-data tr:gt(0)').remove();
      $.ajax({
        url: "<?php echo site_url('Admins/showFixedBooking') ?>",
        type: 'POST',
        dataType: 'json',
        cache: false,
        data: {shipmentstatus: shipmentstatus},
        success: function (result) {
          if (result.fixedbookinglist == false) {
            $('#fixed-booking-data tr:first').after("<tr><td colspan='7' class='text-center'>Data tidak ditemukan</td></tr>");
          } else {
            $.each(result.fixedbookinglist, function(k, v) {
                // console.log(v);
                var btnframe;
                if (v.shipmentstatus == '1') {
                  btnframe = "<a href='#' data-toggle='modal' class='btn btn-primary btn-xs manifest-btn' style='width:100%' data-id='" + v.receiptnumber + "'>Manifested</a>";
                } else if (v.shipmentstatus == '2'){
                  btnframe = "<a href='#' data-toggle='modal' class='btn btn-warning btn-xs process-btn' style='width:100%' data-id='" + v.receiptnumber + "'>On-Processs</a>";
                } else if (v.shipmentstatus == '3'){
                  btnframe = "<a href='#' data-toggle='modal' class='btn btn-warning btn-xs transit-btn' style='width:100%' data-id='" + v.receiptnumber + "'>On-Transit</a>";
                } else if (v.shipmentstatus == '4'){
                  btnframe = "<a href='#set-delivered' data-toggle='modal' class='btn btn-info btn-xs received-btn' style='width:100%' data-id='" + v.receiptnumber + "'>Received On Destination</a>";
                } else if (v.shipmentstatus == '5'){
                  btnframe = "<a href='#' data-toggle='modal' class='btn btn-success btn-xs delivered-btn' style='width:100%' data-id='" + v.receiptnumber + "'>Delivered</a>";
                }
                
               $('#fixed-booking-data tr:first').after("<tr><td>1.</td><td>" + v.receiptnumber + "</td><td>" + v.sendername + "</td><td>" + v.recipientname + "</td><td>" + v.cargoweight + " Kg.</td><td>" + btnframe + "</td></tr>");
            });
          }
        }
      });
    });
  });
</script>

<script>
  $(document).on('click', '.received-btn', function () {
    var receiptnumber = $(this).data('id');
    $('#identity-data').empty();
    $('#package-data').empty();
    $('#noresi').empty();
    $.ajax({
      url: "<?php echo site_url('Admins/showFixedBookingDetail') ?>",
      type: 'POST',
      dataType: 'json',
      data: {receiptnumber: receiptnumber},
      cache: false,
      success: function (result) {
        if (result.fixedbookingdetail == false) {
          $('#identity-data').append("<tr><td colspan='2'>Data tidak ditemukan</td></tr>");
        } else {
          $.each(result.fixedbookingdetail, function(k, v) {
            console.log(result);
            var cargodimension = v.cargolength + " x " +  v.cargowidth + " x " + v.cargolength;
            $('#noresi').text(v.receiptnumber);
            $('#identity-data').append("<tr><td>" + v.sendername + "</td><td>" + v.recipientname + "</td></tr><tr><td>" + v.senderaddress + "</td><td>" + v.recipientaddress +"</td></tr>");
            $('#package-data').append("<tr><td>" + v.cargoweight + " Kg.</td><td>" + cargodimension + " m.</td><td>" + v.category + "</td></tr>");
            $('#arv-receipt').val(v.receiptnumber);
            $('#arv-shipment-status').val(v.shipmentstatus);
          });
        }
      }
    });
  });
</script>
<!-- /Fixed Booking Function -->

<!-- Complaint Function -->
<script>
  $(document).ready(function () {
    $('#complaint-status').change(function () {
      var complaintstatus = $('#complaint-status').val();
      $('#complaint-status #pilih-data').remove();
      $('#complaint-data tr:gt(0)').remove();
      $.ajax({
        url: "<?php echo site_url('Admins/showComplaint') ?>",
        type: 'POST',
        dataType: 'json',
        cache: false,
        data: {complaintstatus: complaintstatus},
        success: function (result) {
          if (result.complaintlist == false) {
            $('#complaint-data tr:first').after("<tr><td colspan='5' class='text-center'>Data tidak ditemukan</td></tr>");
          } else {
            $.each(result.complaintlist, function(k, v) {
                // console.log(v);
                var btnframe;
                if (v.complaintstatus == '1') {
                  btnframe = "<a href='#complaint-detail' data-toggle='modal' class='btn btn-danger btn-xs detail-btn' style='width:100%' data-id='" + v.receiptnumber + "'>Not Responded Yet</a>";
                } else if (v.complaintstatus == '2'){
                  btnframe = "<a href='#complaint-detail' data-toggle='modal' class='btn btn-warning btn-xs detail-btn' style='width:100%' data-id='" + v.receiptnumber + "'>On Processs</a>";
                } else if (v.complaintstatus == '3'){
                  btnframe = "<a href='#complaint-detail' data-toggle='modal' class='btn btn-success btn-xs detail-btn' style='width:100%' data-id='" + v.receiptnumber + "'>Responded</a>";
                } 
                
               $('#complaint-data tr:first').after("<tr><td>1.</td><td>" + v.receiptnumber + "</td><td>" + v.complaintdate + "</td><td>" + v.complaint + "</td><td>" + btnframe + "</td></tr>");
            });
          }
        }
      });
    });
  });
</script>

<script>
  $(document).on('click', '.detail-btn', function () {
    var receiptnumber = $(this).data('id');
    $('#complaint-rcp').empty();
    $('#complaint-date').empty();
    $('#complaint-text').empty();
    $.ajax({
      url: "<?php echo site_url('Admins/showComplaintDetail'); ?>",
      type: 'POST',
      dataType: 'json',
      data: {receiptnumber: receiptnumber},
      cache: false,
      success: function (result) {
        if (result.complaintdetail == false) {
           $('#complaint-rcp').text("Tidak ditemukan");
        } else {
          $.each(result.complaintdetail, function(k, v) {
            console.log(v);
            $('#complaint-rcp').text(v.receiptnumber);
            $('#complaint-date').text(v.complaintdate);
            $('#complaint-text').text(v.complaint);
          });
        }
      }
    })
  });
</script>
<!-- /Complaint Function -->

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">Monitoring</h1>
  <!-- Page Content -->
  <div class="row">
    <!-- Table Form Validation -->
    <div class="col-lg-12 panel panel-default">
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped" id="validation">
            <thead>
              <label>Form Validation</label>
              <label>&nbsp;</label>
              <label><button class="btn btn-sm btn-default glyphicon glyphicon-refresh" id="val-refresh"></button></label>
              <label class="pull-right">
                <select class="form-control input-sm">
                  <option value='5'>5</option>
                  <option value='10'>10</option>
                  <option value='15'>15</option>
                </select>
              </label>
              <label class="pull-right">
                <select style="width:100px" class="form-control input-sm">
                  <option value='courier'>courier</option>
                  <option value='armada'>armada</option>
                </select>
              </label>
            </thead>
            <tbody>
              <tr>
                <th>No.<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>ID<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Nama<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Validation<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Status<span class="glyphicon glyphicon-sort pull-right"></span></th>
              </tr>
            </tbody>
            <tbody id="new-courier-row-data">
              <!-- Filled byb jQuery -->
            </tbody>
          </table>
          <ul class="pagination pull-right">
            <li><a href="#">&laquo;</a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">&raquo;</a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Table Form Validation -->

    <!-- Table Reservation -->
    <div class="col-lg-12 panel panel-default">
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped" id="reservation">
            <thead>
              <label>Reservation</label>
              <label>&nbsp;</label>
              <label><button class="btn btn-sm btn-default glyphicon glyphicon-refresh" id="rsv-refresh"></button></label>
              <label class="pull-right">
                <select class="form-control input-sm">
                  <option value='5'>5</option>
                  <option value='10'>10</option>
                  <option value='15'>15</option>
                </select>
              </label>
              <label for="origin-city" class="pull-right">
                <select id="origin-city" class="form-control input-sm">
                  <!-- Filled by jQuery -->
                </select>
              </label>
              <label for="reservation-status" class=pull-right>
                <select id="reservation-status" class="form-control input-sm">
                  <option id="pilih-data" value="">Pilih Data</option>
                  <option value="0">Semua Data</option>
                  <option value="1">Reserved</option>
                  <option value="2">Validated</option>
                  <option value="3">Rejected</option>
                </select>
              </label>
            </thead>
            <tbody id="reservation-data">
              <tr>
                <th>No.<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Kode Reservasi<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Nama Pengirim<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Meeting Point<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Drop Point<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Tanggal Pengiriman<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Status<span class="glyphicon glyphicon-sort pull-right"></span></th>
              </tr>
              <tr>
                <td colspan="7" class="text-center">Pilih status reservasi yang ingin ditampilkan</td>
              </tr>
              <!-- Filled by jQuery -->
            </tbody>
          </table>
          <ul class="pagination pull-right">
            <li><a href="#">&laquo;</a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">&raquo;</a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Table Reservation -->

    <!-- Table Expedition -->
    <div class="col-lg-12 panel panel-default">
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped" id="expedition">
            <thead>
              <label>Ekspedisi</label>
              <label>&nbsp;</label>
              <label><button class="btn btn-sm btn-default glyphicon glyphicon-refresh" id="exp-refresh"></button></label>
              <label class="pull-right">
                <select class="form-control input-sm">
                  <option value='5'>5</option>
                  <option value='10'>10</option>
                  <option value='15'>15</option>
                </select>
              </label>
              <label for="origin-city-2" class="pull-right">
                <select id="origin-city-2" class="form-control input-sm">
                  <!-- Filled by jQuery -->
                </select>
              </label>
              <label for="expedition-status" class=pull-right>
                <select id="expedition-status" class="form-control input-sm">
                  <option id="pilih-data" value="">Pilih Data</option>
                  <option value="0">Semua Data</option>
                  <option value="1">Manifested</option>
                  <option value="2">On-Journey</option>
                  <option value="3">Canceled </option>
                  <option value="4">Arrived</option>
                </select>
              </label>
            </thead>
            <tbody id="expedition-data">
              <tr>
                <th>No.<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>ID Armada<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Jumlah Paket<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Jam Berangkat<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Jam Tiba<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Tanggal Pengiriman<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Status<span class="glyphicon glyphicon-sort pull-right"></span></th>
              </tr>
              <tr>
                <td colspan="7" class="text-center">Pilih status ekspedisi yang ingin ditampilkan</td>
              </tr>
              <!-- Filled by jQuery -->
            </tbody>
          </table>
          <ul class="pagination pull-right">
            <li><a href="#">&laquo;</a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">&raquo;</a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Table Expedition -->

    <!-- Table Fixed Booking -->
    <div class="col-lg-12 panel panel-default">
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped" id="fixed-booking">
            <thead>
              <label>Fixed Booking</label>
              <label>&nbsp;</label>
              <label><button class="btn btn-sm btn-default glyphicon glyphicon-refresh" id="fxd-refresh"></button></label>
              <label class="pull-right">
                <select class="form-control input-sm">
                  <option value='5'>5</option>
                  <option value='10'>10</option>
                  <option value='15'>15</option>
                </select>
              </label>
              <label for="origin-city-3" class="pull-right">
                <select id="origin-city-3" class="form-control input-sm">
                  <!-- Filled by jQuery -->
                </select>
              </label>
              <label for="shipment-status" class=pull-right>
                <select id="shipment-status" class="form-control input-sm">
                  <option id="pilih-data" value="">Pilih Data</option>
                  <option value="0">Semua Data</option>
                  <option value="1">Manifested</option>
                  <option value="2">On-Process</option>
                  <option value="3">On-Transit </option>
                  <option value="4">Received</option>
                  <option value="5">Delivered</option>
                </select>
              </label>
            </thead>
            <tbody id="fixed-booking-data">
              <tr>
                <th>No.<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>No. Resi<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Pengirim<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Penerima<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Berat Barang<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Status<span class="glyphicon glyphicon-sort pull-right"></span></th>
              </tr>
              <tr>
                <td colspan="6" class="text-center">Pilih status pengiriman yang akan ditampilkan </td>
              </tr>
              <!-- Filled by jQuery -->
            </tbody>
          </table>
          <ul class="pagination pull-right">
            <li><a href="#">&laquo;</a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">&raquo;</a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Table Fixed Booking -->

    <!-- Table Complaint -->
    <div class="col-lg-12 panel panel-default">
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped" id="complaint">
            <thead>
              <label>Complaint</label>
              <label>&nbsp;</label>
              <label><button class="btn btn-sm btn-default glyphicon glyphicon-refresh" id="complaint-refresh"></button></label>
              <label class="pull-right">
                <select class="form-control input-sm">
                  <option value='5'>5</option>
                  <option value='10'>10</option>
                  <option value='15'>15</option>
                </select>
              </label>
              <label for="complaint-status" class=pull-right>
                <select id="complaint-status" class="form-control input-sm">
                  <option id="pilih-data" value="">Pilih Data</option>
                  <option value="0">Semua Data</option>
                  <option value="1">Not Responded Yet</option>
                  <option value="2">On Process</option>
                  <option value="3">Responded</option>
                </select>
              </label>
            </thead>
            <tbody id="complaint-data">
              <tr>
                <th>No.<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>No. Resi<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Tanggal Pengaduan<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Aduan<span class="glyphicon glyphicon-sort pull-right"></span></th>
                <th>Status<span class="glyphicon glyphicon-sort pull-right"></span></th>
              </tr>
              <tr>
                <td colspan="6" class="text-center">Pilih status aduan yang akan ditampilkan </td>
              </tr>
              <!-- Filled by jQuery -->
            </tbody>
          </table>
          <ul class="pagination pull-right">
            <li><a href="#">&laquo;</a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">&raquo;</a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Table Complaint -->
  </div>
</div>

<!-- Modal Courier Validation -->
<div class="modal fade" id="form_validation" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="height:65px" text-center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4>Courier Validation</h4>
      </div>
      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('Admins/validateNewCourier'); ?>" method="POST">
        <div id="modal-body" class="modal-body">
          <div class="row">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-col-md-offset-1 col-lg-offset-1">
              <div class="form-group">
              <label for="courier-id" style="font-size:0.8em" >ID Kurir</label>
                <input type="text" name="idcourier" id="courier-id" required readonly class="form-control">
              </div>
              <div class="form-group">
                <label for="courier-name" style="font-size:0.8em">Nama Kurir</label>
                <div class="input-group">
                  <input type="text" name="couriername" id="courier-name" required="required" class="form-control" readonly />
                  <div class="input-group-addon">*</div>
                </div>
              </div>
              <div class="form-group">
                <label for="courier-address" style="font-size:0.8em">Alamat Kurir</label>
                <div class="input-group">
                  <input type="text" name="courieraddress" id="courier-address" required="required" class="form-control" readonly />
                  <div class="input-group-addon">*</div>
                </div>
              </div>
              <div class="form-group">
                <label for="courier-phone" style="font-size:0.8em">No. Telp Kurir</label>
                <div class="input-group">
                  <input type="tel" name="courierphone" id="courier-phone" required="required" class="form-control" readonly />
                  <div class="input-group-addon">*</div>
                </div>
                <em style="font-size:0.8em">Contoh: 0812xxxx</em>
              </div>
              <div class="form-group">
                <label for="courier-email" style="font-size:0.8em">Email Kurir</label>
                <div class="input-group">
                  <input type="email" name="courieremail" id="courier-email" required="required" class="form-control" readonly />
                  <div class="input-group-addon">*</div>
                </div>
                <em style="font-size:0.8em">Contoh: nama@mail.com</em>
              </div>
              <div class="form-group">
                <label for="owner-id" style="font-size:0.8em">Penanggung Jawab Kurir</label>
                <div class="input-group">
                  <input type="text" name="idowner" id="owner-id" required="required" class="form-control" readonly />
                  <div class="input-group-addon">*</div>
                </div>
              </div>
              <div class="form-group">
                <label for="owner-name" style="font-size:0.8em">Penanggung Jawab Kurir</label>
                <div class="input-group">
                  <input type="text" name="ownername" id="owner-name" required="required" class="form-control" readonly />
                  <div class="input-group-addon">*</div>
                </div>
              </div>
              <div class="form-group">
                <label for="owner-address" style="font-size:0.8em">Alamat Penanggung Jawab</label>
                <div class="input-group">
                  <input type="text" name="owneraddress" id="owner-address" required="required" class="form-control" readonly />
                  <div class="input-group-addon">*</div>
                </div>
              </div>
              <div class="form-group">
                <label for="owner-phone" style="font-size:0.8em">No. Telp Penanggung Jawab</label>
                <div class="input-group">
                  <input type="tel" name="ownerphone" id="owner-phone" required="required" class="form-control" readonly />
                  <div class="input-group-addon">*</div>
                </div>
                <em style="font-size:0.8em">Contoh: 0812xxxx</em>
              </div>
              <div class="form-group">
                <label for="owner-email" style="font-size:0.8em">Email Penanggung Jawab</label>
                <div class="input-group">
                  <input type="email" name="owneremail" id="owner-email" required="required" class="form-control" readonly>
                  <div class="input-group-addon">*</div>
                </div>
                <em style="font-size:0.8em">Contoh: nama@mail.com</em>
              </div>
              <div class="form-group hidden-xs pull-right">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Cancel</button>&nbsp;&nbsp;&nbsp;
                <button type="submit" name="reject" value="reject" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp;Reject</button>&nbsp;&nbsp;&nbsp;
                <button type="submit" name="validate" value="validate" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;Valid</button>
              </div>
              <div class="form-group visible-xs">
                <button type="button" class="btn btn-xs btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Cancel</button>&nbsp;&nbsp;&nbsp;
                <button type="submit" name="reject" value="reject" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp;Reject</button>&nbsp;&nbsp;&nbsp;
                <button type="submit" name="validate" value="validate" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;Valid</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /Modal Courier Validation -->

<!-- Modal Reservation Validation -->
<div class="modal fade" id="rsv-validation" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4>Validasi Reservasi</h4>
      </div>
      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('Admins/validateOrRejectReservation'); ?>" method="POST">
        <div class="modal-body">
         
         <div class="row">
           
           <div class="col-xs-10 col-sm-9 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
              <h4 class="text-center">Reservasi RSV001</h4>

              <div class="form-group">
                <label for="reservation-code" style="font-size:0.8em">Kode Reservasi</label>
                <input type="text" name="reservationcode" id="reservation-code" class="form-control" readonly>
              </div>

              <div class="form-group">
                <label for="departure-id-branch" style="font-size:0.8em">Kota Asal</label>
                <input type="text" name="departureidbranch" id="departure-id-branch" class="form-control" readonly>
              </div>
              
              <div class="form-group">
                <label for="arrival-id-branch" style="font-size:0.8em">Kota Tujuan</label>
                <input type="text" name="arrivalidbranch" id="arrival-id-branch" class="form-control" readonly>
              </div>

              <div class="form-group">
                <label for="reservation-date" style="font-size:0.8em">Tanggal Reservasi</label>
                <input type="text" name="reservationdate" id="reservation-date" class="form-control" readonly>
              </div>
              
              <div class="form-group">
                <label for="delivery-date" style="font-size:0.8em">Tanggal Pengiriman</label>
                <input type="text" name="deliverydate" id="delivery-date" class="form-control" readonly>
              </div>
              
              <div class="form-group">
                <label for="cargo-weight" style="font-size:0.8em">Berat Barang</label>
                <input type="text" name="cargoweight" id="cargo-weight" class="form-control">
              </div>
              
              <div class="form-group">
                <label for="cargo-length" style="font-size:0.8em">Panjang Barang</label>
                <input type="text" name="cargolength" id="cargo-length" class="form-control">
              </div>
              
              <div class="form-group">
                <label for="cargo-width" style="font-size:0.8em">Lebar Barang</label>
                <input type="text" name="cargowidth" id="cargo-width" class="form-control">
              </div>
              
              <div class="form-group">
                <label for="cargo-height" style="font-size:0.8em">Tinggi Barang</label>
                <input type="text" name="cargoheight" id="cargo-height" class="form-control">
              </div>
              
              <div class="form-group">
                <label for="id-cargo-category" style="font-size:0.8em">Kategori Muatan</label>
                <input type="text" name="idcargocategory" id="id-cargo-category" class="form-control" readonly>
              </div>
              
              <div class="form-group">
                <label for="insurance" style="font-size:0.8em">Asuransi</label>
                <select name="insurance" id="insurance" class="form-control">
                  <!-- filled by jQuery -->
                  <option value="1" id="insured">Asuransi</option>
                  <option value="0" id="non-insured">Non-Asuransi</option>
                </select>
              </div>

              <div class="form-group" id="harga-barang">
                <!-- filled by jQuery -->
                <!-- <label for="goods-value" style="font-size:0.8em">Nilai Barang (Rp)</label>
                <input type="text" name="goodsvalue" id="goods-value" class="form-control" placeholder="Nilai barang dalam Rupiah"> -->
              </div>
              
              <div class="form-group">
                <label for="sender-name" style="font-size:0.8em">Nama Penerima</label>
                <input type="text" name="sendername" id="sender-name" class="form-control" >
              </div>
              
              <div class="form-group">
                <label for="sender-address" style="font-size:0.8em">Alamat Penerima</label>
                <input type="text" name="senderaddress" id="sender-address" class="form-control" >
              </div>
              
              <div class="form-group">
                <label for="sender-email" style="font-size:0.8em">Email Penerima</label>
                <input type="text" name="senderemail" id="sender-email" class="form-control" >
              </div>
              
              <div class="form-group">
                <label for="sender-phone" style="font-size:0.8em">No. Telp. Pengirim</label>
                <input type="text" name="senderphone" id="sender-phone" class="form-control" >
              </div>
              
              <div class="form-group">
                <label for="recipient-name" style="font-size:0.8em">Nama Penerima</label>
                <input type="text" name="recipientname" id="recipient-name" class="form-control" >
              </div>
              
              <div class="form-group">
                <label for="recipient-address" style="font-size:0.8em">Alamat Penerima</label>
                <input type="text" name="recipientaddress" id="recipient-address" class="form-control" >
              </div>
              
              <div class="form-group">
                <label for="recipient-phone" style="font-size:0.8em">No. Telp. Penerima</label>
                <input type="text" name="recipientphone" id="recipient-phone" class="form-control" >
              </div>
              
              <div class="form-group">
                <label for="id-armada" style="font-size:0.8em">Kode Armada</label>
                <input type="text" name="idarmada" id="id-armada" class="form-control" >
              </div>
              
              <div class="form-group">
                <label for="fare" style="font-size:0.8em">Tarif</label>
                <input type="text" name="fare" id="fare" class="form-control" readonly>
              </div>

          </div>

         </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Cancel</button>&nbsp;&nbsp;&nbsp;
          <button type="submit" name="reject" value="reject" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp;Reject</button>
          <button type="submit" name="validate" value="validate" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>&nbsp;Validate</button>
        </div>
      </form>    
    </div>
  </div>
</div>
<!-- /Modal Reservation Validation -->

<!-- Modal Show Manifested Package -->
<div class="modal fade" id="set-exp-status" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4>Form Keberangkatan Armada</h4>
      </div>
      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('Admins/setExpeditionStatus'); ?>" method="POST">
        <div class="modal-body">
         
         <div class="row">
           
           <div class="col-xs-10 col-sm-9 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
              <h4 class="text-center">Daftar Barang Yang Dimuat</h4>
              <div class="form-group">
                <label for="rcp-no" class="sr-only">Nomor Resi</label>
                <input type="hidden" name="receiptnumber" id="rcp-no" class="form-control">
              </div>

              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <td>No.</td>
                      <td>No. Resi</td>
                      <td>Berat Barang</td>
                    </tr>
                  </thead>
                  <tbody id="receipt-list">
                    <tr>
                      <td colspan="3">Daftar muatan kosong</td>
                    </tr>
                  </tbody>
                </table>
              </div>

          </div>

         </div>

        </div>
        <div class="modal-footer">
          <button type="submit" name="cancel" value="canceljourney" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp;Cancel Journey</button>
          <button type="submit" name="set" value="setjourney" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>&nbsp;Set Journey</button>
        </div>
      </form>    
    </div>
  </div>
</div>
<!-- /Modal Show Manifested Package -->

<!-- Modal Show On-Journey Package -->
<div class="modal fade" id="set-arrived" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4>Form Kedatangan Armada</h4>
      </div>
      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('Admins/setArrived'); ?>" method="POST">
        <div class="modal-body">
         
         <div class="row">
           
           <div class="col-xs-10 col-sm-9 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
              <h4 class="text-center">Daftar Barang Yang Dimuat</h4>
              <div class="form-group">
                <label for="rcp-no-2" class="sr-only">Nomor Resi</label>
                <input type="hidden" name="receiptnumber" id="rcp-no-2" class="form-control">
              </div>

              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <td>No.</td>
                      <td>No. Resi</td>
                      <td>Berat Barang</td>
                    </tr>
                  </thead>
                  <tbody id="receipt-list-2">
                    <tr>
                      <td colspan="3">Daftar muatan kosong</td>
                    </tr>
                  </tbody>
                </table>
              </div>

          </div>

         </div>

        </div>
        <div class="modal-footer">
          <button type="submit" name="cancel" value="canceljourney" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp;Cancel Journey</button>
          <button type="submit" name="set" value="setjourney" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>&nbsp;Set Journey</button>
        </div>
      </form>    
    </div>
  </div>
</div>
<!-- /Modal Show On-Journey Package -->

<!-- Modal Show Arrived Package -->
<div class="modal fade" id="set-delivered" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4>Bukti Penerima</h4>
      </div>
      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('Admins/setDelivered'); ?>" method="POST">
        <div class="modal-body">
         
         <div class="row">
           
           <div class="col-xs-10 col-sm-9 col-md-10 col-lg-12 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-0">

              <div class="well well-sm" style="background-color:#CCCCCC">No. Resi: <strong><em id="noresi"></em></strong></div>

              <div class="form-group">
                <input type="hidden" name="receiptnumber" id="arv-receipt" class="form-control">
              </div>

              <div class="form-group">
                <input type="hidden" name="shipmentstatus" id="arv-shipment-status" class="form-control">
              </div>

              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead style="background-color:#CCCCCC">
                    <tr>
                      <th>Pengirim</th>
                      <th>Penerima</th>
                    </tr>
                  </thead>
                  <tbody id="identity-data">
                    <tr>
                      <td colspan="3" class="text-center">Daftar muatan kosong</td>
                    </tr>
                    <!-- Filled by jQuery -->
                  </tbody>
                </table>
              </div>

              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead style="background-color:#CCCCCC">
                    <tr>
                      <th>Berat Barang</th>
                      <th>Dimensi Barang</th>
                      <th>Jenis Barang</th>
                    </tr>
                  </thead>
                  <tbody id="package-data">
                    <!-- <tr>
                      <td colspan="3" class="text-center">Daftar muatan kosong</td>
                    </tr> -->
                    <tr>
                      <td>3 Kg.</td>
                      <td>0.1 * 0.2 * 0.3 m.</td>
                      <td>Kimia Padat</td>
                    </tr>
                    <!-- Filled by jQuery -->
                  </tbody>
                </table>
              </div>

          </div>

         </div>

        </div>
        <div class="modal-footer">
          <button type="submit" name="deliver" value="deliver" class="btn btn-success">Deliver</button>
        </div>
      </form>    
    </div>
  </div>
</div>
<!-- /Modal Show Arrived Package -->

<!-- Modal Show Complaint -->
<div class="modal fade" id="complaint-detail" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4>Aduan</h4>
      </div>
      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="POST">
        <div class="modal-body">
         
         <div class="row">
           
           <div class="col-xs-10 col-sm-9 col-md-10 col-lg-12 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-0">

            <div class="well well-sm" style="background-color:#CCCCCC">No. Resi: <strong><em id="complaint-rcp"></em></strong></div>

            <div class="well well-sm"><em id="complaint-date"></em></div>

            <div class="well"><p id="complaint-text"></p></div>

          </div>

         </div>

        </div>
        <div class="modal-footer">
          <button type="submit" name="respond" value="respond" class="btn btn-success">Respond</button>
        </div>
      </form>    
    </div>
  </div>
</div>
<!-- /Modal Show Complaint -->

