window.bootstrap = require('bootstrap')
import $ from "jquery";
require('select2')

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

document.querySelectorAll("textarea").forEach(function (textarea){
    CKEDITOR.replace( textarea );
})


$(".select2").select2();
