var base_request_url = 'http://pmdkj-bbs.test/api/';

// 接收 url参数
function fnGetUrlQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) {
        return JSON.parse(unescape(r[2]));
    }
    return null;
}
