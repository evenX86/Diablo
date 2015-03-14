<script language="javascript">
var validations = new Array();
//定义要执行的验证，每个数组内容存储要验证的表单域，以及要适用的验证方法
validations[0] = ["document.myform.user_ID","user_ID"];
validations[1] = ["document.myform.user_passwd","user_passwd"];
validations[2] = ["document.myform.user_repasswd","user_repasswd"];
//validation[3] = ["document.myform.sex","sex"];
validations[3] = ["document.myform.email","email"];
validations[4] = ["document.myform.tel_num","tel_num"];
//validations[6] = ["document.myform.degree","degree"];
//validations[7] = ["document.myform.major","major"];
validations[5] = ["document.myform.address","address"];

function isEmpty(s)
{
  if(s==null || s.length==0)
    return true;
  else
    return false;
}//isEmpty

function isID(field)
{
  var s = field.value
  if(isEmpty(s))
  {
    alert("用户名不可为空!");
    field.focus();
    return false;
  }//if
  else  
    if(!(/^-?\d+$/.test(s)))
    {//如果输入中包含非数字字符，则给出提示
       alert("用户名为学号或编号!");
       field.focus();
       return false;
    }//if
    else
      if(s.length != 8)
      {
        alert("用户名位数不对，请检查!");
        field.focus();
        return false;
      }//if
  return true;
}//isID
  
  function isPasswd(field)
  {//检查密码是否为空
     var s = field.value;
     if(isEmpty(s))
     {
       alert("密码不可为空!");
       field.focus();
       return false;
     }//if
     return true;
  }//isPasswd

function isRePasswd(field_1,field_2)
{//检查密码是否一致
  var s_1 = field_1.value;
  var s_2 = field_2.value;

  if(s_2 != s_1)
  {
    alert("密码输入有误，请检查！");
    field.focus();
    return false;
  }//if
  return true; 
}//isRePasswd

function isEmail(field)
{//检测Email是否为空，以及是否合法
  var s = field.value;
  if(isEmpty(s))
  {
    alert("E-mail不可为空!");
    field.focus();
    return false;
  }//if
  else
   /* if( s.charAt(0) == "." ||
        s.charAt(0) == "@" ||
        s.indexOf('@',0) == -1 ||
        s.indexOf('.',0) == -1 ||
        s.lastIndexOf('@') == s.length-1 ||
        s.lastIndexOf('.') == s.length-1 || 
      )
    */if(/[^@]+@\w+/.test(s))
    {
     // return true;
      alert("E-mail地址不合法！");
      field.focus();
      return false;
    }//if
  return true;
}//isEmail

function isTel_Num(field)
{//检查手机号码是否为空，以及位数是否正确
  var s = field.value;
  if(isEmpty(s))
  {
    alert("手机号码不可为空!");
    field.focus();
    return false;
  }//if
  else
    if(!(/^-?\d+$/.test(s)))
    {
      alert("手机号码中含有非法字符，请检查!");
      field.focus();
      return false;
    }//if
    else
      if(s.length != 11)
      {
         alert("手机号码位数不对，请检查！");
         field.focus();
         return false;
      }//if
  return true;
}//isTel_Num

function checkuser()
{
  var i;
  var checkToMake;
  var field;
  //逐个读入文本框内容，进行校验
  for(i = 0; i <validations.length; i++)
  {
    field = eval(validations[i][0]);
    checkToMake = validations[i][1];
    switch (checkToMake)
    {
      case 'user_ID':
           if(!isID(field)) 
             return false;
           break;
      case 'user_passwd':
           if(!isPasswd(field))
             return false;
           break;
      case 'user_repasswd':
           var field_1 = eval(validations[i-1][0]);
           var field_2 = eval(validations[i][0]);
           if(!isRePasswd(field_1,field_2))
             return false;
           break;
     
   //   case 'sex':
     
          // var selectedindex = -1;
           //var myform = document.getElementByld("myform");
           //var j = 0;

         //  for(j=0; j<myform.name.length; j++)
          // {
           //  if(myform.name[j].checked)
            // {
             //  selectedindex = j;
              // alert("value是:"+myform.name[j].value);
               //break;
            // }//if
          // }//for
          // if(selectedindex < 0)
           //{
            // alert("性别不可为空！");
             //field.focus();
           //  return false;
          // }//if
           //break;
      
      case 'email':
           if(!isEmail(field))
             return false;
           break;

       case 'tel_num':
            if(!isTel_Num(field))
              return false;
            break;
       case 'address':
            if(isEmpty(field.value))
            {
              alert("联系地址不可为空!");
              field.focus();
              return false;
            }//if
            break;
    }//switch
  }//for
  return true;
}//checkuser

</script>
