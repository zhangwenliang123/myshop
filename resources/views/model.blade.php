<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>学生信息</title>
</head>
<body>
<h2>学生添加</h2>
<a href="/add" id="addBtn">添加学生信息</a>
<table>
   <thead>
     <tr>
     @csrf
       <th>序号</th>
       <th>姓名</th>
       <th>性别</th>
       <th>年龄</th>
       <th>添加时间</th>
       <th>修改时间</th>
     </tr>
     <tbody>
     <?php foreach ($list as $v) : ?>
     	<tr>
           <td><?=$v->uid?></td>
           <td><?=$v->name?></td>
           <td><?=$v->sex?></td>
           <td><?=$v->age?></td>
           <td><?=$v->ctime?></td>
           <td><?=$v->utime?></td>
           <a href="">查看</a><a href="">删除</a><a href="">修改</a>
     	</tr>
     	
     <?php endforeach; ?>

    </tbody>
  </thead>
</table>
</form>
</body>
</html>