<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>上传资源</title>
</head>
<body>
<conter>
	<form action="{{url('do_uploads')}}" method="post" enctype="multipart/form-data">
	@csrf
	<select name="type" id="">
	  <option value="">图片</option>
	  <option value="">音频</option>
	  <option value="">视频</option>
	  <option value="">缩略图</option>

	</select></br></br>
	<input type="file" name="rsource"></br></br>
	<input type="submit" value="提交">
	</form>	
</conter>
	
</body>
</html>