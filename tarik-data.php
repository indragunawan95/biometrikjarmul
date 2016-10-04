<html>
<head><title>Contoh Koneksi Mesin Absensi Mengunakan SOAP Web Service</title>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>

</head>


<body bgcolor="#caffcb">

<H3>Download Log Data</H3>



	<div id="tableHolder">
	
	</div>

</body>
<script type="text/javascript">
	
    $(document).ready(function(){
      refreshTable();
    });

    function refreshTable(){
        $('#tableHolder').load('tabel.php', function(){
           setTimeout(refreshTable, 500);
        });
    }
</script>


</html>
