@extends('layout.index')
@section('title')
文章列表
@endsection


@section('content')
<form method="POST" action="/show">
@csrf
  <div class="form-group">
    <label for="title">标题</label>
    <input type="text" class="form-control" id="title" placeholder="请输入标题" name="title" required="required">
  </div>
  <div class="form-group">
    <label for="author">作者</label>
    <input type="text" class="form-control" id="author" placeholder="请输入作者名" name="author" required="required">
  </div>
  <div class="form-group">
    <label for="img">缩略图</label>
    <input type="file" class="form-control" placeholder="" name="img" style="display:none;" id="uploadField">
    <button class="btn btn-warning" id="img" type="button">上传缩略图</button>
    <div class="row" style="padding: 10px ">
    <div class="col-md-5">
    <img src="{{ asset('images/timg.jpg') }}" alt="缩略图" class="img-thumbnail">
    </div>
    </div>
    
   </div>
  <div class="form-group">
    <label for="content">内容</label>
    <script id="content" name="content" type="text/plain"></script>
  </div>
  <button type="submit" class="btn btn-success">发布文章</button>
</form>

<script charset="utf-8" src="{{ asset('js/ueditor/ueditor.config.js') }}"></script>
<script charset="utf-8" src="{{ asset('js/ueditor/ueditor.all.min.js') }}"></script>
<script charset="utf-8" src="{{ asset('js/ueditor/lang/zh-cn/zh-cn.js') }}"></script>
<script>
var ue = UE.getEditor('content');
</script>



	
@endsection
