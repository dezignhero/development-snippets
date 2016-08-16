function add() {
    if (arguments.length > 1) {
        return arguments[0] + add.apply(this, Array.prototype.splice.call(arguments, 1));
    }
    return arguments[0];
}