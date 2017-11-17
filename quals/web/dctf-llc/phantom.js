var page   = require('webpage').create(),
  address;

address = 'http://127.0.0.1/bot.php';

var doTasks = function() {
  console.log('crawling');
  page.open(address, function(status) {
    if (status !== 'success') {
      console.log('FAIL to load the address');
    } else {
      objs = page.evaluate(function() {
        var ret = [];
        $('a').each(function() {
          ret.push($(this).attr('href'));
        });
        return ret;
      });
      for(var i in objs) {
        openLink(objs[i]);
      }
    }

    console.log('sleep');
    //page.close();
    setTimeout(doTasks, 10000);
  });
}

var openLink = function(url) {
  var vpage = require('webpage').create();
  console.log('opening', url);
  vpage.open(url, function(status) {
    if(status !== 'success') {
      console.log(status);
    } else {
      console.log('opened', url);
     
      setTimeout(function() {
        vpage.close();
      }, 180000);
    }
  });
}

doTasks();
