<?php if (COUNT($checknewport) == 0) { ?>

<?php } else { ?>

    <form id="portscan" name='portscan' method="post">
        <div class="col-md-12" style="margin-top: -1.5%;">
            <div class="row">
                <div class="col-md-5">
                    <?php foreach ($sum_newport as $item) {  ?>
                        <fieldset class="border p-2">
                            <legend class="w-auto"><b>ผลรวม</b></legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-primary btn-sm" style="pointer-events: none;"><b> PORT </b></button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" name="NEWPORT" id="NEWPORT" readonly="true" value="<?php echo $item->topport ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-primary btn-sm" style="pointer-events: none;"><b>MOB</b></button>
                                        </div>
                                        <input type="number" class="form-control form-control-sm" name="MOB" id="MOB" readonly="true" value="<?php echo $item->CountMob; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-primary btn-sm" style="pointer-events: none;"><b>DATESTART</b></button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" name="datepicker" id="datepicker" readonly="true" value="<?php echo $item->TopMONTH_YEAR; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-primary btn-sm" style="pointer-events: none;"><b>COST(%)</b></button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" name="COST" id="COST" readonly="true" style="background-color: black; color: White; font-weight:bold; text-align:right;" value="<?php echo number_format($item->SumNetCost, 2); ?>">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    <?php } ?>
                </div>

                <?php if (COUNT($selectlogapprae) == 0) { ?>

                    <div class="col-md-7">
                        <fieldset class="border p-2">
                            <legend class="w-auto"><b>กรุณากรอกข้อมูล</b></legend>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-primary btn-sm" style="pointer-events: none;"><b>TYPEPORT</b></button>
                                        </div>
                                        <select class="form-control form-control-sm userformvalport" name="TypePort" id="TypePort" onchange="showOnChange()">
                                            <option value="">เลือก</option>
                                            <?php foreach ($select_TypePort as $SubType) { ?>
                                                <option value="<?php echo $SubType->TypePort; ?>"><?php echo  $SubType->TypePort; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="col-md-3">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-primary btn-sm" style="pointer-events: none;"><b>NOL</b></button>
                                            </div>
                                            <input type="text" class="form-control form-control-sm userformvalport" style="font-weight:bold;" name="NOT" id="NOT" readonly="true">
                                        </div>
                                    </div> -->

                                <div class="col-md-5">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-primary btn-sm" style="pointer-events: none;"><b>ORIGINOS</b></button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm userformvalport" style="font-weight:bold; text-align:right;" name="OriginOS" id="OriginOS" onkeypress="CheckNum()">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-primary btn-sm" style="pointer-events: none;"><b>NUMACC</b></button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm userformvalport" name="NUMACC" id="NUMACC" onkeypress=" CheckNum()">
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-primary btn-sm" style="pointer-events: none;"><b>COMPANY</b></button>
                                        </div>
                                        <select class="form-control form-control-sm userformvalport" name="company" id="company">
                                            <option value="">เลือก</option>
                                            <option value="JMT">JMT</option>
                                            <option value="JAM">JAM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <fieldset class="border p-2">
                        <legend class="w-auto"><b>คำนวณ EIR</b></legend>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary btn-sm" style="pointer-events: none;"><b>Bcost</b></button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm userformvalport" style="font-weight:bold; text-align:right;" name="Bcost" id="Bcost" onchange="myFunction(this.value)">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="CheckBcost()"><i class="fas fa-calculator"></i> <b> คำนวณ EIR </b></button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm userformvalport" name="EIR" id="EIR" readonly="true" style="font-weight:bold; text-align:right;" onkeypress="CheckNum()">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary btn-sm " style="pointer-events: none;"><b>%</b></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>


    <?php } else { ?>

        <?php foreach ($selectlogapprae as $item) { ?>
            <div class="col-md-7">
                <fieldset class="border p-2">
                    <legend class="w-auto"><b>กรุณากรอกข้อมูล</b></legend>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary btn-sm" style="pointer-events: none;"><b>TYPEPORT</b></button>
                                </div>
                                <select class="form-control form-control-sm userformvalport" name="TypePort" id="TypePort" onchange="showOnChange()">
                                    <option value="">เลือก</option>
                                    <?php foreach ($select_TypePort as $SubType) { ?>
                                        <?php if ($item->Typeport == $SubType->TypePort && $getport != "") { ?>
                                            <option value="<?php echo $item->Typeport; ?>" selected><?php echo $item->Typeport; ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $SubType->TypePort; ?>"><?php echo  $SubType->TypePort; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <!-- <//?php if ($item->Status_Log == "Approve") { ?> -->
                            <!-- <div class="col-md-3">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary btn-sm" style="pointer-events: none;"><b>NOL</b></button>
                                    </div>
                                    <//?php if ($item->OriginOS != "" && $getport != "") { ?>
                                        <input type="text" class="form-control form-control-sm userformvalport" style="font-weight:bold;" readonly="true" name="NOT" id="NOT" value="<?php echo $item->nol; ?>">
                                    <//?php } else { ?>
                                        <input type="text" class="form-control form-control-sm userformvalport" style="font-weight:bold;" readonly="true" name="NOT" id="NOT">
                                    <//?php } ?>
                                </div>
                            </div> -->
                        <!-- <//?php } else { ?> -->

                        <!-- <//?php } ?> -->

                        <div class="col-md-5">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary btn-sm" style="pointer-events: none;"><b>ORIGINOS</b></button>
                                </div>
                                <?php if ($item->OriginOS != "" && $getport != "") { ?>
                                    <input type="text" class="form-control form-control-sm userformvalport" style="font-weight:bold; text-align:right;" name="OriginOS" id="OriginOS" onkeypress="CheckNum()" value="<?php echo $item->OriginOS ?>">
                                <?php } else { ?>
                                    <input type="text" class="form-control form-control-sm userformvalport" style="font-weight:bold; text-align:right;" name="OriginOS" id="OriginOS" onkeypress="CheckNum()">
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary btn-sm" style="pointer-events: none;"><b>NUMACC</b></button>
                                </div>
                                <?php if ($item->NumAcct != "" && $getport != "") { ?>
                                    <input type="text" class="form-control form-control-sm userformvalport" name="NUMACC" id="NUMACC" onkeypress=" CheckNum()" value="<?php echo $item->NumAcct; ?>">
                                <?php } else { ?>
                                    <input type="text" class="form-control form-control-sm userformvalport" name="NUMACC" id="NUMACC" onkeypress=" CheckNum()">
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary btn-sm" style="pointer-events: none;"><b>COMPANY</b></button>
                                </div>
                                <select class="form-control form-control-sm userformvalport" name="company" id="company">
                                    <option value="">เลือก</option>
                                    <?php if ($item->Company == "JMT" && $getport != "") { ?>
                                        <option value="JMT" selected>JMT</option>
                                        <option value="JAM">JAM</option>
                                    <?php } else if ($item->Company == "JAM" && $getport != "") { ?>
                                        <option value="JMT">JMT</option>
                                        <option value="JAM" selected>JAM</option>
                                    <?php } else { ?>
                                        <option value="JMT">JMT</option>
                                        <option value="JAM">JAM</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <fieldset class="border p-2">
                            <legend class="w-auto"><b>คำนวณ EIR</b></legend>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-primary btn-sm " style="pointer-events: none;"><b>Bcost</b></button>
                                        </div>
                                        <?php if ($item->Bcost != "" && $getport != "") { ?>
                                            <input type="text" class="form-control form-control-sm userformvalport" style="font-weight:bold; text-align:right;" name="Bcost" id="Bcost" value="<?php echo $item->Bcost; ?>">
                                        <?php } else { ?>
                                            <input type="text" class="form-control form-control-sm userformvalport" style="font-weight:bold; text-align:right;" name="Bcost" id="Bcost">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-success btn-sm" onclick="CheckBcost()" readonly="true"><i class="fas fa-calculator"></i> <b> คำนวณ EIR </b></button>
                                        </div>
                                        <?php if ($item->Bcost != "" && $getport != "") { ?>
                                            <input type="text" class="form-control form-control-sm userformvalport" name="EIR" id="EIR" readonly="true" style="font-weight:bold; text-align:right;" onkeypress="CheckNum()" value="<?php echo number_format($item->EIR, 02) ?>">
                                        <?php } else { ?>
                                            <input type="text" class="form-control form-control-sm userformvalport" name="EIR" id="EIR" readonly="true" style="font-weight:bold; text-align:right;" onkeypress="CheckNum()">
                                        <?php } ?>
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-primary btn-sm " style="pointer-events: none;"><b>%</b></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>


    <div class="modal-footer">
        <?php if ($Subject_Right == "SuperAdmin" && ($getport != "")) { ?>
            <?php if ($item->Status_Log == "Request") { ?>
                <button type="button" class="btn btn-success btn-flat" id="btnInsentNewport" onclick="InsentNewport(getport = '<?php echo $item->Port; ?>',Logapprae = '<?php echo $item->ID_Logapprae; ?>')"> <b> <i class="fas fa-check"></i> อนุมัติ </b> </button>
                <!-- <button type="button" class="btn btn-danger btn-flat" id="btnInsertLogApprae" onclick="Reject_Port(getport = '<?php echo $item->Port; ?>',Logapprae = '<?php echo $item->ID_Logapprae; ?>')"><b><i class="fas fa-times"></i> ไม่อนุมัติ </b></button> -->
                <button type="button" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#exampleModal">
                    <b><i class="fas fa-times"></i> ไม่อนุมัติ </b>
                </button>
            <?php } else { ?>
            <?php }  ?>
        <?php } else if ($Subject_Right == "SuperAdmin" && ($getport == "")) { ?>
            <button type="button" class="btn btn-info btn-flat" onclick="Insert_LogApprae()"><i class="far fa-save"></i> <b> ขออนุมัติ </b></button>
        <?php } else if ($Subject_Right != "SuperAdmin" && ($getport == "")) { ?>
            <button type="button" class="btn btn-info btn-flat" onclick="Insert_LogApprae()"><i class="far fa-save"></i> <b> ขออนุมัติ </b></button>
            <!-- <button type="button" class="btn btn-danger btn-flat" onclick="Delete_Reject_All(getport = '<//?php echo $item->Port; ?>')"><i class="fas fa-trash"></i> <b> ยกเลิกข้อมูล </b></button> -->
        <?php } else { ?>

            <?php if ($item->Status_Log == "Request") { ?>
                <button type="button" class="btn btn-warning btn-flat" style="pointer-events: none;"> <b><i class="fas fa-hourglass-half"></i> รออนุมัติ </b></button>
            <?php } else if ($item->Status_Log == "Approve") { ?>
                <button type="button" class="btn btn-success btn-flat" style="pointer-events: none;"> <b><i class="fas fa-hourglass-half"></i> Approve </b></button>
            <?php } else if ($item->Status_Log == "Reject") { ?>
                <button type="button" class="btn btn-danger btn-flat" style="pointer-events: none;"> <b><i class="fas fa-times""></i> ไม่อนุมัติ  <?php echo "หมายเหตุ : " . iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $item->remark); ?></b></button>
            <?php } ?>
        <?php } ?>
    </div>



            <div class=" modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">หมายเหตุ : </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-primary btn-sm" style="pointer-events: none;"><b>หมายเหตุ : </b></button>
                                                </div>
                                                <input type="text" class="form-control form-control-sm userformvalportremark" name="remark" id="remark">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-danger btn-flat" id="btnInsertLogApprae" onclick="Reject_Port(getport = '<?php echo $item->Port; ?>',Logapprae = '<?php echo $item->ID_Logapprae; ?>')"><b><i class="fas fa-times"></i> ไม่อนุมัติ </b></button>
                                    </div>
                                </div>
                            </div>
    </div>



    <div class="wrapper" style=" padding-top:1%;">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover" id="table-data" style="height: 600px; overflow: auto;width: 100%; display: inline-block;">
                                    <thead style="background-color: gray;">
                                        <tr>
                                            <th class="text-center" width="1%">Number</th>
                                            <th class="text-center" width="5%">Port</th>
                                            <th class="text-center" width="5%">Mob</th>
                                            <th class="text-center" width="5%">MONTH_YEAR</th>
                                            <th class="text-center" width="1%">CashFlow</th>
                                            <th class="text-center" width="1%">NetCost</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $num = 1;
                                        foreach ($checknewport as $value) {
                                        ?>
                                            <tr>
                                                <td style="white-space:nowrap;"><?php echo $num; ?></td>
                                                <td style="text-align: center; white-space:nowrap;"><?php echo $value->Port; ?> </td>
                                                <td style="text-align: center; white-space:nowrap;"><?php echo $value->Mob; ?></td>
                                                <td style="text-align: center; white-space:nowrap;"><?php echo $value->MONTH_YEAR; ?></td>
                                                <td style="white-space:nowrap;"><?php echo number_format($value->CashFlow, 2); ?></td>
                                                <td style="white-space:nowrap;"><?php echo number_format($value->NetCost, 2); ?></td>
                                            </tr>
                                        <?php $num++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>


    <!-- ////////////////////////////////////////////////////////////////// -->
    <!-- <div class="col-md-8">
        <ul class="pagination justify-content-center">
            <li class="page-item" data-page="prev"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item" data-page="next" id="prev"><a class="page-link" href="#">Next</a></li>
        </ul>
    </div> -->

    </div>

<?php } ?>


<script>
    $(document).ready(function() {
        <?php if ($this->session->flashdata('Check_log')) : ?>
            swal({
                title: "Port นี้อยู่ระกว่าการขออนุมัติกรุณาตราจสอบ",
                icon: "error",
                dangerMode: true,
                button: "ปิด",
            }).then((willEdit) => {
                if (willEdit) {
                    location.href = '';
                }
            });
        <?php endif; ?>
    });

    function Insert_LogApprae() {

        checkvalport = () => {
            $(".userformvalport").each(function() {
                if ($(this).val() === "" && $(this).val() === "") {
                    $(this).addClass("thisnull");
                    $(this).css("border", "2px solid red");
                } else {
                    $(this).removeClass("thisnull");
                    $(this).css("border", "");
                    $(".bootstrap-select").css("border", "");
                }
                $(".bootstrap-select").removeClass("thisnull");
            });
            return $(".thisnull").length === 0 ? true : false;
        };

        if (checkvalport() == false) {
            swal({
                title: "กรุณากรอกข้อมูลให้ครบ",
                icon: "warning",
                dangerMode: true,
                button: "ปิด",

            }).then((willEdit) => {
                if (willEdit) {

                }
            });
        } else {

            swal({
                    title: "ต้องการบันทึกข้อมูลนี้หรือไม่",
                    icon: "warning",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willEdit) => {
                    if (willEdit) {
                        document.getElementById("spinner").style.display = "block";
                        $.ajax({
                                type: "POST",
                                url: "<?php echo site_url('Call_Newport/Insert_Log_Apprae'); ?>",
                                data: $("#portscan").serialize(),
                            })
                            .done(function(data) {
                                $('#Show_Table_LogApprae').html(data);
                                swal({
                                    title: "บันทึกข้อมูลสำเร็จ",
                                    icon: "success",
                                }).then((willEdit) => {
                                    if (willEdit) {
                                        document.getElementById('spinner').style.display = "none";
                                        location.href = '';
                                    }
                                });
                            });
                    }
                });
        }
    }
</script>



<script>
    function Reject_Port(getport, Logapprae) {

        checkvalportremark = () => {
            $(".userformvalportremark").each(function() {
                if ($(this).val() === "" && $(this).val() === "") {
                    $(this).addClass("thisnull");
                    $(this).css("border", "2px solid red");
                } else {
                    $(this).removeClass("thisnull");
                    $(this).css("border", "");
                    $(".bootstrap-select").css("border", "");
                }
                $(".bootstrap-select").removeClass("thisnull");
            });
            return $(".thisnull").length === 0 ? true : false;
        };

        if (checkvalportremark() == false) {
            swal({
                title: "กรุณากรอกหมายเหตุที่ไม่อนุมัติ",
                icon: "warning",
                dangerMode: true,
                button: "ปิด",

            }).then((willEdit) => {
                if (willEdit) {

                }
            });
        } else {

            var remark = document.getElementById('remark').value;

            swal({
                    title: "ไม่อนุมัติข้อมูลนี้หรือไม่",
                    icon: "warning",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willEdit) => {
                    if (willEdit) {
                        document.getElementById("spinner").style.display = "block";
                        $.ajax({
                                type: "POST",
                                url: "<?php echo site_url('Call_Newport/RejectPort'); ?>",
                                data: $("#portscan").serialize() + "&getportS=" + getport + "&Logapprae=" + Logapprae + "&remark=" + remark,
                            })
                            .done(function(data) {
                                $('#Show_Table_LogApprae').html(data);
                                swal({
                                    title: "ไม่อนุมัติข้อมูลสำเร็จ",
                                    icon: "success",
                                }).then((willEdit) => {
                                    if (willEdit) {
                                        document.getElementById('spinner').style.display = "none";
                                        location.href = '';
                                    }
                                });
                            });
                    }
                });
        }
    }
    
</script>


<!-- <script>
    function Reject_Port(getport, Logapprae) {

        swal({
                title: "ไม่อนุมัติข้อมูลนี้หรือไม่",
                icon: "warning",
                buttons: true,
                dangerMode: false,
            })
            .then((willEdit) => {
                if (willEdit) {
                    document.getElementById("spinner").style.display = "block";
                    $.ajax({
                            type: "POST",
                            url: "<//?php echo site_url('Call_Newport/RejectPort'); ?>",
                            data: $("#portscan").serialize() + "&getportS=" + getport + "&Logapprae=" + Logapprae,
                        })
                        .done(function(data) {
                            $('#Show_Table_LogApprae').html(data);
                            swal({
                                title: "ไม่อนุมัติข้อมูลสำเร็จ",
                                icon: "success",
                            }).then((willEdit) => {
                                if (willEdit) {
                                    document.getElementById('spinner').style.display = "none";
                                    location.href = '';
                                }
                            });
                        });
                }
            });
    }
</script> -->




<script>
    $('#Bcost').change(function() {
        var Port = document.getElementById('NEWPORT').value;
        var datas = "Port=" + Port + "&Bcost=" + $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Call_Newport/Calculate_EIR') ?>",
            data: datas,
        }).done(function(data) {
            $('#EIR').val(data);
        })
    });
</script>


<script>
    function CheckBcost() {
        var Port = document.getElementById('NEWPORT').value;
        var Bcost = document.getElementById('Bcost').value;
        var datas = "Port=" + Port + "&Bcost=" + Bcost;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Call_Newport/Calculate_EIR') ?>",
            data: datas
        }).done(function(data) {
            $('#EIR').val(data);
        })
    }
</script>


<script language="javascript">
    function CheckNum() {
        if (event.keyCode < 48 || event.keyCode > 57) {
            event.returnValue = false;
            swal({
                title: "กรอกตัวเลขเท่านั้น",
                icon: "warning",
                dangerMode: true,
                button: "ปิด",
            });
        }
    }


    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
</script>


<script>
    $(document).ready(function() {
        $('body').on('change', '#TypePort', function() {
            datas = "TypePort=" + this.value;
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Call_Newport/SearchTypeport') ?>",
                data: datas
            }).done(function(data) {
                $('#NOT').val(data);
            })
        });

    });
</script>

<script>
    $(document).ready(function() {

        <?php if ($this->session->flashdata('Check_Column')) : ?>
            swal({
                title: "จำนวน Column ไม่ถูกต้อง",
                icon: "error",
                dangerMode: true,
                button: "ปิด",
            }).then((willEdit) => {
                if (willEdit) {
                    // location.href = '';
                }
            });
        <?php endif; ?>


        <?php if ($this->session->flashdata('Check_numport')) : ?>
            swal({
                title: "Port ซ้ำ กรุณาตรวจสอบ",
                icon: "warning",
                button: "ปิด",
            }).then((willEdit) => {
                if (willEdit) {
                    location.href = '';
                }
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('Countport_tbIRR_2')) : ?>
            swal({
                title: "Port ซ้ำ กรุณาตรวจสอบ IRR/Portun",
                icon: "warning",
                button: "ปิด",
            }).then((willEdit) => {
                if (willEdit) {
                    document.getElementById('spinner').style.display = "none";
                    location.href = '';
                }
            });
        <?php endif; ?>

    });


    //บันทึกของจริง
    function InsentNewport(getport, Logapprae) {

        checkvalport = () => {
            $(".userformvalport").each(function() {
                if ($(this).val() === "" && $(this).val() === "") {
                    $(this).addClass("thisnull");
                    $(this).css("border", "2px solid red");
                } else {
                    $(this).removeClass("thisnull");
                    $(this).css("border", "");
                    $(".bootstrap-select").css("border", "");
                }
                $(".bootstrap-select").removeClass("thisnull");
            });
            return $(".thisnull").length === 0 ? true : false;
        };


        if (checkvalport() == false) {
            swal({
                title: "กรุณากรอกข้อมูลให้ครบ",
                icon: "warning",
                dangerMode: true,
                button: "ปิด",

            }).then((willEdit) => {
                if (willEdit) {
                    // location.href = '';
                }
            });
        } else {

            swal({
                    title: "ต้องการบันทึกข้อมูลนี้หรือไม่",
                    icon: "warning",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willEdit) => {
                    if (willEdit) {
                        document.getElementById("spinner").style.display = "block";
                        $.ajax({
                                type: "POST",
                                url: "<?php echo site_url('Call_Newport/Insert_Newport_True'); ?>",
                                data: $("#portscan").serialize() + "&getportS=" + getport + "&Logapprae=" + Logapprae,
                            })
                            .done(function(data) {
                                // $('#showdatanewporadd').html(data);
                                $('#Show_Table_LogApprae').html(data);
                                swal({
                                    title: "บันทึกข้อมูลสำเร็จ",
                                    icon: "success",
                                }).then((willEdit) => {
                                    if (willEdit) {
                                        document.getElementById('spinner').style.display = "none";
                                        location.href = '';
                                    }
                                });
                            });
                    }
                });
        }
    }
</script>


<script>
    function goBack() {
        window.history.back();
    }
</script>


<!-- <script>
    getPagination('#table-data');

    function getPagination(table) {
        var lastPage = 1;
        $('.pagination')
            .find('li')
            .slice(1, -1)
            .remove();
        var trnum = 0;
        maxRows = 10;

        $('.pagination').show();
        var totalRows = $(table + ' tbody tr').length;
        $(table + ' tr:gt(0)').each(function() {
            trnum++;
            if (trnum > maxRows) {
                $(this).hide();
            }
            if (trnum <= maxRows) {
                $(this).show();
            }
        });

        if (totalRows > maxRows) {
            var pagenum = Math.ceil(totalRows / maxRows);
            for (var i = 1; i <= pagenum;) {
                $('.pagination #prev')
                    .before(
                        '<li class="page-item"data-page="' +
                        i +
                        '">\
                        <a class="page-link" href="#">' +
                        i++ +
                        '</a>\
                    </li>')
                    .show();
            }
        } else {
            $('.pagination').hide();
        }

        $('.pagination [data-page="1"]').addClass('active');
        $('.pagination li').on('click', function(evt) {
            evt.stopImmediatePropagation();
            evt.preventDefault();
            var pageNum = $(this).attr('data-page');
            var maxRows = 10;
            if (pageNum == 'prev') {
                if (lastPage == 1) {
                    return;
                }
                pageNum = --lastPage;
            }
            if (pageNum == 'next') {
                if (lastPage == $('.pagination li').length - 2) {
                    return;
                }
                pageNum = ++lastPage;
            }
            lastPage = pageNum;
            var trIndex = 0;
            $('.pagination li').removeClass('active');
            $('.pagination [data-page="' + lastPage + '"]').addClass('active');

            limitPagging();
            $(table + ' tr:gt(0)').each(function() {

                trIndex++;
                if (
                    trIndex > maxRows * pageNum ||
                    trIndex <= maxRows * pageNum - maxRows
                ) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });

        limitPagging();
    }

    function limitPagging() {


        if ($('.pagination li').length > 7) {
            if ($('.pagination li.active').attr('data-page') <= 3) {
                $('.pagination li:gt(5)').hide();
                $('.pagination li:lt(5)').show();
                $('.pagination [data-page="next"]').show();
            }
            if ($('.pagination li.active').attr('data-page') > 3) {
                $('.pagination li:gt(0)').hide();
                $('.pagination [data-page="next"]').show();
                for (let i = (parseInt($('.pagination li.active').attr('data-page')) - 2); i <= (parseInt($('.pagination li.active').attr('data-page')) + 2); i++) {
                    $('.pagination [data-page="' + i + '"]').show();

                }

            }
        }
    }
</script> -->