int a = 0;
void setup()
{
    colorMode(RGB,255);
    size(600,600);
      a=1;
}
void draw()
{
  colorMode(HSB,255);
  background(0);
  PImage img1 = noise(get(),.02,0,0,1,0);
  image(img1,0,0);

  PImage img2 = get();
  img2 = newNoise(img2,img1,.01); 
  image(img2,0,0);
  a++;
  

}
void mousePressed()
{
   noiseSeed((int)random(100000));
}

PImage newNoise(PImage img, PImage img2, float off)
{
    var pixels = bg.pixels.toArray();
    img.pixels.set(pixels);

  
    float xoff = 0.0;
    
    for (int x = 0; x < width; x++) {
      float yoff = 0.0;
     
      for (int y = 0; y < height; y++) {        

        img.pixels[x+(y*width)] = color(0,0,map(noise(xoff+1000 + ((mouseX*4)/brightness(img2.pixels[x+(y*width)])),yoff+1000),0,1,0,255));
        yoff += (mouseY*.001)/brightness(img2.pixels[x+(y*width)]);
      }
      
      xoff += off; 
    }
    
  
  img.updatePixels();
  return img;
  
  
}

PImage noise(PImage img, float off, int hue, int saturation, int brightness, int alpha) 
{

    var pixels = bg.pixels.toArray();
    img.pixels.set(pixels);
    float xoff = 0.0;
    float xoff2 = 0.0;
    
    for (int x = 0; x < width; x++) {
      float yoff = 0.0;
      float yoff2 = 0.0;
     
      for (int y = 0; y < height; y++) {
        float h, s, b, a;
        if(hue!=0) h = map(noise(xoff,yoff),0,1,0,255);
        else h = v1(img.pixels[x+(y*width)]);
        
        if(saturation!=0) s = map(noise(xoff+1000,yoff+1000),0,1,0,255);
        else s = v2(img.pixels[x+(y*width)]);

        if(brightness!=0) b = map(noise(xoff+2000,yoff+2000),0,1,0,255);
        else b = v3(img.pixels[x+(y*width)]);
        
        if(alpha!=0) a = map(noise(xoff+3000,yoff+3000),0,1,0,255);
        else a = v4(img.pixels[x+(y*width)]);
        

        img.pixels[x+(y*width)] = color(h,s,b,a);
        yoff += off;
      }
      xoff += off;
    }
    
    img.updatePixels();
    return img;
}


int v1(int c)
{
  return (c >> 16) & 0xFF; 
}

int v2(int c)
{
  return (c >> 8) & 0xFF; 
  
}

int v3(int c)
{
  return c & 0xFF; 

}

int v4(int c)
{
  return (c >> 24) & 0xFF;
}