function getDatos() {
    var nombre = prompt('Nombre: ', '');
    var edad = prompt('Edad: ', 0);

    var div1 = document.getElementById('nombre');
    div1.innerHTML = '<h3>Nombre: ' + nombre + '</h3>';
    
    var div2 = document.getElementById('edad');
    div2.innerHTML = '<h3>Edad: ' + edad + '</h3>';
}

function helloWorld() {
    var div = document.getElementById('ej1');
    div.innerHTML = '<h3>Hola Mundo 🦦</h3>';
}

function datos() {
    var nombre = 'Juan';
    var edad = 10;
    var altura = 1.52;
    var casado = false;

    var div = document.getElementById('ej2');
    div.innerHTML = `<h4>Nombre: ${nombre}</h4><p>Edad: ${edad}</p><p>Altura: ${altura}m</p><p>Casado: ${casado}</p>`;
}

function intro() {
    var nombre;
    var edad;
    
    nombre = prompt('Ingresa tu nombre:', '');
    edad = prompt('Ingresa tu edad:', '');

    var div = document.getElementById('ej3');
    div.innerHTML = `<h3>Hola ${nombre}, asi que tienes ${edad} años.</h3>`;
}

function dosNums() {
    var valor1;
    var valor2;

    valor1 = prompt('Introducir primer número:', '');
    valor2 = prompt('Introducir segundo número:', '');

    var suma = parseInt(valor1) + parseInt(valor2);
    var producto = parseInt(valor1) * parseInt(valor2);

    var div = document.getElementById('ej4');
    div.innerHTML = `<p>La suma es: ${suma}</p><p>El producto es: ${producto}</p>`;
}

function nota() {
    var nombre;
    var nota;

    nombre = prompt('Ingresa tu nombre:', '');
    nota = prompt('Ingresa tu nota:', '');

    var div = document.getElementById('ej5');
    if (nota >= 4) {
        div.innerHTML = `<h3>${nombre} está aprobado con un ${nota}</h3>`;
    }
}

function numMayor() {
    var num1, num2;

    num1 = prompt('Ingresa el primer número:', '');
    num2 = prompt('Ingresa el segundo número:', '');
    num1 = parseInt(num1);
    num2 = parseInt(num2);

    var mayor = (num1 > num2) ? num1 : num2;

    var div = document.getElementById('ej6');
    div.innerHTML = `<h3>El mayor es ${mayor}</h3>`;
}

function promedio() {
    var nota1, nota2, nota3;

    nota1 = prompt('Ingresa 1ra. nota:', '');
    nota2 = prompt('Ingresa 2da. nota:', '');
    nota3 = prompt('Ingresa 3ra. nota:', '');
    nota1 = parseInt(nota1);
    nota2 = parseInt(nota2);
    nota3 = parseInt(nota3);

    var pro;
    pro = (nota1 + nota2 + nota3) / 3;

    var div = document.getElementById('ej7');
    if (pro >= 7) {
        div.innerHTML = '<h3>Aprobado</h3>';
    } else if (pro >= 4) {
        div.innerHTML = '<h3>Regular</h3>';
    } else {
        div.innerHTML = '<h3>Reprobado</h3>';
    }
}

function escribirNum() {
    var valor;
    valor = prompt('Ingresar un valor comprendido entre 1 y 5:', '');
    valor = parseInt(valor);

    var div = document.getElementById('ej8');
    switch (valor) {
        case 1: div.innerHTML = '<h3>Uno</h3>'; break;
        case 2: div.innerHTML = '<h3>Dos</h3>'; break;
        case 3: div.innerHTML = '<h3>Tres</h3>'; break;
        case 4: div.innerHTML = '<h3>Cuatro</h3>'; break;
        case 5: div.innerHTML = '<h3>Cinco</h3>'; break;
        default: div.innerHTML = '<h3>Debe ingresar un valor entre 1 y 5.</h3>';
    }
}

