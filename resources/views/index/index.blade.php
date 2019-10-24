<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>学生列表</title>
	<style type="text/css">
      *{
        padding: 0px;
        margin: 0px;
        font-size: 16px;
      }
      .wrap{
      	width: 80%;
      	margin: 10px auto;
      }

      table{
      	width: 80%;
      	margin: 20px auto;
      }
      table tr th,table tr td{
      	border: 1px solid #ddd;
      }

      #addBtn{
      	display: block;
      	width: 200px;
      	height: 40px;
      	background-color: #539a30;
      	border: none;
      	outline: none;
      	text-align: center;
      	text-decoration: none;
      	line-height: 40px;
      	color: #fff;
      	margin-top: 10px;
      	border-radius: 10px;


      }
      #del{
      	display: block;
      	width: 200px;
      	height: 40px;
      	background-color: #422a00;
      	border: none;
      	outline: none;
      	text-align: center;
      	text-decoration: none;
      	line-height: 40px;
      	color: #fff;
      	margin-top: 10px;
      	border-radius: 10px;


      }



      .pagination li{
      	float: left;
      	padding: 10px;
      	list-style: none;
      	border: 1px solid #ddd;
      	margin-left: 10px;
      }


	</style>
</head>
<body>
<div class="wrap">
<h1>学生信息</h1>

<a href="/add" id="addBtn">添加学生信息</a>
<button id="del" id="">删除</button><br>
<form action="index" method="post">
@csrf
<input type="text" name="name" placeholder="根据名字搜索">
<input type="text" name="age" placeholder="根据年龄搜索">

<input type="submit" value="查询">
</form>
	<table cellpadding="0" cellspacing="0">
      <thead>

	         <tr>
	         <th>全选<input type="checkbox" id="selectAll"></th>
	           <th>序号</th>
	           <th>名字</th>
	           <th>年龄</th>
	           <th>操作</th>
	         </tr>
         <tbody>
          <?php foreach ($list as $student) : ?>
          	 <tr>
          	 <td><input type="checkbox" name="checkboxes[]" value="{{$student->id}}"></td>
               <td><?=$student->id?></td>
               <td><?=$student->name?></td>
               <td><?=$student->age?></td>
               <td><a href="">查看</a>
               <a href="{{url('update')}}?id={{$student->id}}">修改</a>
               <a href="{{url('delete')}}?id={{$student->id}}">删除</a></td>
          	 </tr>
          	<?php endforeach; ?>
         </tbody>
     
      
      </thead>
	</table>

	{{ $data->appends($query)->links() }}
	</div>
</body>
</html>
<script src="jq.js"></script>
<script>

  $("#selectAll").click(function(){
  	$('[name="checkboxes[]"]').prop('checked',$(this).prop('checked'));
  })

  //批删
  $("#del").click(function(){
  	var box =$("input[name='checkboxes[]']");
    length=box.length;
    var str=""
    for(var i=0;i<length;i++){
    	if(box[i].checked==true){
    		str=str+","+box[i].value;
    	}
    }
    str = str.substr(1);
    location.href="del?id="+str;
  })

 
</script>