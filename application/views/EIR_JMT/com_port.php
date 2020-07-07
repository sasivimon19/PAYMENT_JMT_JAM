<div class="custom-select">
            <select id="port" name= "port" style="height: 26px; font-size:15px; width: 263px;">
        <option value="">Select Port</option>
            <?foreach($result as $s){?>
                <option value="<?echo $s->Port?>"><? echo $s->Port?></option>
                <?}?>
        </select>
</div>
        