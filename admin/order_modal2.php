
<!-- <head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head> -->
  
  <!-- Modal -->
  <div class="modal fade" id="editstatus<?php echo $row['id'];?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Order</h4>
        </div>

        <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="action_update2.php?staff=<?php echo $row['id']; ?>" enctype="multipart/form-data">
                    
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Order ID:</label>
                            </div>
                            <div class="col-md-9">
                                <h4 class="text"><?php echo $row['id']; ?></h4>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Order Number:</label>
                            </div>
                            <div class="col-md-9">
                                <h4 class="text-center"><?php echo $row['track']; ?></h4>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">Update Status:</label>
                            </div>
                            <div class="col-md-9">
                                
                                            <select class="form-control" name="srole" required="required" >
                                                <option name="srole" value="In Process">In Process</option>
                                                <option name="srole" value="Delivered">Delivered</option>
                                            </select>
                                            
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="payment2" value="Paid">

                </div>
      </div>

                </div>
        </div>



        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-succes">Update</button>
        </form>
        </div>
      </div>
      
    </div>
  </div>
