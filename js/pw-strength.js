var strength = {0: "Elendig 😰 - ",		1: "Dårlig 😟 - ",		2: "Svag 😐 - ",		3: "God 😃 !",		4: "Stærk 😋 !!!"};
//	var strength = {0: "Lousy 😰", 1: "Poor 😟", 2: "Weak 😐", 3: "Good 😃", 4 "Strong 😋"};
var passwrd = document.getElementById('password-strength-code');
var meter = document.getElementById('password-strength-meter');
var text = document.getElementById('password-strength-text');

passwrd.addEventListener('input', function()
{   var val = passwrd.value;
    var result = zxcvbn(val);
    meter.value = result.score;   // Update the password strength meter
    if(val !== "") {    					// Update the feedback text indicator
        text.innerHTML = "PW-Styrke: " + "<strong>" + strength[result.score] + "</strong>" + 
				"<span class='feedback'>" + result.feedback.warning + " " + result.feedback.suggestions + "</span"; 
    }  else { text.innerHTML = ""; }
});
//	https://css-tricks.com/password-strength-meter/