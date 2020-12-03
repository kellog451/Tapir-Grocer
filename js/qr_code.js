/*--- QR code Generation. ----*/
var qr;
(function() {
				qr = new QRious({
				element: document.getElementById('qr-code'),
				size: 200,
				value: 'https://studytonight.com'
		});
})();

function generateQRCode(){
		var qrtext = document.getElementById("qr-text").value;
		document.getElementById("qr-result").innerHTML = "QR code for " + qrtext +":";
		document.getElementById("downloadbtn").style.display = "block";
		qr.set({
				foreground: 'black',
				size: 200,
				value: qrtext
		});
			
}


/*-------- download QR code link ------------- https://www.sanwebe.com/snippet/downloading-canvas-as-image-dataurl-on-button-click---*/
//var c = document.getElementById("qr-code");
//var ctx = c.getContext("2d");
//ctx.beginPath();

function download_image(){
  var canvas = document.getElementById("qr-code");
  image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
  var link = document.createElement('a');
  link.download = "my-image.png";
  link.href = image;
  link.click();
}
  
	

//check in and sign up inputs
var password = document.getElementById("pwd");
var confirmed_password = document.getElementById("pwd2");
var ic_number = document.getElementById("IC_Number");


//show and hide password values.
function ShowPassword() {
	if(password.type == "password"){
		$(".eyeshow").first().removeClass("fas fa-eye").addClass("fas fa-eye-slash");
		password.setAttribute("type", "text");
	}else{
		$(".eyeshow").first().removeClass("fas fa-eye-slash").addClass("fas fa-eye");
		password.setAttribute("type", "password");
	}			
}

//show and hide confirm password values.
function ShowPassword2() {
	
	if(confirmed_password.type == "password"){
		$(".eyeshow:eq(1)").removeClass("fas fa-eye").addClass("fas fa-eye-slash");
		confirmed_password.setAttribute("type", "text");
	}else{
		$(".eyeshow:eq(1)").removeClass("fas fa-eye-slash").addClass("fas fa-eye");
		confirmed_password.setAttribute("type", "password");
	}			
}

//simple password field validation
confirmed_password.onkeyup = function(){
	if (confirmed_password.value != password.value) {
		 confirmed_password.style.border = "solid 2px red";
	 }
	 else {
		 confirmed_password.style.border = "solid 2px #ccc";
	 }
};

//simple IC field validation
ic_number.onkeyup = function(){
	if ((ic_number.value.length < 8) || (ic_number.value.length > 12) ) {
		 ic_number.style.border = "solid 2px red";
	 }
	 else {
		 ic_number.style.border = "solid 2px #ccc";
	 }
};


//simple Temperature field validation
temperature.onkeyup = function(){
	if ((temperature.value < 0) || (ic_number.value > 50) ) {
		 temperature.style.border = "solid 2px red";
	 }
	 else {
		 temperature.style.border = "solid 2px #ccc";
	 }
};

