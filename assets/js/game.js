// the game itself
var game;
// the spinning wheel
var wheel; 
// can the wheel spin?
var canSpin;
var slices = 8;
// the prize you are about to win
var prize, degrees, gift;
// text field where to show the prize
var prizeText;

window.onload = function () {
    // creation of a 458x488 game
    game = new Phaser.Game(458, 488, Phaser.AUTO, "");
    // adding "PlayGame" state
    game.state.add("PlayGame", playGame);
    // launching "PlayGame" state
    game.state.start("PlayGame");
}

// PLAYGAME STATE

var playGame = function (game) { };

playGame.prototype = {
    // function to be executed once the state preloads
    preload: function () {
        // preloading graphic assets
        game.load.image("wheel", "../images/wheel.png");
        game.load.image("pin", "../images/quay.png");
    },
    // funtion to be executed when the state is created
    create: function () {
        // giving some color to background
        game.stage.backgroundColor = "#FFF";
        // adding the wheel in the middle of the canvas
        wheel = game.add.sprite(game.width / 2, game.width / 2, "wheel");
        // setting wheel registration point in its center
        wheel.anchor.set(0.5);
        // adding the pin in the middle of the canvas
        var pin = game.add.sprite(game.width / 2, game.width / 2, "pin");
        // setting pin registration point in its center
        pin.anchor.set(0.5);
        // adding the text field
        prizeText = game.add.text(game.world.centerX, 480, "");
        // setting text field registration point in its center
        prizeText.anchor.set(0.5);
        // aligning the text to center
        prizeText.align = "center";
        // the game has just started = we can spin the wheel
        canSpin = true;
        // waiting for your input, then calling "spin" function
        game.input.onDown.add(this.spin, this);
    },
    // function to spin the wheel
    spin: function () {
        // can we spin the wheel?
        if (canSpin) {
            // resetting text field
            prizeText.text = "";
            // the wheel will spin round from 3 to 5 times. This is just coreography
            var rounds = game.rnd.between(2, 4);
            var degrees = game.rnd.between(0, 360);
            prize = slices - 1 - Math.floor(degrees / (360 / slices));
            $.ajax({
                url : "/assets/ajax/wheel.php",
                method: "POST",
                async:  false,
                dataType: "json",
                data: {
                    spin: prize
                },

                complete: function (data) {
                    data = JSON.parse(data.responseText);
                    if (data.status == -1)
                    {
                        alert(data.errormessage);
                        return;
                    }
                    //degrees = data.degrees;
                    gift = data.gift;
                   
                    canSpin = false;
                    var spinTween = game.add.tween(wheel).to({
                    angle: 360 * rounds +  degrees
                     }, 3000, Phaser.Easing.Quadratic.Out, true);
                    // once the tween is completed, call winPrize function
                     spinTween.onComplete.add(function () {
                         // now we can spin the wheel again
                         canSpin = true;
                         // writing the prize you just won
                         prizeText.text = gift;
                     }, this);
                }
            });
           
        }
    },
     winPrize: function(){
          // now we can spin the wheel again
          canSpin = true;
          // writing the prize you just won
         // prizeText.text = slicePrizes[prize];
     }
  
}