<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Daftar Armada Tersedia</h4>
          <h5 id="av-departure-date"></h5>
        </div>
        <div id="modal-body" class="modal-body table-responsive">
          <!-- filled by jQuery -->
        </div>
        <div class="modal-footer">
          <em style="font-size:0.8em" class="pull-left">*Estimasi harga belum termasuk asuransi</em>
        </div>
      </div>
    </div>
  </div>

  <div class="container">

    <!-- Header & Navbar -->
    <?php include('navbar.php'); ?>
    <!-- /Header & Navbar -->

    <div class="jumbotron">
      <h1>Logistik Online</h1>
      <p class="lead">Layanan ekspedisi bagi Usaha Kecil dan Menengah (UKM) persembahan <a href="http://smartbisnis.id">SmartBisnis</a>. </p>
    </div>

    <div class="row marketing">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2 class="text-center">Cari armada cepat dan murah secara online disini!</h2>
      </div>
      <form id="reservation-form" action="">

        <!-- Form tujuan pengiriman -->
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
          <h4 class="text-left">1. Tujuan Pengiriman</h4>

          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <label class="pull-left" for="origin-city">Kota Asal</label>
            <select class="form-control" id="origin-city" name="origincity">
              <option selected>Pilih Kota Asal</option>
            </select>
          </div>

          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <label class="pull-left" for="arrival-city">Kota Tujuan</label>
            <select class="form-control" id="arrival-city" name="arrivalcity">
              <option selected>Pilih Kota Asal</option>
            </select>
          </div>

        </div>
        <!-- /Form tujuan pengiriman -->

        <!-- Form waktu pengiriman -->
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
          <h4 class="text-left">2. Waktu Pengiriman</h4>

          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <label class="pull-left" for="delivery-date">Tanggal Pengiriman</label>
            <input type="date" name="deliverydate" class="form-control" id="delivery-date" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>">
          </div>

          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <label class="pull-left" for="delivery-time">Jam Pengiriman</label>
            <select class="form-control" id="delivery-time" name="deliverytime">
              <option selected>Pilih Jam</option>
              <!-- Filled by jQuery -->
            </select>
          </div>

        </div>
        <!-- /Form waktu pengiriman -->

        <!-- Form ukuran barang -->
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
          <h4 class="text-left">3. Ukuran Barang</h4>

          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <label class="pull-left" for="cargo-category">Jenis Barang</label>
            <select name="cargocategory" id="cargo-category" class="form-control">
              <option value="">Jenis Muatan</option>
            </select>
          </div>

          <div class="form-group col-xs-6 col-6-12 col-md-6 col-lg-6">
            <label class="pull-left" for="cargo-weight">Berat</label>
            <input type="text" name="cargoweight" id="cargo-weight" class="form-control" placeholder="Kg">
          </div>

          <div class="form-group col-xs-6 col-6-12 col-md-6 col-lg-6">
            <label class="pull-left" for="insurance">Asuransi</label>
            <select name="insurance" id="insurance" class="form-control">
              <option value="0">No</option>
              <option value="1">Yes</option>
            </select>
          </div>

          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <label class="text-left" for="helperdimensi" style="width:100%">Dimensi</label>
            <em class="pull-left" id="helperdimensi" style="font-size:0.8em">*Dalam meter</em>
          </div>

          <div class="form-group col-xs-4 col-sm-4 col-lg-4">
            <label for="cargo-length" class="sr-only">Panjang</label>
            <input type="text" name="cargolength" id="cargo-length" class="form-control" placeholder="p">
          </div>

          <div class="form-group col-xs-4 col-sm-4 col-lg-4">
            <label for="cargo-width" class="sr-only">Lebar</label>
            <input type="text" name="cargowidth" id="cargo-width" class="form-control" placeholder="l">
          </div>

          <div class="form-group col-xs-4 col-sm-4 col-lg-4">
            <label for="cargo-height" class="sr-only">Tinggi</label>
            <input type="text" name="cargoheight" id="cargo-height" class="form-control" placeholder="t">
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
            <label for="cekketersediaan" class="sr-only">Cek ketersediaan</label>
            <input type="submit" name="cekketersediaan" value="Cek Ketersediaan" class="form-control btn btn-success" id="check-availability" data-toggle="modal" data-target="#myModal">
          </div>

        </div>
        <!-- /Form ukuran barang -->
      </form>
    </div>

    <!-- Form TrackOn - Trace & Tracking -->
    <div id="trackon" class="row marketing">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2 class="text-center">Lacak lokasi barang anda dengan TrackOn</h2>
        <form action="<?php echo site_url('User/showTrackingResult'); ?>" method="POST" class="form-inline">
          <div class="form-group col-xs-12 col-sm-9 col-md-9 col-lg-9 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
            <label for="noresi" class="sr-only">Nomor Resi</label>
            <input type="text" name="receiptnumber" class="form-control input-lg" placeholder="No. Resi" required>
            <div class="help-block hidden-sm hidden-md hidden-lg "></div>
            <label for="lacak" class="sr-only">Lacak</label>
            <input type="submit" value="Lacak" id="lacak" class="col-xs-offset-4 col-sm-offset-0 btn btn-primary input-lg">
          </div>
        </form>
      </div>
    </div>
    <!-- /Form TrackOn - Trace & Tracking -->

  </div>
  <!-- /container -->

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
            option.text = v.city + " (" + v.departureidbranch + ") ";
            option.value = v.departureidbranch;
            $('#origin-city').append(option);
          })
        }
      });
    });
  </script>

  <!-- Arrival Branch -->
  <script>
    $(document).ready(function() {
      var arrival = "<?php echo site_url('ControllerSystem/showArrivalPoint') ?>";
      $('#origin-city').change(function() {
        var berangkat = $('#origin-city').val();
        $('#arrival-city').empty();
        $('#arrival-city').append('<option selected>Pilih Kota Tujuan</option>');
        $.ajax({
          type: 'POST',
          url: arrival,
          dataType: 'json',
          data: {
            "berangkat": berangkat
          },
          cache: false,
          success: function(result) {
            $.each(result.results, function(k, v) {
              var option = document.createElement("option");
              option.text = v.city + " (" + v.arrivalidbranch + ") ";
              option.value = v.arrivalidbranch;
              $('#arrival-city').append(option);
            });
          }
        });
      });
    });
  </script>

  <!-- Delivery Time -->
  <script>
    $(document).ready(function () {
      $('#arrival-city').change(function () {
        $('#delivery-time').empty();
        $('#delivery-time').append('<option selected>Pilih Jam</option>');

        var keberangkatan = $('#origin-city').val();
        var kedatangan = $('#arrival-city').val();
        var url = "<?php echo site_url('ControllerSystem/showDepartureTime/"+keberangkatan+"/"+kedatangan+"') ?>";

        $.ajax({
          url: url,
          dataType: 'json',
          cache: false,
          success: function (result) {
            $.each(result.departuretime, function (k, v) {
              // console.log(k, v);
              var option = document.createElement("option");
              option.text = v.departuretime;
              option.value = v.departuretime;
              $('#delivery-time').append(option);
            });
          }
        });
      });
    });
  </script>

  <!-- Cargo Category -->
  <script>
    $(document).ready(function () {
      $('#delivery-time').change(function () {

        $('#cargo-category').empty();
        $('#cargo-category').append('<option selected>Jenis Muatan</option>');

        var keberangkatan = $('#origin-city').val();
        var kedatangan = $('#arrival-city').val();
        var deliverytime = $('#delivery-time').val();

        var url = "<?php echo site_url('ControllerSystem/showAvailableCargoCategory/') ?>";

        $.ajax({
          type: 'POST',
          url: url,
          data:{
            keberangkatan: keberangkatan,
            kedatangan: kedatangan,
            deliverytime: deliverytime
          },
          dataType: 'json',
          cache: false,
          success: function (result) {
            $.each(result.cargocategory, function (k, v) {
              // console.log(k, v);
              var option = document.createElement("option");
              option.text = v.category;
              option.value = v.idcargocategory;
              $('#cargo-category').append(option);
            });
          }
        });
      });
    });
  </script>

  <!-- Available Armada -->
  <script>
    $(document).ready(function () {
      $('#reservation-form').submit(function (event) {
        event.preventDefault();
        
        $('#modal-body').empty();

        var url = "<?php echo site_url('User/showAvailableArmada') ?>";
        var origincity = $('#origin-city').val();
        var arrivalcity = $('#arrival-city').val();
        var deliverydate = $('#delivery-date').val();
        var deliverytime = $('#delivery-time').val();
        var cargocategory = $('#cargo-category').val();
        var cargoweight = $('#cargo-weight').val();
        var insurance = $('#insurance').val();
        var cargolength = $('#cargo-length').val();
        var cargowidth = $('#cargo-width').val();
        var cargoheight = $('#cargo-height').val();  

        var tanggalcustom = new Date(deliverydate);
        tanggalcustom.toLocaleString();
        $('#av-departure-date').empty();
        $('#av-departure-date').html("Untuk pengiriman tanggal: <em><strong>"+tanggalcustom.toLocaleDateString()+"</strong></em>");

        $.ajax({
          type: 'POST',
          url: url,
          data: {
            origincity : origincity,
            arrivalcity : arrivalcity,
            deliverydate : deliverydate,
            deliverytime : deliverytime,
            cargocategory : cargocategory,
            cargoweight : cargoweight,
            insurance : insurance,
            cargolength : cargolength,
            cargowidth : cargowidth,
            cargoheight : cargoheight
          },
          dataType: 'json',
          cache: false,
          success: function (result) {

            $.each(result.armadalist, function (k, v) {

              $.ajax({
                url: "<?php echo site_url('User/showReservedCargoQuota/"+v.idarmada+"/"+origincity+"/"+arrivalcity+"/"+deliverydate+"/"+deliverytime+"'); ?>",
                dataType: 'json',
                cache: false,
                success: function (hasil) {
                  if (hasil.reservedcargo == false) {
                      v.beratsisa = v.beratsisa;
                      v.dimensisisa = v.dimensisisa;
                      v.panjangsisa = v.panjangsisa;
                      v.lebarsisa = v.lebarsisa;
                      v.tinggisisa = v.tinggisisa;
                    } else {
                      $.each(hasil.reservedcargo, function (k2, v2) {
                        v.beratsisa = v.beratsisa - v2.rweight;
                        v.dimensisisa = v.dimensisisa - (v2.rlength*v2.rwidth*v2.rheight);
                        v.panjangsisa = v.panjangsisa - v2.rlength;
                        v.lebarsisa = v.lebarsisa - v2.rwidth;
                        v.tinggisisa = v.tinggisisa - v2.rheight;
                        

                        if (v.beratsisa > 0 && v.dimensisisa > 0 && v.panjangsisa > 0 && v.lebarsisa > 0 && v.tinggisisa > 0)
                        {

                          if (cargolength > 1 || cargowidth > 1 || cargoheight > 1) {
                            fare = v.dimensionfare;
                          } else {
                            fare = v.weightfare;
                          }

                          var tautan = "<?php echo site_url('User/showReservationForm/"+v.idarmada+"/"+origincity+"/"+arrivalcity+"/"+deliverydate+"/"+deliverytime+"/"+cargocategory+"/"+cargoweight+"/"+insurance+"/"+cargolength+"/"+cargowidth+"/"+cargoheight+"/"+fare+"/"+v.departuretime+"/"+v.arrivaltime+"') ?>";

                          console.log(tautan);

                          $('#modal-body').append("<div class='row text-center'><div class='col-xs-6 col-sm-3 col-md-3 col-lg-3'><h6>Jam Pengiriman</h6><h3><strong>"+v.departuretime+"</strong></h3></div><div class='col-xs-6 col-sm-3 col-md-3 col-lg-3'><h6>Jam Tiba</h6><h3><strong>"+v.arrivaltime+"</strong></h3></div><div class='col-xs-12 col-sm-2 col-md-2 col-lg-2'><h6>Sisa Kuota</h6><div class='help-block' style='height:0.2em'>&nbsp;</div><div class='progress'><div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='40' aria-valuemin='0' aria-valuemax='100' style='width: 40%'><span class='sr-only'>40% Complete (success)</span></div></div></div><div class='col-xs-12 col-sm-4 col-md-4 col-md-3 col-lg-4 pull-right text-center'><h6>Estimasi biaya</h6><div class='help-block' style='height:0.2em'>&nbsp;</div><h5><strong>Rp "+fare+"*</strong></h5><a href='"+tautan+"' class='btn btn-xs btn-primary' style='width: 50%'>Pesan</a></div></div><div class='help-block'>&nbsp;</div>");
                        } else {
                          $('#modal-body').append("<div class='row text-center'><strong><em>Armada tidak tersedia.</em></strong></div>");
                        }
                    });
                  }
                }
              });
            });
          }
        });
      });
    });
  </script>