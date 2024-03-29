<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><?php echo $aircraft_category['name']?></h3>
      </div>
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
            <table id="aircrafts" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Name</th>
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

<!-- Add or Update Aircraft Modal -->
<div class="modal fade" id="modal_add_aircrafts" data-backdrop="static" role="dialog">
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
        </div>
      </div>
      <input type="hidden" name="aircraft_id" id="aircraft_id">
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
<!-- /.Add or Update Aircraft Modal -->

<style>
#aircrafts_wrapper .row:first-of-type {
  display: none;
}
</style>
<script>
  var modal_add = $('#modal_add_aircrafts');

  var modal_add_btn_save = $('#modal_add_aircrafts #btn_save');
  var modal_add_btn_update = $('#modal_add_aircrafts #btn_update');

  var modal_add_input_name = $('#modal_add_aircrafts #name');

  var modal_add_input_id = $('#modal_add_aircrafts #aircraft_id');

  var table = $('#aircrafts').DataTable({
    "pagingType": 'full_numbers',
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    'ajax': {
      url: base_url + '/ajax/aircraft/<?php echo $aircraft_category['id']?>/all',
    }
  });

  $(document).on('keyup', '#search', function() {
    table.search($(this).val()).draw(false);
  })

  $(document).on('click', '#btn_new', function() {
    $(modal_add_btn_save).show();
    $(modal_add_btn_update).hide();

    $(modal_add_input_name).val('');

    $(modal_add).modal('show');
  })

  $(document).on('click', '#modal_add_aircrafts #btn_save', function() {
    if($(modal_add_input_name).val() == '') {
      alert('Please Input Name');
      $(modal_add_input_name).focus()
      return;
    }

    $.ajax({
      url: base_url + '/ajax/aircraft/<?php echo $aircraft_category['id']?>/add',
      type: 'post',
      dataType: 'json',
      data: {
        name: $(modal_add_input_name).val()
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

  $(document).on('click', '#modal_add_aircrafts #btn_update', function() {
    if($(modal_add_input_name).val() == '') {
      alert('Please Input Name');
      $(modal_add_input_name).focus()
      return;
    }

    $.ajax({
      url: base_url + '/ajax/aircraft/update',
      type: 'post',
      dataType: 'json',
      data: {
        id: $(modal_add_input_id).val(),
        name: $(modal_add_input_name).val()
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
      url: base_url + '/ajax/aircraft/get/' + $(this).data('id'),
      type: 'get',
      dataType: 'json',
      success: function(resp) {
        if(resp.success) {
          $(modal_add_input_name).val(resp.data.name);
         
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
        url: base_url + '/ajax/aircraft/delete/' + $(this).data('id'),
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