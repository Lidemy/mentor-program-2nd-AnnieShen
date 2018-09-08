function printFactor(a){
    var n = "";
    var a;
    
	for( let i = 1; i <= a; ++i ){
		if( a % i == 0 ){
			n += i + "\n";
		}
	}
	return n;
    console.log(a);
}


