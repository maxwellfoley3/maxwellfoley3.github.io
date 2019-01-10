#ifdef GL_ES
precision mediump float;
#endif

#define STEPS 64
#define SHADOW_STEPS 32
#define MIN_DISTANCE 0.01
#define NUM_LIGHTS 1

#extension GL_OES_standard_derivatives : enable

uniform float time;
uniform vec2 mouse;
uniform vec2 resolution;
vec3 lights[NUM_LIGHTS];

struct material
{
	vec3 color;
};

struct sdfObj
{
	float dist;
	vec3 surface;
};


mat4 inverse(mat4 m) {
  float
      a00 = m[0][0], a01 = m[0][1], a02 = m[0][2], a03 = m[0][3],
      a10 = m[1][0], a11 = m[1][1], a12 = m[1][2], a13 = m[1][3],
      a20 = m[2][0], a21 = m[2][1], a22 = m[2][2], a23 = m[2][3],
      a30 = m[3][0], a31 = m[3][1], a32 = m[3][2], a33 = m[3][3],

      b00 = a00 * a11 - a01 * a10,
      b01 = a00 * a12 - a02 * a10,
      b02 = a00 * a13 - a03 * a10,
      b03 = a01 * a12 - a02 * a11,
      b04 = a01 * a13 - a03 * a11,
      b05 = a02 * a13 - a03 * a12,
      b06 = a20 * a31 - a21 * a30,
      b07 = a20 * a32 - a22 * a30,
      b08 = a20 * a33 - a23 * a30,
      b09 = a21 * a32 - a22 * a31,
      b10 = a21 * a33 - a23 * a31,
      b11 = a22 * a33 - a23 * a32,

      det = b00 * b11 - b01 * b10 + b02 * b09 + b03 * b08 - b04 * b07 + b05 * b06;

  return mat4(
      a11 * b11 - a12 * b10 + a13 * b09,
      a02 * b10 - a01 * b11 - a03 * b09,
      a31 * b05 - a32 * b04 + a33 * b03,
      a22 * b04 - a21 * b05 - a23 * b03,
      a12 * b08 - a10 * b11 - a13 * b07,
      a00 * b11 - a02 * b08 + a03 * b07,
      a32 * b02 - a30 * b05 - a33 * b01,
      a20 * b05 - a22 * b02 + a23 * b01,
      a10 * b10 - a11 * b08 + a13 * b06,
      a01 * b08 - a00 * b10 - a03 * b06,
      a30 * b04 - a31 * b02 + a33 * b00,
      a21 * b02 - a20 * b04 - a23 * b00,
      a11 * b07 - a10 * b09 - a12 * b06,
      a00 * b09 - a01 * b07 + a02 * b06,
      a31 * b01 - a30 * b03 - a32 * b00,
      a20 * b03 - a21 * b01 + a22 * b00) / det;
}

float lengthN(vec3 p,float N)
{
	return pow(pow(p.x,N)+pow(p.y,N)+pow(p.z,N),1./N);	
}

// polynomial smooth min (k = 0.1);
float smin( float a, float b, float k )
{
    float h = clamp( 0.5+0.5*(b-a)/k, 0.0, 1.0 );
    return mix( b, a, h ) - k*h*(1.0-h);
}

sdfObj opUSmooth(sdfObj a, sdfObj b, float k)
{
	sdfObj returnVal; 
	returnVal.dist = smin(a.dist,b.dist,k);
	returnVal.surface = float(a.dist < b.dist)*a.surface + float(b.dist < a.dist)*b.surface;
	return returnVal;
}


sdfObj opU(sdfObj a, sdfObj b)
{
	sdfObj returnVal; 
	returnVal.dist = min(a.dist,b.dist);
	returnVal.surface = float(a.dist < b.dist)*a.surface + float(b.dist < a.dist)*b.surface;
	return returnVal;
}

float vmax(vec3 v)
{
	return max(max(v.x, v.y), v.z);
}

sdfObj checkerBox(vec3 p, vec3 c, vec3 s)
{

	sdfObj returnVal; 
	returnVal.surface = vec3( float( float(mod(p.x,10.) < 5.) + float(mod(p.z,10.) >= 5.) == 1.)+.5 );
	returnVal.dist = vmax(abs(p-c) - s);
	return returnVal;
}

