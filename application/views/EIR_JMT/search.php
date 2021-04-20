<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/util.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">


<div class="container">
    <div class="row">
    <div class="custom-select">
        <select id="company" name="company" style="height: 26px; font-size:15px;"onchange = "com()">
        <option value="">Select Company</option>
        <?php foreach($company as $c){?>
                <option value="<?php echo $c->Company?>"><?php echo $c->Company?></option>
                <?php }?>
        </select>
        </div>
        <div class="custom-select" id ="com_port">
        <select id="port" name= "port" style="height: 26px; font-size:15px;">
        <option value="">Select Port</option>
            <?php foreach($port as $s){?>
                <option value="<?php echo $s->Port?>"><?php echo $s->Port?></option>
                <?php }?>
        </select>
    </div>
        Date :<input type="month" id="date" name="date" >&nbsp;
        <button type="button" onclick="search()"class="btn btn-info btn-sm">ค้นหา</button>
        <button type="button" onclick="refresh()"class="btn btn-success btn-sm">Refresh</button>
        <button type="button" style="margin-left: 10px;" onclick="excel()" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o "></i> ExportExcel</button> 
        <button type="button" onclick="pdf()" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i> ExportPDF</button>
               
    </div>
</div>

<script>
function search() {
        
        var datas = "port=" + document.getElementById('port').value + "&date=" + document.getElementById('date').value
        + "&company=" + document.getElementById('company').value;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('port/pagingmain_eir') ?>",
            data: datas,
        }).done(function(data) {
             $('#all_eir').html(data);        
        });
        

    }
    function refresh() {
     
        location.reload();
    }

    function com() {
        
        var datas =  "company=" + document.getElementById('company').value;
        
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('port/com') ?>",
            data: datas,
        }).done(function(data) {
             $('#com_port').html(data);        
        });
    }

</script>

