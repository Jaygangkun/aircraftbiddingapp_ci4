<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-primary">
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
            <button class="btn btn-primary" id="btn_new">Add Customer To Trip</button>
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
            <table id="bids" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Trip</th>
                  <th>Customer</th>
                  <th>Operators</th>
                  <th>Aircraft</th>
                  <th>Cost</th>
                  <th>Pax</th>
                  <th>Status</th>
                  <th>Action</th>                    
                </tr>
              </thead>
              <tbody>
               
              </tbody>                  
            </table>                
          </div>
        </div>
        
      </div>
    </div>

  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- Add Customer Bid Modal -->
<div class="modal fade" id="modal_customer_add_bid" data-backdrop="static" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body">
        <div class="container-fluid">
          <div class="form-group">
            <label for="name">Customer <i class="text-danger">*</i></label>
            <div class="row">
              <div class="col-md-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="customer_option" id="customer_option_exist" value="exist" checked>
                  <label class="form-check-label" for="customer_option_exist">Already Exist</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="customer_option" id="customer_option_new" value="new">
                  <label class="form-check-label" for="customer_option_new">Add New</label>
                </div>
              </div>
            </div>
          </div>
          <div id="customer_exist_inputs">
            <div class="form-group">
              <select class="form-control" id="customer_select" name="customer_select">
                <option value="">Select</option>
                <?php
                foreach($customers as $customer) {
                  ?>
                  <option value="<?php echo $customer['id']?>"><?php echo $customer['name']?></option>
                  <?php
                }
                ?>                
              </select>
            </div>
          </div>
          <div id="customer_new_inputs" style="display: none">
            <div class="form-group">
              <label for="name">Name <i class="text-danger">*</i></label>
              <div class="input-group">
                  <input type="text" name="name" id="name" class="form-control" value="">
              </div>
            </div>
            <div class="form-group">
              <label for="company">Company <i class="text-danger">*</i></label>
              <div class="input-group">
                  <input type="text" name="company" id="company" class="form-control" value="">
              </div>
            </div>
            <div class="form-group">
              <label for="email">Email <i class="text-danger">*</i></label>
              <div class="input-group">
                  <input type="text" name="email" id="email" class="form-control" value="">
              </div>
            </div>
            <div class="form-group">
              <label for="telephone">Telephone <i class="text-danger">*</i></label>
              <div class="input-group">
                  <input type="text" name="telephone" id="telephone" class="form-control" value="">
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label for="name">Trip <i class="text-danger">*</i></label>
            <div class="row">
              <div class="col-md-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="trip_option" id="trip_option_exist" value="exist" checked>
                  <label class="form-check-label" for="trip_option_exist">Already Exist</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="trip_option" id="trip_option_new" value="new">
                  <label class="form-check-label" for="trip_option_new">Add New</label>
                </div>
              </div>
            </div>
          </div>
          <div id="trip_exist_inputs">
            <div class="form-group">
                <select class="form-control" id="trip_select" name="trip_select">
                  <option value="">Select</option>
                  <?php
                  foreach($trips as $trip) {
                    ?>
                    <option value="<?php echo $trip['id']?>"><?php echo $trip['name']?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
          </div>
          <div id="trip_new_inputs" style="display: none">
            <div class="form-group">
              <label for="name">Name <i class="text-danger">*</i></label>
              <div class="input-group">
                  <input type="text" name="name" id="name" class="form-control" value="">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="place_from">From <i class="text-danger">*</i></label>
                  <div class="input-group">
                      <input type="text" name="place_from" id="place_from" class="form-control" value="">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="place_to">To <i class="text-danger">*</i></label>
                  <div class="input-group">
                      <input type="text" name="place_to" id="place_to" class="form-control" value="">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="date_from">Date From <i class="text-danger">*</i></label>
                  <div class="input-group date" id="date_from" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#date_from"/>
                    <div class="input-group-append" data-target="#date_from" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="date_to">Date To <i class="text-danger">*</i></label>
                  <div class="input-group date" id="date_to" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#date_to"/>
                    <div class="input-group-append" data-target="#date_to" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="pax">Pax <i class="text-danger">*</i></label>
            <div class="input-group">
                <input type="text" name="pax" id="pax" class="form-control" value="">
            </div>
          </div>
          <div class="form-group">
            <label>Aircraft <i class="text-danger">*</i></label>
            <select class="form-control" id="aircraft" name="aircraft">
              <option value="">Select</option>
              <?php
                foreach($aircrafts as $aircraft) {
                  ?>
                  <option value="<?php echo $aircraft['id']?>"><?php echo $aircraft['name']?></option>
                  <?php
                }
                ?>
            </select>
          </div>
        </div>
      </div>
      <input type="hidden" name="bid_id" id="bid_id">
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
<!-- /.Add Customer Bid Modal -->

<style>
#bids_wrapper .row:first-of-type {
  display: none;
}
</style>
<script>
  $('.date').datetimepicker({
    format: 'L'
  });

  var table = $('#bids').DataTable({
    "pagingType": 'full_numbers',
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    'ajax': {
      url: base_url + '/ajax/bid/all',
    }
  });

  $(document).on('keyup', '#search', function() {
    table.search($(this).val()).draw(false);
  })

  // add customer modal
  var modal_customer_add = $('#modal_customer_add_bid');

  var modal_customer_add_btn_save = $('#modal_customer_add_bid #btn_save');
  var modal_customer_add_btn_update = $('#modal_customer_add_bid #btn_update');

  var modal_customer_add_customer_exist_inputs = $('#modal_customer_add_bid #customer_exist_inputs');
  var modal_customer_add_customer_new_inputs = $('#modal_customer_add_bid #customer_new_inputs');
  var modal_customer_add_input_customer_option = $('#modal_customer_add_bid [name="customer_option"]');
  var modal_customer_add_input_customer_option_exist = $('#modal_customer_add_bid #customer_option_exist');
  var modal_customer_add_input_customer_option_new = $('#modal_customer_add_bid #customer_option_new');

  var modal_customer_add_input_customer_select = $('#modal_customer_add_bid #customer_exist_inputs #customer_select');
  var modal_customer_add_input_customer_name = $('#modal_customer_add_bid #customer_new_inputs #name');
  var modal_customer_add_input_customer_company = $('#modal_customer_add_bid #customer_new_inputs #company');
  var modal_customer_add_input_customer_email = $('#modal_customer_add_bid #customer_new_inputs #email');
  var modal_customer_add_input_customer_telephone = $('#modal_customer_add_bid #customer_new_inputs #telephone');
    
  var modal_customer_add_trip_exist_inputs = $('#modal_customer_add_bid #trip_exist_inputs');
  var modal_customer_add_trip_new_inputs = $('#modal_customer_add_bid #trip_new_inputs');
  var modal_customer_add_input_trip_option = $('#modal_customer_add_bid [name="trip_option"]');
  var modal_customer_add_input_trip_option_exist = $('#modal_customer_add_bid #trip_option_exist');
  var modal_customer_add_input_trip_option_new = $('#modal_customer_add_bid #trip_option_new');

  var modal_customer_add_input_trip_select = $('#modal_customer_add_bid #trip_exist_inputs #trip_select');
  var modal_customer_add_input_trip_name = $('#modal_customer_add_bid #trip_new_inputs #name');
  var modal_customer_add_input_trip_place_from = $('#modal_customer_add_bid #trip_new_inputs #place_from');
  var modal_customer_add_input_trip_place_to = $('#modal_customer_add_bid #trip_new_inputs #place_to');
  var modal_customer_add_input_trip_date_from = $('#modal_customer_add_bid #trip_new_inputs #date_from input');
  var modal_customer_add_input_trip_date_to = $('#modal_customer_add_bid #trip_new_inputs #date_to input');

  var modal_customer_add_input_pax = $('#modal_customer_add_bid #pax');
  var modal_customer_add_input_aircraft = $('#modal_customer_add_bid #aircraft');

  var modal_customer_add_input_id = $('#modal_customer_add_bid #bid_id');

  $(document).on('click', '#btn_new', function() {
    $(modal_customer_add_btn_save).show();
    $(modal_customer_add_btn_update).hide();

    $(modal_customer_add_input_customer_select).val('');
    $(modal_customer_add_input_customer_name).val('');
    $(modal_customer_add_input_customer_company).val('');
    $(modal_customer_add_input_customer_email).val('');
    $(modal_customer_add_input_customer_telephone).val('');

    $(modal_customer_add_input_trip_select).val('');
    $(modal_customer_add_input_trip_name).val('');
    $(modal_customer_add_input_trip_place_from).val('');
    $(modal_customer_add_input_trip_place_to).val('');
    $(modal_customer_add_input_trip_date_from).val('');
    $(modal_customer_add_input_trip_date_to).val('');

    $(modal_customer_add_input_pax).val('');
    $(modal_customer_add_input_aircraft).val('');

    $(modal_customer_add_customer_exist_inputs).show();
    $(modal_customer_add_customer_new_inputs).hide();
    $(modal_customer_add_input_customer_option_exist).prop('checked', true);

    $(modal_customer_add_trip_exist_inputs).show();
    $(modal_customer_add_trip_new_inputs).hide();
    $(modal_customer_add_input_trip_option_exist).prop('checked', true);

    $(modal_customer_add).modal('show');
  })

  $(document).on('change', '#modal_customer_add_bid [name="customer_option"]', function() {
    if($(this).val() == 'exist') {
      $(modal_customer_add_customer_exist_inputs).show();
      $(modal_customer_add_customer_new_inputs).hide();
    }
    else {
      $(modal_customer_add_customer_exist_inputs).hide();
      $(modal_customer_add_customer_new_inputs).show();
    }
  })

  $(document).on('change', '#modal_customer_add_bid [name="trip_option"]', function() {
    if($(this).val() == 'exist') {
      $(modal_customer_add_trip_exist_inputs).show();
      $(modal_customer_add_trip_new_inputs).hide();
    }
    else {
      $(modal_customer_add_trip_exist_inputs).hide();
      $(modal_customer_add_trip_new_inputs).show();
    }
  })

  $(document).on('click', '#modal_customer_add_bid #btn_save', function() {
    var data = {};
    if($('#modal_customer_add_bid [name="customer_option"]:checked').val() == 'exist') {
      if($(modal_customer_add_input_customer_select).val() == '') {
        alert('Please Select Customer');
        $(modal_customer_add_input_customer_select).focus() ;
        return;
      }
      data['customer_id'] = $(modal_customer_add_input_customer_select).val();
    }
    else {
      if($(modal_customer_add_input_customer_name).val() == '') {
        alert('Please Input Customer Name');
        $(modal_customer_add_input_customer_name).focus()
        return;
      }
      data['customer_name'] = $(modal_customer_add_input_customer_name).val();

      if($(modal_customer_add_input_customer_company).val() == '') {
        alert('Please Input Customer Company');
        $(modal_customer_add_input_customer_company).focus()
        return;
      }
      data['customer_company'] = $(modal_customer_add_input_customer_company).val();

      if($(modal_customer_add_input_customer_email).val() == '') {
        alert('Please Input Customer Email');
        $(modal_customer_add_input_customer_email).focus()
        return;
      }
      data['customer_email'] = $(modal_customer_add_input_customer_email).val();

      if($(modal_customer_add_input_customer_telephone).val() == '') {
        alert('Please Input Customer Telephone');
        $(modal_customer_add_input_customer_telephone).focus()
        return;
      }
      data['customer_telephone'] = $(modal_customer_add_input_customer_telephone).val();
    }
    data['customer_option'] = $('#modal_customer_add_bid [name="customer_option"]:checked').val();

    if($('#modal_customer_add_bid [name="trip_option"]:checked').val() == 'exist') {
      if($(modal_customer_add_input_trip_select).val() == '') {
        alert('Please Select Trip');
        $(modal_customer_add_input_trip_select).focus() ;
        return;
      }
      data['trip_id'] = $(modal_customer_add_input_trip_select).val();
    }
    else {
      if($(modal_customer_add_input_trip_name).val() == '') {
        alert('Please Input Trip Name');
        $(modal_customer_add_input_trip_name).focus()
        return;
      }
      data['trip_name'] = $(modal_customer_add_input_trip_name).val();

      if($(modal_customer_add_input_trip_place_from).val() == '') {
        alert('Please Input Trip From');
        $(modal_customer_add_input_trip_place_from).focus()
        return;
      }
      data['trip_place_from'] = $(modal_customer_add_input_trip_place_from).val();

      if($(modal_customer_add_input_trip_place_to).val() == '') {
        alert('Please Input Trip To');
        $(modal_customer_add_input_trip_place_to).focus()
        return;
      }
      data['trip_place_to'] = $(modal_customer_add_input_trip_place_to).val();

      if($(modal_customer_add_input_trip_date_from).val() == '') {
        alert('Please Input Trip Date From');
        $(modal_customer_add_input_trip_date_from).focus()
        return;
      }
      data['trip_date_from'] = $(modal_customer_add_input_trip_date_from).val();

      if($(modal_customer_add_input_trip_date_to).val() == '') {
        alert('Please Input Trip Date To');
        $(modal_customer_add_input_trip_date_to).focus()
        return;
      }
      data['trip_date_to'] = $(modal_customer_add_input_trip_date_to).val();
    }
    data['trip_option'] = $('#modal_customer_add_bid [name="trip_option"]:checked').val();

    if($(modal_customer_add_input_pax).val() == '') {
      alert('Please Input Pax');
      $(modal_customer_add_input_pax).focus()
      return;
    }
    data['pax'] = $(modal_customer_add_input_pax).val();

    if($(modal_customer_add_input_aircraft).val() == '') {
      alert('Please Select Aircraft');
      $(modal_customer_add_input_aircraft).focus()
      return;
    }
    data['aircraft'] = $(modal_customer_add_input_aircraft).val();

    $.ajax({
      url: base_url + '/ajax/bid/customer/add',
      type: 'post',
      dataType: 'json',
      data: data,
      success: function(resp) {
        if(resp.success) {
          alert('Added Successfully!');
          table.ajax.reload();

          $(modal_customer_add).modal('hide');
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
        url: base_url + '/ajax/bid/delete/' + $(this).data('id'),
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

  $(document).on('click', '#modal_customer_add_bid #btn_update', function() {
    var data = {};
    if($('#modal_customer_add_bid [name="customer_option"]:checked').val() == 'exist') {
      if($(modal_customer_add_input_customer_select).val() == '') {
        alert('Please Select Customer');
        $(modal_customer_add_input_customer_select).focus() ;
        return;
      }
      data['customer_id'] = $(modal_customer_add_input_customer_select).val();
    }
    else {
      if($(modal_customer_add_input_customer_name).val() == '') {
        alert('Please Input Customer Name');
        $(modal_customer_add_input_customer_name).focus()
        return;
      }
      data['customer_name'] = $(modal_customer_add_input_customer_name).val();

      if($(modal_customer_add_input_customer_company).val() == '') {
        alert('Please Input Customer Company');
        $(modal_customer_add_input_customer_company).focus()
        return;
      }
      data['customer_company'] = $(modal_customer_add_input_customer_company).val();

      if($(modal_customer_add_input_customer_email).val() == '') {
        alert('Please Input Customer Email');
        $(modal_customer_add_input_customer_email).focus()
        return;
      }
      data['customer_email'] = $(modal_customer_add_input_customer_email).val();

      if($(modal_customer_add_input_customer_telephone).val() == '') {
        alert('Please Input Customer Telephone');
        $(modal_customer_add_input_customer_telephone).focus()
        return;
      }
      data['customer_telephone'] = $(modal_customer_add_input_customer_telephone).val();
    }
    data['customer_option'] = $('#modal_customer_add_bid [name="customer_option"]:checked').val();

    if($('#modal_customer_add_bid [name="trip_option"]:checked').val() == 'exist') {
      if($(modal_customer_add_input_trip_select).val() == '') {
        alert('Please Select Trip');
        $(modal_customer_add_input_trip_select).focus() ;
        return;
      }
      data['trip_id'] = $(modal_customer_add_input_trip_select).val();
    }
    else {
      if($(modal_customer_add_input_trip_name).val() == '') {
        alert('Please Input Trip Name');
        $(modal_customer_add_input_trip_name).focus()
        return;
      }
      data['trip_name'] = $(modal_customer_add_input_trip_name).val();

      if($(modal_customer_add_input_trip_place_from).val() == '') {
        alert('Please Input Trip From');
        $(modal_customer_add_input_trip_place_from).focus()
        return;
      }
      data['trip_place_from'] = $(modal_customer_add_input_trip_place_from).val();

      if($(modal_customer_add_input_trip_place_to).val() == '') {
        alert('Please Input Trip To');
        $(modal_customer_add_input_trip_place_to).focus()
        return;
      }
      data['trip_place_to'] = $(modal_customer_add_input_trip_place_to).val();

      if($(modal_customer_add_input_trip_date_from).val() == '') {
        alert('Please Input Trip Date From');
        $(modal_customer_add_input_trip_date_from).focus()
        return;
      }
      data['trip_date_from'] = $(modal_customer_add_input_trip_date_from).val();

      if($(modal_customer_add_input_trip_date_to).val() == '') {
        alert('Please Input Trip Date To');
        $(modal_customer_add_input_trip_date_to).focus()
        return;
      }
      data['trip_date_to'] = $(modal_customer_add_input_trip_date_to).val();
    }
    data['trip_option'] = $('#modal_customer_add_bid [name="trip_option"]:checked').val();

    if($(modal_customer_add_input_pax).val() == '') {
      alert('Please Input Pax');
      $(modal_customer_add_input_pax).focus()
      return;
    }
    data['pax'] = $(modal_customer_add_input_pax).val();

    if($(modal_customer_add_input_aircraft).val() == '') {
      alert('Please Select Aircraft');
      $(modal_customer_add_input_aircraft).focus()
      return;
    }
    data['aircraft'] = $(modal_customer_add_input_aircraft).val();
    data['bid_id'] = $(modal_customer_add_input_id).val();

    $.ajax({
      url: base_url + '/ajax/bid/customer/update',
      type: 'post',
      dataType: 'json',
      data: data,
      success: function(resp) {
        if(resp.success) {
          alert('Updated Successfully!');
          table.ajax.reload();

          $(modal_customer_add).modal('hide');
        }
        else {
          alert(resp.message);
        }
      }
    })
  })

  $(document).on('click', '.tbl-action-btn-edit', function() {
    $.ajax({
      url: base_url + '/ajax/bid/get/' + $(this).data('id'),
      type: 'get',
      dataType: 'json',
      success: function(resp) {
        if(resp.success) {
          $(modal_customer_add_btn_save).hide();
          $(modal_customer_add_btn_update).show();

          $(modal_customer_add_input_customer_select).val(resp.data.customer);
          $(modal_customer_add_input_customer_name).val('');
          $(modal_customer_add_input_customer_company).val('');
          $(modal_customer_add_input_customer_email).val('');
          $(modal_customer_add_input_customer_telephone).val('');

          $(modal_customer_add_input_trip_select).val(resp.data.trip);
          $(modal_customer_add_input_trip_name).val('');
          $(modal_customer_add_input_trip_place_from).val('');
          $(modal_customer_add_input_trip_place_to).val('');
          $(modal_customer_add_input_trip_date_from).val('');
          $(modal_customer_add_input_trip_date_to).val('');

          $(modal_customer_add_input_pax).val(resp.data.pax);
          $(modal_customer_add_input_aircraft).val(resp.data.aircraft);

          $(modal_customer_add_customer_exist_inputs).show();
          $(modal_customer_add_customer_new_inputs).hide();
          $(modal_customer_add_input_customer_option_exist).prop('checked', true);

          $(modal_customer_add_trip_exist_inputs).show();
          $(modal_customer_add_trip_new_inputs).hide();
          $(modal_customer_add_input_trip_option_exist).prop('checked', true);

          $(modal_customer_add_input_id).val(resp.data.id);

          $(modal_customer_add).modal('show');
        }
        else {
          alert(resp.message);
        }
      }
    })
  })
</script>