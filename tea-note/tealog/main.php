﻿<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统</title>
</head>
<frameset rows="88px,600px,60px" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="top.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
  <frameset cols="187,*" frameborder="no" border="0" framespacing="0">
    <frame src="left.php" name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" title="leftFrame" />
    <frame src="right.php" name="rightFrame" id="rightFrame" title="rightFrame" />
  </frameset>
  <frame src="footer.php" name="footerFrame" scrolling="No" noresize="noresize" id="footerFrame" title="footerFrame"  value="版权所有  北工院2017"/>
</frameset>
<noframes>
<body>
</body>
</noframes>
</html>
<?php
session_unset();
session_destroy();
?>