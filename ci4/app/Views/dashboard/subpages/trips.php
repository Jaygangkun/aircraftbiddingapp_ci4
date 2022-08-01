<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-primary">
      <div class="card-body">
        <div class="row d-flex justify-content-between">
          <div class="col-md-2">
            <button class="btn btn-primary" id="btn_new">New</button>
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
            <table id="trips" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Legs</th>
                  <th>Operators</th>
                  <th>Aircraft</th>
                  <th>Pax</th>
                  <th>Date</th>
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

<!-- Add or Update Operator Modal -->
<div class="modal fade" id="modal_add_trip" data-backdrop="static" role="dialog">
  <div class="modal-dialog modal-lg">
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
              <label for="company">Company</label>
              <div class="input-group">
                  <input type="text" name="company" id="company" class="form-control" value="">
              </div>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <div class="input-group">
                  <input type="text" name="email" id="email" class="form-control" value="">
              </div>
            </div>
            <div class="form-group">
              <label for="telephone">Telephone</label>
              <div class="input-group">
                  <input type="text" name="telephone" id="telephone" class="form-control" value="">
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="name">Status</label>
                  <select class="form-control" id="status" name="status">
                    <option value="">Select</option>
                    <option value="In Work">In Work</option>
                    <option value="Quoted & Pending">Quoted & Pending</option>
                    <option value="Booked">Booked</option>
                    <option value="Settled">Settled</option>
                    <option value="Closed">Closed</option>
                  </select>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="pax">Pax <i class="text-danger">*</i></label>
                  <div class="input-group">
                      <input type="text" name="pax" id="pax" class="form-control" value="">
                  </div>
                </div>
              </div>
          </div>
          
          <table class="table table-bordered table-striped text-center">
            <thead>
              <tr>
                <th>From <i class="text-danger">*</i></th>
                <th>To <i class="text-danger">*</i></th>
                <th>Date <i class="text-danger">*</i></th>
                <th>Time <i class="text-danger">*</i></th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="legs">
            </tbody>                  
          </table>
          
          <div class="row">
            <div class="col-md-12 text-right">
              <span class="text-primary text-btn" id="btn_add_leg">Add Another</span>
            </div>
          </div>
        </div>
      </div>
      <input type="hidden" name="trip_id" id="trip_id">
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
#trips_wrapper .row:first-of-type {
  display: none;
}
</style>
<script> 

  var modal_add = $('#modal_add_trip');

  var modal_add_btn_save = $('#modal_add_trip #btn_save');
  var modal_add_btn_update = $('#modal_add_trip #btn_update');

  var modal_add_customer_exist_inputs = $('#modal_add_trip #customer_exist_inputs');
  var modal_add_customer_new_inputs = $('#modal_add_trip #customer_new_inputs');
  var modal_add_input_customer_option = $('#modal_add_trip [name="customer_option"]');
  var modal_add_input_customer_option_exist = $('#modal_add_trip #customer_option_exist');
  var modal_add_input_customer_option_new = $('#modal_add_trip #customer_option_new');

  var modal_add_input_customer_select = $('#modal_add_trip #customer_exist_inputs #customer_select');
  var modal_add_input_customer_name = $('#modal_add_trip #customer_new_inputs #name');
  var modal_add_input_customer_company = $('#modal_add_trip #customer_new_inputs #company');
  var modal_add_input_customer_email = $('#modal_add_trip #customer_new_inputs #email');
  var modal_add_input_customer_telephone = $('#modal_add_trip #customer_new_inputs #telephone');
  
  var modal_add_input_status = $('#modal_add_trip #status');
  var modal_add_input_pax = $('#modal_add_trip #pax');
  var modal_add_input_legs = $('#modal_add_trip #legs');
  
  var modal_add_input_id = $('#modal_add_trip #trip_id');

  var table = $('#trips').DataTable({
    "pagingType": 'full_numbers',
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    'ajax': {
      url: base_url + '/ajax/trip/all',
    }
  });

  $(document).on('keyup', '#search', function() {
    table.search($(this).val()).draw(false);
  })

  function addLegRow(leg) {
    var index = Date.now();
    var leg_id = '';
    var leg_from = '';
    var leg_to = '';
    var leg_date = '';
    var leg_time = '';

    if(leg != null) {
      leg_id = leg.id;
      leg_from = leg.from;
      leg_to = leg.to;
      leg_date = leg.date;
      leg_time = leg.time;
    }

    $(modal_add_input_legs).append(`
      <tr data-leg-id="` + leg_id + `">
        <td>
          <div class="form-group">
            <div class="input-group">
                <input type="text" name="from" id="from` + index + `" class="form-control from" value="` + leg_from + `">
            </div>
          </div>
        </td>
        <td>
          <div class="form-group">
            <div class="input-group">
                <input type="text" name="to" id="to` + index + `" class="form-control to" value="` + leg_to + `">
            </div>
          </div>
        </td>
        <td>
          <div class="form-group">
            <div class="input-group date" id="date` + index + `" data-target-input="nearest">
              <input type="text" class="form-control datetimepicker-input" data-target="#date` + index + `" value="` + leg_date + `"/>
              <div class="input-group-append" data-target="#date` + index + `" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>
        </td>
        <td>
          <div class="form-group">
            <div class="form-group">
              <div class="input-group time" id="time` + index + `" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#time` + index + `" value="` + leg_time + `"/>
                <div class="input-group-append" data-target="#time` + index + `" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>
        </td>
        <td class="align-middle">
          <span class="text-danger text-btn btn-delete">Delete</span>
        </td>
      </tr>
    `);

    $('#date' + index).datetimepicker({
      format: 'L'
    });

    $('#time' + index).datetimepicker({
      dateFormat: '',
      datepicker:false,
      pickDate: false,
      format: "H:mm",
      timeOnly:true
    });
  }

  $(document).on('click', '#btn_new', function() {
    $(modal_add_btn_save).show();
    $(modal_add_btn_update).hide();

    $(modal_add_input_customer_select).val('');
    $(modal_add_input_customer_name).val('');
    $(modal_add_input_customer_company).val('');
    $(modal_add_input_customer_email).val('');
    $(modal_add_input_customer_telephone).val('');
    
    $(modal_add_input_status).val('');
    $(modal_add_input_pax).val('');
    
    $(modal_add_input_legs).html('');
    addLegRow(null);

    $(modal_add_customer_exist_inputs).show();
    $(modal_add_customer_new_inputs).hide();
    $(modal_add_input_customer_option_exist).prop('checked', true);

    $(modal_add).modal('show');
  })

  $(document).on('change', '#modal_add_trip [name="customer_option"]', function() {
    if($(this).val() == 'exist') {
      $(modal_add_customer_exist_inputs).show();
      $(modal_add_customer_new_inputs).hide();
    }
    else {
      $(modal_add_customer_exist_inputs).hide();
      $(modal_add_customer_new_inputs).show();
    }
  })

  $(document).on('click', '#modal_add_trip #btn_add_leg', function() {
    addLegRow(null);
  })

  $(document).on('click', '#modal_add_trip #btn_save', function() {
    var data = {};
    if($('#modal_add_trip [name="customer_option"]:checked').val() == 'exist') {
      if($(modal_add_input_customer_select).val() == '') {
        alert('Please Select Customer');
        $(modal_add_input_customer_select).focus() ;
        return;
      }
      data['customer_id'] = $(modal_add_input_customer_select).val();
    }
    else {
      if($(modal_add_input_customer_name).val() == '') {
        alert('Please Input Customer Name');
        $(modal_add_input_customer_name).focus()
        return;
      }
      data['customer_name'] = $(modal_add_input_customer_name).val();

      // if($(modal_customer_add_input_customer_company).val() == '') {
      //   alert('Please Input Customer Company');
      //   $(modal_customer_add_input_customer_company).focus()
      //   return;
      // }
      data['customer_company'] = $(modal_add_input_customer_company).val();

      // if($(modal_customer_add_input_customer_email).val() == '') {
      //   alert('Please Input Customer Email');
      //   $(modal_customer_add_input_customer_email).focus()
      //   return;
      // }
      data['customer_email'] = $(modal_add_input_customer_email).val();

      // if($(modal_customer_add_input_customer_telephone).val() == '') {
      //   alert('Please Input Customer Telephone');
      //   $(modal_customer_add_input_customer_telephone).focus()
      //   return;
      // }
      data['customer_telephone'] = $(modal_add_input_customer_telephone).val();
    }
    data['customer_option'] = $('#modal_add_trip [name="customer_option"]:checked').val();

    // if($(modal_add_input_status).val() == '') {
    //   alert('Please Choose Status');
    //   $(modal_add_input_status).focus()
    //   return;
    // }
    data['status'] = $(modal_add_input_status).val();

    if($(modal_add_input_pax).val() == '') {
      alert('Please Input Pax');
      $(modal_add_input_pax).focus()
      return;
    }
    data['pax'] = $(modal_add_input_pax).val();

    data['legs'] = [];
    var dom_legs = $('#legs tr');
    for(var index = 0; index < dom_legs.length; index ++) {
      if($(dom_legs[index]).find('.from').val() == '') {
        alert('Please Input From');
        $(dom_legs[index]).find('.from').focus();
        return;
      }

      if($(dom_legs[index]).find('.to').val() == '') {
        alert('Please Input To');
        $(dom_legs[index]).find('.to').focus();
        return;
      }

      if($(dom_legs[index]).find('.date input').val() == '') {
        alert('Please Input Date');
        $(dom_legs[index]).find('.date input').focus();
        return;
      }

      if($(dom_legs[index]).find('.time input').val() == '') {
        alert('Please Input Time');
        $(dom_legs[index]).find('.time input').focus();
        return;
      }

      data['legs'].push({
        'id': $(dom_legs[index]).data('leg-id'),
        'from': $(dom_legs[index]).find('.from').val(),
        'to': $(dom_legs[index]).find('.to').val(),
        'date': $(dom_legs[index]).find('.date input').val(),
        'time': $(dom_legs[index]).find('.time input').val(),
      })
    }

    $.ajax({
      url: base_url + '/ajax/trip/add',
      type: 'post',
      dataType: 'json',
      data: data,
      success: function(resp) {
        if(resp.success) {
          alert('Added Successfully!');
          table.ajax.reload();

          $(modal_add).modal('hide');
        }
        else {
          alert(resp.message);
        }
      }
    })
  })

  $(document).on('click', '#modal_add_trip #btn_update', function() {
    var data = {};
    data['id'] = $(modal_add_input_id).val();

    if($('#modal_add_trip [name="customer_option"]:checked').val() == 'exist') {
      if($(modal_add_input_customer_select).val() == '') {
        alert('Please Select Customer');
        $(modal_add_input_customer_select).focus() ;
        return;
      }
      data['customer_id'] = $(modal_add_input_customer_select).val();
    }
    else {
      if($(modal_add_input_customer_name).val() == '') {
        alert('Please Input Customer Name');
        $(modal_add_input_customer_name).focus()
        return;
      }
      data['customer_name'] = $(modal_add_input_customer_name).val();

      // if($(modal_customer_add_input_customer_company).val() == '') {
      //   alert('Please Input Customer Company');
      //   $(modal_customer_add_input_customer_company).focus()
      //   return;
      // }
      data['customer_company'] = $(modal_add_input_customer_company).val();

      // if($(modal_customer_add_input_customer_email).val() == '') {
      //   alert('Please Input Customer Email');
      //   $(modal_customer_add_input_customer_email).focus()
      //   return;
      // }
      data['customer_email'] = $(modal_add_input_customer_email).val();

      // if($(modal_customer_add_input_customer_telephone).val() == '') {
      //   alert('Please Input Customer Telephone');
      //   $(modal_customer_add_input_customer_telephone).focus()
      //   return;
      // }
      data['customer_telephone'] = $(modal_add_input_customer_telephone).val();
    }
    data['customer_option'] = $('#modal_add_trip [name="customer_option"]:checked').val();
    
    // if($(modal_add_input_status).val() == '') {
    //   alert('Please Choose Status');
    //   $(modal_add_input_status).focus()
    //   return;
    // }
    data['status'] = $(modal_add_input_status).val();

    if($(modal_add_input_pax).val() == '') {
      alert('Please Input Pax');
      $(modal_add_input_pax).focus()
      return;
    }
    data['pax'] = $(modal_add_input_pax).val();

    data['legs'] = [];
    var dom_legs = $('#legs tr');
    for(var index = 0; index < dom_legs.length; index ++) {
      if($(dom_legs[index]).find('.from').val() == '') {
        alert('Please Input From');
        $(dom_legs[index]).find('.from').focus();
        return;
      }

      if($(dom_legs[index]).find('.to').val() == '') {
        alert('Please Input To');
        $(dom_legs[index]).find('.to').focus();
        return;
      }

      if($(dom_legs[index]).find('.date input').val() == '') {
        alert('Please Input Date');
        $(dom_legs[index]).find('.date input').focus();
        return;
      }

      if($(dom_legs[index]).find('.time input').val() == '') {
        alert('Please Input Time');
        $(dom_legs[index]).find('.time input').focus();
        return;
      }

      data['legs'].push({
        'id': $(dom_legs[index]).data('leg-id'),
        'from': $(dom_legs[index]).find('.from').val(),
        'to': $(dom_legs[index]).find('.to').val(),
        'date': $(dom_legs[index]).find('.date input').val(),
        'time': $(dom_legs[index]).find('.time input').val(),
      })
    }

    $.ajax({
      url: base_url + '/ajax/trip/update',
      type: 'post',
      dataType: 'json',
      data: data,
      success: function(resp) {
        if(resp.success) {
          alert('Updated Successfully!');
          table.ajax.reload();

          $(modal_add).modal('hide');
        }
        else {
          alert(resp.message);
        }
      }
    })
  })

  $(document).on('click', '.tbl-action-btn-edit', function() {
    $.ajax({
      url: base_url + '/ajax/trip/get/' + $(this).data('id'),
      type: 'get',
      dataType: 'json',
      success: function(resp) {
        if(resp.success) {
          $(modal_add_input_customer_select).val(resp.trip.customer);
          $(modal_add_input_customer_name).val('');
          $(modal_add_input_customer_company).val('');
          $(modal_add_input_customer_email).val('');
          $(modal_add_input_customer_telephone).val('');

          $(modal_add_input_status).val(resp.trip.status);
          $(modal_add_input_pax).val(resp.trip.pax);
          
          $(modal_add_input_legs).html('');
          if(resp.legs.length > 0) {
            for(var index = 0; index < resp.legs.length; index ++) {
              addLegRow(resp.legs[index]);
            }
          }
          else {
            addLegRow(null);
          }
          
          $(modal_add_input_id).val(resp.trip.id);

          $(modal_add_btn_save).hide();
          $(modal_add_btn_update).show();
          
          $(modal_add).modal('show');
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
        url: base_url + '/ajax/trip/delete/' + $(this).data('id'),
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

  $(document).on('click', '#legs .btn-delete', function() {
     $(this).parents('tr').remove();
  })
</script>