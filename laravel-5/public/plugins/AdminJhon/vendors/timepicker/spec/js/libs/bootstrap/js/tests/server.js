/*
 * Simple connect server for phantom.js
 * Adapted from Modernizr
 */

var connect = require('connect')
  , http = require('http')
  , fs   = require('fs')
  , app = connect()
      .use(connect.static(__dirname + '/../../'));

http.createServer(app).listen(3000);

<<<<<<< HEAD
fs.writeFileSync(__dirname + '/pid.txt', process.pid, 'utf-8')
=======
fs.writeFileSync(__dirname + '/pid.txt', process.pid, 'utf-8')
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
