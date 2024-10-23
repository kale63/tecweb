// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/imagen.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
    // SE LISTAN TODOS LOS PRODUCTOS
    //listarProductos();
}

$(document).ready(function() {
    let edit = false;
  
    console.log('jquery funciona');
    fetchProducts();
    $('#product-result').hide();

  
    // busqueda
    $('#search').keyup(function(e) {
       if($('#search').val()) {
        let search = $('#search').val();
        $.ajax({
          url: 'backend/product-search.php',
          type: 'GET',
          data: {search},
          success: function (response) {
            //if(!response.error) {
              let products = JSON.parse(response);
              let template = '';
              let template2 = '';
              products.forEach(product => {
                let descripcion = '';
                descripcion += '<li>precio: '+product.precio+'</li>';
                descripcion += '<li>unidades: '+product.unidades+'</li>';
                descripcion += '<li>modelo: '+product.modelo+'</li>';
                descripcion += '<li>marca: '+product.marca+'</li>';
                descripcion += '<li>detalles: '+product.detalles+'</li>';
                    
                template += `
                    <tr productId="${product.id}">
                      <td>${product.id}</td>
                      <td><a href="#" class="product-item">
                        ${product.nombre}</a>
                      </td>
                      <td>${product.detalles}</td>
                      <td>
                      <button class="product-delete btn btn-danger">
                        Borrar 
                      </button>
                      </td>
                      </tr>
                    `;
                template2 += `<li><a href="#" class="product-item">
                      ${product.nombre}</a></li>`
              });
              console.log(template);
              console.log(template2);
              $('#product-result').show();
              $('#container').html(template2);
              $('#products').html(template);
            //}
          } 
        })
      }
    });
  
    $('#product-form').submit(e => {
      e.preventDefault();

        const name = $('#name').val().trim();

        var hilo = $('#description').val();
        var finalJSON = JSON.parse(hilo);
        finalJSON['nombre'] = $('#name').val();
        finalJSON['id'] = $('#productId').val();

        hilo = JSON.stringify(finalJSON, null, 2);


        // Validaciones
        if (name === '') {
            alert('El nombre del producto es requerido.');
            return;
        }

        if (isNaN(finalJSON.precio) || finalJSON.precio <= 99) {
          alert('El precio debe ser mayor a 99.');
          console.log(finalJSON.precio);
          return;
        }
      
        if (isNaN(finalJSON.unidades) || finalJSON.unidades <= 0) {
          alert('Las unidades deben ser un número mayor a 0.');
          return;
        }
      
        if (finalJSON.modelo === '' || finalJSON.marca === '' || finalJSON.detalles === '') {
          alert('Todos los campos (modelo, marca, detalles) son obligatorios.');
          return;
        }
      

      let url = edit === false ? 'backend/product-add.php' : 'backend/product-edit.php';
      $.post(url, hilo, function(response)  {
        fetchProducts();
        $('#product-form').trigger('reset');
        init();

        let resp = JSON.parse(response);
        let template = '';
        template += `
            <li style="list-style: none;">status: ${resp.status}</li>
            <li style="list-style: none;">message: ${resp.message}</li>
            `;
        $('#product-result').show();
        $('#container').html(template);
      });
        fetchProducts();
    });
  
    // recoger elementos
    function fetchProducts() {
      $.ajax({
        url: 'backend/product-list.php',
        type: 'GET',
        success: function(response) {
          const products = JSON.parse(response);
          let template = '';
          products.forEach(product => {
            template += `
                    <tr productId="${product.id}">
                    <td>${product.id}</td>
                    <td><a href="#" class="product-item">
                      ${product.nombre}</a>
                    </td>
                    <td>${product.detalles}</td>
                    <td>
                      <button class="product-delete btn btn-danger">
                       Borrar 
                      </button>
                    </td>
                    </tr>
                  `
          });
          $('#products').html(template);
        }
      });
    }
  
    //busqueda por ID
    $(document).on('click', '.product-item', function() {
      let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');
        $.post('backend/product-single.php', {id}, function(response){
            let product = JSON.parse(response);
            $('#name').val(product.nombre);
            $('#productId').val(product.id);
            console.log(product);
            
            delete product.id;
            delete product.nombre;
            let JSONProduct = JSON.stringify(product,null,2);
            $('#description').val(JSONProduct);
            edit = true;
        })
    })

    // borrar elementos
    $(document).on('click', '.product-delete', function() {
      if(confirm('De verdad quieres eliminarlo?')) {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');

        $.ajax({
          url: 'backend/product-delete.php',
          type: 'GET',
          data: {id},
          success: function(response) {
            let resp = JSON.parse(response);
            let template = '';
            template += `
                <li style="list-style: none;">status: ${resp.status}</li>
                <li style="list-style: none;">message: ${resp.message}</li>
                `;
            $('#product-result').show();
            $('#container').html(template);

            fetchProducts();
          }
        })
      }
    })    
  });