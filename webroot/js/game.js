//Global variables >>>>>>>>>>>>>>>>>>>>>>>
function openModal(content) {
    document.getElementById("modal-body").innerHTML= content;

    document.getElementById("backdrop").style.display = "block"
    document.getElementById("gameModal").style.display = "block"
    document.getElementById("gameModal").classList.add("show")
}
function closeModal() {
    document.getElementById("backdrop").style.display = "none"
    document.getElementById("gameModal").style.display = "none"
    document.getElementById("gameModal").classList.remove("show")
}
// Get the modal
var modal = document.getElementById('gameModal');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    closeModal()
  }
}

var yourMove;
var dragonMove;
var saveddragonMove;
var yourHealth = 100;
var dragonHealth = 100;

//Turn powerattacks >>>>>>>>>>>>>>>>>>>>>>>>>>
var givenup = 0;
var totRounds = 0;
var count = 50;
var timer;

//Doument rewrites >>>>>>>>>>>>>>>>>>>>>>>

var res;
var playByPlay = document.getElementById('announcements');
var yourHealthBar = document.getElementById('yourHealthBar');
var dragonHealthBar = document.getElementById('dragonHealthBar');
var attackButton = document.getElementById('attack');
var powerattackButton = document.getElementById('powerattack');
var healButton = document.getElementById('heal');
var giveupButton = document.getElementById('giveup');
var startButton = document.getElementById('start');
var playAgain = document.getElementById('playAgain');
var countdown = document.getElementById('countdown');
var uid =  parseInt(document.getElementById('uid').value);

//Run on load >>>>>>>>>>>>>>>>>>>>>>>>>>>>
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

function enableButtons() {
	attackButton.disabled = false;
	powerattackButton.disabled = false;
	healButton.disabled = false;
	giveupButton.disabled = false;
}

function clock() {
    timer = setInterval(function() {
	startButton.disabled = true;
	countdown.innerHTML = count--;

	if(count == 0) {
		startButton.disabled = false;
		res = 'gameOver!';
		clearInterval(timer);
		if (yourHealth > dragonHealth ) { 
			let file_data = 'Win from timing';
			history('Win',uid,file_data); 
			openModal('You Win');
		}
		else if (yourHealth < dragonHealth ) { 
			let file_data = 'Lose from timing';
			history('Lose',uid,file_data); 
			openModal('Dragon Win');
		}
		else {
			let file_data = 'Draw from timing';
			history('Draw',uid,file_data); 
			openModal('Draw');
		}
		roundResults(res);
		attackButton.disabled = true;
		powerattackButton.disabled = true;
		//playAgain.disabled = true;
		healButton.disabled = true;
		giveupButton.disabled = true;
	}

}, 1000);

}


// triggers the fight in the HTML
function fight(id) {
	addRound();
	dragonMove(id);
	healthChange();
	gameOver();
}
// adds a round to the round powerattacks
function addRound() {
	totRounds += 1;
}

//adds the powerattack action to attack
function powerattack(y, c) {
	var move = Math.floor((Math.random()*5));
	if (move >= 3 && y === 'attack') {
		res = 'Dragon powerattack was successful! You deal damage!';
		yourHealth -= Math.floor((Math.random()*11)+1);
	} else if (move >= 3 && y === 'powerattack') {
		res = 'Your powerattack was successful! Dragon got damage';
		dragonHealth -= Math.floor((Math.random()*11)+1);
	} else if (move < 3 && y === 'attack') {
		res = 'Dragon powerattack failed! You deal damage!';
		dragonHealth -= Math.floor((Math.random()*11)+1);
	} else if (move < 3 && y === 'powerattack') {
		res = 'Your powerattack was not successful! You deal damage!';
		yourHealth -= Math.floor((Math.random()*11)+1);
	}

}

// Dislpays results of the round
function roundResults(res) {
	playByPlay.innerHTML += res + "<br>";
}

function healthChange() {
	yourHealthBar.style.width = yourHealth + "%";
	yourHealthBar.innerHTML = yourHealth;
	dragonHealthBar.style.width =  dragonHealth + "%";
	dragonHealthBar.innerHTML = dragonHealth;
}

function gameOver() {
	if (yourHealth === 0 || dragonHealth === 0) {
	
		res = 'gameOver!';
		if(yourHealth === 0) { 
			let file_data = playByPlay.innerHTML;
			history('Lose',uid,file_data); 
			openModal('Dragon Win');
		}
		else if (dragonHealth === 0) {
			let file_data = playByPlay.innerHTML;
			history('Lose',uid,file_data); 
			openModal('You Win');
		}
		else { 
			let file_data = playByPlay.innerHTML;
			history('Lose',uid,file_data); 
			openModal('Draw');
		}
		clearInterval(timer);
		roundResults(res);
		attackButton.disabled = true;
		powerattackButton.disabled = true;
		playAgain.style.display = "block";
		playAgain.style.margin = "0 auto";
		startButton.style.display = "none";
		healButton.disabled = true;
		giveupButton.disabled = true;
	}
}

//The Game >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

// Takes the moves of the player and generates one for the Dragon and then runs the damage step
function dragonMove(id) {
	var move = Math.floor((Math.random()*4)+1);
	if (move <= 3) {
		saveddragonMove =  'attack';
	} else {
		saveddragonMove = 'powerattack';
	};
	res = ('Your move is <span>'+ id + '</span> and the Dragon move is <span>' + saveddragonMove + '</span> on round ' + totRounds);
	damageStep(id, saveddragonMove);
	roundResults(res);

}

//proccesses the moves to a result
function damageStep(y, c) {
	if ( y === 'giveup' ) {
		res = 'You have given up! Better try next time';
		yourHealth = 0;
		clearInterval(timer);
	}
	
	else if ( y === 'heal' && c === 'attack' ) {
		res = 'Your heal was not successful';
		if (dragonHealth >= 10 && yourHealth >= 10) {
			yourHealth -= 10;
		} else {
			yourHealth = 0;
		}
	}

	else if ( y === 'heal' && c === 'powerattack' ) {
		res = 'Your heal was successful';
		if (dragonHealth >= 10 && yourHealth >= 10) {
			yourHealth += 10;
		} else {
			yourHealth = 0;
		}
	}

	else if ( y === 'attack' && c === 'attack' ) {
		res = 'Both players took damage';
		if (dragonHealth >= 10 && yourHealth >= 10) {
			dragonHealth -= 10;
			yourHealth -= 10;
		} else {
			dragonHealth = 0;
			yourHealth = 0;
		}
	} else if ( y === 'powerattack' && c === 'powerattack') {
		res = 'Defensive stances taken in vain';
	} else if ( y === 'attack' && c === 'powerattack') {
		res = 'Dragon took a defensive stance and prepares to powerattack';
		powerattack(y, c);
	} else if ( y === 'powerattack' && c === 'attack') {
		res = 'You took a defensive stance and prepare to powerattack';
		powerattack(y, c);
	}
}

function history(res,uid,file_data) {
	    var xhr = new XMLHttpRequest();
		xhr.open("POST", '/users/history', true);

		//Send the proper header information along with the request
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		xhr.onreadystatechange = function() { // Call a function when the state changes.
			if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
				// Request finished. Do processing here.
			}
		}
		xhr.send('result='+res+'&uid='+uid+''+'&file_data='+file_data);
}


window.onload=enableButtons();