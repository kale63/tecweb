document.getElementById('formularioProducto').addEventListener('submit', function(event) {
    event.preventDefault(); 

    const name = document.getElementById('form-name').value.trim();
    const brand = document.getElementById('form-brand').value.trim();
    const model = document.getElementById('form-model').value.trim();
    const price = document.getElementById('form-price').value.trim();
    const details = document.getElementById('form-details').value.trim();
    const units = document.getElementById('form-units').value.trim();
    const imgPath = document.getElementById('form-img-path').value.trim();
    
    if (!name || !brand || !model || !price || !details || !units || !imgPath) {
        alert('Por favor llena todos los campos.');
        return;
    }

    if (isNaN(price) || parseFloat(price) <= 0) {
        alert('El precio debe ser un número positivo.');
        return;
    }

    if (isNaN(units) || parseInt(units) <= 0) {
        alert('Las unidades deben ser un número mayor a 0.');
        return;
    }

    alert('Formulario válido, enviando...');
    document.getElementById('formularioProducto').submit();
});
