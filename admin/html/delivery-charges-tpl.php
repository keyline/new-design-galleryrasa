<div class="col-sm-9 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Delivery Charges</h3>
        </div>
        <div class="panel-body">
            <div role="tabpanel">

                <form class="form-inline" id="delivery-charge-form">
                    <div class="row">
                        <div class="col-xs-4">
                            <label for="lname">Description <span>*</span></label>
                            <input type="text" class="form-control" name="delivery_options" id="delivery_options"
                                   placeholder="Description" required="">
                        </div>
                        <div class="col-xs-4">
                            <label for="lname">Amount <span>*</span></label>
                            <input type="text" class="form-control" name="delivery_price" id="delivery_price"
                                   placeholder="Amount" required="">

                        </div>
                        <div class="col-xs-3">

                            <button type="submit" class="btn btn-default">Add</button>
                            <br/>

                            <input type="checkbox" name="cod" id="cod"> Add as Cash on Delivery

                        </div>

                    </div>


                </form>
                <div class="output">
                    <?php echo $shipping['shp2'] ?>
                </div>

            </div>
        </div>


	