/*
	players is an array to hold each player's information.
	Fields:
		name - Football player's name
		img  - The relative/absolute path to the image file.
		alt  - The alternative text that describes the image.
		year - The student's year in college (Freshman, Sophomore, Junior, Senior).
		major- The student's current college major.
		games_played    - The number of football games the student has played for the Buffs.
		pass_yards      - The total number of passing yards in the student's football career for the Buffs.
		rushing_yards   - The total number of rushing yards in the student's football career for the Buffs.
		receiving_yards - The total number of receiving yards in the student's football career for the Buffs.
*/
var players = [{name:"John Doe", img: "../resources/img/player1.jpg", alt:"Image of Player 1", year:"Sophomore", major:"Art", games_played: 23, pass_yards: 435, rushing_yards: 200, receiving_yards: 88},
				{name:"James Smith", img: "../resources/img/player2.jpg", alt:"Image of Player 2", year:"Junior", major:"Science", games_played: 17, pass_yards: 192, rushing_yards: 102, receiving_yards: 344},
				{name:"Samuel Phillips", img: "../resources/img/player3.jpg", alt:"Image of Player 3", year:"Freshman", major:"Math", games_played: 8, pass_yards: 35, rushing_yards: 70, receiving_yards: 98},
				{name:"Robert Myers", img: "../resources/img/player4.jpg", alt:"Image of Player 4", year:"Senior", major:"Computer Science", games_played: 31, pass_yards: 802, rushing_yards: 375, receiving_yards: 128}];




				/* If toggle is 0 set the HTML element’s css visibility to hidden and the height to 0, but if toggle is 1 set the css visibility to visible and the height to auto. */

/*
	Registration Page:
		viewStudentStats(id, toggle) method
			parameters:
				id - The css id of the html tag being updated.
				toggle -
					0 - hide the html tag
					1 - make the html tag visible
					function viewStudentStats(id, toggle) {
					/* Get the HTML element with the given id */
					function viewStudentStats(id, toggle) {
					var x = document.getElementById(id);
					if (toggle == 0){
						x.style.visibility = "hidden";
						x.style.height = "0px";
					}
					else {
						x.style.visibility = "visible";
						x.style.height = "auto";
					}

				}


/*
	Home Page:
		changeColor(color) method
			parameter:
				color- A css color

			purpose: This method will set the html body's background color to the
					 provided parameter.
*/

				function changeColor(color) {
					/* Set the HTML body’s background color to color */
					document.body.style.backgroundColor = color;


}


/*
	Football Season Stats Page:
		loadStatsPage method:
			parameters: none

			purpose: This method will iterate through the stats table and
					 do the following:
						1. Read through each row of the table & determine which team won
						   the game.

						2. Update the winner column to the name of the winning team.

						3. Keep track of the number of wins/losses for the Buffs.

						4. Update the second table to show the total number of wins/losses for the Buffs.
*/
function loadStatsPage() {
/* Read through each team won the game */ /* Update the winner team */
/* Keep track of the

/* Update the second
for the Buffs */
var win= 0;
var lose = 0;

var table = document.getElementById("stats_table");
for (var i = 2; i < table.rows.length;i++) {
	//totgame ++;
	val1 = table.rows[i].cells[2];
	val2 = table.rows[i].cells[3];
	// converting to int
	var x = parseInt(val1.innerHTML);
	//console.log(x);	// print the value into the console
	var y = parseInt(val2.innerHTML);
	if (x > y){
		table.rows[i].cells[4].innerHTML = "CU Boulder";
		win++;
	}
	else{
		table.rows[i].cells[4].innerHTML = table.rows[i].cells[1].innerHTML;
		lose++;
	}
	//var w = document.getElementById("wins");
	document.getElementById("wins").innerHTML = win;
	//w.rows.innerHTML = win;
	//var l =
	document.getElementById("losses").innerHTML = lose;
	//l.rows.innerHTML = lose;
   //iterate through rows
   //rows would be accessed using the "row" variable assigned in the for loop

}
}


function loadPlayersPage(){

//var select = document.getElementById("player_selector");
var string = "";
for (var i = 0 ; i < players.length; i++){
//	document.getElementById("player_selector").innerHTML = players[i].name
 //var anchor
 string += '<a href ="#" onclick ="switchPlayers('+ i +')">'+ players[i].name +"</a><br>";
 //select.innerHTML += anchor;
}
document.getElementById("player_selector").innerHTML = string;
}


function switchPlayers(playerNum) {
//	for(i = 0 ; players.length; i++){
	//if (players[i].name == 'John Doe')
	document.getElementById("p_year").innerHTML = players[playerNum].year;
	document.getElementById("p_major").innerHTML = players[playerNum].major;
	document.getElementById("g_played").innerHTML = players[playerNum].games_played;
	document.getElementById("p_yards").innerHTML = players[playerNum].pass_yards;
	document.getElementById("avg_p_yards").innerHTML = parseInt(players[playerNum].pass_yards/players[playerNum].games_played);
	document.getElementById("r_yards").innerHTML = players[playerNum].rushing_yards;
	document.getElementById("avg_r_yards").innerHTML = parseInt(players[playerNum].rushing_yards/players[playerNum].games_played);
	document.getElementById("rec_yards").innerHTML = players[playerNum].receiving_yards;
	document.getElementById("avg_rec_yards").innerHTML = parseInt(players[playerNum].receiving_yards/players[playerNum].games_played);
	document.getElementById("player_img").src = players[playerNum].img;
//	document.getElementById("player_img").alt= players[playerNum].alt;
//	document.getElementById("player_selector").innerHTML = playerNum.name;
	//document.getElementById("r_yards").innerHTML = players[playerNum].year;

}//




/* Update the HTML span tag on the player’s information page and calculate the average passing, rushing, and receiving yards. */
//}


//function start() { func1();
//func2(); }
//window.onload = start;


/*
	Football Player Information Page
		loadPlayersPage method:
			parameters: none

			purpose: This method will populate the dropdown menu to allow the
					 user to select which player's information to view.

					 To handle this, you will need to iterate through the players array
					 and do the following for each player:
						1. Create an anchor tag
						2. Set the href to "#", this will make sure the
							anchor tag doesn't change pages
						3. Set the onclick to call switchPlayers method
							(this will need to pass in the index inside the players array)
						4. Set the anchor tag's text to the player's name.

					After setting all of the anchor tags, update the innerHTML of the dropdown menu.
					As a note, the id for the dropdown menu is player_selector.

		switchPlayers(playerNum) method:
			parameters:
				playerNum - The index of the football player in the players array.

			purpose:
				This method will update the the spans on the player's information pageX
				and calculate the average passing, rushing, and receiving yards.

				Span ids:
					p_year     - the player's year in college
					p_major    - the player's major in college
					g_played   - the number of games played for Buffs
					player_img - the player's photo (must set src and alt)
					p_yards    - the number of passing yards
					r_yards    - the number of rushing yards
					rec_yards  - the number of receiving yards

					Calculated values:
					  avg_p_yards   - the average number of passing yards for the player's Buff career
					  avg_r_yards   - the average number of rushing yards for the player's Buff career
					  avg_rec_yards - the average number of receiving yards for the player's Buff career
*/
