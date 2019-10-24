<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户列表</title>
</head>
<body>
<center>
<form action="" method="post" >
@csrf
<input type="submit" value='提交'></br>

<table border="1">
<tr>
   <td>用户昵称</td>
   <td>用户性别</td>
   <td>用户省份</td>
   <td>市</td>
   <td>操作</td>
</tr>
@foreach($dtinfo as $v)
<tr>
   <td>{{$v['nickname']}}</td>
   <td>{{$v['sex']}}</td>
   <td>{{$v['province']}}</td>
   <td>{{$v['city']}}</td>
   <td><a href="">查看标签</a>|
   <a href="">删除</a>|
   <a href="">修改</a>|
   <a href="{{ url('push_template_msg') }}?openid={{$v['openid']}}">发送消息</a></td>

</tr>

@endforeach
</table>
</form>
	
</body>
</html>