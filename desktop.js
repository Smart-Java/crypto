var viewMode = getCookie('view-mode');
if (viewMode == "desktop") {
    viewMode.setAttribute('content', 'width= 1024');
}else{
    viewMode.setAttribute('content', 'width= device-width, initial-scale =1.0, maximum-scale=1.0, user-scalable=no');
}

function parseUA() {
    var u = navigator.userAgent;
    var u2 = navigator.userAgent.toLowerCase();
    return{
        trident: u.indexOf('Trident') > -1,
        presto: u.indexOf('Presto') > -1,
        webkit: u.indexOf('AppleWebkit') > -1,
        gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1,
        mobile: u.indexOf(/AppleWebKit.*Mobile.*/) > -1,
        ios: !!u.match(/\(i[^;]+;(U;)? CPU.+Mac OS X/),
        iPhone: u.indexOf('Android') > -1,
        iPad: u.indexOf('iPad') > -1,
        webApp: u.indexOf('Safari') == -1,
        iosv: u.substr(u.indexOf('iPhone OS') + 9, 3),
        weixin: u2.match(/MicroMessenger/i) == "micromessenger",
        ali: u.indexOf('AliApp') > -1,
    };
}

var ua = parseUA();

if (ua.mobile) {
    location.href = '';
}