<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  $(".click").click(function(){
  $(".tip").fadeIn(200);
  });
  
  $(".tiptop a").click(function(){
  $(".tip").fadeOut(200);
});

  $(".sure").click(function(){
  $(".tip").fadeOut(100);
});

  $(".cancel").click(function(){
  $(".tip").fadeOut(100);
});

});
</script>


</head>


<body>
<?php
 error_reporting(0);
//连接
@$id = mysql_connect("localhost","root","root");
//打开
@$db=mysql_select_db("db_tealog",$id);
$tea_name1=$_GET['tea_name'];
$tea_term1=$_GET['tea_term'];
$tea_class1=$_GET['tea_class'];
$tea_cou1=$_GET['tea_cou'];
//if(isset($_GET['searchbt'])){
//$tea_name1=$_GET['tea_name'];
//$tea_term1=$_GET['tea_term'];
$sql="select tea_id,tea_name,tea_class,tea_cou,tea_hour,tea_term from tb_teachinginfo where tea_name like '%$tea_name1%' and tea_cou like '%$tea_cou1%' and tea_class like '%$tea_class1%' and tea_term like '%$tea_term1%' order by tea_term desc";
//echo $sql;
//}else{
 
 
//$sql="select tea_id,tea_name,tea_class,tea_cou,tea_hour,tea_term from tb_teachinginfo order by tea_term desc";
//}
$result = mysql_query($sql,$id); 


?>
	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    
    <li><a href="#">查找信息</a></li>
    <li><a href="#">数据列表</a></li>
    </ul>
    </div>
    
    <div class="rightinfo">
    
    <div class="tools">
    
    	<ul class="toolbar">
        <li class="click"><span><img src="images/t01.png" /></span>添加</li>
        <li class="click"><span><img src="images/t02.png" /></span>修改</li>
        <li><span><img src="images/t03.png" /></span>删除</li>
        
        </ul>
        
        
        <ul class="toolbar1">
        <li><span><img src="images/t05.png" /></span>设置</li>
        </ul>
    
    </div>
    
    
    <div style="margin:0 auto;width:600px; font-family:'华文楷体'"> 
    
 </div>
    <table class="tablelist" align='center' border='10' cellspacing='0' cellpadding='8'  bordercolor='#000'>

<tr>
 <th><input name="" type="checkbox" value="" checked="checked"/></th>
<th>序号</th><th>学期</th><th>教师</th><th>课程</th><th>班级</th><th>月份</th><th>操作</th>
</tr>
<?php

  if(mysql_num_rows($result)>0){
	$number=mysql_num_rows($result);
	if(empty($_GET['p']))
	$p=0;
	else {$p=$_GET['p'];}	
	$check=$p +10;
	for($i=0;$i<$number;$i++){
		$row=mysql_fetch_array($result);
		$rows=$rows+1;
		$tea_id=$row['tea_id'];
		$tea_name=$row['tea_name'];
        $tea_class=$row['tea_class'];
        $tea_cou=$row['tea_cou'];

        $tea_hour=$row['tea_hour'];
        $tea_term=$row['tea_term'];
		if($i>=$p && $i < $check){
			if($i%2 ==0)
echo "<form name='f$rows' method='post' action='showTeachingPlan.php'>";
echo "<tr>";
echo "<td><input name='' type='checkbox' value='' /></td>";
echo "<td>$rows</td>";
echo "<td><input type='hidden' name='tea_term' value='$tea_term' />".$row['tea_term']." </td>";
echo "<td><input type='hidden' name='tea_name' value='$tea_name' />".$row['tea_name']." </td>";
echo "<td><input type='hidden' name='tea_cou' value='$tea_cou' />".$row['tea_cou']."</td>";
echo "<td><input type='hidden' name='tea_class' value='$tea_class' />".$row['tea_class']."</td>";
echo "<td>";
$sqlmonth="select DISTINCT left(tp_time,7) as tp_time from tb_teachingplaninfo where tea_id=$tea_id order by tp_time";
//$sqlmonth="select tp_time from tb_teachingplaninfo left join tb_teachinginfo where tb_teachingplaninfo.tea_id=$tea_id order by tp_time";
//$sqlmonth="select tp_id,tea_id,tp_content,tp_time,tp_kewai from tb_teachingplaninfo order by tp_time";
//echo $sqlmonth;
echo "<select name='month'>";



$resultmonth = mysql_query($sqlmonth,$id); 
 while($row=mysql_fetch_array($resultmonth)){
echo "<option value=".$row['tp_time'].">".$row['tp_time']."</option>";
}

echo "</select>";
echo "</td>";
echo "<td><input type='submit'   value='查看'/><a href='deleteTeachingPlan.php?tea_id=$tea_id&tea_term=$tea_term1&tea_name=$tea_name1' onclick='return del()'>删除</a></td>";
echo "</tr>";
echo "</form>";
$j=$i+1;
		}
		}
}
?>
</table>
    
   
    <div class="pagin" align="center">
    	<table width="400" border="0" align="center">
  <tr>
      <td align="center"><a href="showAllTeachingPlan.php? p=0">首页</a></td>
      <td align="center">
	  <?php
	  if($p>9){
		  $last=(floor($p/10)*10)-10;
		  echo "<a href='showAllTeachingPlan.php? p=$last'>上一页</a>";
		  }
		  else
		  echo"上一页";
      ?>
      </td>
      <td align="center">
      <?php
	  if($i>9 and $number>$check){
		    echo"<a href='showAllTeachingPlan.php? p=$j'>下一页</a>";
		  }
	  else
	     echo"下一页";
      ?>
      </td>
      <td align="center">
      <?php
      if($i>9)
      {
      $final=floor($number/10)*10;
      echo"<a href='showAllTeachingPlan.php? p=$final'>尾页</a>";
      }
      else
        echo"最后一页";
		?>
       
      </td>
  </tr>
</table>
    </div>
    
    
    <div class="tip">
    	<div class="tiptop"><span>提示信息</span><a></a></div>
        
      <div class="tipinfo">
        <span><img src="images/ticon.png" /></span>
        <div class="tipright">
        <p>是否确认对信息的修改 ？</p>
        <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
        </div>
        </div>
        
        <div class="tipbtn">
        <a href='deleteTeachingPlan.php?tea_id=$tea_id&tea_term=$tea_term1&tea_name=$tea_name1' onclick='return del()'>删除</a>&nbsp;
        <input name="" type="button"  class="cancel" value="取消" />
        </div>
    
    </div>
    
    
    
    
    </div>
    
    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>
</body>
</html>
