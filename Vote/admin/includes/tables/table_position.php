<!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            List of all organization</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Position</th>
                    <th>Organization</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Organization</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php  Position::position_table_show_all();    ?>  
                </tbody>
                
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated at <?php echo date("l jS \of F Y h:i:s A")?></div>
        </div>
        