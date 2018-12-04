
var maxLevel = 3;
var u;
var noConstraints;
var mySq  = new SubdivisionQueue();
var ss = new ShapeSubdivider();
var pg;
var seedPlus;
var seed;

function setup()
{

  seedPlus = random(100);
  seed = random(100000);

  canvas = createCanvas(window.innerWidth,window.innerHeight);
  var width = canvas.width;

  colorMode(HSB,255);
  noConstraints = new Constraints(0,255,0,255,0,255);

  mySq = new SubdivisionQueue();
  u = new Unit(new Rectangle(0,0,width/2,height/2),0, ss, noConstraints);

  pg = createGraphics(width,height);

}

function draw()
{

  clear();

  for(var i=0; i < 10; i++) mySq.run();


 pg.noStroke();
 // pg.beginDraw();
 if(u!=null) u.display(pg);
  //pg.endDraw();
  image(pg,0,0);

}

function mousePressed()
{
    seed+=seedPlus;
    randomSeed(seed);

    mySq.clear();

    u = new Unit(new Rectangle(0,0,width/2,height/2),0, ss, noConstraints);

}

window.onresize = function() {
    canvas = createCanvas(window.innerWidth,window.innerHeight);
      pg = createGraphics(width,height);
    u = new Unit(new Rectangle(0,0,width/2,height/2),0, ss, noConstraints);

}



























//each Unit will have a range of colors which its children are allowed to be.
function Constraints(h1,h2,s1,s2,b1,b2)
{
  this.hMin = h1;
  this.hMax = h2;
  this.sMin = s1;
  this.sMax = s2;
  this.bMin = b1;
  this.bMax = b2;

  //console.log("constraints is getting made");

  this.subdivide2 = function(divisions,n)
  {
      return subdivide("linear",true, true, true, divisions, n);
  }

  this.subdivide3 = function (axes,divisions,n)
  {
        return subdivide("linear", axes,  divisions,  n);
  }

  this.subdivide4 = function(grad,axes,divisions,n)
  {
    return this.subdivide6(grad,axes%2==0, axes%4 < 2, axes%8 <4, divisions, n);
  }

  this.subdivide5 = function(h,s,b,divisions,n)
  {
        return this.subdivide6("linear",h,s,b, divisions, n);

  }

  this.subdivide6 = function(grad, h, s, b, divisions, n)
  {


        var newhMin = this.hMin, newhMax=this.hMax, newsMin=this.sMin, newsMax=this.sMax, newbMin=this.bMin, newbMax=this.bMax;
        var n2 = n+1;
        if(grad == "radial")
        {
          n2++;
          if(n>div(divisions,2))
          {
            n = 2*(divisions-1-n);
            n2= n - 2;
          }
          else n = n*2;
        }
        if(grad == "random")
        {
           n = random(divisions);
        }

          if(h)
          {
               newhMin = Math.floor(this.hMin+ (((this.hMax-this.hMin)/divisions)*n));
               newhMax = Math.floor(this.hMin + (((this.hMax-this.hMin)/divisions)*(n2)));
          }

          if(s)
          {
              newsMin = Math.floor(this.sMin+ (((this.sMax-this.sMin)/divisions)*n));
              newsMax = Math.floor(this.sMin + (((this.sMax-this.sMin)/divisions)*(n2)));
          }

          if(b)
          {

              newbMin = Math.floor(this.bMin + (((this.bMax-this.bMin)/divisions)*n));
              newbMax = Math.floor(this.bMin + (((this.bMax-this.bMin)/divisions)*(n2)));
          }

          //console.log("divisions " + divisions + " grad " + grad + " h " + h + " s " + s + " b " + b);
          //console.log("new constraints " + newhMin + " " + newhMax + " " + newsMin + " " + newsMax + " " + newbMin + " " + newbMax )
          return new Constraints(newhMin, newhMax, newsMin, newsMax, newbMin, newbMax);
  }

  this.average = function()
  {
    return color((this.hMax+this.hMin)/2, (this.sMax+this.sMin)/2, (this.bMax+this.bMin)/2);

  }

}






















function SubdivisionQueue()
{
   this.Q = new Array();

   //SubdivisionQueue() { Q = new ArrayList<Unit>(); }

   this.run = function()
   {
     //console.log(this.Q.length);

      if(this.Q.length > 0) this.Q.pop(0).subdivide();
   }

   this.add = function(gu)
   {
      this.Q.push(gu);
   }

   this.clear = function()
   {
     this.Q = new Array();
   }

   /*
   this.size = function()
   {
     console.log("dulpy shulpy");
     return this.Q.size;
   }
    */
}


















