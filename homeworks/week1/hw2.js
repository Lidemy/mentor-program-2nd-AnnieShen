function capitalize(str){
  
  strLen = str.length;
  
  var str2 = str.substring(0,1).toUpperCase();
  postString = str.substring(1,strLen);
  str = str2 + postString;
  return str;
  
  console.log(str);
  
}

