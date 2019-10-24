<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改学生信息</title>
	<style type="text/css">
	 *{
	 	margin: 0px;
	 	padding: 0px;
	 }
	 .wrap{
	 	width: 80%;
	 	margin: 0px auto;
	 }
     table{
     	width: 100%;
     	margin-top: 20px;
     }
     table tr td{
     	border: 1px solid #ddd ;
     	height: 50px;
     	line-height: 50px;
     	padding-left: 10px;
     }
     input{
     	height: 30px
     	line-height: 30px;
     	width: 100px;
     	font-size: 10px;
     	padding: 5px;
     }
     button{
     	width: 200px;
     	height:40px;
     	line-height:40px;
     	background-color: #ef6763;
     	border: none;
     	outline: none;
     	text-align: center;
     	color: #fff;
     	border-radius:4px;
     }

	</style>
	<script type="text/javascript">
	    function post($obj){
	    	console.log($obj);
          //阻止默认行为
          event.preventDefault();
          var name=$obj.name.value;
          var age=$obj.age.value;
          if(name==""||age==""){
          	alert('信息填写不完整');
          	return fasle;
          }
          //使用ajax提交
          $obj.submit();
	    	
	    }



	</script>
</head>
<body>
<div class="wrap">
<h1>修改学生信息</h1>
<form action="/update_do" method="post" onsubmit="javascript:post(this);">
<input type="hidden" name="id" value="{{$student->id}}">
  <table cellpadding="0" cellspacing="0">
     <tr>
     @csrf
       <td>姓名</td>
       <td><input type="text" name="name" value="{{$student->name}}"></td>
     </tr>
     <tr>
       <td>年龄</td>
       <td><input type="number" name="age" value="{{$student->age}}"></td>
     </tr>
     <tr>
      <td colspan="2">
      <button type='submit'>修改</button></td>
     </tr>



  </table>
</form>
</div>
</body>
</html>