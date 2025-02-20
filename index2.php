<html>
<head>
    <title>Maxwell Foley</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="style.css">
    <noscript>
            <link rel="stylesheet" type="text/css" href="noscriptstyle.css">
    </noscript>
    <script src="jquery-1.11.3.js"></script>

    <script>

        var $mouseX = 0;
        var $mouseY = 0;

        $(document).mousemove(function(e){
            $mouseX = e.pageX;
            $mouseY = e.pageY;
        });

        //these variables hold the piece that we are currently looking at in the art viewer. that piece is arr[displayedPiece]
        var displayedPiece;
        var arr;

        //if a work of art has multiple images for it, this variable holds which one is currently displayed
        var displayedImage = 0;

        //list of all the sub-pages you can get to in box2
        var pages = ["artwork", "cswork","resume"];

        var box2Container = $('#box2container');


        //function called when window size changes
        $(window).on('resize', function(){
            changeBox2Height();
        });

        function changeBox2Height()
        {
            if ($('#box2').height() > $(window).height()-75) {
                $('#box2').height( $(window).height()-75);
            }

            else ($('#box2').css("height","auto"));


        }



        //object to hold art pieces
        function piece(title, imgURLs, year, medium)
        {
            this.title = title;
            this.imgURLs = imgURLs;
            this.year = year;
            this.medium = medium;
        }

        //all of the art pieces
        var art = [
            new piece("Luncheon on the grass", ["luncheon1.jpg", "luncheon2.jpg", "luncheon3.jpg"], 2015, "digital painting"),
            new piece("Martyrdom of St. Sebastian", ["st sebastian.jpg"], 2015, "digital painting"),
            new piece("Snakes", ["snakes.jpg"], 2015, "digital image"),
            new piece("My best friend", ["my best friend.jpg"], 2015, "digital painting"),

            new piece("Waterbed", ["waterbed.jpg"], 2015, "digital painting"),
            new piece("Iceberg", ["iceberg.jpg"], 2015, "digital painting"),

            new piece("Submersion", ["submersion.jpg"], 2015, "digital image"),
            new piece("Motivational speaker", ["be yourself.jpg"], 2015, "digital image"),

            new piece("Sea queen", ["sea queen.jpg"], 2015, "digital painting"),
            new piece("3 christs of ypsilanti", ["3 christs of ypsilanti.jpg"], 2015, "digital painting"),
            new piece("Oil man", ["oil man.jpg"], 2015, "digital painting"),
            new piece("Crown of thorns", ["crown of thorns.jpg"], 2015, "digital painting"),
            new piece("Conflagration", ["conflagration.jpg"], 2015, "digital painting"),
            new piece("Apprentice magician", ["apprentice magician.jpg"], 2015, "digital painting"),
            new piece("Pseudo-fractals", ["a.jpg","b.jpg","c.jpg","d.jpg","e.jpg","f.jpg", "g.jpg","h.jpg","i.jpg","j.jpg","k.jpg","l.jpg"], 2015, "algorithmically generated images"),
        //    new piece("Homonculus", ["homonculus.jpg"], 2015, "3D animation"),
            new piece("Mountain giant", ["mountain giant.jpg"], 2015, "digital painting"),
            new piece("Imprisonment", ["imprisonment.jpg"], 2015, "digital painting"),
            new piece("Face", ["face.jpg"], 2015, "digital painting"),
            new piece("Immolation", ["immolation.jpg"], 2015, "digital painting"),
            new piece("Squirrel", ["squirrel.jpg"], 2015, "digital painting"),
            new piece("Snake charmer", ["snake charmer.jpg"], 2015, "digital painting"),
            new piece("Monk", ["monk.jpg"], 2015, "digital painting"),
            new piece("Self portrait 3", ["self portrait 3.jpg"], 2015, "digital and oil painting"),
            new piece("Bed", ["bed01.jpg", "bed02.jpg","bed03.jpg","bed04.jpg","bed05.jpg","bed06.jpg","bed07.jpg","bed08.jpg"], 2015, "Wood, foam, canvas, and found materials"),
            new piece("The Pandas Friend (series)", ["pandasfriend2.jpg", "pandasfriend3.jpg", "pandasfriend4.jpg", "pandasfriend5.jpg", "pandasfriend6.jpg", "pandasfriend7.jpg", "pandasfriend8.jpg", "pandasfriend1.jpg"], 2015, "oil on canvas" ),
            new piece("The Queen of Spades", ["queenofspades.jpg"], 2015, "oil on canvas"),
            new piece("Shrine", ["shrine01.jpg", "shrine02.jpg", "shrine03.jpg",  "shrine04.jpg", "shrine05.jpg"], 2015, "ceramics, found materials"),
            new piece("Jonah", ["jonah.jpg"], 2015, "oil on canvas"),
            new piece("Self portrait 2", ["selfportrait2.jpg"], 2014, "digital collage"),
            new piece("Self portrait", ["selfportrait.jpg"], 2014, "oil pastel"),
            new piece("Friendly Face", ["friendlyface.jpg"], 2012, "oil on canvas"),
            new piece("O Face", ["oface.jpg"], 2012, "oil on canvas"),
            new piece("Scary Face", ["scaryface.jpg"], 2012, "oil on canvas"),
            new piece("Maybe the only point of being awake is to sleep", ["maybetheonlypoint.jpg"], 2012, "digital"),
            new piece("Imagine having nothing to hide", ["nothingtohide.jpg"], 2012, "digital"),
            new piece("Slime Man", ["slimeman.jpg"], 2012, "drawing"),
            new piece("Clock Man", ["clockman.jpg"], 2012, "drawing"),
            new piece("Bird", ["bird.jpg"], 2012, "acrylic on canvas"),
            new piece("Female nude", ["nudewoman.jpg"], 2012, "acrylic on canvas"),
            new piece("Omni", ["shangrila.jpg"], 2012, "acrylic on canvas"),
            new piece("Erin", ["erin.jpg"], 2012, "acrylic on canvas"),
            new piece("Lemons", ["lemons.jpg"], 2012, "acrylic on canvas"),
            new piece("Untitled", ["pinkman.jpg"], 2011, "acrylic on canvas")


        ];

        //all of the comdes pieces. necessary to have two arrays for purposes of displaying them in separate sections
        var comDes = [
            new piece("Rush poster 2", ["threemen.jpg"], 2014, "digital"),
            //new piece("Election season poster", ["art/voteposter.jpg"], 2014, "digital"),
            new piece("Pattern design", ["pattern.jpg"], 2014, "digital"),
            new piece("Storytelling comic", ["comic.jpg"], 2014, "digital"),
            new piece("Rush poster", ["rushposter.jpg"], 2014, "digital"),
            new piece("Rush t-shirt", ["shirt1.jpg", "shirt2.jpg"], 2014, "t-shirt")
        ];

        var artThumbs = new Array();
        var comDesThumbs = new Array();

        doPreload();

        //this is what is called when you click on one of the buttons next to my face
        function displayBox2(page)
        {
            //hide all other box2s
            for(var i = 0; i < pages.length; i++)
            {
                if (page != pages[i]) {
                    $('#box2.' + pages[i]).css("display", "none");
                    $('#box2container').removeClass(pages[i]);

                }
            }

            //and box3
            $('#box3container').css("display", "none");


            //set box2container's class to the same one as box2
            $('#box2container').addClass(page);
            $('#box2container').removeClass("layoutB");
            $('#box2container').addClass("layoutA");



            //set that box's display style from none to inline-block
            $('#box2.' + page).css("display", "inline-block");

        //    if (windowWidth() == "yellow") {
                //scroll to where it is
                $('html, body').animate({
                        scrollTop: $("#box2."+page).offset().top - 30
                }, 500);


            //fade in
            $('.' + page).animate({opacity:1},500);






            //if page is artwork, then build the page
            if (page == "artwork")
            {

                //here is where we build the list of artwork links based on array
                var HTML = "";

                HTML += "<b>Art</b><br>";

                for(var i = 0; i < art.length; i++)
                {
                    HTML += "<a href='#' onmouseover='displayThumbnail(" + i + ", \"art\"); return false;' onMouseOut='hideThumbnail(); return false;' onClick='displayBox3(" + i + ", \"art\"); return false;'>" + art[i].title + "</a><br>";
                }

                HTML += "<br>";
                HTML += "<b>Design</b><br>";

                for(var i = 0; i < comDes.length; i++)
                {
                    HTML += "<a href='#' onmouseover='displayThumbnail(" + i + ", \"comDes\"); return false;' onMouseOut='hideThumbnail(); return false;' onClick='displayBox3(" + i + ", \"comDes\"); return false;'>" + comDes[i].title + "</a><br>";
                }

                HTML += "<br><br>For more, follow skwrk on <a href='http://instagram.com/skwrk'>instagram</a> and <a href='http://skwrk.tumblr.com'>Tumblr</a>";

                document.getElementById("artworkList").innerHTML = HTML;

            }


                            changeBox2Height();


        }

        //hide box 2
        function hideBox2(page) {

            //scroll to the top
            $('html, body').animate({
                    scrollTop:0
            }, 500);

            //box2containers class is unknown
            $('#box2container').removeClass(page);


            //fade out
            $('#box2.' + page).animate({
                opacity: 0
            }, 500);

            //set display to none
            $('#box2.' + page).css("display", "none");



            //hide box 3
            hideBox3();


        }

        //this is what is called when you click on an artwork that you want to see
        function displayBox3(i, which)
        {

            //switch box2 and its container to layoutB
            $('#box2').removeClass("layoutA");
            $('#box2').addClass("layoutB");

            $('#box2container').removeClass("layoutA");
            $('#box2container').addClass("layoutB");


            $("#box3container").css("display", "block");

            $('html, body').animate({
                    scrollTop: $("#box3container").offset().top

                }, 500);


          //  $('#box3container').fadeIn(500);


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

            //here is where we get the url of display image
            switchImage(arr[i].imgURLs[displayedImage]);

            document.getElementById("viewerTitle").innerHTML = arr[i].title;
            document.getElementById("viewerDescription").innerHTML = "" + arr[i].year + ", " + arr[i].medium;

            displaySelector();


        }

        function displayThumbnail(i, which)
        {
            document.getElementById("thumbnailHolder").style.display = "inline-block";

            var arr2;
            if (which == "art")
            {
                arr2 = artThumbs;
            }
            if (which == "comDes")
            {
                arr2 = comDesThumbs;
            }


            document.getElementById("thumbnail").src = arr2[i].src;

            document.getElementById("thumbnailHolder").style.top = $mouseY; //TODO, add minus page offset
            document.getElementById("thumbnailHolder").style.left = $("#box2.artwork").offset().left - 100;



        }

        function hideThumbnail()
        {
            document.getElementById("thumbnailHolder").style.display = "none";

        }

        function hideBox3()
        {



            $('html, body').animate({
                    scrollTop: 0
                }, 500, function() {

                    $('#box2').removeClass("layoutB");
                    $('#box2').addClass("layoutA");

                    $('#box2container').removeClass("layoutB");
                    $('#box2container').addClass("layoutA");


                    $("#box3container").css("display", "none");
                });

          /*  $('#artwork').animate({
                left: '200x',
                top: '50px',
            }, 500);*/



        }


        //this is what is called when you view a different image for the same art piece
        function switchImage(newImg) {
            img = document.getElementById("viewerImg");
            //we need to change these two lines to make it different
            document.getElementById("viewerImgLink").href = "art/" + newImg;
            img.src = "art/smaller/" + newImg;
            img.style.visibility = "hidden";
            img.onload = function () {img.style.visibility = "visible";}

        }

        //this function is in charge of displaying the widget you use to scroll back and forth between multiple images for one piece
        function displaySelector()
        {
            document.getElementById("viewerSelector").innerHTML = selHTML;

            var selHTML = "";

            if(displayedImage > 0) selHTML += "<a href='#' onClick='prevImg(); return false;'><div id='leftarrow'></div></a>"; //<img id='leftarrow' onmouseover='leftArrowHover();' src='lefttrianglelight.gif' width='15px' height='20px'></a>";


            for (var j = 0; j < arr[displayedPiece].imgURLs.length; j++)
            {
                if(j == displayedImage) selHTML += "<div id='circledark'></div>"; // <img src='circledark.gif' width='10px' height='10px'>";
                else selHTML += "<div id='circlelight'></div>"; //<img src='circlelight=.gif' width='10px' height='10px'>";
            }

            if(displayedImage < arr[displayedPiece].imgURLs.length -1 ) selHTML += "<a href='#' onClick='nextImg(); return false;'><div id='rightarrow'></div></a>";

            document.getElementById("viewerSelector").innerHTML = selHTML;

        }

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

        function windowWidth()
        {
            if ($(window).width() > 1100) {
                return "red";
            }
            if ($(window).width() > 850) {
                return "green";
            }
            if ($(window).width() > 675) {
                return "blue";
            }

            return "yellow";
        }

        function doPreload()
        {
            for(var i = 0; i < art.length; i++)
            {
                var an_image = new Image();
                an_image.src = "art/icons/" + art[i].imgURLs[0];
                artThumbs.push(an_image);
            }

            for(var i = 0; i < comDes.length; i++)
            {
                var an_image = new Image();
                an_image.src = "art/icons/" + comDes[i].imgURLs[0];
                comDesThumbs.push(an_image);
            }

        }

    </script>
