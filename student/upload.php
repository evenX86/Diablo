<?php
/*临时存储文件地址*/
$upload_file=$_FILES['upload_file']['tmp_name'];
/*存储文件名称*/
$upload_file_name=$_FILES['upload_file']['name'];

if($upload_file)
{
  $file_size_max = 5*1024*1024; //2M限制文件上传最大容量
  $store_dir = "/var/www/gms/uploads/"; //上传文件的存储位置
  $accept_overwrite = 1; //是否允许覆盖相同文件

  if($upload_file_size > $file_size_max)
  {
    echo "<script>alert ('对不起，您的文件容量太大！');history.back();</script>";
    exit();
  }//if

  if(file_exists($store_dir.$upload_file_name)&& !$accept_overwrite)
  {
   echo "<script>alert ('存在相同文件名的文件！');history.back();</script>"; 
   exit();
  }//if

  if(!move_uploaded_file($upload_file, $store_dir.$upload_file_name))
  {
    echo "<script>alert ('文件上传失败,请重新上传！');history.back();</script>";
  }//if
  else
  {
    echo "<script>alert ('文件上传成功！');</script>";
  }//else

}//if
?>
