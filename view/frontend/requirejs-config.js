var config = {
    paths: {
        'slick': "Magepow_Autorelated/js/slick"
    },
    map: {
       '*': {
           magepowRelated: 'Magepow_Autorelated/js/magepowRelated'
       }
   },
   shim: {
        slick: {
            deps: ['jquery']
        }
   },
};