try
{
    global.$ = global.jQuery = require('jquery');
    global.Popper = require('@popperjs/core');
    require('bootstrap');
}
catch(err)
{
    throw err;
}