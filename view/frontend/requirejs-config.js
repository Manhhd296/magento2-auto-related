var config = {
    paths: {
        'slick': "Magepow_Autorelated/js/slick.min"
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