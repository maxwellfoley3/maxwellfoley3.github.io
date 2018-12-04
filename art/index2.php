<html>
<head>
    <title>Maxwell Foley</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="jquery-1.11.3.js"></script>

    <script>
        
        //these variables hold the piece that we are currently looking at in the art viewer. that piece is arr[displayedPiece]
        var displayedPiece;
        var arr;

        //if a work of art has multiple images for it, this variable holds which one is currently displayed
        var displayedImage = 0;

        
        function piece(title, imgURLs, year, medium)
        {
            this.title = title;
            this.imgURLs = imgURLs;
            this.year = year;
            this.medium = medium;
        }
        
        
        var art = [
            new piece("Bed", ["art/bed01.jpg", "art/bed02.jpg","art/bed03.jpg","art/bed04.jpg","art/bed05.jpg","art/bed06.jpg","art/bed07.jpg","art/bed08.jpg"], 2015, "Wood, foam, canvas, and found materials"),
            new piece("The Pandas Friend (series)", ["art/pandasfriend1.jpg", "art/pandasfriend2.jpg", "art/pandasfriend3.jpg", "art/pandasfriend4.jpg", "art/pandasfriend5.jpg", "art/pandasfriend6.jpg", "art/pandasfriend7.jpg", "art/pandasfriend8.jpg"], 2015, "oil on canvas" ),            
            new piece("The Queen of Spades", ["art/queenofspades.jpg"], 2015, "oil on canvas"),
            new piece("Shrine", ["art/shrine01.jpg", "art/shrine02.jpg", "art/shrine03.jpg",  "art/shrine04.jpg", "art/shrine05.jpg"], 2015, "ceramics, found materials"),
            new piece("Jonah", ["art/jonah.jpg"], 2015, "oil on canvas"),
            new piece("Self portrait 2", ["art/selfportrait2.jpg"], 2014, "digital collage"),
            new piece("Self portrait", ["art/selfportrait.jpg"], 2014, "oil pastel"),
            new piece("Friendly Face", ["art/friendlyface.jpg"], 2012, "oil on canvas"),
            new piece("O Face", ["art/oface.jpg"], 2012, "oil on canvas"),
            new piece("Scary Face", ["art/scaryface.jpg"], 2012, "oil on canvas"),
            new piece("Maybe the only point of being awake is to sleep", ["art/maybetheonlypoint.jpg"], 2012, "oil on canvas"),
            new piece("Imagine having nothing to hide", ["art/nothingtohide.jpg"], 2012, "oil on canvas"),
            new piece("Slime Man", ["art/nothingtohide.jpg"], 2012, "drawing"),
            new piece("Clock Man", ["art/nothingtohide.jpg"], 2012, "drawing"),
            new piece("Slime Man", ["art/nothingtohide.jpg"], 2012, "drawing"),
            new piece("Bird", ["art/bird.jpg"], 2012, "acrylic on canvas"),
            new piece("Female nude", ["art/nudewoman.jpg"], 2012, "acrylic on canvas"),
            new piece("Omni", ["art/shangrila.jpg"], 2012, "acrylic on canvas"),
            new piece("Erin", ["art/erin.jpg"], 2012, "acrylic on canvas"),
            new piece("Lemons", ["art/lemons.jpg"], 2012, "acrylic on canvas"),
            new piece("Untitled", ["art/pinkman.jpg"], 2011, "acrylic on canvas")
            

        ];
        
        var comDes = [
            new piece("Rush poster 2", ["art/threemen.jpg"], 2014, "digital"),
            //new piece("Election season poster", ["art/voteposter.jpg"], 2014, "digital"),
            new piece("Pattern design", ["art/pattern.jpg"], 2014, "digital"),
            new piece("Storytelling comic", ["art/comic.jpg"], 2014, "digital"),
            new piece("Rush poster", ["art/rushposter.jpg"], 2014, "digital"),
            new piece("Rush t-shirt", ["art/shirt1.jpg", "art/shirt2.jpg"], 2014, "t-shirt")
        ];
        
        //this is what is called when you click on one of the buttons next to my face
        function displayPage(page)
        {
            document.getElementById(page).style.visibility = "visible";
            
            if (page == "artwork")
            {
                $('#artwork').fadeIn(500);

                var HTML = "";
                
                HTML += "<a href='#' onClick='closeArtworkList(); return false;'><div id='xButton'></div></a>"
                HTML += "<b>Art</b><br>";

                for(var i = 0; i < art.length; i++)
                {
                    HTML += "<a href='#' onClick='displayArt(" + i + ", \"art\"); return false;'>" + art[i].title + "</a><br>";
                }
                
                HTML += "<br>";
                HTML += "<b>Communication Design</b><br>";

                for(var i = 0; i < comDes.length; i++)
                {
                    HTML += "<a href='#' onClick='displayArt(" + i + ", \"comDes\"); return false;'>" + comDes[i].title + "</a><br>";
                }
                
                document.getElementById("artwork").innerHTML = HTML;
                

            }
            
        }
        
        //this is what is called when you click on an artwork that you want to see
        function displayArt(i, which)
        {
            $('html, body').animate({
                    scrollTop: 450 //$("#viewer").offset().top
                }, 500);
            
            $('#artwork').animate({
                left: '200px',
                top: '500px',
            }, 500);
            
            $('#viewer').fadeIn(500);
                        
            document.getElementById("viewer").style.visibility = "visible";
            if (which == "art")
            {
                arr = art;
            }
            if (which == "comDes")
            {
                arr = comDes;
            }
            
            displayedPiece = i;
            displayedImage = 0;
            
            
            switchImage(arr[i].imgURLs[displayedImage]);
            
            document.getElementById("viewerTitle").innerHTML = arr[i].title;
            document.getElementById("viewerDescription").innerHTML = "" + arr[i].year + ", " + arr[i].medium;
            
            displaySelector();


        }
        
        function switchImage(newImg) {
            img = document.getElementById("viewerImg");
            document.getElementById("viewerImgLink").href = newImg;
            img.src = newImg;
            img.style.visibility = "hidden";
            img.onload = function () {img.style.visibility = "visible";}

        }
        
        //this function is in charge of displaying the widget you use to scroll back and forth between multiple images for one piece
        function displaySelector()
        {
            document.getElementById("imgSelector").innerHTML = selHTML;
            
            
            var selHTML = "";
            
            if(displayedImage > 0) selHTML += "<a href='#' onClick='prevImg(); return false;'><div id='leftarrow'></div></a>"; //<img id='leftarrow' onmouseover='leftArrowHover();' src='lefttrianglelight.gif' width='15px' height='20px'></a>";
        
            
            for (var j = 0; j < arr[displayedPiece].imgURLs.length; j++)
            {
                if(j == displayedImage) selHTML += "<div id='circledark'></div>"; // <img src='circledark.gif' width='10px' height='10px'>";
                else selHTML += "<div id='circlelight'></div>"; //<img src='circlelight.gif' width='10px' height='10px'>";
            }
            
            if(displayedImage < arr[displayedPiece].imgURLs.length -1 ) selHTML += "<a href='#' onClick='nextImg(); return false;'><div id='rightarrow'></div></a>";
            
            document.getElementById("imgSelector").innerHTML = selHTML;
            
        }
        
 /*       function leftArrowHover()
        {
            document.getElementById("leftarrow").src = "leftarrowdark.gif";
        }

        function rightArrowHover()
        {
            document.getElementById("rightarrow").src = "rightarrowdark.gif";
            
        }*/
        
        
        function prevImg()
        {
            displayedImage--;
            switchImage(arr[displayedPiece].imgURLs[displayedImage]);
            displaySelector();
        }
        function nextImg()
        {
            displayedImage++;
            switchImage(arr[displayedPiece].imgURLs[displayedImage]);
            displaySelector();

        }
        
        function closeArtworkList() {
            $('html, body').animate({
                    scrollTop:0
                }, 500);

            $('#artwork').animate({
                left: '200x',
                top: '50px',
                opacity: 0
            }, 500);
                        
            $('#viewer').fadeOut(500);

                     
        }
        
        function closeImgViewer() {
            $('html, body').animate({
                    scrollTop: 0
                }, 500);
            
            $('#artwork').animate({
                left: '200x',
                top: '50px',
            }, 500);
            
            $('#viewer').fadeOut(500);
        }
        
    </script>
