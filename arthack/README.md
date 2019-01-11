# mind-toy-art-hack

This is the code for an interactive art installation conceptualized and built in 48 hours for St. Louis's [Art Hack Day: Eclipse event](http://www.arthackday.net/events/eclipse-stlouis). The installation used a [NeuroSky MindWave Mobile](https://store.neurosky.com/pages/mindwave) EEG-reading headset, which was connected to my laptop via bluetooth, which ran this code and then used a projector to display an image on the wall. The idea was for the art piece to serve as a sort of impressionistic visualizer of one's mental activity, specifically how calm and/or focused the person using the headset was. 

[Click here](http://skwrk.com/arthack/demo.html) for a demo version of the installation with simple UI sliders that simulate the EEG parameters. In this way you can experience the piece without a headset.

To use the program with the headset, download the ThinkGearConnector program, which is bundled in [the developer tools on NeuroSky's website](http://developer.neurosky.com/docs/doku.php?id=mdt2.5). I used a Mac, no idea if it will work on Windows the same way or not. Use ThinkGearConnector to begin broadcasting the EEG data from the headset. 

Install the required npm module `node-thinkgear-sockets`, then run `nodescript.js`. Now in order to run the code for the visualizer in your browser, you have to find a way to enable cross-origin resource sharing, so that the web page can access the information from the node server. This will probably require downloading a browser extension, for Google Chrome I used one called ["Allow-Control-Allow-Origin: *"](https://chrome.google.com/webstore/detail/allow-control-allow-origi/nlfbmbojpeacfghkpbjhddihlkkiljbi).

Now you are good to go, open up `index.html` in your browser, and it should all be working. 

Obviously if you reuse or share an aspect of this project somewhere, please give proper credit and a link my way, thanks. 
