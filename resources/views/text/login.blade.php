<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
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
			border: 1px solid #ddd;
			height: 50px;
			line-height: 50px;
			padding-left: 10px;
		}




		input{
			height: 30px;
			line-height: 30px;
			width: 300px;
			font-size: 16px;
			padding: 5px;
		}




		select{
			height: 30px;
		}




		button{
			width: 200px;
			height: 40px;
			line-height: 40px;
			background-color: #ef6763;
			border: none;
			outline: none;
			text-align: center;
			color: #fff;
			border-radius: 4px;
		}
	</style>
    <title>学生信息添加</title>
</head>
<body>
<div class="wrap">
    <form action="login_do" method="post" onsubmit="javascript:post(this);">
    @csrf
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td>用户名</td>
                <td>
                    <input type="text" name="username">
                </td>
            </tr>
            <tr>
                <td>密码</td>
                <td>
                    <input type="password" name="password">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                        <button type="submit">登录</button>
                </td>
            </tr>
        </table>
    </form>
    </div>
</body>
</html>
<script>
    function post($obj){
        //阻止默认行为
        event.preventDefault();
        var username=$obj.username.value;
        var password=$obj.password.value;




        if(username=="" || password==""){
				alert("信息填写不完整!");
				return false;
			}
        //使用ajax提交
        $obj.submit();




    }
</script>