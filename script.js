function newsLoader(p) {
    var o = this;
    this.root = $(p.root);
    this.newsBlock = $(p.newsBlock, this.root);
    this.newsLoader = $(p.newsLoader);
    this.ajaxLoader = $(p.ajaxLoader);
    this.parentLoader = $(p.parentLoader);
    this.cntMore = $(p.cntMore);

    this.curPage = 1;
    this.loadSett = (p.loadSett);

    // загружаем дополнительные новости
    this.loadMoreNews = function () {
        var loadUrl = location.href;
        if (location.search != '') {
            loadUrl += '&';
        }
        else {
            loadUrl += '?';
        }
        loadUrl += 'PAGEN_' + o.loadSett.navNum + '=' + (++o.curPage);

        o.ajaxLoader.show();

        $.ajax({
            url: loadUrl,
            type: "POST",
            data: {
                AJAX: 'Y'
            }
        })
            .done(function (html) {
                o.newsBlock.append(html);
                o.ajaxLoader.hide();
                if (o.curPage == o.loadSett.endPage) {
                    o.parentLoader.hide();
                }
                /*проверяем цифру показать еще - если состалось меньше чем "показать на странице" - меняем*/
                if (o.loadSett.totalNum - o.curPage * o.loadSett.onPage < o.loadSett.onPage) {
                    o.cntMore.text(o.loadSett.totalNum - o.curPage * o.loadSett.onPage);
                }
            });
    }

    this.init = function () {
        o.newsLoader.click(function (event) {
            o.loadMoreNews();
            event.preventDefault();
        })
    }

}