sdfObj roundedBox(vec3 p, vec3 c, vec3 s, vec3 color)
{

	sdfObj returnVal; 
	returnVal.surface = color;
	//returnVal.dist = vmax(abs(p-c) - s) - .7;
	vec3 d = abs(p-c) - s;
	returnVal.dist = min(max(d.x,max(d.y,d.z)),0.0) + length(max(d,0.0)) -.8;
		returnVal.dist = max(vmax(abs(p-c) - s),0.);
	return returnVal;
}


sdfObj box(vec3 p, vec3 c, vec3 s, vec3 color)
{

	sdfObj returnVal; 
	returnVal.surface = color;
	returnVal.dist = vmax(abs(p-c) - s);
	return returnVal;
}


sdfObj sphere(vec3 p, vec3 center, float radius, vec3 color)
{
	sdfObj returnVal; 
	returnVal.surface =  color;
	returnVal.dist = distance(p,center) - radius;
	return returnVal;
}

sdfObj plane(vec3 p, float level, vec3 color)
{	
	sdfObj returnVal; 
	returnVal.surface = color;
	returnVal.dist = abs(p.y-level);
	return returnVal;
	 
}
mat4 constructMatrix(float a, vec3 c) {

	//rotate by a certain angle around y axis
	
	
	mat4 rotMat =  mat4( vec4(cos(a),0,sin(a),0),
		    vec4(0,1,0,0),
		    vec4(-sin(a),0,cos(a),0),
		    vec4(0,0,0,1));
	
	 rotMat = rotMat* mat4( vec4(1.0,0.,0.,c.x),
			    vec4(0.0,1.,0.,c.y),
			    vec4(0.0,0.,1.,c.z),	
			   vec4(0.,0.,0.,1.));
	//take the inverse of rotMat
	return inverse(rotMat);
	
	
}

sdfObj torus(vec3 p, vec3 c, float r, float ir, float norm, vec3 color)
{
	vec3 param = p - c;
	
	vec2 q = vec2(length(param.xz)-ir  ,   param.y);
	sdfObj returnObj;
  	returnObj.dist = lengthN(vec3(q,0.),norm)-r;
	returnObj.surface = color;
	return returnObj;
	
	//todo: put in option to make it filled
}