function Unit(shap, l, ss_, c)
{
  //console.log("beginning of unit constructor");

  this.s = shap;
  this.shapeSubdivider = ss_;
  this.level = l;
  this.cst = c;
  this.main = this.cst.average();
  this.children = new Array();


  mySq.add(this);

  /*
  Unit(Shape shap, int l, ShapeSubdivider ss_, Constraints c)
  {
     s = shap;
     shapeSubdivider = ss_;
     level = l;
     cst = c;
     main = cst.average();
     children = new ArrayList<Unit>();

     //s.display();
     //sq.add(this);

  }*/
  /*
  Unit(Unit u)
  {
     s = u.s;
     shapeSubdivider = u.shapeSubdivider;
     level = u.level + 1;
     cst = u.cst;
     children = new ArrayList<Unit>();

     //display();
     sq.add(this);

  }*/

  this.display = function(pg)
  {
        //pg.beginDraw();
        pg.fill(this.main);

        this.s.display(pg);
       // pg.endDraw();

      if(this.level<maxLevel)
      {
        for(var i = 0; i < this.children.length; i++)
        {
            this.children[i].display(pg);
        }
      }

  }

  this.subdivide = function()
  {
      if(this.level >= maxLevel) return;

      var newChildren = this.shapeSubdivider.subdivide(this.s);
      var subdivision = Math.floor(random(8));


      for(var i = 0; i < newChildren.length; i++)
      {
        var newConstraints = this.cst.subdivide4("linear",subdivision,newChildren.length,i);
        //console.log("hue " + hue(newConstraints.average()) + " saturation " + saturation(newConstraints.average()) + " brightness " + brightness(newConstraints.average()));
         this.children.push(new Unit(newChildren[i], this.level+1, this.shapeSubdivider, newConstraints ));
      }

  }
}







function Rectangle(x1,y1,w,h)
{
   this.x = x1;
   this.y = y1;
   this.width = w;
   this.height = h;


   this.display = function(pg)
   {
      pg.rect(this.x,this.y,this.width,this.height);
   }

}

function Circle(x1,y1,r1)
{
   this.x = x1;
   this.y = y1;
   this.d = r1;

     this.display = function(pg)
     {
       //pg.beginDraw();
       pg.ellipse(this.x,this.y,this.d,this.d);
      // pg.endDraw();
     }
}

function Triangle(Ax, Ay, Bx, By, Cx, Cy) {
   this.ax = Ax;
   this.ay = Ay;
   this.bx = Bx;
   this.by = By;
   this.cx = Cx;
   this.cy = Cy;


  this.centroid = function()
  {
     return new Point(div(this.ax+this.bx+this.cx,3),div(this.ay+this.by+this.cy,3));
  }

  this.display = function( pg)
  {
     pg.triangle(this.ax, this.ay, this.bx, this.by, this.cx, this.cy);
  }

}



function Star(x1, y1, r1, n1) {
  this.x = x1;
  this.y = y1;
  this.r = r1;
  this.n = n1;

  this.display = function( pg)
  {
      var angle = TWO_PI / n;
      pg.beginShape();
      for (var a = 0; a < 2*TWO_PI; a += 2*angle)
      {
        var sx = x + cos(a) * r;
        var sy = y + sin(a) * r;
        pg.vertex(sx, sy);
      }
      pg.endShape(CLOSE);


  }

}

function RegPoly(x1,y1,r1,n1) {
  this.x = x1;
  this.y = y1;
  this.r = r1;
  this.n = n1;

  this.getPoint = function( pn)
  {
      var a = pn * (TWO_PI/n);
      var sx = x + cos(a) * r;
      var sy = y + sin(a) * r;
      return new Point(sx, sy);
  }
  this.display = function( pg)
  {
      var angle = TWO_PI / n;
      pg.beginShape();
      for (var a = 0; a < TWO_PI; a += angle)
      {
        var sx = x + cos(a) * r;
        var sy = y + sin(a) * r;
        pg.vertex(sx, sy);
      }
      pg.endShape(CLOSE);
  }
}

function Point(x1,y1)
{
  this.x = x1;
  this.y = y1;
}








