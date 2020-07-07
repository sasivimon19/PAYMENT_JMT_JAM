<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/util.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">

<!--<style>
    /* Removes the clear button from date inputs */
input[type="month"]::-webkit-clear-button {
    display: block;
}

/* Removes the spin button */
input[type="month"]::-webkit-inner-spin-button { 
    display: none;
}

/* Always display the drop down caret */
input[type="month"]::-webkit-calendar-picker-indicator {
    color: #2c3e50;
}

/* A few custom styles for month inputs */
input[type="month"] {
    appearance: block;
    -webkit-appearance: none;
    color: #95a5a6;
    font-family: "Helvetica", arial, sans-serif;
    font-size: 16px;
    border:1px solid black;
    background:#ecf0f1;
 
    
    display: inline-block !important;
    visibility: visible !important;
}

input[type="month"], focus {
    color: black;
    box-shadow: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
}
.custom-select {
    appearance: block;
    -webkit-appearance: none;
    color: #95a5a6;
    font-family: "Helvetica", arial, sans-serif;
    font-size: 16px;
   
    background:#ecf0f1;
    color: black;
    box-shadow: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
   
 
    
    display: inline-block !important;
    visibility: visible !important;
}

</style>-->

<div class="container">
    <div class="row">
    <div class="custom-select">
        <select id="company" name="company" style="height: 26px; font-size:15px;"onchange = "com()">
        <option value="">Select Company</option>
        <? foreach($company as $c){?>
                <option value="<? echo $c->Company?>"><? echo $c->Company?></option>
                <?}?>
        </select>
        </div>
        <div class="custom-select" id ="com_port">
        <select id="port" name= "port" style="height: 26px; font-size:15px;">
        <option value="">Select Port</option>
            <? foreach($port as $s){?>
                <option value="<? echo $s->Port?>"><? echo $s->Port?></option>
                <? }?>
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
        
            // alert(datas);
       
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
        
            // alert(datas);
       
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('port/com') ?>",
            data: datas,
        }).done(function(data) {
             $('#com_port').html(data);        
        });
    }

</script>

