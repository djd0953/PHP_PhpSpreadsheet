<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>엑셀 파일 읽기</title>
</head>
<body>	
    <header class="entry-header"><h1>엑셀 파일 선택</h1></header>
	
	<form name="add_form_entry" id="add_form_entry" method="post" action="read.php" enctype="multipart/form-data">
        <label for="inputFileName">Select a file:</label>
        <input type="file" name="inputFileName" size="40">
        <input type="submit" value="확인">
	</form>
	
    <div onclick="excelDown()">주소록 다운로드</div>
    <iframe width=0 height=0 name='hiddenframe' style='display:none;'></iframe>
    <script>
        function excelDown()
        {
            opnner = window.open(`ExcelDownload.php`,"hiddenframe","width=0, height=0, top=0, statusbar=no, toolbar=no, scrollbars=no");
            opnner.focus();
            
        }
    </script>
</body>
</html>