<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Profil</h1>
          <div class="row">
              <div class="col-sm-6 col-md-12 col-lg-12 col-sm-offset-3 col-md-offset-0 col-lg-offset-0">
                <div class="card hovercard">
                  <div class="card-background">
                    <img class="card-bkimg" alt="" src="<?php echo base_url('dashboardassets/dist/img/2.jpg') ?>">
                  </div>
                  <div class="useravatar">
                    <img alt="" src="<?php echo base_url('dashboardassets/dist/img/2.jpg') ?>">
                  </div>
                  <div class="card-info">
                    <span class="card-title">Anonymous</span>
                  </div>
                </div>
                <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
                  <div class="btn-group" role="group">
                    <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                      <div class="hidden-xs">Home</div>
                    </button>
                  </div>
                  <div class="btn-group" role="group">
                    <button type="button" id="following" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        <div class="hidden-xs">Settings</div>
                    </button>
                  </div>
                </div>

                <div class="well">
                  <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1">
                      <table>
                        <tr>
                          <td>Name</td>
                          <td>:&nbsp;</td>
                          <td>Ahmad Santoso</td>
                        </tr>
                        <tr>
                          <td>Email</td>
                          <td>:&nbsp;</td>
                          <td>ahmadsantoso@email.com</td>
                        </tr>
                        <tr>
                          <td>Nomor Identitas</td>
                          <td>:&nbsp;</td>
                          <td>7000101120103010</td>
                        </tr>
                        <tr>
                         <td>Phone</td>
                         <td>:&nbsp;</td>
                         <td>08119920110</span></td>
                        </tr>
                        <tr>
                         <td>Address</td>
                         <td>:&nbsp;</td>
                         <td>Jl. Ir. Soekarno No.99</span></td>
                        </tr>
                        <tr>
                          <td>Jenis Kelamin</td>
                          <td>:&nbsp;</td>
                          <td>Laki-Laki</td>
                        </tr>
                        <tr>
                          <td>Tanggal Lahir</td>
                          <td>:&nbsp;</td>
                          <td>21/10/1982</td>
                        </tr>
                        <tr>
                          <td>Nama Penjamin</td>
                          <td>:&nbsp;</td>
                          <td>Marta Tilaar</td>
                        </tr>
                        <tr>
                          <td>No. Telepon Penjamin</td>
                          <td>:&nbsp;</td>
                          <td>082143890567</td>
                        </tr>
                        <tr>
                          <td>Status Penjamin</td>
                          <td>:&nbsp;</td>
                          <td>Istri</td>
                        </tr>
                      </table>
                    </div>
                    <div class="tab-pane fade in" id="tab2">
                      <h4><strong>Edit Profile</strong></h4>
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        <div class="form-group">
                          <div class="input-group">
                            <label for="agent-name" class="sr-only col-md-3 col-sm-3 col-xs-12">Nama Agen</label>
                            <input type="text" id="agent-name" required="required" class="form-control" placeholder="Nama Agen">
                            <div class="input-group-addon">*</div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <label for="agent-email" class="sr-only col-md-3 col-sm-3 col-xs-12">Email Agen</label>
                            <input type="email" id="agent-email" required="required" class="form-control" placeholder="Email Agen">
                            <div class="input-group-addon">*</div>
                          </div>
                          <em style="font-size:0.8em">nama@email.com</em>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <label for="agent-idnumb" class="sr-only col-md-3 col-sm-3 col-xs-12">Nomor Identitas Agen</label>
                            <input type="text" id="agent-idnumb" required="required" class="form-control" placeholder="Nomor Identitas Agen">
                            <div class="input-group-addon">*</div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <label for="agent-phone" class="sr-only col-md-3 col-sm-3 col-xs-12">No. Telepon Agen</label>
                            <input type="tel" id="agent-phone" required="required" class="form-control" placeholder="Nomor Telepon Agen">
                            <div class="input-group-addon">*</div>
                          </div>
                          <em style="font-size:0.8em">Contoh: 081*********</em>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <label for="agent-address" class="sr-only col-md-3 col-sm-3 col-xs-12">Alamat Agen</label>
                            <input type="text" id="agent-address" required="required" class="form-control" placeholder="Alamat Agen">
                            <div class="input-group-addon">*</div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <label for="agent-gender" style="font-size:0.8em">Jenis Kelamin Agen</label><br>
                              <div class="radio radio-inline">
                                <label><input type="radio" name="gender" value="male" checked>L</label>
                              </div>
                              <div class="radio radio-inline">
                                <label><input type="radio" name="gender" value="female">P</label>
                              </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <em style="font-size:0.8em">Tanggal Lahir Agen</em>
                          <div class="input-group">
                            <label for="agent-bdate" class="sr-only" style="font-size:0.8em">Tanggal Lahir Agen</label>
                            <input type="date" id="agent-bdate" required="required" class="form-control">
                            <div class="input-group-addon">*</div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <label for="insurer-name" class="sr-only col-md-3 col-sm-3 col-xs-12">Nama Penjamin</label>
                            <input type="text" id="insurer-name" required="required" class="form-control" placeholder="Nama Penjamin">
                            <div class="input-group-addon">*</div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <label for="insurer-address" class="sr-only col-md-3 col-sm-3 col-xs-12">Alamat Penjamin</label>
                            <input type="text" id="insurer-address" required="required" class="form-control" placeholder="Alamat Penjamin">
                            <div class="input-group-addon">*</div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <label for="insurer-phone" class="sr-only col-md-3 col-sm-3 col-xs-12">No. Telepon Penjamin</label>
                            <input type="tel" id="insurer-phone" required="required" class="form-control" placeholder="Nomor Telepon Penjamin">
                            <div class="input-group-addon">*</div>
                          </div>
                          <em style="font-size:0.8em">Contoh: 081*********</em>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <label for="insurer-rel" style="font-size:0.8em">Status Penjamin</label><br>
                              <div class="radio radio-inline">
                                <label><input type="radio" name="relation" value="Suami">Suami</label>
                              </div>
                              <div class="radio radio-inline">
                                <label><input type="radio" name="relation" value="Istri" checked>Istri</label>
                              </div>
                              <div class="radio radio-inline">
                                <label><input type="radio" name="relation" value="Orang Tua">Orang Tua</label>
                              </div>
                              <div class="radio radio-inline">
                                <label><input type="radio" name="relation" value="Saudara">Saudara</label>
                              </div>
                              <div class="radio radio-inline">
                                <label><input type="radio" name="relation" value="Tetangga">Tetangga</label>
                              </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <button type="button" class="btn btn-primary data-dismiss"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Cancel</button>&nbsp;&nbsp;&nbsp;
                          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Save</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

           </div>


      </div>
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="<?php echo base_url('dashboardassets/assets/js/jquery-3.1.0.min.js'); ?>"></script>
      <script src="<?php echo base_url('dashboardassets/assets/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $(".btn-pref .btn").click(function () {
          $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
    // $(".tab").addClass("active"); // instead of this do the below
          $(this).removeClass("btn-default").addClass("btn-primary");
        });
      });
    </script>
  </body>
</html>
