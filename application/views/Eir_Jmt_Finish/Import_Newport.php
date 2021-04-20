<div class="card-body" style="margin-top: -3%;">
    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true"> <b>IMPORT NEWPORT</b></a>
        </li>
        <?php if ($Subject_Right == "SuperAdmin") { ?>
            <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">รายการรออนุมัติ</a>
            </li>
        <?php } ?>
    </ul>
    <div class="tab-content" id="custom-content-below-tabContent">
        <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button type="button" class="input-group-text btn btn-default btn-sm" style="background-color: #ae1b09; color:  white;" onclick="Upload_FileNewport()"><i class="fas fa-file-import"></i> <b>Import</b> </button>
                        </div>
                        <input type="file" name="FileNewport" id="FileNewport" class="custom-file form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>


            <div align="center" id="showdatanewporadd">

            </div>

            <div class="row">
                <div class="col-md-12" id="Show_Table_LogApprae" name="Show_Table_LogApprae">
                    <?php $this->load->view('Eir_Jmt_Finish/Table_LogApprae'); ?>
                </div>
            </div>
        </div>


        <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
            <div class="row">
                <div class="col-md-12" id="Table_LogApprae" name="Table_LogApprae">
                    <?php $this->load->view('Eir_Jmt_Finish/TableApprae'); ?>
                </div>
            </div>

        </div>

    </div>
</div>





<script>
    function Upload_FileNewport() {

        var FileNewport = document.getElementById('FileNewport').value;
        var form_data = new FormData();

        form_data.append('FileNewport', $('#FileNewport')[0].files[0]);

        if (FileNewport == '') {
            swal("กรุณาเลือกไฟล์ก่อน", "", "warning");

        } else {
            if ($('#FileNewport').val().split(".").pop() != "xlsx") {
                swal("ชนิดไฟลไม่ถูกต้อง กรุณาใช้ .xlsx", "", "warning");
                return false;
            }
            document.getElementById("spinner").style.display = "block";
            $.ajax({
                cache: false,
                type: 'POST',
                url: '<?php echo site_url('Call_Newport/check_ImportExcel_Newport'); ?>', //Import
                contentType: false,
                processData: false,
                data: form_data,
            }).done(function(data) {
                $('#showdatanewporadd').html(data);
                document.getElementById("Show_Table_LogApprae").style.display = "none";
                document.getElementById("spinner").style.display = "none";
            })
        };
    }
</script>