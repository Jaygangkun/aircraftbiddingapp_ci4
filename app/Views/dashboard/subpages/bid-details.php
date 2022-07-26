<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-9">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Operators</h3>
          </div>
          <div class="card-body">
            <div class="row mt-4">
              <div class="col-md-12">
                <table id="operators" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Operator</th>
                      <th>Pax</th>
                      <th>Cost</th>
                      <th>Aircraft</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach($operators as $operator) {
                      ?>
                      <tr>
                        <td><?php echo $operator->operator_name?></td>
                        <td><?php echo $operator->pax?></td>
                        <td><?php echo $operator->cost?></td>
                        <td><?php echo $operator->aircraft_name?></td>
                        <td><?php echo $operator->status?></td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>                  
                </table>                
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Bid Information</h3>
          </div>
          
          <div class="card-body">
            <ul class="nav flex-column">
              <li class="nav-item">
                <span href="#" class="nav-link">
                  Pax <span class="float-right"><?php echo $bid[0]->pax?></span>
                </span>
              </li>
              <li class="nav-item">
              <span href="#" class="nav-link">
                  Cost <span class="float-right"><?php echo $bid[0]->cost?></span>
                </span>
              </li>
              <li class="nav-item">
                <span href="#" class="nav-link">
                  Aircraft <span class="float-right"><?php echo $bid[0]->aircraft_name?></span>
                </span>
              </li>
              <li class="nav-item">
                <span href="#" class="nav-link">
                  Status <span class="float-right"><?php echo $bid[0]->status?></span>
                </span>
              </li>
            </ul>
          </div>
        </div>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Trip Information</h3>
          </div>
          <div class="card-body">
            <ul class="nav flex-column">
              <li class="nav-item">
                <span href="#" class="nav-link">
                  Name <span class="float-right"><?php echo $trip['name']?></span>
                </span>
              </li>
              <li class="nav-item">
              <span href="#" class="nav-link">
                  Date <span class="float-right"><?php echo $trip['date_from']?> to <?php echo $trip['date_to']?></span>
                </span>
              </li>
              <li class="nav-item">
                <span href="#" class="nav-link">
                  Place <span class="float-right"><?php echo $trip['place_from']?> to <?php echo $trip['place_to']?></span>
                </span>
              </li>
            </ul>
          </div>
        </div>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Customer Information</h3>
          </div>
          <div class="card-body">
            <ul class="nav flex-column">
              <li class="nav-item">
                <span href="#" class="nav-link">
                  Name <span class="float-right"><?php echo $customer['name']?></span>
                </span>
              </li>
              <li class="nav-item">
              <span href="#" class="nav-link">
                  Company <span class="float-right"><?php echo $customer['company']?></span>
                </span>
              </li>
              <li class="nav-item">
                <span href="#" class="nav-link">
                  Telephone <span class="float-right"><?php echo $customer['telephone']?></span>
                </span>
              </li>
              <li class="nav-item">
                <span href="#" class="nav-link">
                  Email <span class="float-right"><?php echo $customer['email']?></span>
                </span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<style>
#operators_wrapper .row:first-of-type {
  display: none;
}
</style>
<script>
  var table = $('#operators').DataTable({
    "pagingType": 'full_numbers',
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    // 'ajax': {
    //   url: base_url + '/ajax/aircraft/all',
    // }
  });

  $(document).on('keyup', '#search', function() {
    table.search($(this).val()).draw(false);
  })
</script>