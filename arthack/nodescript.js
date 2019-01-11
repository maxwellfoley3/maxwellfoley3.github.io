var eegData;

var thinkgear = require('node-thinkgear-sockets');
var http = require('http');
var url = require('url');

var client = thinkgear.createClient({ enableRawOutput: true });
console.log('testing');
client.on('data',function(data){
    // magical and wonderful things 
		eegData = data;
 		console.log(data);
});
client.connect();

var server = http.createServer(function(req, res) {
	var page = url.parse(req.url).pathname;
	res.writeHead(200);
	if(page==="/getEegData")
	{ 
		try{
			res.write(JSON.stringify(eegData)); 
		}
		catch(err) {
			res.write("could not write data, error: "+err);
		}
	}
	res.end();
});
server.listen(8080);