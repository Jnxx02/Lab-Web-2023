let dealerSum = 0;
let yourSum = 0;

let dealerAceCount = 0;
let yourAceCount = 0;

let hidden;
let deck;

let canHit = true;
let credit = 30000;
let betAmount = 0;
let gameInProgress = false;

window.onload = function () {
    buildDeck();
    shuffleDeck();
    document.getElementById("credit").textContent = "Credit: Rp. " + credit;
    document.getElementById("start").addEventListener("click", startGame);
}

function buildDeck() {
    let values = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
    let types = ["C", "D", "H", "S"];
    deck = [];

    for (let i = 0; i < types.length; i++) {
        for (let j = 0; j < values.length; j++) {
            deck.push(values[j] + "-" + types[i]);
        }
    }
    console.log(deck);
}

function shuffleDeck() {
    for (let i = 0; i < deck.length; i++) {
        let j = Math.floor(Math.random() * deck.length);
        let temp = deck[i];
        deck[i] = deck[j];
        deck[j] = temp;
    }
}

function startGame() {
    if (gameInProgress) {
        return;
    }

    const creditInput = document.getElementById("credit-input").value;
    const numericCreditInput = parseInt(creditInput);

    if (numericCreditInput < 5000) {
        alert("Minimal bet yang diperlukan adalah 5000.");
    } else if (numericCreditInput > credit) {
        alert("Credit kurang.");
    } else if (isNaN(numericCreditInput)) {
        alert("Minimal bet yang diperlukan adalah 5000.")
    } else {
        betAmount = numericCreditInput;
        credit -= betAmount;
        document.getElementById("credit").textContent = "Credit: Rp. " + credit;

        let newDealerCards = document.createElement("img");
        newDealerCards.src = "./cards/BACK.png";
        newDealerCards.id = "hidden";
        document.getElementById("dealer-cards").appendChild(newDealerCards);

        document.getElementById("dealer-cards").style.display = "none";
        document.getElementById("your-cards").style.display = "none";
        document.getElementById("dealer-sum").style.display = "block";
        document.getElementById("your-sum").style.display = "block";

        gameInProgress = true;

        hidden = deck.pop();
        dealerSum += getValue(hidden);
        dealerAceCount += checkAce(hidden);

        while (dealerSum < 17) {
            let cardImg = document.createElement("img");
            let card = deck.pop();
            cardImg.src = "./cards/" + card + ".png";
            dealerSum += getValue(card);
            dealerAceCount += checkAce(card);
            document.getElementById("dealer-cards").append(cardImg);
        }
        console.log(dealerSum);

        for (let i = 0; i < 2; i++) {
            let cardImg = document.createElement("img");
            let card = deck.pop();
            cardImg.src = "./cards/" + card + ".png";
            yourSum += getValue(card);
            yourAceCount += checkAce(card);
            document.getElementById("your-cards").append(cardImg);
        }

        console.log(yourSum);

        document.getElementById("dealer-cards").style.display = "block";
        document.getElementById("your-cards").style.display = "block";
        document.getElementById("credit-input").style.display = "none";

        document.getElementById("hit").addEventListener("click", hit);
        document.getElementById("hold").addEventListener("click", hold);
    }
}

function hit() {
    if (!canHit) {
        return;
    }

    let cardImg = document.createElement("img");
    let card = deck.pop();
    cardImg.src = "./cards/" + card + ".png";
    yourSum += getValue(card);
    yourAceCount += checkAce(card);
    document.getElementById("your-cards").append(cardImg);

    if (reduceAce(yourSum, yourAceCount) > 21) {
        canHit = false;
    }
}

function hold() {
    dealerSum = reduceAce(dealerSum, dealerAceCount);
    yourSum = reduceAce(yourSum, yourAceCount);

    canHit = false;
    document.getElementById("hidden").src = "./cards/" + hidden + ".png";

    let message = "";
    if (yourSum > 21) {
        message = "You Lose!";
        credit -= 3000;
    }
    else if (dealerSum > 21) {
        message = "You Win!";
        credit += betAmount * 2;
    }
    else if (yourSum == dealerSum) {
        message = "Tie!";
    }
    else if (yourSum > dealerSum) {
        message = "You Win!";
        credit += betAmount * 2;
    }
    else if (yourSum < dealerSum) {
        message = "You Lose!";
        credit -= 3000;
    }

    document.getElementById("dealer-sum").innerText = "Dealer: " + dealerSum;
    document.getElementById("your-sum").innerText = "You: " + yourSum;
    document.getElementById("results").innerText = message;
    document.getElementById("credit").textContent = "Credit: Rp. " + credit;

    if (credit <= 0) {
        alert("Your credit is empty. Game over!");
        quitGame();
    } else {
        gameInProgress = false;
        canHit = true;
        document.getElementById("start").textContent = "Try Again"
        document.getElementById("start").addEventListener("click", tryAgain);
    }
}

function quitGame() {
    location.reload;
}

function tryAgain() {
    buildDeck();
    shuffleDeck();
    console.log(deck);

    dealerSum = 0;
    yourSum = 0;
    dealerAceCount = 0;
    yourAceCount = 0;

    document.getElementById("dealer-sum").innerText = "Dealer: ";
    document.getElementById("your-sum").innerText = "You: ";
    document.getElementById("results").innerText = "";

    let dealerCards = document.getElementById("dealer-cards");
    dealerCards.innerHTML = "";

    let newDealerCards = document.createElement("img");
    newDealerCards.src = "./cards/BACK.png";
    newDealerCards.id = "hidden";
    document.getElementById("dealer-cards").appendChild(newDealerCards);

    let yourCards = document.getElementById("your-cards");
    yourCards.innerHTML = "";

    hidden = deck.pop();
    dealerSum += getValue(hidden);
    dealerAceCount += checkAce(hidden);

    while (dealerSum < 17) {
        let cardImg = document.createElement("img");
        let card = deck.pop();
        cardImg.src = "./cards/" + card + ".png";
        dealerSum += getValue(card);
        dealerAceCount += checkAce(card);
        document.getElementById("dealer-cards").append(cardImg);
    }
    console.log(dealerSum);

    for (let i = 0; i < 2; i++) {
        let cardImg = document.createElement("img");
        let card = deck.pop();
        cardImg.src = "./cards/" + card + ".png";
        yourSum += getValue(card);
        yourAceCount += checkAce(card);
        document.getElementById("your-cards").append(cardImg);
    }

    console.log(yourSum);

    document.getElementById("dealer-cards").style.display = "block";
    document.getElementById("your-cards").style.display = "block";

    document.getElementById("hit").addEventListener("click", hit);
    document.getElementById("hold").addEventListener("click", hold);
}

function getValue(card) {
    let data = card.split("-");
    let value = data[0];

    if (isNaN(value)) {
        if (value == "A") {
            return 11;
        }
        return 10;
    }
    return parseInt(value);
}

function checkAce(card) {
    if (card[0] == "A") {
        return 1;
    }
    return 0;
}

function reduceAce(playerSum, playerAceCount) {
    while (playerSum > 21 && playerAceCount > 0) {
        playerSum -= 10;
        playerAceCount -= 1;
    }
    return playerSum;
}
