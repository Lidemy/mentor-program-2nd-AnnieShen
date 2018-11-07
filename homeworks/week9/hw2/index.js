function Stack(){
    var list = []
    this.push = function(num){
        var i = list.length
        list[i] = num 
    }
    this.pop = function(){
        var i = list.length
        var val = list[i - 1]
        list.splice(i - 1, 1)
        return val;            
    }
    
}

var stack = new Stack()
stack.push(10)
stack.push(5)
console.log(stack.pop()) // 5
console.log(stack.pop()) // 10

function Queue(){
    var list = []
    this.push = function(num){
        var i = list.length
        list[i] = num 
    }
    this.pop = function(){
        var i = list.length
        var val = list[0]
        list.splice(0, 1)
        return val;            
    }
    
}

var queue = new Queue()
queue.push(1)
queue.push(2)
console.log(queue.pop()) // 1
console.log(queue.pop()) // 2