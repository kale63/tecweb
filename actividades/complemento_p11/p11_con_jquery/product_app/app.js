$(document).ready(function() {
    $('#product-result').hide();
    $('#product-status').hide();
    listarProductos();

    function handleProductSearch() {
        let search = $('#search').val();
        if (search) {
            $.ajax({
                url: 'backend/product-search.php',
                type: 'GET',
                data: { search },
                success: function(response) {
                    let productos = JSON.parse(response);
                    let template = '';
                    let template_bar = '';
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
                        template_bar += `<li>${producto.nombre}</li>`;
                    });
                    $('#product-result').show();
                    $('#product-status').hide();
                    $('#container').html(template_bar);
                    $('#products').html(template);
                }
            });
        }
    }

    $('#search').keyup(handleProductSearch);

    function handleFormSubmit(e) {
        e.preventDefault();
        let finalJSON = {
            id: $('#productId').val(),
            nombre: $('#name').val(),
            marca: $('#form-marca').val(),
            modelo: $('#form-modelo').val(),
            descripcion: $('#form-descripcion').val(),
            precio: parseFloat($('#form-precio').val()),
            unidades: parseInt($('#form-unidad').val()),
            img: $('#form-img').val()
        };

        let errores = validateFields(finalJSON);
        if (errores.length > 0) {
            $('#product-status').show();
            $('#product-result').hide();
            $('#status').html(errores.join('<br>'));
            return;
        }

        $.post('backend/product-add.php', JSON.stringify(finalJSON, null, 2), function(response) {
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
    }

    $('#product-form').submit(handleFormSubmit);

    function listarProductos() {
        $.ajax({
            url: 'backend/product-list.php',
            type: 'GET',
            success: function(response) {
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

    function handleProductDelete() {
        if (confirm('¿Estás seguro de querer eliminar el producto?')) {
            let id = $(this).closest('tr').attr('productId');
            $.ajax({
                url: 'backend/product-delete.php',
                type: 'GET',
                data: { id },
                success: function(response) {
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
    }

    $(document).on('click', '.product-delete', handleProductDelete);

    function handleProductItemClick() {
        let id = $(this).closest('tr').attr('productId');
        $.post('backend/product-single.php', { id }, function(response) {
            let product = JSON.parse(response);
            $('#name').val(product.nombre);
            $('#productId').val(product.id);
            $('#form-marca').val(product.marca || '0');
            $('#form-modelo').val(product.modelo);
            $('#form-descripcion').val(product.detalles);
            $('#form-precio').val(product.precio);
            $('#form-unidad').val(product.unidades);
            $('#form-img').val(product.img);
        });
    }

    $(document).on('click', '.product-item', handleProductItemClick);

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
                if (isNaN(producto.precio)) errores.push('El precio debe ser un número');
                else if (producto.precio <= 99.99) errores.push('El precio debe ser mayor a 99.99');
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
});
