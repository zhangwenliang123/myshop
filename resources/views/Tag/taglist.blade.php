<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>标签管理</title>
</head>
<body>
<conter>
	<table border="1">
	<button id="add_btn">添加</button>
	</br>
	</br>
	    <tr>
          <td>标签ID</td>
          <td>标签名称</td>
          <td>操作</td>
	    </tr>
        @foreach($data as $v)
        <tr>
           <td>{{$v['id']}}</td>
           <td>{{$v['name']}}</td>
           <td>
           <a href="{{url('del_tag')}}">删除</a>
           <a href="{{url('update_tag')}}">修改</a>
           </td>
        </tr>
      @endforeach
</form>
	</table>
	<script src="js/jquery.min.js"></script>
	<script>
 $('#add_btn').on('click',function(){
 	window.location.href='{{url('add_tag')}}';
 })

	</script>
	</conter>
</body>
</html>