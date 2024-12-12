//Usa un ciclo for o forEach para recorrer el arreglo e imprimir los nombres y apellidos en un div en la página.
function estudiantes() {
    let output = "";
    const estudiantesArray = [
        {
            nombre: "Juan",
            apellido: "Pérez",
            nota: 85
        },
        {
            nombre: "María",
            apellido: "González",
            nota: 90
        },
        {
            nombre: "Carlos",
            apellido: "Ramírez",
            nota: 78
        },
        {
            nombre: "Ana",
            apellido: "López",
            nota: 92
        }
    ];

    for (let i = 0; i < estudiantesArray.length; i++) {
        output += estudiantesArray[i].nombre + " " + estudiantesArray[i].apellido + ".<br>";
    }

    document.getElementById("result").innerHTML = output;
}

