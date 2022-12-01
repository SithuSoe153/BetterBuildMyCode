window.scrollTo(0, 0);

// Convert the div to image (canvas)
html2canvas(document.getElementById('capture')).then(function(canvas) {

// Get the image data as JPEG and 0.9 quality (0.0 - 1.0)
console.log(canvas.toDataURL('image/jpeg', 0.9));

var ajax = new XMLHttpRequest();


ajax.open('POST', 'save-capture.php', true);


ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');


ajax.send('imagesave=' + canvas.toDataURL('image/jpeg', 0.9));

ajax.onreadystatechange = function() {

if (this.readyState == 4 && this.status == 200) {

console.log(this.responseText);
}

};

if (alert('You will receive the mail after the checkout process!')) {

}

});