function alphaSwap(str) {
    var char =''
    var result =[]
    for(var i = 0; i < str.length; i++){
      if(str[i] >= 'a' && str[i] <= 'z'){   
        char = str[i].toUpperCase()
        result.push(char)
      }else {
        char = str[i].toLowerCase()
        result.push(char)
      }
    }  
    return result.join("")
}

module.exports = alphaSwap