<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Report</h1>
          <div class="row">
            <div class="col-lg-12">
              <button class="btn btn-info" data-toggle="collapse" data-target="#demo">Select the columns displayed</button>
              <div id="demo" class="collapse">
                <form role="form">
                  <div class="form-group">
                   <div class="checkbox">
                    <label><input type="checkbox">ID</label>
                    <label><input type="checkbox">Name</label>
                    <label><input type="checkbox">address</label>
                    <label><input type="checkbox">phone</label>
                    <label><input type="checkbox">email</label>
                   </div>
                  </div>
                  <button type="submit" class="btn btn-success">Submit</button>
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
  </body>
</html>
