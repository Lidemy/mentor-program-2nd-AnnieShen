function join(str, concatStr) { 

  var newstr = "";
  for(var i = 0; i < str.length; i++){
	  if(i < str.length-1){
		  newstr += str[i] + concatStr; 
	  }
	  else{
		  newstr +=  str[i];
	  }
  }
  return newstr;
  console.log(newstr);
  
}


function repeat(str, times) { 
  
  var array = []; 
  for (i = 0; i < times; i++) { 
    array.push(str); 
  } 
  return array.join('');
  console.log(repeat(str, times));
}
