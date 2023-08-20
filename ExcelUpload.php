<?php
    // Composer 없이 사용 가능하다고 했는데 사용해보니 다운로드에 문제 있음
    // require_once(__DIR__.'/PhpOffice/Psr/autoloader.php');
    // require_once(__DIR__.'/PhpOffice/PhpSpreadsheet/autoloader.php');

    // Composer로 Install 후 폴더만 이동하여 테스트 해보니 사용가능함
    require_once(__DIR__."vendor/autoload.php");

    use PhpOffice\PhpSpreadsheet\Spreadshhet;
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

    $server_inputFileName = $_FILES["inputFileName"]["tmp_name"];
    $pc_FileName = $_FILES["inputFileName"]["name"];
    $file_type = pathinfo($pc_FileName, PATHINFO_EXTENSION);

    if ($server_inputFileName) 
    {
        /** Create a new Excel File Reader  **/
        if ($file_type =='xls') 
        {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();	
        }
        elseif ($file_type =='xlsx') 
        {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        else 
        {
            echo '처리할 수 있는 엑셀 파일이 아닙니다';
            exit;
        }

        $spreadsheet = $reader->load($server_inputFileName);
	
        $spreadData = $spreadsheet-> getActiveSheet()->toArray();
        
        $rows=count($spreadData);
        $cols=(count($spreadData,1)/count($spreadData))-1;
        
        echo '<table border="1" style="width:100%">';	
        for ($i = 0; $i < $rows; $i++) 
        {
            echo '<tr>';
            for ($j = 0; $j < $cols; $j++) 
            {
                if ($j == 1 and $i > 0) 
                {
                    echo '<td nowrap>'.$spreadData[$i][$j].'</td>';
                }
                else 
                {
                    echo '<td nowrap align="center">'.$spreadData[$i][$j].'</td>';
                }
            }
            echo '</tr>';		
        }	
        echo '</table>';

    }
?>