function ShapeSubdivider()
{

  this.subdivide = function(s)
  {
      //console.log("subdivide");

      if(s instanceof Rectangle)
      {
          //console.log("it's an instance of rectangle");

          var r = s;


          //randomly pick a number
          var stripes = Math.floor(random(5) + 2);
          //randomly decide between horizontal and vertical stripes
          var direction =  Math.floor(random(8));
          //console.log(direction);

          switch(direction)
          {
            case 0: return this.HorizontalStripes(r, stripes);
            case 1: return this.VerticalStripes(r, stripes);
            case 2: return this.RectangleGrid(r, stripes);
            case 3: return this.ConcentricRectangles(r, stripes);
            case 4: return this.RectangleToCircle(r);
            case 5: return this.PBJForward(r);
            case 6: return this.PBJBackward(r);
            case 7: return this.Confederacy(r);

            default: return [];
          }

      }

      if(s instanceof Triangle)
      {
          var t = s;
          var direction = Math.floor(random(3));
          switch(direction)
          {
             case 0: return this.bisectTriangle(t);
             case 1: return this.trisectTriangle(t);
             case 2: return this.sierpinski(t);
             default: return [];
          }
      }

      if(s instanceof RegPoly)
      {
          var rp = s;

           var direction = Math.floor(random(2));
           switch(direction)
           {
              case 0: return this.regPolyToTriangles(rp);
              case 1: return this.regPolyToStar(rp);
              default: return [];
           }

      }

      else return new Array();


  }
          this.HorizontalStripes = function(r,  stripes) //horizontal
          {

             var shapes = new Array(stripes);
             for(var i = 0; i < stripes; i++)
             {

                 var newHeight;
                 if(i == stripes-1)
                 {
                    newHeight = (r.y + r.height) - (r.y+div(r.height,stripes)*i);
                 }

                 else
                 {
                     newHeight = r.height / stripes;

                 }
                 shapes[i] = new Rectangle(r.x, r.y+div(r.height,stripes)*i, r.width, newHeight);

             }
             return shapes;

          }

          this.VerticalStripes = function( r,  stripes)
          {
             var shapes = new Array(stripes);
             for(var i = 0; i < stripes; i++)
             {
                 var newWidth;
                 if(i == stripes-1)
                 {
                    newWidth = (r.x + r.width) - (r.x+div(r.width,stripes)*i);
                 }

                 else
                 {
                     newWidth = div(r.width,stripes);

                 }
                 shapes[i] = new Rectangle(    r.x+div(r.width,stripes)*i, r.y, newWidth, r.height);

             }
            return shapes;
          }

          this.RectangleGrid = function( r, stripes)
          {
              var shapes = new Array(stripes);
              for(var i = 0; i < stripes; i++)
              {
                 var newWidth;
                 if(i == stripes-1)
                 {
                    newWidth = (r.x + r.width) - (r.x + div(r.width,stripes)*i);
                 }

                 else
                 {
                     newWidth = div(r.width,stripes);

                 }
                for(var j=0; j < stripes; j++)
                {

                 var newHeight;
                 if(j == stripes-1)
                 {
                    newHeight = (r.y + r.height) - (r.y + div(r.height,stripes)*j);
                 }

                 else
                 {
                     newHeight = div(r.height,stripes);

                 }

                   shapes[i*stripes + j] = new Rectangle(r.x+div(r.width,stripes)*i, r.y+div(r.height,stripes)*j, newWidth, newHeight);

                }


              }

              return shapes;

          }



          this.ConcentricRectangles = function( r,  stripes)
          {
             var shapes = new Array(stripes);
             for(var i = 0; i < stripes; i++)
             {
                shapes[i] = new Rectangle(r.x+(div(r.width,10)*i), r.y+(div(r.height,10))*i, r.width-(2*i*div(r.width,10)), r.height - (2*i*div(r.height,10)));

             }

             return shapes;

          }


          this.RectangleToCircle = function( r)
          {
              //console.log("rectangle to circle");

              if(r.height == 0 || r.width == 0) return new Array();
              if(r.width > r.height)
              {
                  var diameter = r.height;
                  var inner = div(r.width%diameter,2);
                  var stripes2 = div(r.width,diameter);
                  var shapes = new Array();
                  shapes[0] = new Rectangle(r.x, r.y, r.width, r.height);
                  for(var i = 1; i <= stripes2; i++)
                  {
                    shapes[i] = new Circle(r.x + inner+(diameter*i)-div(diameter,2), r.y + div(r.height,2), diameter);

                  }
                  return shapes;
              }
              else
              {
                var diameter = r.width;
                var inner = div(r.height%diameter,2);
                var stripes2 = div(r.height,diameter);
                var shapes = new Array(Math.floor(stripes2)+1);
                shapes[0] = new Rectangle(r.x, r.y, r.width, r.height);

                for(var i = 1; i <= stripes2; i++)
                {
                    shapes[i] = new Circle(r.x+div(diameter,2), r.y + inner + (diameter*i) -div(diameter,2),diameter);
                }
                              return shapes;

              }


          }



      this.PBJBackward = function( r)
      {
          var shapes = new Array(2);
          shapes[0] = new Triangle(r.x, r.y, r.x + r.width, r.y + r.height, r.x + r.width, r.y);
          shapes[1] = new Triangle(r.x, r.y, r.x + r.width, r.y + r.height, r.x, r.y + r.height);
          return shapes;
      }
      this.PBJForward = function( r)
      {
         var shapes = new Array(2);
         shapes[0] = new Triangle(r.x+r.width,r.y+r.height,r.x+r.width,r.y,r.x,r.y+r.height);
         shapes[1] = new Triangle(r.x,r.y,                 r.x+r.width,r.y,r.x,r.y+r.height);
         return shapes;

      }

      this.Confederacy = function( r)
      {
            var shapes = new Array(4);
            shapes[0] = new Triangle(r.x,r.y,r.x,r.y+r.height,r.x + div(r.width,2),r.y+div(r.height,2));
            shapes[1] = new Triangle(r.x,r.y,r.x+r.width,r.y,r.x + div(r.width,2),r.y+div(r.height,2));
            shapes[2] = new Triangle(r.x+r.width,r.y,r.x+r.width,r.y+r.height,r.x + div(r.width,2),r.y+div(r.height,2));
            shapes[3] = new Triangle(r.x,r.y+r.height,r.x+r.width,r.y+r.height,r.x + div(r.width,2),r.y+div(r.height,2));
            return shapes;
      }

        this.bisectTriangle = function( t)
        {

            var a = new Point(t.ax,t.ay);
            var b = new Point(t.bx,t.by);
            var c = new Point(t.cx,t.cy);
            var mab = midpoint(a,b);
            var mbc = midpoint(b,c);
            var mca = midpoint(c,a);

           var shapes = new Array(2);
           shapes[0] = new Triangle(a.x, a.y, mca.x, mca.y, b.x, b.y);
           shapes[1] = new Triangle(c.x, c.y, mca.x, mca.y, b.x, b.y);



           return shapes;
        }

        this.trisectTriangle = function( t)
        {
            console.log("trisect triangle");
            var a = new Point(t.ax,t.ay);
            var b = new Point(t.bx,t.by);
            var c = new Point(t.cx,t.cy);

            var shapes = new Array(3);
            var centroid = t.centroid();
            shapes[0] = new Triangle(a.x, a.y, b.x, b.y, centroid.x, centroid.y);
            shapes[1] = new Triangle(b.x, b.y, c.x, c.y, centroid.x, centroid.y);
            shapes[2] = new Triangle(a.x, a.y, c.x, c.y, centroid.x, centroid.y);

            console.log(shapes.length);
            return shapes;
        }

        this.sierpinski = function( t)
        {
            console.log("sierpinsky ");
            var a = new Point(t.ax,t.ay);
            var b = new Point(t.bx,t.by);
            var c = new Point(t.cx,t.cy);
            var mab = midpoint(a,b);
            var mbc = midpoint(b,c);
            var mca = midpoint(c,a);

            var shapes = new Array(3);

            shapes[0] = new Triangle(a.x,a.y,mca.x,mca.y,mab.x,mab.y);
         shapes[1] = new Triangle(b.x,b.y,mbc.x,mbc.y,mab.x,mab.y);
         shapes[2] = new Triangle(c.x,c.y,mca.x,mca.y,mbc.x,mbc.y);

            console.log(shapes.length);

          return shapes;


        }

        this.regPolyToTriangles = function(rp)
        {
            var shapes = new Array(rp.n);
            for(var i = 0; i < rp.n; i++)
            {
              shapes[i] = new Triangle(rp.x, rp.y, rp.getPoint(i).x, rp.getPoint(i).y, rp.getPoint(i+1).x, rp.getPoint(i+1).y);

            }
            return shapes;

        }

        this.regPolyToStar = function(rp)
        {
           var shapes = new Shape[1];
           shapes[0] = new Star(rp.x, rp.y, rp.r, rp.n);
           return shapes;
        }

}

function div(a,b)
{
  return a/b;
}



function midpoint(a, b)
{
   return new Point(div(a.x+b.x,2), div(a.y+b.y,2));
}
