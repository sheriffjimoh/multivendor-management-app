<!-- Add -->
<div class="modal fade" id="Book">
    <div class="modal-dialog">
        <div class="modal-content" style="background: #787854; color: #fff;">
          	<div class="modal-header">
             
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 &times; </button> <h4 class="modal-title"><b>Book new trip</b></h4>
          	</div>
          	<div class="modal-body">
            	 <form class="form-horizontal" method="POST" action="../class/process/supplier-action.php">
          		
                     <div class="form-group">
                    <label for="position" class="col-sm-3 control-label">Product name</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="prod_name" id="position" required>
                        <option value="" selected>Select---</option>
                        <?php
                     $obj= new Main;
                   $data = $obj->Read_record('product');
                    foreach ($data as $prow) {
                            echo "
                              <option value='".$prow['P_name']."'>".$prow['P_name']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                    <div class="form-group"> 
                    <label for="rate" class="col-sm-3 control-label">Product piecies</label>
                      
                        <div class="col-sm-9">
                      <input type="text" class="form-control" id="title" name="prod_peices"  placeholder="e.g  100.." required>
                    </div></div>
                     <div class="form-group">
                    <label for="position" class="col-sm-3 control-label">Product size</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="prod_size" id="position" required>
                        <option value="" selected>Select---</option>
                        <?php
                     $obj= new Main;
                   $data = $obj->Read_record('product');
                    foreach ($data as $prow) {
                            echo "
                              <option value='".$prow['P_size']."'>".$prow['P_size']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                   
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add_supply"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

     