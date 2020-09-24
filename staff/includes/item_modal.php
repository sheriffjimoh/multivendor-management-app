

<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Item</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../class/process/staff-action.php" enctype="multipart/form-data">
          		  <div class="form-group">
                  	<label for="firstname" class="col-sm-3 control-label">Category</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="firstname" name="category" placeholder="enter item Category ....." required>
                  	</div>
                </div>
                 <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Item_name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="firstname" name="item_name" placeholder="enter item name ....." required>
                    </div>
                </div>

          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add_item"><i class="fa fa-save"></i> Save</button></div>
            	</form>
          	</div>
        </div>
    </div>
</div>

