const itemList = document.querySelector('.item-list');
const gridViewBtn = document.getElementById('grid-active-btn');
const detailsViewBtn = document.getElementById('details-active-btn');

gridViewBtn.classList.add('active-btn');

gridViewBtn.addEventListener('click', () => {
    gridViewBtn.classList.add('active-btn');
    detailsViewBtn.classList.remove('active-btn');
    itemList.classList.remove('details-active');
});

detailsViewBtn.addEventListener('click', () => {
    detailsViewBtn.classList.add('active-btn');
    gridViewBtn.classList.remove("active-btn");
    itemList.classList.add("details-active");
});


// DOUBLE SLIER 

const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const containerr = document.getElementById('containerr');

signUpButton.addEventListener('click', () => {
containerr.classList.add('right-panel-active');
});

signInButton.addEventListener('click', () => {
containerr.classList.remove('right-panel-active');
});