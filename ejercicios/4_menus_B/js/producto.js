document.addEventListener('DOMContentLoaded', setup);

function setup(_) {
    setProduct();
}

function setProduct() {
    const product = JSON.parse(localStorage.getItem('product'));
    console.log(product) 

    const div = document.querySelector('.product');

    const right = document.createElement('div');
    right.setAttribute('class', 'right');
    const left = document.createElement('div');
    left.setAttribute('class', 'left');
    div.appendChild(right);
    div.appendChild(left);

    const nImg = document.createElement('img');
    nImg.setAttribute('src', product.image);
    right.appendChild(nImg);

    const nH2 = document.createElement('h2');
    nH2.textContent = product.title;
    left.appendChild(nH2);

    const nPrice = document.createElement('strong');
    nPrice.textContent = product.price + '$';
    left.append(nPrice);

    const nCategory = document.createElement('p');
    nCategory.textContent = product.category;
    left.appendChild(nCategory);

    const nDescription = document.createElement('p');
    nDescription.textContent = product.description;
    left.appendChild(nDescription);

}