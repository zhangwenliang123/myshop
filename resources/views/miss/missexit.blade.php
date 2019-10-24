<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<form method="POST" action="/missexit">
@csrf
  <div class="form-group">
    <label for="title">收货人</label>
    <input type="text" class="form-control" id="title" placeholder="请输入标题" name="title" required="required">
  </div>
  <div class="form-group">
    <label for="author">总金额</label>
    <input type="text" class="form-control" id="author" placeholder="请输入作者名" name="author" required="required">
  </div>
   </div>
  <button type="submit" class="btn btn-success">添加</button>
</form>

	
</body>
</html>