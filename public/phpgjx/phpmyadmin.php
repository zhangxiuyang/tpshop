<?php 
$config = include_once 'config.php';
$url = $_SERVER['HTTP_REFERER'].'phpMyAdmin-4.4.11/';



?>
<script>
   //parent.location.href = '$url;';
   window.open ('<?php echo $url;?>','_blank');   
</script>

