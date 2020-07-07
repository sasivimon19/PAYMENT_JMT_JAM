<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=SumYear.xls"); //ชื่อfile
header("Pragma: no-cache");
header("Expires: 0");
?>

<style>
    th {
            background-color: #5bc0de;
        }
</style>

<h2 style="margin-top: 3%; text-align: center;margin-bottom: 14px;">Summary Per Year</h2>
<div class="container">
    <div class="table-responsive" style="margin-top: 1%;">
        <table id="user_data" border="1" style="background-color: white;" class="table table-striped table  table-hover">

         
            <?php
            foreach ($sumyear as $index => $tableData) { ?>
                <?php if ($index === 0) { ?>
                    <thead>
                        <tr>
                            <?php foreach ($tableData as $key => $data) { ?>
                                <th nowrap style="text-align:center;">
                                    <?php echo $key; ?>
                                </th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <?php
            foreach ($sumos as $index => $tbos) { ?>
                <?php if ($index === 0) { ?>
                    <tbody id="tbodyid">
                        <tr>
                            <td style="background-color: #F0F8FF; color: black;">OS:</td>
                            <?php foreach ($tbos as $rows) { ?>
                                <td style="background-color: #F0F8FF; color: black;" <?php if (is_numeric($rows)) {
                                        echo "right";
                                    } else {
                                        echo "center";
                                    } ?>>
                                    <?php if (is_numeric($rows)) {
                                        echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', number_format($rows, 2));
                                    } else {
                                        echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $rows);
                                    } ?>
                                </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                <?php } ?>
            <?php } ?>

            <?php
            foreach ($sumacct as $index => $tbacct) { ?>
                <?php if ($index === 0) { ?>
                    <tbody id="tbodyid">
                        <tr>
                            <td style="background-color: #F0F8FF; color: black;">Account:</td>
                            <?php foreach ($tbacct as $rows) { ?>
                                <td style="background-color: #F0F8FF; color: black;" <?php if (is_numeric($rows)) {
                                        echo "right";
                                    } else {
                                        echo "center";
                                    } ?>>
                                    <?php if (is_numeric($rows)) {
                                        echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', number_format($rows, 2));
                                    } else {
                                        echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $rows);
                                    } ?>
                                </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                <?php } ?>
            <?php } ?>
                <?php } ?>
                
                <tbody id="tbodyid">
                    <tr class="openMonth" onclick="openDetail('<?php echo 'tr-year' . $tableData->Year ?>');">
                        <?php foreach ($tableData as $rows) { ?>
                            <td <?php if (is_numeric($rows)) {
                                    echo "right";
                                } else {
                                    echo "center";
                                } ?>>
                                <?php if (is_numeric($rows)) {
                                    echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', number_format($rows, 2));
                                } else {
                                    echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $rows);
                                } ?>
                            </td>
                        <?php } ?>
                    </tr>
                    <?php foreach ($summonth as $ind => $tbmonth) {
                        if ($tableData->Year == $tbmonth->Year) {
                    ?>
                            <tr class="tr-year<? echo $tableData->Year?>" style="background-color: #F0F8FF;">
                                <?php foreach ($tbmonth as $r) { ?>
                                    <td <?php if (is_numeric($r)) {
                                            echo "right";
                                        } else {
                                            echo "center";
                                        } ?>>
                                        <?php if (is_numeric($r)) {
                                            echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', number_format($r, 2));
                                        } else {
                                            echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r);
                                        } ?>
                                    </td>
                                <?php } ?>
                            </tr>
                    <?php }
                    }
                    ?>
                </tbody>
            <?php } ?>
            <?php
            foreach ($sumport as $index => $tbsum) { ?>
                <?php if ($index === 0) { ?>
                    <tbody id="tbodyid">
                        <tr>
                            <td style="background-color: black; color: white;">GrandTotal:</td>
                            <?php foreach ($tbsum as $rows) { ?>
                                <td style="background-color: black; color: white;" <?php if (is_numeric($rows)) {
                                        echo "right";
                                    } else {
                                        echo "center";
                                    } ?>>
                                    <?php if (is_numeric($rows)) {
                                        echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', number_format($rows, 2));
                                    } else {
                                        echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $rows);
                                    } ?>
                                </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                <?php } ?>
            <?php } ?>

            <?php
            foreach ($sumyear1 as $index => $tableData) { ?>
                <?php if ($index === 0) { ?>
                    <thead>
                        <tr>  
                            <?php foreach ($tableData as $key => $data) { ?>
                               
                            <?php } ?>
                        </tr>
                    </thead>
                <?php } ?>
                <tbody id="tbodyid">
                    <tr class="openMonth" onclick="openDetail1('<?php echo 'tr-year1' . $tableData->Year ?>');">
                        <?php foreach ($tableData as $rows) { ?>
                            <td <?php if (is_numeric($rows)) {
                                    echo "right";
                                } else {
                                    echo "center";
                                } ?>>
                                <?php if (is_numeric($rows)) {
                                    echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', number_format($rows, 2));
                                } else {
                                    echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $rows);
                                } ?>
                            </td>
                        <?php } ?>
                    </tr>
                    <?php foreach ($summonth1 as $ind => $tbmonth) {
                        if ($tableData->Year == $tbmonth->Year) {
                    ?>
                            <tr class="tr-year1<? echo $tableData->Year?>" style="background-color: #F0F8FF;">
                                <?php foreach ($tbmonth as $r) { ?>
                                    <td style="background-color: #F0F8FF;"<?php if (is_numeric($r)) {
                                            echo "right";
                                        } else {
                                            echo "center";
                                        } ?>>
                                        <?php if (is_numeric($r)) {
                                            echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', number_format($r, 2));
                                        } else {
                                            echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $r);
                                        } ?>
                                    </td>
                                <?php } ?>
                            </tr>
                    <?php }
                    }
                    ?> 
                </tbody>
            <?php } ?>
            <?php
            foreach ($sumport1 as $index => $tbsum) { ?>
                <?php if ($index === 0) { ?>
                    <tbody id="tbodyid">
                        <tr>
                            <td style="background-color: black; color: white;">GrandTotal:</td>
                            <?php foreach ($tbsum as $rows) { ?>
                                <td style="background-color: black; color: white;" <?php if (is_numeric($rows)) {
                                        echo "right";
                                    } else {
                                        echo "center";
                                    } ?>>
                                    <?php if (is_numeric($rows)) {
                                        echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', number_format($rows, 2));
                                    } else {
                                        echo iconv('TIS-620//IGNORE', 'UTF-8//IGNORE', $rows);
                                    } ?>
                                </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                <?php } ?>
            <?php } ?>
        </table>
    </div>
</div>
</html>