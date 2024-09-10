
// Show the popup if the gameover parameter is in the URL
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('gameover') && urlParams.get('gameover') === 'true') {
        const finalScore = urlParams.get('score');
        document.getElementById('gameoverPopup').style.display = 'block';

        // Display the final score inside the popup
        if (finalScore !== null) {
            document.getElementById('finalScore').innerText = "Your final score is: " + finalScore;
        }
    }
}