sdfObj king (vec3 p, vec3 pawnC, vec3 color)
{
	sdfObj returnVal;
	returnVal.surface = color;
	
	float x =1000.;
	//various heights
	float crownHeight = 1.5;
	float crownBaseHeight = .15;
	float headHeight = 1.8;
	float neck1Height = .2;
	float neck2Height = .4;
	float neck3Height = .2;
	float neck4Height = .3;
	float bodyHeight = 4.2;
	float base1Height = .4;
	float base2Height = 1.2;
	float footHeight = .4;
	
	//vertical part of crown
	vec3 crownVertC = pawnC;// - vec3(0.,crownBaseHeight/2.,0.);

	float crownH = crownHeight/2.;
	
	//calculate curve
	float yParam3 = p.y - (crownVertC.y-crownH);
	float crownR = .2+pow(yParam3-1.,2.)/5. ;
	float a = max( length(p.xz-crownVertC.xz)-crownR,abs(p.y-crownVertC.y)-crownH);
	a = max(a,p.x-pawnC.x-.1); 
	a = max(a,pawnC.x-p.x-.1); 
	x = smin(x , a,1.  );
	
	//horizontal part of crown
	vec3 crownHorzB = vec3(.05,.2,.7); 
	float crownHorzRound = .05;
	
	x = smin(x,length(max(abs(p-crownVertC)-crownHorzB,0.0))-crownHorzRound, .04);
	
	//base of crown
	vec3 torTopC = crownVertC - vec3(0.,crownHeight/2.+crownBaseHeight/2. ,0.);
	float torTopR = .2;
	float torTopIR = .4;
	vec3 torTopParam = p-torTopC;	
  	x = smin(x, torus(p,torTopC,torTopR,torTopIR,2.,vec3(1.)).dist,.1);	
	
	//cone thing for head
	vec3 headC = torTopC - vec3(0.,crownBaseHeight/2.+headHeight/2.,0.);

	float headH = headHeight/2.;
	
	//calculate curve
	float yParam2 = p.y - (headC.y-headH);
	float headR = .8+ yParam2/4. ;
	 x = smin(x , max( length(p.xz-headC.xz)-headR,abs(p.y-headC.y)-headH),.0  );
	//mix this with very top of head as well to get curve
	//x = smin(x, torus(p,headC+vec3(0.,headH-.025,0.),.01,1.05,2.,vec3(1.)).dist,.5);
	
	
	//cylinder for neck
	vec3 neckC = headC - vec3(0.,headHeight/2. + neck1Height/2.,0.);
	float neckR = neck1Height/2.;
	float neckIR = .8;
  	x = smin(x, torus(p,neckC,neckR,neckIR,2.,vec3(1.)).dist,.1);
	
	vec3 neck2C = neckC - vec3(0.,neck1Height/2. + neck2Height/2.,0.);
	float neck2R = neck2Height/2.;
	float neck2IR = .5;
  	x = smin(x, torus(p,neck2C,neck2R,neck2IR,6.,vec3(1.)).dist,.4);	
	
	vec3 neck3C = neck2C - vec3(0.,neck2Height/2. + neck3Height/2.,0.);
	float neck3R = neck3Height/2.;
	float neck3IR = .8;
  	x = smin(x, torus(p,neck3C,neck3R,neck3IR,6.,vec3(1.)).dist,.3);


	vec3 neck4C = neck3C - vec3(0.,neck3Height + neck4Height/2.,0.);
	float neck4R = neck4Height/2.;
	float neck4IR = 1.;
  	x = smin(x, torus(p,neck4C,neck4R,neck4IR,3.001,vec3(1.)).dist,.2);

	
	//cylinder for body, gotta modify this to make it more curvy, by making cyl2R parametric
	vec3 cyl2C = neck4C - vec3(0,neck4Height/2.+bodyHeight/2.,0);

	float cyl2H = bodyHeight/2.;
	
	//calculate curve
	float yParam = p.y - (cyl2C.y - cyl2H);
	float cyl2R = .5+pow(yParam-2.7, 2.)/11. ;//.4 + pow(yParam+.5, 2.1)/20. ;
	x = smin(x , max( length(p.xz-cyl2C.xz)-cyl2R,abs(p.y-cyl2C.y)-cyl2H),.1  );
	
	//top of base
	vec3 cyl3C = cyl2C - vec3(0.,bodyHeight/2.+base1Height/2.,0.);
	float cyl3H = .2;
	float cyl3R = 1.4;
	x = min(x , max( length(p.xz-cyl3C.xz)-cyl3R,  abs(p.y-cyl3C.y) - cyl3H)   );	
	
	
	//main part of base
	vec3 tor4C = cyl3C - vec3(0.,base1Height/2.+base2Height/2. ,0.);
	float tor4R =.6;
	float tor4IR = 1.2;
	vec3 tor4Param = p-tor4C;
	
	//distance to torus is distance to closest point on a circle, minus the radius
	//how do we get this distance? it must lie along the ray that points from p to the center
	//and match the formula p2.x^2 + p2.z^2 = ir^2 
	//so... p2.x 
	//whatever i give up for now but one day i want to know how to derive this
	
	vec2 q = vec2(length(tor4Param.xz)-tor4IR,tor4Param.y);
  	x = smin(x, lengthN(vec3(q,0.),2.2)-tor4R,.4);
	

	
	//foot 
	vec3 tor5C = tor4C - vec3(0.,base2Height/2.+footHeight/2.,0.);
	float tor5R =.2;
	float tor5IR = 1.7;
	vec3 tor5Param = p-tor5C;
	vec2 q2 = vec2(length(tor5Param.xz)-tor5IR,tor5Param.y);
	
  	x = smin(x, lengthN(vec3(q2,0.),8.)-tor5R,.3);
	
	returnVal.dist = x;
	return returnVal;
	
}

