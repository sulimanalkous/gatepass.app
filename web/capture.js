var fs=require('fs'),
    args=require('system').args,
    page=require('webpage').create();

// page.settings.userAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36';
page.settings.userAgent = "Mozilla/5.0 (Windows NT 6.0) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/13.0.782.41 Safari/535.1";

// page.settings.media = screen;
// page.set('settings.localToRemoteUrlAccessEnable', true);
// page.set('settings.loadImages', true);

page.content=fs.read(args[1]);
// the size of the screenshot
// page.viewportSize = { width: 2880, height: 1800 };

page.viewportSize = { width: 1238, height: 1763 };
page.paperSize = {width:'1238px', height:'1763px'};
page.settings.dpi = 150;

//the clipRect is the portion of the page you are taking a screenshot of
// page.clipRect = { top: 0, left: 0, width: 1024, height: 768 };

// page.viewportSize = { width: 1024, height: 1024 };
// page.viewportSize={width:1024, height:768};
// page.clipRect = { top: 0, left: 0, width: 1024, height: 768 };
page.paperSize = {
    format: 'A4',
    orientation: 'portrait',
    margin: '1cm',
    footer: {
        height: '2cm',
        contents: phantom.callback(function (pageNum, numPages) {
            return '<div class="col-md-4"><h4>رئيس قسم الأمن و السلامه</h4></div>' +
                '<div style="text-align: right; font-size: 12px;">' + pageNum + ' / ' + numPages + '</div>';
        })
    }
};
page.onError = function (msg, trace) {
    console.log(msg);
    trace.forEach(function(item) {
        console.log('  ', item.file, ':', item.line);
    })
}

window.setTimeout(function(){
    page.render(args[1]);
    phantom.exit();
},1000);

