'use strict';

var NOAH = NOAH || {};

// Requirements
NOAH.sass = require('../modules/sass').NOAH;

// // Expanded
// NOAH.sass({
//     src : 'development/scss/default.scss',
//     dest: '../css/default.css'
// });

// NOAH.sass({
//     src : 'scss/foundation.scss',
//     dest: '../css/foundation.min.css',
//     style: 'compressed'
//
// });

// Minified
NOAH.sass({
    src  : 'scss/default.scss',
    dest : '../css/default.min.css',
    style: 'compressed',
});
// Compiles ucr_expanding_card styles. 
NOAH.sass({ 
    src  : '../../../../modules/custom/ucr_core/modules/ucr_expanding_card/scss/expanding-card.scss', 
    dest : '../../../../modules/custom/ucr_core/modules/ucr_expanding_card/css/expanding-card.min.css', 
    style: 'compressed', 
}); 