sdfObj pawn (vec3 p, vec3 pawnC, vec3 color)
{
	sdfObj returnVal;
	returnVal.surface = color;
	
	
	//various heights
	float headHeight = 2.;
	float neckHeight = .3;
	float bodyHeight = 3.2;
	float base1Height = .4;
	float base2Height = 1.2;
	float footHeight = .4;
	
	//sphere for head
	float x = distance(p,pawnC) - headHeight/2.;
	
	
	//cylinder for neck
	vec3 torC = pawnC - vec3(0.,headHeight/2.,0.);
	float torR = neckHeight/2.;
	float torIR = .8;
	vec3 torParam = p - torC;
	
	vec2 q3 = vec2(length(torParam.xz)-torIR,torParam.y);
  	x = smin(x, lengthN(vec3(q3,0.),10.)-torR,.4);

	
	//cylinder for body, gotta modify this to make it more curvy, by making cyl2R parametric
	vec3 cyl2C = torC - vec3(0,neckHeight/2.+bodyHeight/2.,0);

	float cyl2H = bodyHeight/2.;
	
	//calculate curve
	float yParam = p.y - (cyl2C.y-cyl2H);
	float cyl2R = .4+pow(yParam-2.2, 2.)/8. ;
	x = smin(x , max( length(p.xz-cyl2C.xz)-cyl2R,abs(p.y-cyl2C.y)-cyl2H),.1  );
	
	//top of base
	vec3 cyl3C = cyl2C - vec3(0.,bodyHeight/2.+base1Height/2.,0.);
	float cyl3H = .2;
	float cyl3R = 1.1;
	x = min(x , max( length(p.xz-cyl3C.xz)-cyl3R,  abs(p.y-cyl3C.y) - cyl3H)   );	
	
	
	//main part of base
	vec3 tor4C = cyl3C - vec3(0.,base1Height/2.+base2Height/2. ,0.);
	float tor4R =.6;
	float tor4IR = 1.;
	vec3 tor4Param = p-tor4C;
	
	//distance to torus is distance to closest point on a circle, minus the radius
	//how do we get this distance? it must lie along the ray that points from p to the center
	//and match the formula p2.x^2 + p2.z^2 = ir^2 
	//so... p2.x 
	//whatever i give up for now but one day i want to know how to derive this
	
	vec2 q = vec2(length(tor4Param.xz)-tor4IR,tor4Param.y);
  	x = smin(x, lengthN(vec3(q,0.),2.2)-tor4R,.4);
	

	
	//foot 
	vec3 tor5C = tor4C - vec3(0.,base2Height/2.+footHeight/2.,0.);
	float tor5R =.2;
	float tor5IR = 1.7;
	vec3 tor5Param = p-tor5C;
	vec2 q2 = vec2(length(tor5Param.xz)-tor5IR,tor5Param.y);
	
  	x = smin(x, lengthN(vec3(q2,0.),8.)-tor5R,.3);
	
	returnVal.dist = x;
	return returnVal;
	
}
sdfObj rook (vec3 p, vec3 pawnC, vec3 color)
{
	sdfObj returnVal;
	returnVal.surface = color;
	
	
	//various heights
	float headHeight = 1.;
	float neckHeight = .5;
	float bodyHeight = 3.2;
	float base1Height = .4;
	float base2Height = 1.4;
	float footHeight = .45;
	

	float x = 1000.;//distance(p,pawnC) - headHeight/2.;
	
	
	//cylinder for head	
	vec3 headC = pawnC ;
	float headR = headHeight/2.;
	float headIR = .85;
	vec3 headParam = p - headC;
	
	vec2 q3 = vec2(length(headParam.xz)-headIR,headParam.y);
  	float a = lengthN(vec3(q3,0.),10.)-headR;
	
	//cylinder to subtract out
	float headInnerCylR = 1.1;
	
	a= max(-(length(p.xz-headC.xz)-headInnerCylR),a);
	

	vec3 crennelC = headC + vec3(0.,.25,0.);
	//block 1 to subtract out 
	vec3 headB1 = vec3(.4,.3,2.);
	vec3 d = abs(p-crennelC) - headB1;
	float a_ = min(max(d.x,max(d.y,d.z)),0.0) + length(max(d,0.0));
	a = max(-1.*a_,a);
	
	//block 2 to subtract out 
	//multiply p by the model matrix
	
	vec4 p2 = vec4(p,1.);
	
 	vec4 p5 = p2 * constructMatrix(3.14195/3.,crennelC);
	vec3 p3 = vec3(p5.x,p5.y,p5.z);
	vec3 d1 = abs(p3) - headB1;
	float a_1 = min(max(d1.x,max(d1.y,d1.z)),0.0) + length(max(d1,0.0));
	a = max(-1.*a_1,a);	
	
	//block 3 to subtract out 
	vec4 p2_ = vec4(p,1.);
	
 	vec4 p5_ = p2_ * constructMatrix(2.*3.14195/3.,crennelC);
	vec3 p3_ = vec3(p5_.x,p5_.y,p5_.z);
	vec3 d1_ = abs(p3_) - headB1;
	float a_2 = min(max(d1_.x,max(d1_.y,d1_.z)),0.0) + length(max(d1_,0.0));
	a = max(-1.*a_2,a);		
	
	
	
	
	x = smin(x, a,.4);
	//cylinder for neck
	vec3 torC = pawnC - vec3(0.,headHeight/2.,0.);
	float torR = neckHeight/2.;
	float torIR = .75;
	vec3 torParam = p - torC;
	
	vec2 q4 = vec2(length(torParam.xz)-torIR,torParam.y);
  	x = smin(x, lengthN(vec3(q4,0.),10.)-torR,.4);

	
	//cylinder for body, gotta modify this to make it more curvy, by making cyl2R parametric
	vec3 cyl2C = torC - vec3(0,neckHeight/2.+bodyHeight/2.,0);

	float cyl2H = bodyHeight/2.;
	
	//calculate curve
	float yParam = p.y - (cyl2C.y-cyl2H);
	float cyl2R = 1.+pow(yParam-2.2, 2.)/15. ;
	x = smin(x , max( length(p.xz-cyl2C.xz)-cyl2R,abs(p.y-cyl2C.y)-cyl2H),.1  );
	
	//top of base
	vec3 cyl3C = cyl2C - vec3(0.,bodyHeight/2.+base1Height/2.,0.);
	float cyl3H = .2;
	float cyl3R = 1.4;
	x = min(x , max( length(p.xz-cyl3C.xz)-cyl3R,  abs(p.y-cyl3C.y) - cyl3H)   );	
	
	
	//main part of base
	vec3 tor4C = cyl3C - vec3(0.,base1Height/2.+base2Height/2. ,0.);
	float tor4R =.8;
	float tor4IR = 1.;
	vec3 tor4Param = p-tor4C;
	
	//distance to torus is distance to closest point on a circle, minus the radius
	//how do we get this distance? it must lie along the ray that points from p to the center
	//and match the formula p2.x^2 + p2.z^2 = ir^2 
	//so... p2.x 
	//whatever i give up for now but one day i want to know how to derive this
	
	vec2 q = vec2(length(tor4Param.xz)-tor4IR,tor4Param.y);
  	x = smin(x, lengthN(vec3(q,0.),2.2)-tor4R,.2);
	

	
	//foot 
	vec3 tor5C = tor4C - vec3(0.,base2Height/2.+footHeight/2.,0.);
	float tor5R =.2;
	float tor5IR = 1.7;
	vec3 tor5Param = p-tor5C;
	vec2 q2 = vec2(length(tor5Param.xz)-tor5IR,tor5Param.y);
	
  	x = smin(x, lengthN(vec3(q2,0.),8.)-tor5R,.3);
	
	returnVal.dist = x;
	return returnVal;
	
}

