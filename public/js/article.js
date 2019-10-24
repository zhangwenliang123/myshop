$(function(){

   $('#img').on('click',function(e){
   	   // alert(123);

     	$('#uploadField').click();
     });
  $('#uploadField').on('change',function(e){

    $files=$(this)[0].files[0];
  	//将图片显示到所图中
  	var reader=new FileReader();
  	reader.readAsDataURL($files);
  	reader.onload=function(){
  		//展示
  		$(".img-thumbnail").attr("src",reader.result);
  	} 
  });


})