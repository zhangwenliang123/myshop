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
    <form action="javascript:;" method="post" onsubmit="javascript:post(this);" id="form">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @csrf
        <table cellpadding="0" cellspacing="0">  
            <tr>
                <td>用户名</td>
                <td>
                    <input type="text" name="user_name" id="user_name">
                </td>
            </tr>
            <tr>
                <td>密码</td>
                <td>
                    <input type="password" name="user_pwd" id="user_pwd">
                </td>
            </tr>
            <tr>
                <td>确认密码</td>
                <td><input type="password" name="user_pwd1" id="user_pwd1"></td>
            </tr>
            <tr>
                <td colspan="2">
                       <input type="button" value="注册" id="pwd">
                </td>
            </tr>
        </table>
    </form>
    </div>  
</body>
</html>
<script type="text/javascript" src="js/jquery.min.js"></script>

<script>
    $('#pwd').on('click',function(){
      var form=$('#form').serialize();
      var user_name=$('#user_name').val();
      var user_pwd=$('#user_pwd').val();
      var user_pwd1=$('#user_pwd1').val();
      if(user_name==""){
        alert('用户名不能为空');
        return false; 
      }
      if(user_pwd==""){
        alert('密码不能为空');
        return false;
      }
      if(user_pwd!=user_pwd1){
        alert('密码与确认密码不一致');
        return false;
      }

      $.ajax({
        headers:{
          'X-CSRF-TOKEM':$('make[name="csrf-token"]').attr('content')
        },
        url:'buthregist_do',
        type:'post',
        data:form,
        dataType:'json',
        async:true,
        success:function(res){
          if (res.error==1) {
            alert(res.msg);
            location.href="buthlogin";
          }else{
            alert(res.msg);
          }
        }
      },'json');

    })
</script>