//this is a signed distance function now
sdfObj map (vec3 p)
{	
	//multiply p by the model matrix
	/*
	vec4 p2 = vec4(p,0.);
 	vec4 p3 = constructMatrix() * p2;
	 p = vec3(p3.x,p3.y,p3.z);*/

	
	sdfObj x =  checkerBox(p, vec3(0.,-10.,0.) , vec3(20.,.25,20.));
	if(x.dist <MIN_DISTANCE) return x;
		x = opU(x, pawn( p, vec3(-2.5,-3.2,-17.5), vec3(1.)));
	if(x.dist <MIN_DISTANCE) return x;	
		x = opU(x, king( p, vec3(-7.5,0.8,-12.5), vec3(1.)));
		if(x.dist <MIN_DISTANCE) return x;	
		//x = opU(x, pawn( p, vec3(-2.5,-3.2,2.5), vec3(.4)));
		
		x = opU(x, king( p, vec3(-17.5,0.8,-17.5), vec3(.4)));
		
		x = opU(x, rook( p, vec3(-17.5,-3.44,2.5), vec3(1.)));	
	
		//x = opU(x, rook( p, vec3(12.5,-3.44,7.5), vec3(.4)));	
	
		//x = opU(x, pawn( p, vec3(7.5,-3.2,2.5), vec3(1.)));
	
		//x = opU(x, pawn( p, vec3(2.5,-3.2,12.5), vec3(1.)));
		/*x = opU(x,
		box(p,vec3(6.0,1.0,-.6),vec3(1.),vec3(1.,0.,.4))
		)*/;
	

	return x;
}



