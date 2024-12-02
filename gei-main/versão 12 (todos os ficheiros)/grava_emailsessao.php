<?php
  session_start();
  session_regenerate_id();
  ?>
<!DOCTYPE html>
<html lang="pt">
   <head>
      

<?php

 include ("head.php");
?>

   </head>


   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="<?php echo SVRURL ?>images/loading.gif" alt="Loading" /></div>
      </div>
      <!-- end loader -->


     <?php include ("header.php");?>
     


     <?php
//session_start();



include("sessao_timeout.php");

 
  ?>
      
      <!-- about -->
      <div  class="about">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
               <a href="#" class="btn btn-secondary disabled">CONFIGURAÇÕES >> EMAIL/SESSÃO >> INSERIR</a>
               <div class="titlepage">
                
                  </div>
               </div>
            </div>
            
            <div class="container">
               <div class="row">
                  <div class="col-md-8 offset-md-3">
              
                        

<?php
include("msg_bemvindo.php");
?>
    
<br>




<?php
if ( !isset($_POST['pass']) || !isset($_POST['email']) || !isset($_POST['nome']) || !isset($_POST['sessao']))
{
?>


<script>
window.setTimeout(function() {
    window.location.href = '<?php echo SVRURL ?>email_sessao.php';
}, 10);
</script>


<?php
}
?>



<?php
if( isset($_POST['email']) )
{
$em=$_POST["email"];


$sql = "select count(*) from settings where email_user='".$em."'";
$result = mysqli_query($db,$sql);

$count = mysqli_fetch_array($result);


//echo ($count[0]);

if ($count[0]>0)

{
?>
    <script>
   
    swal({
title: 'O email já existe!',
text: '<?php echo $t; ?>',
icon: 'error',
//buttons: false,

})
.then(function() {
window.location = "<?php echo SVRURL ?>inseriremse";
});


</script>


<?php

}


elseif   ($_SESSION['tipo']==1)
{

$pa=$_POST["pass"];

$sql = "insert into settings (email_user,pass,email_smtp,email_smtpport,nome_app,sessao_timeout) 
values ('".$_POST["email"]."',AES_ENCRYPT('$pa', 'secret'),'".$_POST["smtp"]."',".$_POST["smtpport"].",'".$_POST["nome"]."',".$_POST["sessao"].")";
$result = mysqli_query($db,$sql);

mysqli_close($db);
?>


<script>
    
    swal({
title: 'Os dados foram guardados!',
//text: 'Os dados foram guardados!',
icon: 'success',
//buttons: false,

})
.then(function() {
window.location ="<?php echo SVRURL ?>emsess";
});


</script>
<?php
}

else

{
?>


<script>
    
swal({
title: 'Não pode inserir!',
text: 'Não tem permisssão!',
icon: 'error',
//buttons: false,

})
.then(function() {
window.location = "<?php echo SVRURL ?>inseriremse";
});


</script>



<?php
}

}


else

{
?>
    <script>
window.setTimeout(function() {
    window.location.href = 'inseriremse';
}, 10);
</script>


<?php

}

?>



<br><br><br><br><br><br><br>
                    </div>
               
               </div>
            </div>
         </div>
      </div>
      <!-- end about -->
    


      <?php include ("footer.php");?>


   </body>
</html>