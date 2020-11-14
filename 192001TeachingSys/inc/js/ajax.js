function showData(str,areaId,url,x)
{
var xmlhttp;
if (str=="")
  {
  document.getElementById(areaId).innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById(areaId).innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url+"?q="+str+"&x="+x,true);
xmlhttp.send();
}