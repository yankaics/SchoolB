<?
if($_SESSION['utype']!="管理员")
{
	//需配合PHP/adminse.php使用
	?>
	<script type="text/javascript">
		alert("非法接入");
		window.location.href="<?=$add?>";
	</script>
	<?
	die();
}
?>