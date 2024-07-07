const mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js');
//styles
mix.styles([
    'resources/assets/vendors/bootstrap/dist/css/bootstrap.min.css',
    'resources/assets/vendors/jqueryUi/jquery-ui.min.css',
    'resources/assets/vendors/font-awesome/css/font-awesome.min.css',
    'resources/assets/vendors/nprogress/nprogress.css',
    'resources/assets/vendors/iCheck/skins/flat/_all.css',
    'resources/assets/vendors/iCheck/skins/flat/green.css',
    'resources/assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
    'resources/assets/vendors/jqvmap/dist/jqvmap.min.css',
    'resources/assets/vendors/select2/select2.min.css',
    'resources/assets/vendors/multipleImage/dist/image-uploader.min.css',
    'resources/assets/vendors/switchery/dist/switchery.min.css',
    //'resources/assets/vendors/starrr/dist/starrr.css',
    //'resources/assets/vendors/bootstrap-daterangepicker/daterangepicker.css',
    'resources/assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css',
    'resources/assets/vendors/pnotify/dist/pnotify.css',
    'resources/assets/vendors/pnotify/dist/pnotify.buttons.css',
    'resources/assets/vendors/pnotify/dist/pnotify.nonblock.css',
    'resources/assets/summerNote/summernote-bs4.css',

], 'public/css/vendor.css');

//styles custom css
mix.styles([
    'resources/assets/build/css/custom.css',
    'resources/assets/css/mineCss.css',
], 'public/css/custom.css');

//calendar css
mix.styles([
    'resources/assets/vendors/fullcalendar/dist/fullcalendar.css',
    'resources/assets/vendors/fullcalendar/dist/fullcalendar.print.css',
], 'public/css/calendar.css');

//Datatable css
mix.styles([
    'resources/assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
    'resources/assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',
    'resources/assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css',
    'resources/assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css',
    'resources/assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css',

], 'public/css/datatable.css');


//Copy icheck assets
mix.copy('resources/assets/vendors/iCheck/skins/flat/green.png', 'public/css/green.png')
    .copy('resources/assets/vendors/iCheck/skins/flat/green@2x.png', 'public/css/green@2x.png')
    .copy('resources/assets/vendors/iCheck/skins/flat/blue.png', 'public/css/blue.png')
    .copy('resources/assets/vendors/iCheck/skins/flat/blue@2x.png', 'public/css/blue@2x.png')
    .copy('resources/assets/vendors/iCheck/skins/flat/flat.png', 'public/css/flat.png')
    .copy('resources/assets/vendors/iCheck/skins/flat/flat@2x.png', 'public/css/flat@2x.png')
    .copy('resources/assets/vendors/iCheck/skins/flat/pink.png', 'public/css/pink.png')
    .copy('resources/assets/vendors/iCheck/skins/flat/pink@2x.png', 'public/css/pink@2x.png');

//Scripts
mix.scripts([
    'resources/assets/vendors/jquery/dist/jquery.min.js',
    'resources/assets/vendors/jqueryUi/jquery-ui.min.js',
    'resources/assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js',
    'resources/assets/vendors/fastclick/lib/fastclick.js',
    'resources/assets/vendors/nprogress/nprogress.js',
    'resources/assets/vendors/Chart.js/dist/Chart.min.js',
    'resources/assets/vendors/gauge.js/dist/gauge.min.js',
    'resources/assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js',
    'resources/assets/vendors/iCheck/icheck.min.js',
    'resources/assets/vendors/skycons/skycons.js',
    //'resources/assets/vendors/Flot/jquery.flot.js',
    //'resources/assets/vendors/Flot/jquery.flot.pie.js',
   // 'resources/assets/vendors/Flot/jquery.flot.time.js',
    //'resources/assets/vendors/Flot/jquery.flot.stack.js',
    //'resources/assets/vendors/Flot/jquery.flot.resize.js',
    //'resources/assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js',
    //'resources/assets/vendors/flot-spline/js/jquery.flot.spline.min.js',
    //'resources/assets/vendors/flot.curvedlines/curvedLines.js',
    //'resources/assets/vendors/DateJS/build/date.js',
    //'resources/assets/vendors/jqvmap/dist/jquery.vmap.js',
    //'resources/assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js',
    //'resources/assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js',
    'resources/assets/vendors/moment/min/moment.min.js',
    //'resources/assets/vendors/bootstrap-daterangepicker/daterangepicker.js',
    'resources/assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
    'resources/assets/vendors/jszip/dist/jszip.min.js',
    'resources/assets/vendors/pdfmake/build/pdfmake.min.js',
    'resources/assets/vendors/pdfmake/build/vfs_fonts.js',
    'resources/assets/vendors/multipleImage/dist/image-uploader.min.js',
    'resources/assets/vendors/switchery/dist/switchery.min.js',
    'resources/assets/vendors/select2/select2.min.js',
    'resources/assets/vendors/pnotify/dist/pnotify.js',
    'resources/assets/vendors/pnotify/dist/pnotify.buttons.js',
    'resources/assets/vendors/pnotify/dist/pnotify.nonblock.js',
    'resources/assets/vendors/parsleyjs/dist/parsley.min.js',
    'resources/assets/vendors/autosize/dist/autosize.min.js',
    //'resources/assets/vendors/starrr/dist/starrr.js',
    'resources/assets/summerNote/summernote-bs4.js',

], 'public/js/vendor.js');


//Echart Scripts:
mix.scripts([
    'resources/assets/vendors/echartsUpdate/dist/echarts.min.js',
], 'public/js/echarts.js');

//Calendar Scripts:
mix.scripts([
    'resources/assets/vendors/fullcalendar/dist/fullcalendar.min.js',
], 'public/js/calendar.js');


// custom Scripts
mix.scripts([
    'resources/assets/build/js/custom.js',
], 'public/js/custom.js');

// datatable Scripts
mix.scripts([
    'resources/assets/vendors/datatables.net/js/jquery.dataTables.min.js',
    'resources/assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
    'resources/assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js',
    'resources/assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',
    'resources/assets/vendors/datatables.net-buttons/js/buttons.flash.min.js',
    'resources/assets/vendors/datatables.net-buttons/js/buttons.html5.min.js',
    'resources/assets/vendors/datatables.net-buttons/js/buttons.print.min.js',
    'resources/assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js',
    'resources/assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js',
    'resources/assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js',
    'resources/assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js',
    'resources/assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js',

], 'public/js/datatable.js');


/*//summerNote css
mix.styles([
    'resources/assets/summerNote/summernote-bs4.css',
], 'public/css/summerNote.css');


//summerNote js
mix.scripts([
    'resources/assets/summerNote/summernote-bs4.js',
], 'public/js/summerNote.js');*/



