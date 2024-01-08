import ThermomixService from "./services/ThermomixService.js";

document.addEventListener('DOMContentLoaded', setup);


async function setup(_) {
    const service = new ThermomixService();
    addOptionsToSelect()
    addDishesOfSelect()
}


async function addOptionsToSelect() {
    const service = new ThermomixService();

    const nSelect = document.querySelector('#tSelLibros');
    const books = await service.getBooks();

    books.forEach(book => {
        const nOption = document.createElement('option')
        nSelect.appendChild(nOption);

        nOption.setAttribute('value', book.clave);
        nOption.textContent = book.titulo;
    });

}

function addDishesOfSelect() {
    const nSelect = document.querySelector('#tSelLibros')
    const nTds = document.querySelectorAll('.td');

    nSelect.addEventListener('change', addDishes);
    
}

async function addDishes(e) {
    const service = new ThermomixService();
    const codeOfSelect = e.target.value;
    const dishes = await service.getDishes(codeOfSelect);
    const nDivTable = document.querySelector('.table')

    nDivTable.innerHTML = '';

    const nTable = document.createElement('table');
    nDivTable.appendChild(nTable)

    dishes.forEach( dish => {
        const nTr = document.createElement('tr');
        nTable.appendChild(nTr);

        const nTdImage = document.createElement('td')
        nTdImage.setAttribute('data-code', dish.clave)
        nTr.appendChild(nTdImage)
        const nImg = document.createElement('img')
        nImg.setAttribute('src', `/fotos/${dish.foto}`)
        nTdImage.appendChild(nImg)

        const nTdDish = document.createElement('td');
        nTdDish.setAttribute('data-code', dish.clave)
        nTr.appendChild(nTdDish)
        nTdDish.textContent = dish.nombre;

    })

    const nTds = document.querySelectorAll('.td');
    
    nTds.forEach( td => {
        td.addEventListener('click', showInfo);
    })

}

function showInfo(e) {

    console.log('hola')
}