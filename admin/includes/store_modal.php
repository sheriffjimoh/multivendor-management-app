<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Item to store</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../class/process/action.php">
          		  <div class="form-group">
                    <label for="schedule" class="col-sm-3 control-label">Item name</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="schedule" name="item_name" required>
                        <option selected disabled>select item name ----</option>
                        <?php
                       $obj= new Main;
                   $data = $obj->Read_record('item');
                    foreach ($data as $srow) {
                            echo "
                              <option value='".$srow['Item_name']."'>".$srow['Item_name']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>                    <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Item-type</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="title" name="item_type"  placeholder="e.g  flour.." required>
                    </div></div>
                  <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Item_amount</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="title" name="item_amount" placeholder="e.g 20,000..."  required>
                    </div></div>
                 <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Quantity</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="title" name="quantity" placeholder="e.g 3.." required>
                    </div></div>
                <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Size</label>

                    <div class="col-sm-9">
                     <select name="size" class="form-control select-2"   required="">
                       <option selected disabled>select size---</option>
                       <option value="bag">Bag</option>
                        <option value="h-bag">Half-bag</option>
                         <option value="q-bag">Qurtar-bag</option>
                         <option value="p-rubber">paint-rubber</option>
                         <option value="tin">Tin</option>
                         <option value="shachet">Shachet</option>
                      

                     </select>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Measure</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="rate" name="measure" placeholder="e.g  4kg" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Exp_Date</label>

                    <div class="col-sm-9">
                      <input type="date" class="form-control" id="rate" name="exp_date" placeholder="expiredate ..." required>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add_store"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

     