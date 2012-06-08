(function ($) {

  var layers      = [],
      docWidth    = $(window).width(),
      docHeight   = $(window).height(),
      urlString   = '  |                                                  ',
      plaxObjects = {
        'layerA': {
          'start':3,
          'range':50,
          'item': {'pos':3,'str':'ˁ˚ᴥ˚ˀ'}
        },
        'layerB':{
          'start':10,
          'range':20,
          'item': {'pos':10,'str':'Ƹ̵̡Ӝ̵̨̄Ʒ'}
        },
        'layerC':{
          'start':5,
          'range':10,
          'item': {'pos':5,'str':'~'}
        }
      }

  function compileUrl(str) {
    var urlArray = str.split(''),
        a        = plaxObjects.layerA,
        b        = plaxObjects.layerB,
        c        = plaxObjects.layerC

    urlArray.splice(c.item.pos,   1,c.item.str)
    urlArray.splice(c.item.pos+1, 1,c.item.str)
    urlArray.splice(c.item.pos+2, 1,c.item.str)
    urlArray.splice(c.item.pos+15, 1,c.item.str)
    urlArray.splice(c.item.pos+16, 1,c.item.str)
    urlArray.splice(c.item.pos+17,   1,c.item.str)
    urlArray.splice(c.item.pos+30, 1,c.item.str)
    urlArray.splice(c.item.pos+31, 1,c.item.str)
    urlArray.splice(c.item.pos+32,   1,c.item.str)


    urlArray.splice(b.item.pos,   1,b.item.str)
    urlArray.splice(b.item.pos+1, 1,b.item.str)
    urlArray.splice(b.item.pos+7, 1,b.item.str)
    urlArray.splice(b.item.pos+15, 1,b.item.str)
    urlArray.splice(b.item.pos+16, 1,b.item.str)

    urlArray.splice(a.item.pos,1,a.item.str)

    return urlArray.join('')
  }

  function setUrl(str) {
    location.hash = compileUrl(str)
  }

  $(window).resize(function() {
      docWidth  = $(window).width()
      docHeight = $(window).height()
  })

  // Public Methods
  $.fn.plaxify = function (params){

    return this.each(function () {

      var layer = {"xRange":0,"yRange":0,"invert":false}
      for (var param in params) {
        if (layer[param] == 0) {
          layer[param] = params[param]
        }
      }

      // Add an object to the list of things to parallax
      layer.obj    = $(this)
      layer.startX = this.offsetLeft
      layer.startY = this.offsetTop

      if(layer.invert == false){
        layer.startX -= Math.floor(layer.xRange/2)
        layer.startY -= Math.floor(layer.yRange/2)
      } else {
        layer.startX += Math.floor(layer.xRange/2)
        layer.startY += Math.floor(layer.yRange/2)
      }
      layers.push(layer)
    })
  }

  function plaxifier(e) {
    var x      = e.pageX,
        y      = e.pageY,
        hRatio = Math.round((x/docWidth)*100)/100,
        vRatio = Math.round((y/docHeight)*100)/100,
        a      = plaxObjects.layerA,
        b      = plaxObjects.layerB,
        c      = plaxObjects.layerC,
        layer, i

    a.item.pos = Math.round(a.range*hRatio)+a.start
    b.item.pos = Math.round(b.range*hRatio)+b.start
    c.item.pos = Math.round(c.range*hRatio)+c.start

    console.log(b.item.pos)

    setUrl(urlString)
  }

  $.plax = {
    enable: function(){
      setUrl(urlString)

      $(document).bind('mousemove.plax', function (e) {
        plaxifier(e)
      })
    },
    disable: function(){
      $(document).unbind('mousemove.plax')
    }
  }

})( jQuery )