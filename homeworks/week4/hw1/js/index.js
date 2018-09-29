//數字
function getNum(num) {
  document.getElementById("result").value += num;
}

//clear
function clearResult() {
   document.getElementById("result").value = "";
}

//=
function equal() {
    var boxRes = document.getElementById("result").value;
    var lastSym = boxRes.substr(boxRes.length - 1); 
    
    
    if(lastSym == "+" || lastSym == "-" || lastSym == "*" || lastSym == "/"|| lastSym == "."){
        document.getElementById("result").value = "";
    }else{
		document.getElementById("result").value = eval(boxRes);
    }
}

//加減乘除
function cal(calSymbol) {

    var boxRes = document.getElementById("result").value;
    var lastSym = boxRes.substr(boxRes.length - 1); 
    

    if(boxRes == ""){
        document.getElementById("result").value = "";
    }else if(lastSym == "+" || lastSym == "-" || lastSym == "*" || lastSym == "/" || lastSym == "."){
		document.getElementById("result").value;
    }else{		
		document.getElementById("result").value += calSymbol;
    }
}

