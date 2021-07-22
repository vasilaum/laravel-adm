window._ = require('lodash');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.$ = require('jquery');

_baseUrl_ = "http://127.0.0.1:8000";