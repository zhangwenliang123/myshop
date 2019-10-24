@extends('layout.index')
@section('title')
文章列表
@endsection


@section('content')


@if(session()->has('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
@endif


<form action="" method="get">
	标题:<input type="text" name="title">
	作者:<input type="text" name="author">
	条件:<select name="order">
			<option value="">请选择..</option>
			<option value="id">id</option>
		</select>


		排序:<select name="order_do">
				<option value="">请选择..</option>
				<option value="asc">升序</option>
				<option value="desc">倒序</option>
			</select>
	<input type="submit" value="搜索">
</form> 
	<table class="table table-bordered">
 		<thead>
			<tr>
				<th>序号</th>	
				<th>标题</th>
				<th>发布时间</th>
				<th>图片</th>
				<th>作者</th>
				<th>浏览量</th>
				<th>内容</th>
				<th>操作</th>
			</tr>
 		</thead>
 		<tbody>
 		@foreach($list as $v)
			<tr>
				<td>{{$v->id}}</td>
				<td>{{$v->title}}</td>
				<td>{{$v->created_at}}</td>
				<td><img src="{{ asset('images/'.$v->img) }}" style="max-width:10px;"><td>
				<td>{{$v-z>author}}</td>
				<td>{{$v->hits}}</td>
				<td>{{$v->content}}</td>
				<td>
					<a href="{{url('update')}}?id={{$v->id}}" class="btn btn-small btn-primary">修改</a>
					<a href="{{url('del')}}?id={{$v->id}}" class="btn btn-danger btn-small">删除</a>
				</td>
			</tr>
		@endforeach
 		</tbody>


	</table>
		
@endsection
