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
            	<form class="form-horizontal" method="POST" action="../class/process/action.php" enctype="multipart/form-data">
          		  <div class="form-group">
                  	<label for="firstname" class="col-sm-3 control-label">Product name</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id=">Product name" name="p_name" placeholder="enter product name ....." required>
                  	</div>
                </div>
                 <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">size</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="size" name="p_size" placeholder="enter product size ....." required>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Price</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="Price" name="p_price" placeholder="enter product Price....." required>
                    </div>
                </div>

          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add_product"><i class="fa fa-save"></i> Save</button></div>
            	</form>
          	</div>
        </div>
    </div>
</div>

