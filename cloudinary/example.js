/* SERVER CODE */
var Crypto = require('crypto');

function generateSignature() {
	var d = new Date();
	var requestObject = {};
	var	timestamp = Math.floor(d.getTime()/1000), // in seconds
		key = "sample";

	// Keys MUST be alphabetically in order
	requestObject['public_id'] = key;
	requestObject['timestamp'] = timestamp;

	// Generate signature and add
	requestObject['signature'] = generateSignature(jsonSerialize(requestObject));
	
	return requestObject;
}

function generateSignature(serialized) {
	return Crypto.createHash('sha1').update(serialized+SECRET_KEY).digest('hex');
}

function jsonSerialize(json) {
	return Object.keys(json).map(function(key) {
		return encodeURIComponent(key) + '=' +
		encodeURIComponent(json[key]);
	}).join('&');
}

/* CLIENT CODE */

// Takes response from generateSignature() call
function uploadFile(file, response, callback) {
	var fd = new FormData();
	fd.append('api_key', CONFIG.Cloudinary.accessKey);
	fd.append('timestamp', response.timestamp);
	fd.append('signature', response.signature);
	fd.append('file', file);

	var xhr = new XMLHttpRequest();
	xhr.upload.addEventListener('progress', uploadProgress, false);
	xhr.addEventListener('load', function(e) { callback(e, response); }, false);
	xhr.addEventListener('error', uploadFailed, false);
	xhr.addEventListener('abort', uploadCanceled, false);

	xhr.open('POST', CONFIG.Cloudinary.storage, true);
	xhr.send(fd);
}