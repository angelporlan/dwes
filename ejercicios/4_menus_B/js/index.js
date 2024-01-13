document.addEventListener('DOMContentLoaded', setup);

function setup(_) {
    itemStore();
}

async function itemStore() {
    const dataItems = await item();
    console.log(dataItems);

    const container = document.querySelector('.container');

    dataItems.forEach(data => {
        const nProduct = document.createElement('div');
        nProduct.setAttribute('class', 'product');

        container.appendChild(nProduct);

        const nRight = document.createElement('div');
        const nLeft = document.createElement('div');
        nRight.setAttribute('class', 'right');
        nLeft.setAttribute('class', 'left');
        nProduct.appendChild(nRight);
        nProduct.appendChild(nLeft);

        const nImg = document.createElement('img');
        nImg.setAttribute('src', data.image);
        nRight.appendChild(nImg);

        const nH2 = document.createElement('h2');
        nH2.textContent = data.title;
        nLeft.appendChild(nH2);

        const nPrice = document.createElement('b');
        nPrice.textContent = data.price + '$';
        nLeft.append(nPrice);

        const nCategory = document.createElement('p');
        nCategory.textContent = data.category;
        nLeft.appendChild(nCategory);

        const nButton = document.createElement('div');
        nButton.setAttribute('class', 'button-product');
        nButton.textContent = 'Ir al producto';
        nProduct.appendChild(nButton);

        const nStart = document.createElement('div');
        nStart.setAttribute('class', 'start-rate');

        if (Math.round(data.rating.rate) === 2) {
            nStart.textContent = '★★☆☆☆';
        }
        if (Math.round(data.rating.rate) === 3) {
            nStart.textContent = '★★★☆☆';
        }
        if (Math.round(data.rating.rate) === 4) {
            nStart.textContent = '★★★★☆';
        }
        if (Math.round(data.rating.rate) === 5) {
            nStart.textContent = '★★★★★';
        }

        nProduct.appendChild(nStart);

    });

}

async function item() {
    const response = await fetch('https://fakestoreapi.com/products/');
    const json = await response.json();
    return json;
}