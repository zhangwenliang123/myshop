<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<conter>
	<table border="1">
	   <form action="">
	   @csrf
          <tr>
             <td>图片</td>
             <td>音频</td>
             <td>视频</td>
             <td>缩略图</td>
          </tr>
          @foreach($res as $v)
          <tr>
             <td>{{ $v->id }}</td>
             
          </tr>
         @endforeach
	   </form>
	</table>	
	<conter>
</body>
</html>