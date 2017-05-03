    //Instafeed.js - add Instagram photos to your website
    //Ref: http://instafeedjs.com/#user
    
    var userFeed = new Instafeed({
        limit: 12,
        get: 'user',
        userId: 1065049433, /* Find out your userID: http://www.pinceladasdaweb.com.br/instagram/user-id/ */
        accessToken: '510573486.ab7d4b6.d8b155be5d1a47c78f72616b4d942e8d', /* You need to generate your own token: http://www.pinceladasdaweb.com.br/instagram/access-token/ */
        template: '<a class="item" href="{{link}}"><img class="img-responsive" src="{{image}}" /></a>'
    });
    userFeed.run();