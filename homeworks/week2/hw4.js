function isPalindromes(str){
    var newstr = ""; 
    for (var i = str.length - 1; i >= 0; i--) {
      newstr += str[i]
    };
    
    return (newstr === str);
    
  }
  

module.exports = isPalindromes