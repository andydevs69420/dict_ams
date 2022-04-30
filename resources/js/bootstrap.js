try
{
    global.$ = global.jQuery = require('jquery');
    global.Popper = require('@popperjs/core');
    global.bootstrap = require('bootstrap');
}
catch(err)
{
    throw err;
}