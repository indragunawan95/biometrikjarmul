<html>
<head><title>Contoh Koneksi Mesin Absensi Mengunakan SOAP Web Service</title>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>

</head>


<body bgcolor="#caffcb">

<H3>Download Log Data</H3>



	<div id="tableHolder">
	<?php $redirect = 1;?>
	</div>

</body>
<script type="text/javascript">
	 
   var redir = <?php echo $redirect ?>;
    $(document).ready(function(){
      if(redir==1){
          redirect();
      }
      else{
          refreshTable();
      }
      
    });

    function refreshTable(){
        $('#tableHolder').load('tabel.php', function(){
           setTimeout(refreshTable, 500);
        });

    }
    function redirect(){
        $('#tableHolder').load('index.php', function(){
           
        });
      }
</script>


</html>
