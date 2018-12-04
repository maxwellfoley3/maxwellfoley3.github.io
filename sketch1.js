var a = 0;
var img;
var myHeight;
var myWidth;
var canvas;

function setup() {
    colorMode(RGB,255);
    canvas = createCanvas(window.innerWidth,window.innerHeight);
    a=1;
    frameRate(10);
    myWidth=250;
    myHeight=250;


}

function mousePressed()
{
   noiseSeed(random(100000));
}


function draw() {
  clear();
  colorMode(HSB,255);

  var img1 = noiseOne(get(0,0,myWidth,myHeight),.02,0,0,1,0);

  fill(color(255)); 
  rect(0,0,width,height);


  var img2 = newNoise(get(0,0,myWidth,myHeight),img1,.01);
  
  fill(color(0)); 
  rect(0,0,width,height);

  img2.resize(width,height);
  image(img2,0,0);
  a++;

}

function onMouseClick()
{
  redraw();
}

function noiseOne(img,off,hue,saturation,brightness, alpha)
{
    img.loadPixels();

    for (var x = 0; x < myWidth; x++) {
      var yoff = 0.0;

      for (var y = 0; y < myHeight; y++) {
        var h, s, b, a;
        
        var location = 4*(x+(y*myWidth));
        var value =  map(noise(x*off,yoff),0,1,0,255);
 

        img.pixels[location+3] = value;
        //img.pixels[location+1] = value;
        //img.pixels[location+2] = value;
        //img.pixels[location+3] = 255;
        
        yoff += off;
      }
    }
    
    img.updatePixels();
    return img;
  
  
}

function newNoise(img,img2, off)
{
  img.loadPixels();
  
    var xoff = 0.0;
    
    for (var x = 0; x < myWidth; x++) {
      var yoff = 0.0;

      for (var y = 0; y < myHeight; y++) {        

          var location = 4*(x+(y*myWidth));
          var value = map(noise(xoff+1000 + ((mouseX*4)/(img2.pixels[location+3])& 0xFF),yoff+1000),0,1,0,255);
          
          

          img.pixels[location+3] = value;
        
          yoff += (mouseY*.001)/(img2.pixels[location+3] & 0xFF);
      }
      
      xoff += off; 
    }
    
  
  img.updatePixels();
  return img;

}

window.onresize = function() {
      canvas = createCanvas(window.innerWidth,window.innerHeight);

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