export default class ThermomixService {

    async getBooks() {
        const url = 'http://localhost/dwes/js/thermomix/controlador.php?operacion=obtener_libros'

        const response = await fetch(url);
        const data = await response.json();
        return data.libros;
    }

    async getDishes(code) {
        const url = 'http://localhost/dwes/js/thermomix//controlador.php?operacion=obtener_platos&libro=' + code;

        const response = await fetch(url);
        const data = await response.json();
        return data.platos;
    }

}