vec3 normal (vec3 p)
{
	const float eps = 0.0001;
 
	return normalize
	(	vec3
		(	map(p + vec3(eps, 0, 0)	).dist - map(p - vec3(eps, 0, 0)).dist,
			map(p + vec3(0, eps, 0)	).dist - map(p - vec3(0, eps, 0)).dist,
			map(p + vec3(0, 0, eps)	).dist - map(p - vec3(0, 0, eps)).dist
		)
	);
}
vec3 renderSurfaceBP(vec3 p, vec3 v,vec3 l,vec3 color)
{
	vec3 n = normal(p);

	float diffuse = dot(n,l);
	
	//vec3 h = normalize((l+v)/length(l+v));
	
	//float specPower = 1.;
	//float specular = pow(dot(n,h),specPower);
	
	return diffuse*color;//+  specular*vec3(1.,0.,1.);
	
}



vec3 background(vec3 p)
{
	return vec3(.5);	
}

bool shadowTrace(vec3 lDirection, vec3 pos)
{
	lDirection = normalize(lDirection);

	vec3 lightPos = pos + 1000.*lDirection;
	lDirection = -lDirection;
	//lDirection; //= -1.*lDirection;
	float objDist; 	
	float distTraveled = 0.; 
	for(int i = 0; i < SHADOW_STEPS; i++) 
	{

		objDist = map(lightPos+lDirection*distTraveled).dist;
			
		distTraveled+=objDist;
		if(distTraveled >= 999.-MIN_DISTANCE){ return false; }
		
		//if we came into contact with an object
		if(objDist < MIN_DISTANCE)
		{
			return true;
		}
		

		

		
	}
	
	return false;
				     
}
vec3 trace(vec3 pos, vec3 viewDirection) 
{	
	float drawdist = 100.;
	for (int i = 1; i <= STEPS; i++)
	{
		sdfObj obj = map(pos);
		float distance = obj.dist;
		if (distance < MIN_DISTANCE)
		{
			
			vec3 color = vec3(0.);

			/*
			for(int k = 0; k < 2; k++)
			{
				color += obj.surface* renderSurfaceBP(pos,viewDirection,myLights[k]);
			}*/
			
			color += renderSurfaceBP(pos,viewDirection,lights[0],obj.surface);
			//color += obj.surface * renderSurfaceBP(pos,viewDirection,lights[1]);
			
			vec3 myLights0 = lights[0];
			vec3 colorWithShadow = color*float(!shadowTrace(lights[0],pos));
		        //colorWithShadow = colorWithShadow*.5*float(!shadowTrace(pos,lights[1]));
			return colorWithShadow;
		}
		if(distance > drawdist){
			return background(pos);	
		}
		pos += distance * viewDirection;
	}

	return background(pos);
}


mat4 gluLookAt(vec3 eye, vec3 center, vec3 up) {
	vec3 f = normalize(center - eye);
	vec3 s = normalize(cross(f, up));
	vec3 u = cross(s, f);
	return mat4(
		vec4(s, 0.0),
		vec4(u, 0.0),
		vec4(-f, 0.0),
		vec4(0.0, 0.0, 0.0, 1)
	);
}


void main( void ) {
	//return;
	

	lights[0] = normalize(vec3(sin(time),1.,cos(time)));
	//lights[1] = normalize(vec3(.3,-.4,10.));


	vec2 position = ( gl_FragCoord.xy / resolution.xy ) * 2.0 - 1.0;
	position = position * resolution.xy / max(resolution.x, resolution.y);

	vec3 color = vec3(0.0);


	vec3 viewDir = normalize(vec3(position ,-1.));
	vec3 from = vec3(cos(time/8.)*35.,9.*(mouse.y),sin(time/8.)*35.);

	mat4 viewToWorld = gluLookAt(from, vec3(0.), vec3(0.,1.,0.));
	vec3 worldDir = (viewToWorld*vec4(viewDir,0.0)).xyz;
	

	color = trace(from,worldDir); 	


	gl_FragColor = vec4( color , 1.0 );
}