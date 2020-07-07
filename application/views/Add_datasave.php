
    <section class="content" style=" padding-top: 2%;">
        <div class="container-fluid">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title"> เพิ่มข้อมูล Payment </h3>
                </div>
                <div class="card-body">
                    <form id="insert1" action="<?php echo site_url('Payment_controller/loadpayment_get_from'); ?>" method = "post" enctype = "multipart/form-data" >
                        <div class="row" id="checkInsurance_premium">
                            <div class="col-md-12">
                                <div class="input-group input-group-sm">
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-primary"> Date </button>
                                            </div>
                                            <input id="date" type="date" class="form-control" name="date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-primary"> Contract No </button>
                                            </div>
                                            <input id="Agreement" type="text" class="form-control" name="Agreement">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-primary"> IDCard </button>
                                            </div>
                                            <input id="IDCard" type="text" class="form-control" name="IDCard">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-primary"> Channel </button>
                                            </div>
                                            <input class="form-control" list="Channel1" name="Channel" id="Channel">
                                            <datalist id="Channel1">
                                                <?php foreach ($Channel as $key) {
                                                    ?>
                                                    <option value="<?php echo $key->code; ?>">
                                                    <?php }
                                                    ?>
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-primary"> Ref1 </button>
                                            </div>
                                            <input id="Ref1" type="text" class="form-control" name="Ref1">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-primary"> Ref2 </button>
                                            </div>
                                            <input id="Ref2" type="date" class="form-control" name="Ref2">

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-primary"> Amount </button>
                                            </div>
                                            <input id="Amount" type="text" class="form-control" name="Amount">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-primary"> Remark </button>
                                            </div>
                                            <input id="Remark" type="text" class="form-control" name="Remark">
                                        </div>
                                    </div>
                                    
                                    <div class=" col-5"></div>
                                    <div class=" col-5">
                                        <button style="width: 15%;margin: 15px;" type="button" onclick="save_get()" class="btn btn-success">บันทึก</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>    
        </div>
    </section>