</head>
<body>
    <div id="name"><span id="firstname">Maxwell</span> <br> <span id="lastname">Foley</span></div>
    <div id="website_name">skwrk.com</div>
    <div id="website_acronym">structured kollection of work, revealing knowledgability</div>

    <div id="container">
        <div id="bio">Maxwell Foley is an undergraduate at Washington University in St. Louis pursuing a double major in studio art and computer science.</div>
        <div id="face"><img src="face.jpg"  width="100" height="135" alt="me"></div>
        <div id="links"><ul><li><a href="#" onclick='displayPage("artwork"); return false;'>artwork</a></li><li><a href="#" onclick='displayPage("cs work"); return false;'>cs work</a></li><li><a href="#" onclick='displayPage("resume"); return false;'>resume</a></li></ul></div>
        <div id="contact">Contact: maxwellfoley@wustl.edu, (614) 378-1741</div>
    </div>
    
   <div id="artwork">
    
   </div>
   
   <div id="viewer">
        <a href='#' onClick='closeImgViewer(); return false;'><div id="xButton"></div></a>
        <div id="viewerImgDiv">
            <a id="viewerImgLink"><img id="viewerImg" class="viewerImg"></a>
        </div>
        
        <div id="viewerTitle"></div>
        
        <div id="viewerDescription"></div>

        <div id="imgSelector"></div>
   </div>

    
</body>

</html>