document.getElementById('formularioProducto').addEventListener('submit', function(event) {
    event.preventDefault(); 

    const name = document.getElementById('form-name').value.trim();
    const brand = document.getElementById('form-brand').value;
    const model = document.getElementById('form-model').value.trim();
    const price = document.getElementById('form-price').value.trim();
    const details = document.getElementById('form-details').value.trim();
    const units = document.getElementById('form-units').value.trim();
    const imgPath = document.getElementById('form-img-path').value.trim() || 'practicas/p09/img/imagen.png';
    
    if (!name) {
        alert('El nombre es un campo requerido.');
        return;
    }

    if(name.length > 100) {
        alert('El nombre debe ser menor a 100 caracteres.');
        return;
    }

    if (!brand || brand === 'default') {
        alert('La marca debe seleccionarse.');
        return;
    }

    if (!model) {
        alert('El modelo es un campo requerido.');
        return;
    }

    if (model.length > 25) {
        alert('El modelo debe ser menor a 25 caracteres.');
        return;
    }

    if (!price) {
        alert('El precio es un campo requerido. debe ser mayor a $99.99.');
        return;
    }

    if (parseFloat(price) <= 99.99) {
        alert('El precio debe ser mayor a $99.99.');
        return;
    }

    if (details && details.length > 250) {
        alert('Los detalles deben ser menor a 250 caracteres.');
        return;
    }

    if (!units) {
        alert('Las unidades es un campo requerido.');
        return;
    }

    if (parseInt(units) <= 0) {
        alert('Las unidades deben ser un número mayor a 0.');
        return;
    }

    alert('Formulario válido, enviando...');
    document.getElementById('formularioProducto').submit();
});
