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
                  <th>From</th>
                  <th>To</th>
                  <th>Date</th>
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
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body">
        <div class="container-fluid">
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
  $('#date_from').datetimepicker({
    format: 'L'
  });

  $('#date_to').datetimepicker({
    format: 'L'
  });

  var modal_add = $('#modal_add_trip');

  var modal_add_btn_save = $('#modal_add_trip #btn_save');
  var modal_add_btn_update = $('#modal_add_trip #btn_update');

  var modal_add_input_name = $('#modal_add_trip #name');
  var modal_add_input_place_from = $('#modal_add_trip #place_from');
  var modal_add_input_place_to = $('#modal_add_trip #place_to');
  var modal_add_input_date_from = $('#modal_add_trip #date_from input');
  var modal_add_input_date_to = $('#modal_add_trip #date_to input');

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

  $(document).on('click', '#btn_new', function() {
    $(modal_add_btn_save).show();
    $(modal_add_btn_update).hide();

    $(modal_add_input_name).val('');
    $(modal_add_input_place_from).val('');
    $(modal_add_input_place_to).val('');
    $(modal_add_input_date_from).val('');
    $(modal_add_input_date_to).val('');

    $(modal_add).modal('show');
  })

  $(document).on('click', '#modal_add_trip #btn_save', function() {
    if($(modal_add_input_name).val() == '') {
      alert('Please Input Name');
      $(modal_add_input_name).focus()
      return;
    }

    if($(modal_add_input_place_from).val() == '') {
      alert('Please Input From');
      $(modal_add_input_place_from).focus()
      return;
    }

    if($(modal_add_input_place_to).val() == '') {
      alert('Please Input To');
      $(modal_add_input_place_to).focus()
      return;
    }

    if($(modal_add_input_date_from).val() == '') {
      alert('Please Input Date From');
      $(modal_add_input_date_from).focus()
      return;
    }

    if($(modal_add_input_date_to).val() == '') {
      alert('Please Input Date To');
      $(modal_add_input_date_to).focus()
      return;
    }

    $.ajax({
      url: base_url + '/ajax/trip/add',
      type: 'post',
      dataType: 'json',
      data: {
        name: $(modal_add_input_name).val(),
        place_from: $(modal_add_input_place_from).val(),
        place_to: $(modal_add_input_place_to).val(),
        date_from: $(modal_add_input_date_from).val(),
        date_to: $(modal_add_input_date_to).val(),
      },
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
    if($(modal_add_input_name).val() == '') {
      alert('Please Input Name');
      $(modal_add_input_name).focus()
      return;
    }

    if($(modal_add_input_place_from).val() == '') {
      alert('Please Input From');
      $(modal_add_input_place_from).focus()
      return;
    }

    if($(modal_add_input_place_to).val() == '') {
      alert('Please Input To');
      $(modal_add_input_place_to).focus()
      return;
    }

    if($(modal_add_input_date_from).val() == '') {
      alert('Please Input Date From');
      $(modal_add_input_date_from).focus()
      return;
    }

    if($(modal_add_input_date_to).val() == '') {
      alert('Please Input Date To');
      $(modal_add_input_date_to).focus()
      return;
    }

    $.ajax({
      url: base_url + '/ajax/trip/update',
      type: 'post',
      dataType: 'json',
      data: {
        id: $(modal_add_input_id).val(),
        name: $(modal_add_input_name).val(),
        place_from: $(modal_add_input_place_from).val(),
        place_to: $(modal_add_input_place_to).val(),
        date_from: $(modal_add_input_date_from).val(),
        date_to: $(modal_add_input_date_to).val(),
      },
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
          $(modal_add_input_name).val(resp.data.name);
          $(modal_add_input_place_from).val(resp.data.place_from);
          $(modal_add_input_place_to).val(resp.data.place_to);
          $(modal_add_input_date_from).val(resp.data.date_from);
          $(modal_add_input_date_to).val(resp.data.date_to);

          $(modal_add_input_id).val(resp.data.id);

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
</script>