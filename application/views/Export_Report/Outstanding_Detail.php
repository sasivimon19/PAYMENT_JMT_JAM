<?php header("Content-Type: application/csv");
    header("Content-Disposition: attachment; filename=Outstanding Detail.csv");
    header("Pragma: no-cache");
    header("Expires: 0");
    echo iconv("utf-8","tis-620","No").",".
        iconv("utf-8","tis-620","Product"). ",".
        iconv("utf-8","tis-620","Lot No"). ",".
        iconv("utf-8","tis-620","contract_no").",".
        iconv("utf-8","tis-620","Before_amt").",".
        iconv("utf-8","tis-620","amount"). ",".
        iconv("utf-8","tis-620","Endingmonth")."\r\n";
$no = 1;  foreach ($report as $value) {
        echo $no.",".
             $value-> product . ",".
             $value->lot_no.","."'".
             $value->contract_no.",".
            $value-> beinmonth.",".
            $value->rpinmonth.",".
            $value->endingmonth . "\r\n";
    $no++; }
