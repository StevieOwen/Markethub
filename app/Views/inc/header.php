<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$cust_id="";
if(isset($_SESSION['cust_id'])){
    $cust_id=$_SESSION['cust_id'];
}else{
   Header("Location:/login");  
} 
// echo $cust_id;

?>

<script>
    const URLROOT = '<?php echo URLROOT; ?>';
</script>