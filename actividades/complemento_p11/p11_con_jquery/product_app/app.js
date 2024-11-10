$(document).ready(function () {
    $('#product-result').hide();
    $('#product-status').hide();
    listarProductos();

    $('#search').keyup(function(e) {
        $('#form-marca').prop('selectedIndex', 0); 
    
        if ($('#search').val()) {
            let search = $('#search').val(); 
            
            $.ajax({
                url: 'backend/product-search.php', 
                type: 'GET',
                data: { search }, 
                success: function(response) {
                    console.log(response); 
                    let productos = response;  
                    let template = '';  
                    let template_bar = ''; 
                
                    if (productos.length > 0) {
                        productos.forEach(producto => {
                            let descripcion = '';
                            descripcion += `<li>precio: ${producto.precio}</li>`;
                            descripcion += `<li>unidades: ${producto.unidades}</li>`;
                            descripcion += `<li>modelo: ${producto.modelo}</li>`;
                            descripcion += `<li>marca: ${producto.marca}</li>`;
                            descripcion += `<li>detalles: ${producto.detalles}</li>`;
                        
                            template += `
                                <tr productId="${producto.id}">
                                    <td>${producto.id}</td>
                                    <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                    <td><ul>${descripcion}</ul></td>
                                    <td><button class="product-delete btn btn-danger" onclick="eliminarProducto()">Eliminar</button></td>
                                </tr>
                            `;
                
                            template_bar += `<li>${producto.nombre}</li>`;
                        });
                
                        $('#product-result').show();
                        $('#product-status').hide();
                
                        $('#container').html(template_bar);
                        $('#products').html(template);
                    } else {
                        $('#product-result').hide();
                        $('#product-status').show().html('<li>No se encontraron productos.</li>');
                    }
                }
                ,
                error: function(xhr, status, error) {
                    console.error("Error in AJAX request:", error);

                    $('#product-result').hide();
                    $('#product-status').show().html('<li>Error al realizar la búsqueda. Intenta nuevamente.</li>');
                }
            });
        }
    });
    
    $('#name').keyup(function() {
        let productName = $('#name').val().trim();
    
        console.log("User is typing:", productName); 
    
        $('#name-feedback').show(); 
    
        if (productName.length > 0) {
            console.log("Sending request to server with product name:", productName);
    
            $.ajax({
                url: 'backend/product-name.php',
                method: 'GET',
                data: { name: productName },
                success: function(response) {
                    console.log('Server response:', response);
            
                    if (typeof response === 'string') {
                        try {
                            response = JSON.parse(response); 
                        } catch (e) {
                            console.error('Error parsing JSON:', e);
                        }
                    }
            
                    if (response.exists) {
                        $('#name-feedback').text('Este nombre ya existe!').show();
                    } else {
                        $('#name-feedback').text('Este nombre esta disponible!').show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error);
                }
            });
            
        } else {
            console.log("Input is empty"); 
    
            $('#name').css('border', '');
            $('#name-feedback').text("");
        }
    });
    
    $('#product-form').submit(function (e) {
        e.preventDefault();
        let finalJSON = {
            id: $('#productId').val(),
            nombre: $('#name').val(),
            marca: $('#form-marca').val(),
            modelo: $('#form-modelo').val(),
            descripcion: $('#form-descripcion').val(),
            precio: parseFloat($('#form-precio').val()) || 0,  
            unidades: parseInt($('#form-unidad').val()) || 0,  
            img: $('#form-img').val()
        };

        let errores = validateFields(finalJSON);
        if (errores.length > 0) {
            $('#product-result').show();
            $('#product-status').hide();
            $('#container').html(`<li style="color: red;">${errores.join('<br>')}</li>`);
            return;
        }

        $.post('backend/product-add.php', JSON.stringify(finalJSON, null, 2), function (response) {
            let respuesta = JSON.parse(response);
            if (respuesta.status === 'success') {
                listarProductos();
                $('#product-form').trigger('reset');
            }
            $('#product-result').show();
            $('#product-status').show();
            $('#container').html(`
                <li style="list-style: none;">status: ${respuesta.status}</li>
                <li style="list-style: none;">message: ${respuesta.message}</li>
            `);
        });
    });

    $('#name').on('input', () => validateForm());
    $('#form-marca').on('input', () => validateForm());
    $('#form-modelo').on('input', () => validateForm());
    $('#form-precio').on('input', () => validateForm());
    $('#form-unidad').on('input', () => validateForm());
    $('#form-descripcion').on('input', () => validateForm());

    function validateFields(producto) {
        let errores = [];
        const validators = {
            nombre: () => {
                if (!producto.nombre) errores.push('El nombre del producto es requerido');
            },
            marca: () => {
                if (!producto.marca) errores.push('La marca del producto es requerida');
            },
            modelo: () => {
                if (!producto.modelo) errores.push('El modelo del producto es requerido');
                else if (!/^[a-zA-Z0-9-]+$/.test(producto.modelo)) errores.push('Solo caracteres alfanumericos en el modelo');
                else if (producto.modelo.length > 25) errores.push('El modelo no debe exceder los 25 caracteres');
            },
            precio: () => {
                if (isNaN(producto.precio) || producto.precio <= 99.99) errores.push('El precio debe ser un número mayor a 99.99');
            },
            unidades: () => {
                if (producto.unidades <= 0) errores.push('Las unidades deben ser mayores a 0');
            },
            descripcion: () => {
                if (producto.descripcion && producto.descripcion.length > 255) errores.push('La descripción no puede exceder los 255 caracteres');
            }
        };

        for (let field in validators) {
            validators[field]();
        }

        return errores;
    }

    function validateForm() {
        let finalJSON = {
            nombre: $('#name').val(),
            marca: $('#form-marca').val(),
            modelo: $('#form-modelo').val(),
            precio: parseFloat($('#form-precio').val()) || 0,
            unidades: parseInt($('#form-unidad').val()) || 0,
            descripcion: $('#form-descripcion').val()
        };

        let errores = validateFields(finalJSON);
        let successMessages = [];

        if (!errores.length) {
            if (finalJSON.nombre) successMessages.push('Nombre del producto: Aceptable');
            if (finalJSON.marca) successMessages.push('Marca del producto: Aceptable');
            if (finalJSON.modelo && finalJSON.modelo.length <= 25) successMessages.push('Modelo del producto: Aceptable');
            if (finalJSON.precio > 99.99) successMessages.push('Precio del producto: Aceptable');
            if (finalJSON.unidades > 0) successMessages.push('Unidades del producto: Aceptable');
            if (!finalJSON.descripcion || finalJSON.descripcion.length <= 255) successMessages.push('Descripción del producto: Aceptable');
        }

        if (errores.length > 0) {
            $('#product-result').show();
            $('#product-status').hide();
            $('#container').html(`
                <li style="color: red;">${errores.join('<br>')}</li>
            `);
        } else {
            $('#product-result').show();
            $('#product-status').show();
            $('#container').html(`
                <li>${successMessages.join('<br>')}</li>
            `);
        }
    }

    function listarProductos() {
        $.ajax({
            url: 'backend/product-list.php',
            type: 'GET',
            success: function (response) {
                let productos = JSON.parse(response);
                let template = '';
                productos.forEach(producto => {
                    let descripcion = `
                        <li>precio: ${producto.precio}</li>
                        <li>unidades: ${producto.unidades}</li>
                        <li>modelo: ${producto.modelo}</li>
                        <li>marca: ${producto.marca}</li>
                        <li>detalles: ${producto.detalles}</li>
                    `;
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td><a href="#" class="product-item">${producto.nombre}</a></td>
                            <td><ul>${descripcion}</ul></td>
                            <td><button class="product-delete btn btn-danger">Eliminar</button></td>
                        </tr>
                    `;
                });
                $('#products').html(template);
            }
        });
    }

    $(document).on('click', '.product-delete', function () {
        if (confirm('¿Estás seguro de querer eliminar el producto?')) {
            let id = $(this).closest('tr').attr('productId');
            $.ajax({
                url: 'backend/product-delete.php',
                type: 'GET',
                data: { id },
                success: function (response) {
                    let respuesta = JSON.parse(response);
                    $('#product-result').show();
                    $('#product-status').hide();
                    $('#container').html(`
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `);
                    listarProductos();
                }
            });
        }
    });
});
