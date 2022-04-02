import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';

window._ = require('lodash');

window.$ = window.jQuery = require("jquery");

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.moment = require('moment');

document.querySelectorAll('[data-tippy-toggle="tippy"]').forEach((tippyEl)=>{
    let title = tippyEl.getAttribute('data-tippy-title');
    tippy(tippyEl, {
        content: title,
    });
});
