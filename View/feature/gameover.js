
// Show the popup if the gameover parameter is in the URL
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('gameover') && urlParams.get('gameover') === 'true') {
        document.getElementById('gameoverPopup').style.display = 'block';
    }
};