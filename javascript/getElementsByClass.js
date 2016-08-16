document.getElementsByClassName = function(name) {
    var all = document.getElementsByTagName("*"),
        matches = [];

    for (var i=0, e=all.length; i < e; i++) {
        var el = all[i],
            classes = el.getAttribute('class');
        if ( typeof classes == 'string' && classes.indexOf(name) >= 0 ) {
            matches.push(all[i]);
        }
    }

    return matches;
};
