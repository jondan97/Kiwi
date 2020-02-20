/* Detects if user is using TAB to select clickable elements 
and enables the selector ring */
function handleFirstTab(e) {
    if (e.keyCode === 9) { // the "I am a keyboard user" key
        document.body.classList.add('user-is-tabbing');
        window.removeEventListener('keydown', handleFirstTab);
    }
}

window.addEventListener('keydown', handleFirstTab);

// Preloader

var overlay = document.getElementById("overlay");

window.addEventListener('load', function(){
  overlay.style.display = 'none';
}) 

// Animated Typing 

var typed = new Typed('#typed',{
  stringsElement: '#typed-strings',
 
  typeSpeed: 50,
});