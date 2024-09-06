$(document).ready(function(){
    const url = window.location;

    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).parent().addClass('active');

    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".sidebar-menu > .nav-treeview").addClass('menu-open');

    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).addClass('active');

    $('li.has-treeview a').filter(function() {
        return this.href == url;
    }).addClass('active');

    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".sidebar-menu > .nav-treeview").children(0).addClass('active');

    $('li.nav-item a').filter(function() {
        return this.href == url;
    }).parentsUntil(".sidebar-menu > .nav-item").children(0).addClass('active');

});