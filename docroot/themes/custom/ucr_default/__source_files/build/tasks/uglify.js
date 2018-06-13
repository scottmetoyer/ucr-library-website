'use strict';

var NOAH = NOAH || {};

// Requirements
NOAH.uglify = require('../modules/uglify').NOAH;

NOAH.uglify({
    src : 'scripts/default.js',
    dest: '../js/default.min.js'
});

NOAH.uglify({
    src : 'node_modules/foundation-sites/dist/js/foundation.js',
    dest: '../js/foundation.min.js'
});
