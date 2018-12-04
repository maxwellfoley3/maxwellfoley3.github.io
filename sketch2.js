var a = 30;
var myHeight;
var myWidth;
var canvas;

function setup()
{
  
    colorMode(RGB,255);
    
    canvas = createCanvas(window.innerWidth,window.innerHeight);
    myWidth=300;
    myHeight=300;
  
}
function draw()
{
  
  clear();
  colorMode(HSB,255);
  fill(color(0)); 

  console.log("window.innerWidth " + window.innerWidth);
  console.log("window.innerHeight " + window.innerHeight);

  var img = noiseOne(get(0,0,myWidth,myHeight),.003,1,1,1,1);
  
 img = brazyShit(img,a);
 img.resize(width,height);

  image(img,0,0);

  a++;

}


window.onresize = function() {
    canvas = createCanvas(window.innerWidth,window.innerHeight);

}


function mousePressed()
{
  noiseSeed(random(100000));
  redraw();
}

/*
function justThat(a,arr)
{
    var c = (arr[3] << 24) + (arr[0] << 16) + (arr[1] << 8) + (arr[2]);
    var c2 = map(c,0,a,mouseX,mouseY);

}
*/

function brazyShit(img,  a)
{
   img.loadPixels();

   for(var i = 0; i < img.pixels.length; i+=4) {
    
     var c = (img.pixels[i+3] << 24) + (img.pixels[i] << 16) + (img.pixels[i+1] << 8) + (img.pixels[i+2]);
     var c2 = map(c,0,a,mouseX,mouseY);
     

     img.pixels[i] = v1(c2);
     img.pixels[i+1] = v2(c2);
     img.pixels[i+2] = v3(c2);
     img.pixels[i+3] = v4(c2);
     
   }
  

   img.updatePixels();
   return img; 
}


function noiseOne(img, off, myHue, mySaturation, myBrightness, myAlpha) 
{

    img.loadPixels();
    var xoff = 0.0;
    var xoff2 = 0.0;
    
    
    for (var x = 0; x < myWidth; x++) {
      var yoff = 0.0;
      var yoff2 = 0.0;
     
      for (var y = 0; y < myHeight; y++) {
        var h, s, b, a;
        var location = 4*(x+(y*myWidth));

        img.pixels[location] = map(noise(xoff,yoff),0,1,0,255);    
        img.pixels[location+1] = map(noise(xoff+1000,yoff+1000),0,1,0,255);
        img.pixels[location+2] = map(noise(xoff+2000,yoff+2000),0,1,0,255);        
        img.pixels[location+3] = map(noise(xoff+3000,yoff+3000),0,1,0,255);
        yoff+=off;
      }
      xoff += off;
    }
    
    img.updatePixels();
    return img;
}



function v1(c)
{
  return (c >> 16) & 0xFF; 
}

function v2(c)
{
  return (c >> 8) & 0xFF; 
  
}

function v3(c)
{
  return c & 0xFF; 

}

function v4(c)
{
  return (c >> 24) & 0xFF;
}