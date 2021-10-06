// function randomColor() {
//     return '#'+ ('000000' + (Math.random()*0xFFFFFF<<0).toString(16)).slice(-6)
// }

// function setBackImg(){
//     document.getElementById('backImg').style.backgroundColor = randomColor();
//     setTimeout(setColor, 2000);
// }
// setColor();

var images = new Array(
    './background_photos/img1.jpeg',
    './background_photos/img2.jpeg',
    './background_photos/img3.jpeg',
    './background_photos/img4.jpeg',
    './background_photos/img5.jpeg',
    './background_photos/img6.jpeg',
    './background_photos/img7.jpeg',
    './background_photos/img8.jpeg',
    './background_photos/img9.jpeg',
    './background_photos/img10.jpeg',
    './background_photos/img11.jpeg',
    './background_photos/img12.jpeg',
    './background_photos/img13.jpeg',
    './background_photos/img14.jpeg',
    './background_photos/img15.jpeg',
    './background_photos/img16.jpeg',
    './background_photos/img17.jpeg',
    './background_photos/img18.jpeg',
    './background_photos/img19.jpeg'
);

var slider = setInterval(function() {
    document.getElementsByClassName('backImg')[0].setAttribute('style', 'background-image: url("'+images[0]+'")');
    images.splice(images.length, 0, images[0]);
    images.splice(0, 1);
}, 5000);

