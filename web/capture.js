var fs=require('fs'),
    args=require('system').args,
    page=require('webpage').create();

page.settings.userAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36';

// page.settings.media = screen;

page.content=fs.read(args[1]);

page.viewportSize={width:1024, height:768};
page.clipRect = { top: 0, left: 0, width: 1024, height: 768 };
page.paperSize = {
    format: 'A4',
    orientation: 'portrait',
    margin: '1cm',
    footer: {
        height: '1cm',
        contents: phantom.callback(function (pageNum, numPages) {
            return '<div style="text-align: right; font-size: 12px;">' + pageNum + ' / ' + numPages + '</div>';
        })
    }
};

window.setTimeout(function(){
    page.render(args[1]);
    phantom.exit();
},1000);

