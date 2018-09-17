function add(a, b) {
  //var a = "12312383813881381381"
  //var b = "129018313819319831"
  var sumArray = []
  
  
  var aArray = a.split('')
  var bArray = b.split('')
  
  if (aArray.length > bArray.length){
    
    var abLength = aArray.length - bArray.length
    for(var i = 1; i <= abLength; i++){
      bArray.unshift('0')
      //console.log(aArray)
      //console.log(bArray)
  
    }
  
  }else if(bArray.length > aArray.length){
    var baLength = bArray.length - aArray.length
    for(var m = 1; m <= baLength; m++){
      aArray.unshift('0')
      //console.log(aArray)
      //console.log(bArray)
    }
  }
  
  
  for(var j = aArray.length-1; j >= 0; j--){
    sumArray.push(parseInt(aArray[j]) + parseInt(bArray[j]))
  }
  
  
  console.log(sumArray)
  
  for(var k = 0; k < sumArray.length; k++){
    if(sumArray[k] >= 10){
      sumArray[k] = sumArray[k] - 10;
      //sumArray.push(0)
      sumArray[k + 1] += 1;
      //console.log("要進位"+sumArray)
      
      if(sumArray[sumArray.length-1] >=10 ){
        sumArray.push(0)
      }
      
    }
  
  }
  
  //console.log(aArray)
  //console.log(bArray)
  return (sumArray.reverse().join(""))
  }

module.exports = add;

