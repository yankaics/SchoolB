<?
/**
 * This file is part of SchoolB.
 *
 * Licensed under The Apache License, Version 2.0
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    AmosHuKe<amoshuke@qq.com>
 * @copyright AmosHuKe<amoshuke@qq.com>
 * @link      https://github.com/AmosHuKe/SchoolB
 * @license   https://opensource.org/licenses/Apache-2.0 (Apache License, Version 2.0)
 */

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