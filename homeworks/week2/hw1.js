function stars(n) {
    var star = ''
    var result = []
    for (var i = 0; i < n; i++) {
        star += '*'
        result.push(star)
    }
    return result
}

module.exports = stars;