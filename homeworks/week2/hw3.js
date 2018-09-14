function isPrime(n) {
    for(i = 2; i <= n-1; i++){
      if(n % i == 0){
        return false
      }
  　}
     return true
  }

module.exports = isPrime