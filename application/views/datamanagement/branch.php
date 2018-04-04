<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <script>
    $(document).ready(function () {
      $('#city').change(function () {
        var idcity = $(this).val();
        $.ajax({
          url: "<?php echo site_url('Branch/generateIdBranch/"+idcity+"') ?>",
          cache: false,
          success: function (result) {
            var bmemail = result + "@logon.com";
            $('#add_branch #branch-id').val(result);
            $('#add_branch #bm-email').val(bmemail.toLowerCase());
          }
        });
      });
    });
  </script>

  <script>
    $(document).on('click', '.edit-button', function () {
      var idbranch = $(this).data('id');
      $.ajax({
        url: "<?php echo site_url('Branch/showBranchDetailToModal/"+idbranch+"') ?>",
        cache: false,
        dataType: 'json',
        success: function (result) {
          $.each(result.branchdetail, function (k, v) {
            console.log(v);
            $('#edit_branch #branch-id').val(v.idbranch);
            $('#edit_branch #branch-name').val(v.branchname);
            $('#edit_branch #branch-address').val(v.branchaddress);
            $('#edit_branch #branch-phone').val(v.branchphone);
            $('#edit_branch #branch-manager').val(v.branchmanager);
            $('#edit_branch #manager-email').val(v.bmemail);
          });
        }
      })
    });
  </script>

  <!-- page content -->

  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <ol class="breadcrumb">
      <li><a href="#">Data Management</a></li>
      <li><a href="#">Branch</a></li>
    </ol>

    <h2 class="sub-header">Branch&nbsp;
      <a data-toggle="modal" href="#add_branch" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Branch</a>
    </h2>

    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Branch Name</th>
            <th>Branch Address</th>
            <th>Branch Phone</th>
            <th>Branch Manager</th>
            <th>Manager Email</th>
            <th>Status</th>
            <th><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></th>
          </tr>
        </thead>
        <tbody>
          <?php
            if ($allbranch == false) {
          ?>
          <tr><td colspan='8' class='text-center'>Data Kantor Cabang belum terisi</td></tr>
          <?php
            } else {
              foreach ($allbranch as $v) { 
          ?>
          <tr>
            <td><?php echo $v['idbranch'] ?></td>
            <td><?php echo $v['branchname'] ?></td>
            <td><?php echo $v['branchaddress'] ?></td>
            <td><?php echo $v['branchphone'] ?></td>
            <td><?php echo $v['branchmanager'] ?></td>
            <td><?php echo $v['bmemail'] ?></td>
            <td>
              <?php if ($v['branchstatus'] == '0'): ?>
                <button type="submit" class="btn btn-xs btn-default">Inactive</button>
              <?php elseif ($v['branchstatus'] == '1'): ?>
                <button type="submit" class="btn btn-xs btn-success">Active</button>
              <?php elseif ($v['branchstatus'] == '2'): ?>
                <button type="submit" class="btn btn-xs btn-warning">On Vacation</button>
              <?php elseif ($v['branchstatus'] == '3'): ?>
                <button type="submit" class="btn btn-xs btn-danger">Banned</button>
              <?php endif; ?>
            </td>
            <td>
              <a data-toggle="modal" href="#edit_branch" class="edit-button btn btn-primary btn-xs" data-id="<?php echo $v['idbranch'] ?>">
                <span class="glyphicon glyphicon-pencil"></span>
              </a>
              &nbsp;
              <a onclick="return confirm('Hapus data?')" class="edit-button btn btn-danger btn-xs" href="<?php echo site_url('Branch/deleteBranch/').$v['idbranch']; ?>" >
                <span class="glyphicon glyphicon-trash"></span>
              </a>
            </td>
          </tr>
          <?php }} ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

  <!-- Modal -->
  
  <!-- Modal Add -->
  <div class="modal fade" id="add_branch" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Add  Branch</h4>
        </div>
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
        action="<?php echo site_url('Branch/insertBranch'); ?>" method="POST">
          <div class="modal-body">
            <div class="row">
              <div class="col-xs-10 col-sm-9 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
                  <div class="form-group">
                    <label for="branch-name" style="font-size:0.8em">Nama Kantor Cabang</label>
                    <div class="input-group">
                    <input type="hidden" name="idbranch" id="branch-id" required="required" class="form-control">
                      <input type="text" name="branchname" id="branch-name" required="required" class="form-control col-md-7 col-xs-12">
                      <div class="input-group-addon">*</div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="branch-address" style="font-size:0.8em">Alamat Kantor Cabang</label>
                    <div class="input-group">
                      <input type="text" name="branchaddress" id="branch-address" name="branch-address" required="required" class="form-control col-md-7 col-xs-12">
                      <div class="input-group-addon">*</div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="province" style="font-size:0.8em">Provinsi</label>
                    <div class="input-group">
                      <select name="province" id="province" onchange="changeCity()" class="form-control">
                      <option value="">Pilih Provinsi</option>
                        <!-- Filled by jQuery -->
                      </select>
                      <div class="input-group-addon">*</div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="city-id" style="font-size:0.8em">Kota</label>
                    <div class="input-group">
                      <select name="idcity" id="city" class="form-control">
                      <option value="">Pilih Kota</option>
                        <!-- Filled by jQuery -->
                      </select>
                      <div class="input-group-addon">*</div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="branch-phone" style="font-size:0.8em">No. Telp Kantor Cabang</label>
                    <div class="input-group">
                      <input type="tel" name="branchphone" id="branch-phone" required="required" class="form-control col-md-7 col-xs-12" >
                      <div class="input-group-addon">*</div>
                    </div>
                    <em style="font-size:0.8em">contoh: 081234******</em>
                  </div>
                  <div class="form-group">
                    <label for="bm-name" style="font-size:0.8em">Nama Manajer</label>
                    <div class="input-group">
                      <input type="text" name="bmname" id="bm-name" required="required" class="form-control col-md-7 col-xs-12">
                      <div class="input-group-addon">*</div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="bm-email" style="font-size:0.8em">Email Manajer</label>
                    <div class="input-group">
                      <input type="text" name="bmemail" id="bm-email" required="required" class="form-control col-md-7 col-xs-12" readonly>
                      <div class="input-group-addon">*</div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Cancel</button>&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /Modal Add -->

  <!-- Modal Edit-->
  <div class="modal fade" id="edit_branch" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Edit Branch</h4>
        </div>
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('Branch/editBranch'); ?>" method="POST">
          <div class="modal-body">
           <div class="row">
             <div class="col-xs-10 col-sm-9 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
                <div class="form-group">
                  <label for="branch-id" style="font-size:0.8em">ID Branch</label>
                  <div class="input-group">
                    <input type="text" name="idbranch" id="branch-id" required="required" class="form-control" readonly />
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="branch-name" style="font-size:0.8em">Nama Kantor Cabang</label>
                  <div class="input-group">
                    <input type="text" name="branchname" id="branch-name" required="required" class="form-control" >
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="branch-address" style="font-size:0.8em">Alamat Kantor Cabang</label>
                  <div class="input-group">
                    <input type="text" name="branchaddress" id="branch-address" required="required" class="form-control" >
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="branch-phone" style="font-size:0.8em">No. Telepon Kantor Cabang</label>
                  <div class="input-group">
                    <input type="tel" name="branchphone" id="branch-phone" required="required" class="form-control" >
                    <div class="input-group-addon">*</div>
                  </div>
                  <em style="font-size:0.8em">contoh: 081234******</em>
                </div>
                <div class="form-group">
                  <label for="branch-manager" style="font-size:0.8em">Manager Kantor Cabang</label>
                  <div class="input-group">
                    <input type="text" name="branchmanager" id="branch-manager" required="required" class="form-control">
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="manager-email" style="font-size:0.8em">Email Manager</label>
                  <div class="input-group">
                    <input type="email" name="bmemail" id="manager-email" required="required" class="form-control" readonly />
                    <div class="input-group-addon">*</div>
                  </div>
                  <em style="font-size:0.8em">contoh: name@email.com</em>
                </div>
                <div class="form-group">
                  <label for="branch-status" style="font-size:0.8em">Status</label>
                  <div class="input-group">
                    <select name="branchstatus" id="branch-status" class="form-control">
                      <option value="0">Inactive</option>
                      <option value="1">Active</option>
                      <option value="2">On-Vacation</option>
                      <option value="3">Banned</option>
                      <option value="4">Rejected</option>
                      <option value="5">Deleted</option>
                    </select>
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Cancel</button>&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /Modal Edit -->
    
  <!-- /Modal -->