<html>
    <head>
        <title>Artist timeline</title>
        <link rel="stylesheet" type="text/css" href="artiststyle.css">    
    </head>
    <body>
        
            <script src="jquery-1.11.3.js"></script>

        <script>
         /*   window.onload=function(){

                console.log("WGGGWGWGWG");
                var c = document.getElementById("timelineCanvas");
                var ctx = c.getContext("2d");
                ctx.fillStyle = "#FF0000";
                ctx.fillRect(40,50,19900,10);

                ctx.fillStyle = "#000000";
                
                for(var i = 0; i < 500; i++)
                {
                    ctx.fillRect(100*i, 40, 40, 40);
                    ctx.arc(50, i*30, 30, 0, 2 * Math.PI, false);
                }
            }
        */
         
        
        function artist(name, decade,title,influences) {
            this.name = name;
            this.decade = decade;
            this.title = title;
            this.influences = influences;
        }

        function event(decade,year,name) {
            this.name = name;
            this.decade = decade;
            this.year = year;
        }
                
        var colors = new Array(50);
        
        var events = [new event(1510, 1517, "Martin Luther posts his 95 Theses"),
            new event(1520,1521, "Ferdinand Magellan encounters the Phillipines"), 
            new event(1530,0,""),
            new event(1540, 1543, "Copernicus publishes his theory in which he argues that the earth and other planets revolve around the sun"),
            new event(1550,0,""),
            new event(1560,0,""),
            new event(1570,0,""),
            new event(1580,0,""),
            new event(1590,0,""),
            new event(1600, 1605, "Guy Fawkes' 'gunpowder plot' is foiled"),
            new event(1610,0,""),
            new event(1620,0,""),
            new event(1630, 1633, "Galileo Galilei is tried"),
            new event(1640,0,""),
            new event(1650, 1651, "English Civil War ends"),
            new event(1660,0,""),
            new event(1670,0,""),
            new event(1680, 1688, "England becomes a constitutional monarchy"),
            new event(1690, 1692, "Salem witch trials"),
            new event(1700,0,""),
            new event(1710,0,""),
            new event(1720,0,""),
            new event(1730,0,""),
            new event(1740,0,""),
            new event(1750, 1756, "Seven Years War"),
            new event(1760,0,""),
            new event(1770,1776, "America declares independence"),
            new event(1780,1789, "French Revolution"),
            new event(1790,0,""),
            new event(1800,1804,"Napoleon becomes emperor of France"),
            new event(1810,0,""),
            new event(1820,0,""),
            new event(1830,0,""),
            new event(1840,1848,"The Communist Manifesto is published"),
            new event(1850,1859, "On the Origin of the Species is published"),
            new event(1860,1861, "American Civil War"),
                        new event(1870,0,""),
            new event(1880,0,""),
            new event(1890,0,""),
            new event(1900,0,""),

            new event(1910,1914, "World War I"), 
            new event(1920,0,""),
            new event(1930,1936, "Beginning of the Spanish Civil War"),
            new event(1940,1940, "World War II begins"),
            new event(1950,0,""),
            new event(1960,1962, "Cuban missile crisis"),
            new event(1970,0,""),
            new event(1980,1989, "Berlin wall falls"),
            new event(1990,0,""), 
            new event(2000,2001, "World Trade Center is attacked by Al-Qaeda"),
            new event(2010,0,"")];
        var artists = [

            new artist("Hieronymous Bosch", "1510", "The Temptation of St. Anthony",  [1550, 1560, 1900]),              
            new artist("Bernard van Orley", "1520", "Before the Crucifiction",        [1540, 1580, 1590]),        
            new artist("Jan Gossaert", "1530", "Adoration of the Kings",              [1660, 1870, 1910]), 
            new artist("Pieter Coeck van Aelst", "1540", "Adoration of the Magi",     [1560, 1570, 1790]), 
            new artist("Hieronymous Cock", "1550", "Gluttony",                        [1510, 1790, 1970]), 
            new artist("Pieter Bruegel the Elder", "1560", "The Fall of the Rebel Angels",  [1510, 1590, 1650]),              
            new artist("Michiel Coxie", "1570", "The Death of Abel",                  [1540, 1740, 2000]), 
            new artist("Pieter de Kempeneer", "1580", "Descent from the Cross",       [1520, 1890, 1940]),      
            new artist("Jan Breugel the Elder", "1590", "Garden of Eden",             [1560, 1780, 1910]),   
            new artist("Karel van Mander", "1600", "Garden of Love",                  [1730, 1850, 1930]), 
            new artist("Hendrik Goltzius", "1610", "Cadmus Slays the Dragon",              [1700, 1800, 2010]), 
            new artist("Frans Hals", "1620", "The Officers of the St Adrian Militia Company",          [1760, 1890, 1930]), 
            new artist("Adriaen van Ostade", "1630", "The Schoolmaster",                      [1750, 1780, 1810]),  
            new artist("David Teneris the Younger", "1640", "Guardroom",                    [1530, 1560, 1800]),  
            new artist("Pieter de Hooch", "1650", "Courtyard with an Arbour",               [1540, 1560, 1870]),  
            new artist("Jan Steen", "1660", "The Way You Hear It Is the Way You Sing It",   [1530, 1970, 2010]),     
            new artist("Jan Vermeer", "1670", "The Love Letter",                            [1830, 1860, 1890]), 
            new artist("Melchior d'Hondecoeter", "1680", "William III's Lowland Wars II",   [1920, 1990, 2010]),     
            new artist("Aert de Gelder", "1690", "Descent from the Cross",             [1610, 1840, 1910]), 
            new artist("Jan Weenix", "1700", "Game-piece: the Garden of a Chateau",       [1610, 1920, 1990]),          
            new artist("Peter Tillemans", "1710", "River Thames",                         [1850, 1870, 1950]), 
            new artist("Jean Antoine Watteau", "1720", "Rural Feast",                 [1780, 1850, 1870]),  
            new artist("Jean Francois de Troy", "1730", "The Judgement of Paris",    [1600, 1790, 2000]),            
            new artist("Charles Andre van Loo", "1740", "Drunken Silenus",           [1570, 1770, 1800]),       
            new artist("Francois Boucher", "1750", "Allegory of Painting",               [1530, 1610, 1930]), 
            new artist("Jean Baptiste Greuze", "1760", "Girl Weeping Over Her Dead Canary",        [1620, 1630, 1900]),    
            new artist("Joshua Reynolds", "1770", "Collina",                               [1850, 1880, 1960]), 
            new artist("Thomas Stothard", "1780", "The Dance",                            [1530, 1590, 1740]), 
            new artist("William Blake", "1790", "Eve Tempted by the Serpent",             [1550, 1730, 1900]),  
            new artist("Henry Fuseli", "1800", "Titania and Bottom",                      [1610, 1740, 1910]),  
            new artist("Theodore Gericault", "1810", "Evening Landscape with Aqueduct",     [1540, 1640, 1710]),  
            new artist("John Constable", "1820", "Salisbury Cathedral from the Meadows",     [1590,  1710, 1860]),           
            new artist("Eugene Delacroix", "1830", "Arabs Skirmishing in the Mountains",   [1620, 1670, 1780]),            
            new artist("Joseph Turner", "1840", "Fifth Plague of Egypt",                  [1690,  1980, 2000]), 
            new artist("Jean-Baptise Camille Corot", "1850", "Repose",                    [1600, 1620, 1750]),  
            new artist("Charles Francois Daubigny", "1860", "Riverbank in Moonlight",       [1670, 1720, 1820]),         
            new artist("Camille Pissarro", "1870", "The Hermitage at Pontoise",           [1590,    1710, 1930]), 
            new artist("Paul Gaugin", "1880", "When Will You Marry",                      [1650, 1770, 1960]), 
            new artist("Edvard Munch", "1890", "Anxiety",                                 [1580, 1670, 1940]),  
            new artist("Pablo Picasso", "1900", "Woman with Pigeons",                     [1760, 1790, 2010]),  
            new artist("Max Ernst", "1910", "Mundus est Fabula",                          [1530, 1690, 2000]),       
            new artist("Joan Miro", "1920", "Carnival of Harlequin",                      [1680, 1700, 1970]), 
            new artist("Arshile Gorky", "1930", "The Liver is the Cock's Comb",           [1600, 1620, 1750]),  
            new artist("Wilhelm De Kooning", "1940", "Woman I",                           [1580, 1900,  1990]), 
            new artist("Wladyslaw Dutkiewicz", "1950", "Shapes in Space 2",               [1710, 1860, 1900]), 
            new artist("Georg Baselitz", "1960", "Der Hirte",                             [1770, 1880, 2000]), 
            new artist("Phillip Guston", "1970", "The Rest is For You",                   [1550, 1660, 1920]), 
            new artist("Jorg Immendorf", "1980", "Cafe Deutschland",                      [1800, 1840, 1910]), 
            new artist("Cicily Brown", "1990", "High Society",                            [1510, 1680, 1940]), 
            new artist("Kent Williams", "2000", "Sea Foam",                               [1570, 1730, 1840]), 
            new artist("Joshua Hagler", "2010", "Red as Fever and White as a Ghost",       [1610, 1680, 1800])  

        ];
        
        function scrollMe()
        {
            $('#right').scrollTop(($('#left').scrollTop()/67)*3);
            $('#timeline').scrollLeft(($('#left').scrollTop()/670)*155);
        }
        

        
        function createTimeline()
        {
            var html = "";
            for(var i = 0; i < 50; i++)
            {
                var clr = hsvToRgb(i*5, 90, 90);
                var clrTxt = 'rgb(' + clr[0] + ',' + clr[1] + ',' + clr[2] + ')';                    

                colors[i] = clrTxt;
                
                var a = document.createElement('a');
                a.href = "#" + (1510+(10*i));
                var element = document.createElement("div");
                element.classList.add("timeLineChunk");
                a.appendChild(element);
                document.getElementById("timelineInner").appendChild(a);
                element.style.backgroundColor = colors[i];
                
               // html+= '<div class="timelineChunk" background-color="' + clrTxt + '">aaa</div>';
//                html+= '<div class="timelineChunk" bgcolor="' + clrTxt + '">aaa</div>';
                //html+= '<div class="timelineChunk" background-color="' + '#ff0000' + '">aaa</div>';

            }
            
                /*
                console.log("WGGGWGWGWG");
                var c = document.getElementById("timelineCanvas");
                var ctx = c.getContext("2d");
                ctx.fillStyle = "#FF0000";
                ctx.fillRect(40,50,19900,10);

                ctx.fillStyle = "#000000";
                
                for(var i = 0; i < 50; i++)
                {
                    var clr = hsvToRgb(i*5, 90, 90);
                    
                    console.log("clr " + clr.r);
                    ctx.fillStyle = 'rgb(' + clr[0] + ',' + clr[1] + ',' + clr[2] + ')';                    
                    ctx.fillRect(100*i, 40, 40, 40);
                    ctx.arc(50, i*30, 30, 0, 2 * Math.PI, false);
                }*/
                //document.getElementById("timelineInner").innerHTML = html;
                
            
            
        }
        function writeArtists()
        {
            console.log("writing");
            for(var i = 0; i < artists.length; i++)
            {
                var html = document.getElementById("left").innerHTML;
                var a = artists[i];
                html+= '<div class="artistbox">';
                html+= '<a name="'+a.decade+'"><div class="artistheading"><span class="decade ' + a.decade+ '">' + a.decade + 's</span></a>';
                html+= '<span class="artistName">' + a.name + '</span></div><br><br>';
                html+= '<div class="stupidThing"><div class="paintingBox"><img class="painting" src="artists/' + a.decade + '.jpg"></div></div>';
                html+= '<div class="paintingDescription">' + a.title + ' </div>';
                html+= '<br><br>';
                html+= '<span class="goto goto1 ' + i + '"><a href ="#' + artists[i].influences[0] + '">'+ artists[(artists[i].influences[0]-1510)/10].name + '</a></span>'; 
                html+= '<span class="goto goto2 ' + i + '"><a href ="#' + artists[i].influences[1] + '">'+ artists[(artists[i].influences[1]-1510)/10].name + '</a></span>'; 
                html+= '<span class="goto goto3 ' + i + '"><a href ="#' + artists[i].influences[2] + '">'+ artists[(artists[i].influences[2]-1510)/10].name + '</a></span>'; 
                html+= '<br>';    
                html+= '</div>';
                document.getElementById("left").innerHTML = html;
                document.getElementsByClassName("goto1 " + i)[0].style.borderColor = colors[(artists[i].influences[0]-1510)/10];
                document.getElementsByClassName("goto2 " + i)[0].style.borderColor = colors[(artists[i].influences[1]-1510)/10];
                document.getElementsByClassName("goto3 " + i)[0].style.borderColor = colors[(artists[i].influences[2]-1510)/10];

            }
            
            for(var i = 0; i < artists.length; i++)
            {
                document.getElementsByClassName("decade " + artists[i].decade)[0].style.color = colors[i];
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
           createTimeline();
            writeArtists();
            writeEvents();
        }, false);
        
        function writeEvents()
        {
            for(var i = 0; i < events.length; i++)
            {
                            var html = document.getElementById("right").innerHTML;

                html+='<div class="eventbox"><a href="#'+events[i].decade+'">';
                if (events[i].year != 0) {
                    html+='<span class="eventyear ' + i + '">' + events[i].year + '</span>';
                    html+='<span class="eventname">' + events[i].name + '</span>';

                }
                html+='</a></div>';
                            document.getElementById("right").innerHTML = html;
                if (events[i].year != 0) {

                                document.getElementsByClassName("eventyear " + i)[0].style.color = colors[i];
                }
                
            }
            
            
        }
    
        /**
         * HSV to RGB color conversion
         *
         * H runs from 0 to 360 degrees
         * S and V run from 0 to 100
         * 
         * Ported from the excellent java algorithm by Eugene Vishnevsky at:
         * http://www.cs.rit.edu/~ncs/color/t_convert.html
         */
        function hsvToRgb(h, s, v) {
                var r, g, b;
                var i;
                var f, p, q, t;
         
                // Make sure our arguments stay in-range
                h = Math.max(0, Math.min(360, h));
                s = Math.max(0, Math.min(100, s));
                v = Math.max(0, Math.min(100, v));
         
                // We accept saturation and value arguments from 0 to 100 because that's
                // how Photoshop represents those values. Internally, however, the
                // saturation and value are calculated from a range of 0 to 1. We make
                // That conversion here.
                s /= 100;
                v /= 100;
         
                if(s == 0) {
                        // Achromatic (grey)
                        r = g = b = v;
                        return [Math.round(r * 255), Math.round(g * 255), Math.round(b * 255)];
                }
         
                h /= 60; // sector 0 to 5
                i = Math.floor(h);
                f = h - i; // factorial part of h
                p = v * (1 - s);
                q = v * (1 - s * f);
                t = v * (1 - s * (1 - f));
         
                switch(i) {
                        case 0:
                                r = v;
                                g = t;
                                b = p;
                                break;
         
                        case 1:
                                r = q;
                                g = v;
                                b = p;
                                break;
         
                        case 2:
                                r = p;
                                g = v;
                                b = t;
                                break;
         
                        case 3:
                                r = p;
                                g = q;
                                b = v;
                                break;
         
                        case 4:
                                r = t;
                                g = p;
                                b = v;
                                break;
         
                        default: // case 5:
                                r = v;
                                g = p;
                                b = q;
                }
         
                return [Math.round(r * 255), Math.round(g * 255), Math.round(b * 255)];
        }
                
        </script>
        <div id="websiteName"><a href="index.php">go back to skwrk.com</a></div>
        <div id="container">
            <div id="header">
                500 years of painting
            </div>
            <div id="timeline">
                <div id="timelineInner">                </div>

                <div id="timelineLine"></div>
                <!--<canvas id="timelineCanvas" width="5000" height="90" style="border:1px solid #000000;"> </canvas>-->
                                        <div id="andOneEngraving">(AND ONE ENGRAVING)</div>

            </div>

            <div id="left" onscroll="scrollMe()" >
    
 
            </div>
            <div id = "right">

                   
                
                
            </div>
        
        </div>

    </body>
</html>