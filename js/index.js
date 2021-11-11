// Create an array containing all background images

var count = 1;

// Function that changes background image repeatedly every 4 seconds
var slider = setInterval(function() {

    nextImg = './img/img' + count + '.jpeg';
    document.getElementsByClassName('backImg')[0].setAttribute('style', 'background-image: url("' + nextImg + '")');
    count = (count + 1) % (4);
}, 4000);

// Function that displays content of the dropdown
function dropthebox() {
    document.getElementById("userdropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
    if (!e.target.matches('.dropbtn')) {
        var myDropdown = document.getElementById("myDropdown");
        if (myDropdown.classList.contains('show')) {
            myDropdown.classList.remove('show');
        }
    }
}