</head>
<body> <!--</body> onLoad="doPreload();">-->



        <div id="thumbnailHolder">
             <!--<a href='#' onmouseover="changeThumbnail(); return false;" onclick ="changeThumbnail(); return false;">Jambo</a>-->

            <img id="thumbnail"  src="crown of thorns icon.jpg">

        </div>

    <div id="myName"><span id="firstName">Maxwell</span> <br> <span id="lastName">Foley</span></div>
    <div id="websiteName">skwrk.com</div>

    <div id="box1">
        <div id="bio">Maxwell Foley is an undergraduate at Washington University in St. Louis pursuing a double major in studio art and computer science.</div>
        <div id="links" class="script"><ul><li><a href="#" onclick='displayBox2("artwork"); return false;'>artwork</a></li><li><a href="#" onclick='displayBox2("cswork"); return false;'>cs work</a></li><li><a href="#" onclick='displayBox2("resume"); return false;'>resume</a></li></ul></div>
        <div id="links" class="no-script"><ul><li><a href="artwork.php">artwork</a></li><li><a href="cswork.php">cs work</a></li><li><a href="resume.php">resume</a></li></ul></div>


        <div id="face"><img src="face.jpg"  alt="me"></div>

        <div id="contact">Contact: maxwellfoley@wustl.edu, (614) 378-1741</div>
    </div>

    <div id="box2container" class="layoutA">

        <div id="box2" class="artwork">
             <a href='#' onClick='hideBox2("artwork"); return false;'><div class="xButton"></div></a>
             <div id = "artworkList"></div>
        </div>

        <div id="box2" class = "cswork">
             <a href='#' onClick='hideBox2("cswork"); return false;'><div class="xButton"></div></a>
             <a href="https://mighty-island-51217.herokuapp.com/"><h1>Quiz app</h1></a>
              <p>Flashcard quiz app using the MEAN stack. Users can create sets of flashcards, upload images, edit and delete flashcards, and then quiz themselves. Heroku was used to deploy the app and Bootstrap was used for CSS. Filepicker.js was used for file uploading. </p>
             <a href="calendar/calendar2.html"><h1>Calendar</h1></a>
                <p>Online calendar tool. Users can register and log into an account, and then add events to their personalized calendar. Users can make events public so that every calendar user can see the event. Users can also share events with other users, or send friend requests so that all of their events are automatically shared. The front end was built in Javascript and PHP with a functioning back end in SQL.</p>
             <h1>Generative art</h1>
                <p>Several interactive visuals initially built in Processing then ported into P5.js for online compatibility. Try clicking and moving the mouse around to see what happens. Warning: might be too intense for slower computers.</p>
                <ul>
                    <li><h3><a href="sketch3.html">Pseudo-fractals</a></h3></li>
                    <li><h3><a href="sketch2.html">Cyber rainbow cloud kingdom</a></h3></li>
                    <li><h3><a href="sketch1.html">Gameboy goo</a></h3></li>
                </ul>

             <h1>Twitter bots</h1>
              <p><a href="https://twitter.com/pseudo_frac">@pseudo_frac is a a twitter bot</a> that will generate an image from the "pseudo-fractals" algorithm above and post it to Twitter once every 24 hours. Written in node.js and p5.js and deployed on Amazon EC2. I'm probably going to make a few more of these soon.</p>
             <a href="artists.php"><h1>Artists Timeline</h1></a>
                <p>This was built for a project for an art class in which we were required to create a geneology of artists of the past five hundred years and find a way to visually integrate it with contemporary historical events. I developed a simple interactive page in JavaScript in which three sections of the website scroll simultaneously - a gallery of paintings, a timeline of historical events, and a horizontal timeline at the top simply for visual integration purposes. One can then click on a historic event to find the corresponding artist, or click on a handful of selected influences underneath each artist to jump to that point in the timeline. </p>
             <h1>skwrk.com</h1>
                <p>The website you are currently reading was designed and coded by myself from scratch in HTML, CSS, and JavaScript. </p><br><br>
             </h1><center><img src="underconstruction.gif"></center><br>
             <p>More coming soon, I'm currently working on tweaking the projects I have done to a more professional standard for portfolio purposes.</p>
        </div>

        <div id="box2" class = "resume">
             <a href='#' onClick='hideBox2("resume"); return false;'><div class="xButton"></div></a>

             <div id= "resumeBody">
                 <h2>Maxwell S. Foley</h2>
                 <h3>2595 Bryden Rd. | Bexley, OH 43209 | (614) 378-1741</h3>
                 <hr>
                 <h4>Experience</h4>
                 <ul>
                     <li>Attended the Columbus Academy from fall of 1999 to spring of 2012.</li>
                         <ul>
                             <li>Was the co-founder and Chief Justice of the political club</li>
                             <li>Honorable Mention in the Scholastic Art and Writing awards</li>
                             <li>Achieved a score of 5 on eight separate Advanced Placement tests</li>
                         </ul>
                     <li>Attended the Rhode Island School of Design pre-college program as a painting major in the summer of 2012</li>
                     <li>Attended the Putney School from fall of 2012 to spring of 2013.</li>
                         <ul>
                             <li>Chose to spend a year at an alternative high school in order to broaden my horizons and have new experiences</li>
                         </ul>
                     <li>Currently am finishing graduation requirements at Washington University in St. Louis</li>
                         <ul>
                             <li>Completed a double major in studio art and computer science</li>
                             <li>Active in KWUR student radio and the Zeta Beta Tau fraternity</li>
                         </ul>
                     <li>Worked as an intern at the Department of Biomedical Informatics at the Ohio State University College of Medicine in summer of 2014</li>
                         <ul>
                             <li>
                                 Developed Java applet for analyzing miRNA data in cancer patients in order to determine which genes are linked with incidents of melanoma
                             </li>
                             <li>
                                 Designed web-based portal for nurses to relay information to elderly patients
                             </li>
                         </ul>
                     <li>Worked as a teaching assistant at St. Louis Chess Club and Scholastic Center in the summer of 2015</li>
                    <li>Worked on a two-man team to develop an educational video game about the carbon cycle in Adobe Flash</li>
                        <ul> The product was developed under a grant from the National Science Foundation and terrestrial ecologist Ann Elizabeth Russell of Iowa State University. </ul>
                    <li>Was a Software Development intern at Less Annoying CRM in the Summer of 2017, doing front-end web development in React</li>

                 </ul>
                 <h4>Skills</h4>
                 <ul>
                     <li>Coding (Java, Javascript, C++, Perl, Python, and others)</li>
                     <li>Web development (HTML, CSS, MySQL, PHP, JavaScript, Angular, React)</li>
                     <li>Drawing, painting, working with wood and metal</li>
                     <li>Photoshop, inDesign, Illustrator, Cinema 4D, Processing, Blender 3D, Abelton Live</li>
                     <li>Writing</li>
                 </ul>
             </div>


        </div>

    </div>
    <div id="box3container">
        <div id="box3" class="viewer">
             <a href='#' onClick='hideBox3(); return false;'><div class="xButton"></div></a>
             <div id="viewerImgDiv">
                 <a id="viewerImgLink"><img id="viewerImg" class="viewerImg"></a>

             <div id="viewerTitle"></div>

             <div id="viewerDescription"></div>

             <div id="viewerSelector"></div>
        </div>
    </div>




</body>

</html>
