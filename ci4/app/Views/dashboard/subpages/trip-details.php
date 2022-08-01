<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-9">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Bid Operators</h3>
          </div>
          <div class="card-body">
            <div class="row d-flex justify-content-between">
              <div class="col-md-8">
                <button class="btn btn-primary" id="btn_new">Add Operator Bid</button>
              </div>
              <div class="col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control" id="search" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-md-12">
                <table id="bid_operators" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Pax</th>
                      <th>Cost</th>
                      <th>Aircraft</th>
                      <th>Status</th>
                      <th>Action</th>    
                    </tr>
                  </thead>
                </table>                
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <div class="col-md-3">
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
        <div class="card card-primary">
          <div class="card-header">
            <h4 class="card-title">Trip Information</h4>
          </div>
          <div class="card-body">
            <?php
            if(count($trip_legs) > 0) {
              ?>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>From</th>
                    <th>To</th>
                    <th>Date</th>
                    <th>Time</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach($trip_legs as $trip_leg) {
                    ?>
                    <tr>
                      <td><?php echo $trip_leg['from']?></td>
                      <td><?php echo $trip_leg['to']?></td>
                      <td><?php echo $trip_leg['date']?></td>
                      <td><?php echo $trip_leg['time']?></td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>                  
              </table>
              <?php
            }
            ?>
          </div>
        </div>
        
      </div>
    </div>

  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<input type="hidden" name="trip_id" id="trip_id" value="<?php echo $trip_id?>">
<!-- Add or Update Operator Modal -->
<div class="modal fade" id="modal_operator_add_bid" data-backdrop="static" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body">
        <div class="container-fluid">
          <div class="form-group">
            <label for="name">Operator <i class="text-danger">*</i></label>
            <div class="row">
              <div class="col-md-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="operator_option" id="operator_option_exist" value="exist" checked>
                  <label class="form-check-label" for="operator_option_exist">Already Exist</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="operator_option" id="operator_option_new" value="new">
                  <label class="form-check-label" for="operator_option_new">Add New</label>
                </div>
              </div>
            </div>
          </div>
          <div id="operator_exist_inputs">
            <div class="form-group">
              <select class="form-control" id="operator_select" name="operator_select">
                <option value="">Select</option>
                <?php
                foreach($operators as $operator) {
                  ?>
                  <option value="<?php echo $operator['id']?>"><?php echo $operator['name']?></option>
                  <?php
                }
                ?>                
              </select>
            </div>
          </div>
          <div id="operator_new_inputs" style="display: none">
            <div class="form-group">
              <label for="name">Name <i class="text-danger">*</i></label>
              <div class="input-group">
                  <input type="text" name="name" id="name" class="form-control" value="">
              </div>
            </div>
            <div class="form-group">
              <label for="telephone">Telephone <i class="text-danger">*</i></label>
              <div class="input-group">
                  <input type="text" name="telephone" id="telephone" class="form-control" value="">
              </div>
            </div>
            <div class="form-group">
              <label for="contact">Contact <i class="text-danger">*</i></label>
              <div class="input-group">
                  <input type="text" name="contact" id="contact" class="form-control" value="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Operator Status <i class="text-danger">*</i></label>
            <select class="form-control" id="operator_status" name="operator_status">
              <option value="">Select</option>
              <option value="Bid">Bid</option>
              <option value="Won">Won</option>
              <option value="Lost">Lost</option>
            </select>
          </div>
          <div class="form-group">
            <label for="pax">Pax <i class="text-danger">*</i></label>
            <div class="input-group">
                <input type="text" name="pax" id="pax" class="form-control" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="cost">Cost <i class="text-danger">*</i></label>
            <div class="input-group">
                <input type="text" name="cost" id="cost" class="form-control" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Aircraft <i class="text-danger">*</i></label>
            <div class="row">
              <div class="col-md-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="aircraft_option" id="aircraft_option_exist" value="exist" checked>
                  <label class="form-check-label" for="aircraft_option_exist">Already Exist</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="aircraft_option" id="aircraft_option_new" value="new">
                  <label class="form-check-label" for="aircraft_option_new">Add New</label>
                </div>
              </div>
            </div>
          </div>
          <div id="aircraft_exist_inputs">
            <div class="form-group">
              <select class="form-control" id="aircraft_select" name="aircraft_select">
                <option value="">Select</option>
                <?php
                  foreach($aircrafts as $aircraft) {
                    ?>
                    <option value="<?php echo $aircraft->id?>"><?php echo $aircraft->name?> <?php echo $aircraft->aircraft_category_name != '' ? '('.$aircraft->aircraft_category_name.')' : ''?></option>
                    <?php
                  }
                ?>
              </select>
            </div>
          </div>
          <div id="aircraft_new_inputs" style="display: none">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="category_select">Category <i class="text-danger">*</i></label>
                  <select class="form-control mb-2" id="category_select" name="category_select">
                    <option value="">New</option>
                    <?php
                      foreach($aircraft_categories as $aircraft_category) {
                        ?>
                        <option value="<?php echo $aircraft_category['id']?>"><?php echo $aircraft_category['name']?></option>
                        <?php
                      }
                    ?>
                  </select>
                  <div class="input-group">
                      <input type="text" name="category" id="category" class="form-control" value="">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Name <i class="text-danger">*</i></label>
                  <div class="input-group">
                      <input type="text" name="name" id="name" class="form-control" value="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <input type="hidden" name="operator_trip_id" id="operator_trip_id">
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="btn_save">Save</button>
        <button type="button" class="btn btn-primary" id="btn_update">Update</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Add or Update Operator Modal -->
<style>
#bid_operators_wrapper .row:first-of-type {
  display: none;
}
</style>
<script>
  var modal_add = $('#modal_add_operator');

  var modal_add_btn_save = $('#modal_add_operator #btn_save');
  var modal_add_btn_update = $('#modal_add_operator #btn_update');

  var modal_add_input_name = $('#modal_add_operator #name');
  var modal_add_input_telephone = $('#modal_add_operator #telephone');
  var modal_add_input_contact = $('#modal_add_operator #contact');
  var modal_add_input_id = $('#modal_add_operator #operator_id');

  var table = $('#bid_operators').DataTable({
    "pagingType": 'full_numbers',
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    'ajax': {
      url: base_url + '/ajax/trip/<?php echo $trip_id?>/operator/all/'
    }
  });

  $(document).on('keyup', '#search', function() {
    table.search($(this).val()).draw(false);
  })

  // add operator modal
  var modal_operator_add = $('#modal_operator_add_bid');

  var modal_operator_add_btn_save = $('#modal_operator_add_bid #btn_save');
  var modal_operator_add_btn_update = $('#modal_operator_add_bid #btn_update');

  var modal_operator_add_operator_exist_inputs = $('#modal_operator_add_bid #operator_exist_inputs');
  var modal_operator_add_operator_new_inputs = $('#modal_operator_add_bid #operator_new_inputs');
  var modal_operator_add_input_operator_option = $('#modal_operator_add_bid [name="operator_option"]');
  var modal_operator_add_input_operator_option_exist = $('#modal_operator_add_bid #operator_option_exist');
  var modal_operator_add_input_operator_option_new = $('#modal_operator_add_bid #operator_option_new');

  var modal_operator_add_input_operator_select = $('#modal_operator_add_bid #operator_exist_inputs #operator_select');
  var modal_operator_add_input_operator_name = $('#modal_operator_add_bid #operator_new_inputs #name');
  var modal_operator_add_input_operator_telephone = $('#modal_operator_add_bid #operator_new_inputs #telephone');
  var modal_operator_add_input_operator_contact = $('#modal_operator_add_bid #operator_new_inputs #contact');

  var modal_operator_add_input_operator_status = $('#modal_operator_add_bid #operator_status');
  var modal_operator_add_input_pax = $('#modal_operator_add_bid #pax');
  var modal_operator_add_input_cost = $('#modal_operator_add_bid #cost');
  
  var modal_customer_add_aircraft_exist_inputs = $('#modal_operator_add_bid #aircraft_exist_inputs');
  var modal_customer_add_aircraft_new_inputs = $('#modal_operator_add_bid #aircraft_new_inputs');
  var modal_customer_add_input_aircraft_option = $('#modal_operator_add_bid [name="aircraft_option"]');
  var modal_customer_add_input_aircraft_option_exist = $('#modal_operator_add_bid #aircraft_option_exist');
  var modal_customer_add_input_aircraft_option_new = $('#modal_operator_add_bid #aircraft_option_new');

  var modal_customer_add_input_aircraft_select = $('#modal_operator_add_bid #aircraft_exist_inputs #aircraft_select');
  var modal_customer_add_input_aircraft_category_select = $('#modal_operator_add_bid #aircraft_new_inputs #category_select');
  var modal_customer_add_input_aircraft_category = $('#modal_operator_add_bid #aircraft_new_inputs #category');
  var modal_customer_add_input_aircraft_name = $('#modal_operator_add_bid #aircraft_new_inputs #name');

  var modal_operator_add_input_operator_trip_id = $('#modal_operator_add_bid #operator_trip_id');

  var hidden_trip_id = $('#trip_id');

  $(document).on('click', '#btn_new', function() {
    $(modal_operator_add_btn_save).show();
    $(modal_operator_add_btn_update).hide();

    $(modal_operator_add_input_operator_select).val('');
    $(modal_operator_add_input_operator_name).val('');
    $(modal_operator_add_input_operator_telephone).val('');
    $(modal_operator_add_input_operator_contact).val('');

    $(modal_operator_add_input_operator_status).val('');
    $(modal_operator_add_input_pax).val('');
    $(modal_operator_add_input_cost).val('');
    
    $(modal_customer_add_input_aircraft_select).val('');
    $(modal_customer_add_input_aircraft_category_select).val('');
    $(modal_customer_add_input_aircraft_category).val('');
    $(modal_customer_add_input_aircraft_category).show();
    $(modal_customer_add_input_aircraft_name).val('');

    $(modal_operator_add_operator_exist_inputs).show();
    $(modal_operator_add_operator_new_inputs).hide();
    $(modal_operator_add_input_operator_option_exist).prop('checked', true);

    $(modal_customer_add_aircraft_exist_inputs).show();
    $(modal_customer_add_aircraft_new_inputs).hide();
    $(modal_customer_add_input_aircraft_option_exist).prop('checked', true);

    $(modal_operator_add).modal('show');
  })

  $(document).on('change', '#modal_operator_add_bid [name="operator_option"]', function() {
    if($(this).val() == 'exist') {
      $(modal_operator_add_operator_exist_inputs).show();
      $(modal_operator_add_operator_new_inputs).hide();
    }
    else {
      $(modal_operator_add_operator_exist_inputs).hide();
      $(modal_operator_add_operator_new_inputs).show();
    }
  })

  $(document).on('change', '#modal_operator_add_bid [name="aircraft_option"]', function() {
    if($(this).val() == 'exist') {
      $(modal_customer_add_aircraft_exist_inputs).show();
      $(modal_customer_add_aircraft_new_inputs).hide();
    }
    else {
      $(modal_customer_add_aircraft_exist_inputs).hide();
      $(modal_customer_add_aircraft_new_inputs).show();
    }
  })

  $(document).on('change', '#modal_operator_add_bid [name="category_select"]', function() {
    if($(this).val() == '') {
      $(modal_customer_add_input_aircraft_category).show();
    }
    else {
      $(modal_customer_add_input_aircraft_category).hide();
    }
  })

  $(document).on('click', '#modal_operator_add_bid #btn_save', function() {
    var data = {};
    if($('#modal_operator_add_bid [name="operator_option"]:checked').val() == 'exist') {
      if($(modal_operator_add_input_operator_select).val() == '') {
        alert('Please Select Operator');
        $(modal_operator_add_input_operator_select).focus() ;
        return;
      }
      data['operator_id'] = $(modal_operator_add_input_operator_select).val();
    }
    else {
      if($(modal_operator_add_input_operator_name).val() == '') {
        alert('Please Input Operator Name');
        $(modal_operator_add_input_operator_name).focus()
        return;
      }
      data['operator_name'] = $(modal_operator_add_input_operator_name).val();

      if($(modal_operator_add_input_operator_telephone).val() == '') {
        alert('Please Input Operator Telephone');
        $(modal_operator_add_input_operator_telephone).focus()
        return;
      }
      data['operator_telephone'] = $(modal_operator_add_input_operator_telephone).val();

      if($(modal_operator_add_input_operator_contact).val() == '') {
        alert('Please Input Operator Contact');
        $(modal_operator_add_input_operator_contact).focus()
        return;
      }
      data['operator_contact'] = $(modal_operator_add_input_operator_contact).val();
    }
    data['operator_option'] = $('#modal_operator_add_bid [name="operator_option"]:checked').val();

    if($(modal_operator_add_input_operator_status).val() == '') {
      alert('Please Input Operator Status');
      $(modal_operator_add_input_operator_status).focus()
      return;
    }
    data['operator_status'] = $(modal_operator_add_input_operator_status).val();

    if($(modal_operator_add_input_pax).val() == '') {
      alert('Please Input Pax');
      $(modal_operator_add_input_pax).focus()
      return;
    }
    data['pax'] = $(modal_operator_add_input_pax).val();

    if($(modal_operator_add_input_cost).val() == '') {
      alert('Please Input Cost');
      $(modal_operator_add_input_cost).focus()
      return;
    }
    data['cost'] = $(modal_operator_add_input_cost).val();

    if($('#modal_operator_add_bid [name="aircraft_option"]:checked').val() == 'exist') {
      if($(modal_customer_add_input_aircraft_select).val() == '') {
        alert('Please Select Aircraft');
        $(modal_customer_add_input_aircraft_select).focus() ;
        return;
      }
      data['aircraft_id'] = $(modal_customer_add_input_aircraft_select).val();
    }
    else {
      if($(modal_customer_add_input_aircraft_category_select).val() == '') {
        if($(modal_customer_add_input_aircraft_category).val() == '') {
          alert('Please Input Aircraft Category');
          $(modal_customer_add_input_aircraft_category).focus()
          return;
        }
        data['aircraft_category_name'] = $(modal_customer_add_input_aircraft_category).val();  
      }
      else {
        data['aircraft_category'] = $(modal_customer_add_input_aircraft_category_select).val();  
      }

      if($(modal_customer_add_input_aircraft_name).val() == '') {
        alert('Please Input Aircraft Name');
        $(modal_customer_add_input_aircraft_name).focus() ;
        return;
      }
      data['aircraft_name'] = $(modal_customer_add_input_aircraft_name).val();
    }

    data['aircraft_option'] = $('#modal_operator_add_bid [name="aircraft_option"]:checked').val();

    data['trip_id'] = <?php echo $trip_id?>;

    $.ajax({
      url: base_url + '/ajax/trip/operator/add',
      type: 'post',
      dataType: 'json',
      data: data,
      success: function(resp) {
        if(resp.success) {
          alert('Added Successfully!');
          table.ajax.reload();

          $(modal_operator_add).modal('hide');
        }
        else {
          alert(resp.message);
        }
      }
    })
  })


  $(document).on('click', '#modal_operator_add_bid #btn_update', function() {
    var data = {};
    if($('#modal_operator_add_bid [name="operator_option"]:checked').val() == 'exist') {
      if($(modal_operator_add_input_operator_select).val() == '') {
        alert('Please Select Operator');
        $(modal_operator_add_input_operator_select).focus() ;
        return;
      }
      data['operator_id'] = $(modal_operator_add_input_operator_select).val();
    }
    else {
      if($(modal_operator_add_input_operator_name).val() == '') {
        alert('Please Input Operator Name');
        $(modal_operator_add_input_operator_name).focus()
        return;
      }
      data['operator_name'] = $(modal_operator_add_input_operator_name).val();

      if($(modal_operator_add_input_operator_telephone).val() == '') {
        alert('Please Input Operator Telephone');
        $(modal_operator_add_input_operator_telephone).focus()
        return;
      }
      data['operator_telephone'] = $(modal_operator_add_input_operator_telephone).val();

      if($(modal_operator_add_input_operator_contact).val() == '') {
        alert('Please Input Operator Contact');
        $(modal_operator_add_input_operator_contact).focus()
        return;
      }
      data['operator_contact'] = $(modal_operator_add_input_operator_contact).val();
    }
    data['operator_option'] = $('#modal_operator_add_bid [name="operator_option"]:checked').val();

    if($(modal_operator_add_input_operator_status).val() == '') {
      alert('Please Input Operator Status');
      $(modal_operator_add_input_operator_status).focus()
      return;
    }
    data['operator_status'] = $(modal_operator_add_input_operator_status).val();

    if($(modal_operator_add_input_pax).val() == '') {
      alert('Please Input Pax');
      $(modal_operator_add_input_pax).focus()
      return;
    }
    data['pax'] = $(modal_operator_add_input_pax).val();

    if($(modal_operator_add_input_cost).val() == '') {
      alert('Please Input Cost');
      $(modal_operator_add_input_cost).focus()
      return;
    }
    data['cost'] = $(modal_operator_add_input_cost).val();

    if($('#modal_operator_add_bid [name="aircraft_option"]:checked').val() == 'exist') {
      if($(modal_customer_add_input_aircraft_select).val() == '') {
        alert('Please Select Aircraft');
        $(modal_customer_add_input_aircraft_select).focus() ;
        return;
      }
      data['aircraft_id'] = $(modal_customer_add_input_aircraft_select).val();
    }
    else {
      if($(modal_customer_add_input_aircraft_category_select).val() == '') {
        if($(modal_customer_add_input_aircraft_category).val() == '') {
          alert('Please Input Aircraft Category');
          $(modal_customer_add_input_aircraft_category).focus()
          return;
        }
        data['aircraft_category_name'] = $(modal_customer_add_input_aircraft_category).val();  
      }
      else {
        data['aircraft_category'] = $(modal_customer_add_input_aircraft_category_select).val();  
      }

      if($(modal_customer_add_input_aircraft_name).val() == '') {
        alert('Please Input Aircraft Name');
        $(modal_customer_add_input_aircraft_name).focus() ;
        return;
      }
      data['aircraft_name'] = $(modal_customer_add_input_aircraft_name).val();
    }

    data['aircraft_option'] = $('#modal_operator_add_bid [name="aircraft_option"]:checked').val();

    data['operator_trip_id'] = $(modal_operator_add_input_operator_trip_id).val();
    data['trip_id'] = <?php echo $trip_id?>;

    $.ajax({
      url: base_url + '/ajax/trip/operator/update',
      type: 'post',
      dataType: 'json',
      data: data,
      success: function(resp) {
        if(resp.success) {
          alert('Updated Successfully!');
          table.ajax.reload();

          $(modal_operator_add).modal('hide');
        }
        else {
          alert(resp.message);
        }
      }
    })
  })

  $(document).on('click', '.tbl-action-btn-edit', function() {
    $.ajax({
      url: base_url + '/ajax/trip/operator/get/' + $(this).data('id'),
      type: 'get',
      dataType: 'json',
      success: function(resp) {
        if(resp.success) {
          $(modal_operator_add_input_operator_select).val(resp.data.operator);
          $(modal_operator_add_input_operator_name).val('');
          $(modal_operator_add_input_operator_telephone).val('');
          $(modal_operator_add_input_operator_contact).val('');

          $(modal_operator_add_input_operator_status).val(resp.data.status);
          $(modal_operator_add_input_pax).val(resp.data.pax);
          $(modal_operator_add_input_cost).val(resp.data.cost);
          
          $(modal_customer_add_input_aircraft_select).val(resp.data.aircraft);
          $(modal_customer_add_input_aircraft_category_select).val('');
          $(modal_customer_add_input_aircraft_category).val('');
          $(modal_customer_add_input_aircraft_category).show();
          $(modal_customer_add_input_aircraft_name).val('');

          $(modal_operator_add_operator_exist_inputs).show();
          $(modal_operator_add_operator_new_inputs).hide();
          $(modal_operator_add_input_operator_option_exist).prop('checked', true);

          $(modal_customer_add_aircraft_exist_inputs).show();
          $(modal_customer_add_aircraft_new_inputs).hide();
          $(modal_customer_add_input_aircraft_option_exist).prop('checked', true);

          $(modal_operator_add_input_operator_trip_id).val(resp.data.id);

          $(modal_operator_add_btn_save).hide();
          $(modal_operator_add_btn_update).show();
          
          $(modal_operator_add).modal('show');
        }
        else {
          alert(resp.message);
        }
      }
    })
  })

  $(document).on('click', '.tbl-action-btn-delete', function() {
    if(confirm('Are you sure to delete?')) {
      $.ajax({
        url: base_url + '/ajax/trip/operator/delete/' + $(this).data('id'),
        type: 'get',
        dataType: 'json',
        success: function(resp) {
          if(resp.success) {
            alert('Deleted Successfully!');
            table.ajax.reload();
          }
          else {
            alert(resp.message);
          }
        }
      })
    }
  })
</script>