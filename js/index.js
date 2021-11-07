// Create an array containing all background images
var images = new Array(
    './img/img1.jpeg',
    './img/img2.jpeg',
    './img/img3.jpeg',
    './img/img4.jpeg',
    './img/img5.jpeg',
    './img/img6.jpeg',
    './img/img7.jpeg',
    './img/img8.jpeg',
    './img/img9.jpeg',
    './img/img10.jpeg',
    './img/img11.jpeg',
    './img/img12.jpeg',
    './img/img13.jpeg',
    './img/img14.jpeg',
    './img/img15.jpeg',
    './img/img16.jpeg',
    './img/img17.jpeg'
);

// Function that changes background image repeatedly every 4 seconds
var slider = setInterval(function() {
    document.getElementsByClassName('backImg')[0].setAttribute('style', 'background-image: url("'+images[0]+'")');
    images.splice(images.length, 0, images[0]);
    images.splice(0, 1);
}, 4000);

