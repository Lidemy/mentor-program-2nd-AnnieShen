function join(str, concatStr) { 

  var result = str.join(concatStr);
  return result;
  console.log(result);
  
}


function repeat(str, times) { 
  
  var array = []; 
  for (i = 0; i < times; i++) { 
    array.push(str); 
  } 
  return array.join('');
  console.log(repeat(str, times));
}
