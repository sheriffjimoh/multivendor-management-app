<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Set supplier  accounts</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../class/process/action.php">
          		  <div class="form-group">
                   <input type="hidden" name="usertype"  value="supplier">
                  	<label for="title" class="col-sm-3 control-label">user ID</label>

                  <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control"   name="user-id" required>
                      </div>
                    </div>
          	</div>
            <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">username</label>

                  <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control"  name="user-name" required>
                      </div>
                    </div>
            </div>
            <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">password</label>

                  <div class="col-sm-9"> 
                      <div class="date">
                        <input type="password" class="form-control"  name="password" required>
                      </div>
                    </div>
            </div> <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">comfirm password</label>

                  <div class="col-sm-9"> 
                      <div class="date">
                        <input type="password" class="form-control"  name="cpassword" required>
                      </div>
                    </div>
            </div>
           
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add_supp_acct"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>