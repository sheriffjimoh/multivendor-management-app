<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content" style="background: #787854; color: #fff;">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>update infomation</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../class/process/staff-update.php">
          		  <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Change username</label>
                      <div class="col-sm-9"> 

                        <input type="text" class="form-control"  name="username" required>
                    </div></div>
                    <div class="form-group">
                       <label for="rate" class="col-sm-3 control-label">Old password</label>
                         <div class="col-sm-9"> 
                        <input type="password" class="form-control"  name="opassword"   required>
                    </div></div>
                     <div class="form-group">
                       <label for="rate" class="col-sm-3 control-label">Change password</label>
                         <div class="col-sm-9"> 
                        <input type="password" class="form-control"  name="password"   required>
                    </div></div>
                     <div class="form-group">
                       <label for="rate" class="col-sm-3 control-label">Comfirm password</label>
                    <div class="col-sm-9"> 
                        <input type="password" class="form-control"  name="cpassword" value="" required>
                      </div>
                    </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="update_profile_stock"><i class="fa fa-save"></i> Update</button>
            	</form>
          	</div>
        </div>
    </div>
</div>