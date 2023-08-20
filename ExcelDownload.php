<?php
    // Composer 없이 사용 가능하다고 했는데 사용해보니 다운로드에 문제 있음
    // require_once(__DIR__.'/PhpOffice/Psr/autoloader.php');
    // require_once(__DIR__.'/PhpOffice/PhpSpreadsheet/autoloader.php');

    // Composer로 Install 후 폴더만 이동하여 테스트 해보니 사용가능함
    require_once(__DIR__."vendor/autoload.php");

    require_once($_SERVER["DOCUMENT_ROOT"]."/include/dbdao.php");

    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

    $spreadsheet = $reader->load("AddAddress.xlsx");
    $spreadData = $spreadsheet-> getActiveSheet();

    $dao = new WB_SMSUSER_DAO;
    $vo = $dao->SELECT();
    $rowNumber = 2;

    foreach($vo as $v)
    {
        $spreadData->setCellValue("A".$rowNumber, $v->GCode);
        $spreadData->setCellValue("B".$rowNumber, $v->UName);
        $spreadData->setCellValue("C".$rowNumber, $v->Phone);
        $spreadData->setCellValue("D".$rowNumber, $v->Division);
        $spreadData->setCellValue("E".$rowNumber++, $v->UPosition);
    }

    $writer = new Xlsx($spreadsheet);

    
    ob_end_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename=AddAdress.xlsx');
    header("Cache-Control: max-age=0");
    
    $writer->save('php://output');
?>