function colorFondo() {
    var col;
    col = prompt('Ingresa el color con que quieras pintar el fondo de la pestaña (rojo, verde, azul)', '');

    switch (col) {
        case 'rojo': document.bgColor = '#ff0000'; 
                    break;
        case 'verde': document.bgColor = '#00ff00'; 
                    break;
        case 'azul': document.bgColor = '#0000ff'; 
                    break;
    }
}

function repeticion() {
    var x;
    x = 1;
    var output = '';

    var div = document.getElementById('ej10');
    
    while (x <= 100) {
        output += x + '<br>';
        x = x + 1;
    }
    
    div.innerHTML = output;
}

function valores() {
    var x = 1;
    var suma = 0;
    var valor;

    while (x <= 5) {
        valor = prompt('Ingresa el valor:', '');
        valor = parseInt(valor);
        suma = suma + valor;
        x = x + 1;
    }

    var div = document.getElementById('ej11');
    div.innerHTML = "La suma de los valores es " + suma;
}

function digitos() {
    var valor;
    var output = '';

    var div = document.getElementById('ej12');
    do {
        valor = prompt('Ingresa un valor entre 0 y 999:', '');
        valor = parseInt(valor);

        output += 'El valor ' + valor + ' tiene ';
        if (valor < 10) {
            output += '1 dígito';
        } else { 
            if (valor < 100) {
                output += '2 dígitos';
            } else {
                output += '3 dígitos';
            }
        }
        output += '<br>';
    } while (valor != 0);

    div.innerHTML = output;
}

function cicloFor() {
    var f;
    var output = '';
    var div = document.getElementById('ej13');

    for (f =1; f <= 10; f++) {
        output += f + '<br>';
    }

    div.innerHTML = output;
}

function aviso() {
    var output = '';
    var div = document.getElementById('ej14');

    output += 'Cuidado<br>';
    output += 'Ingresa tu documento correctamente<br>';
    output += 'Cuidado<br>';
    output += 'Ingresa tu documento correctamente<br>';
    output += 'Cuidado<br>';
    output += 'Ingresa tu documento correctamente<br>';
    
    div.innerHTML = output;
}

function mostrarMensaje() {
    var output = 'Cuidado<br>Ingresa tu documento correctamente<br>';
    return output;
}

function avisoFunction() {
    var output = '';
    var div = document.getElementById('ej15');

    for (var i = 1; i <= 3; i++) {
        output += mostrarMensaje();
    }

    div.innerHTML = output;
}

function mostrarRango(x1, x2) {
    var inicio;
    var output = '';

    var div = document.getElementById('ej16');
    for (inicio = x1; inicio <= x2; inicio++) {
        output +=  inicio + '<br>';
    }

    div.innerHTML = output;
}

function usarRango() {
    var valor1, valor2;

    valor1 = prompt('Ingresa el valor inferior:', '');
    valor1 = parseInt(valor1);
    valor2 = prompt('Ingresa el valor superior:', '');
    valor2 = parseInt(valor2);

    mostrarRango(valor1, valor2);
}

function convertirCastellano(x) {
    if (x == 1)
        return "uno";
    else
        if (x == 2)
            return "dos";
        else
            if (x == 3)
                return "tres";
            else
                if(x == 4)
                    return "cuatro";
                else
                    if (x == 5)
                        return "cinco";
                    else
                        return "valor incorrecto";
}

function usarConvertidor() {
    var valor = prompt('Ingresa un valor entre 1 y 5', '');
    valor = parseInt(valor);

    var div = document.getElementById('ej17');
    var r = convertirCastellano(valor);
    div.innerHTML =  r;
}

function convertirEsp(x) {
    switch (x) {
        case 1: return "uno";
        case 2: return "dos";
        case 3: return "tres";
        case 4: return "cuatro";
        case 5: return "cinco";
        default: return "valor incorrecto";
    }
}

function usarConvertidorv2() {
    var valor = prompt('Ingresa un valor entre 1 y 5', '');
    valor = parseInt(valor);

    var div = document.getElementById('ej18');
    var r = convertirEsp(valor);
    div.innerHTML =  r;
}