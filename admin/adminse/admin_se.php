<?
if($_SESSION['utype']!="管理员")
{
	
	?>
	<script type="text/javascript">
		alert("非法接入");
		window.location.href="<?=$add?>";
	</script>
	<?
	die();
}
?>