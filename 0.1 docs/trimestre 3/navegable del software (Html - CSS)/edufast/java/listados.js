
const datos = [
        { nombres: 'Juan Andres', apellidos: 'Romero Olivares', grado: 'Grado 0', curso: '0-05', jornada: 'Mañana', enlace: 'matriculas_vista.html' },
        { nombres: 'Maria Fernanda', apellidos: 'López García', grado: 'Grado 1', curso: '1-01', jornada: 'Tarde', enlace: 'matriculas_vista.html' },
        { nombres: 'Carlos Eduardo', apellidos: 'Pérez Rodríguez', grado: 'Grado 2', curso: '2-02', jornada: 'Mañana', enlace: 'matriculas_vista.html' },
        { nombres: 'Ana Sofía', apellidos: 'Martínez Sánchez', grado: 'Grado 1', curso: '1-03', jornada: 'Tarde', enlace: 'matriculas_vista.html' },
        { nombres: 'Luis Felipe', apellidos: 'Gómez Torres', grado: 'Grado 3', curso: '3-01', jornada: 'Mañana', enlace: 'matriculas_vista.html' },
        { nombres: 'Camila Andrea', apellidos: 'Ramírez Castro', grado: 'Grado 2', curso: '2-05', jornada: 'Tarde', enlace: 'matriculas_vista.html' },
        { nombres: 'Jorge Enrique', apellidos: 'Morales Díaz', grado: 'Grado 0', curso: '0-02', jornada: 'Mañana', enlace: 'matriculas_vista.html' },
        { nombres: 'Valeria Isabel', apellidos: 'Vargas Ríos', grado: 'Grado 1', curso: '1-02', jornada: 'Tarde', enlace: 'matriculas_vista.html' },
        { nombres: 'Santiago José', apellidos: 'Mejía Pardo', grado: 'Grado 2', curso: '2-04', jornada: 'Mañana', enlace: 'matriculas_vista.html' },
        { nombres: 'Natalia Paola', apellidos: 'Ortiz Ramírez', grado: 'Grado 3', curso: '3-03', jornada: 'Tarde', enlace: 'matriculas_vista.html' },
        { nombres: 'Andrés Felipe', apellidos: 'Salazar Mendoza', grado: 'Grado 0', curso: '0-03', jornada: 'Mañana', enlace: 'matriculas_vista.html' },
        { nombres: 'Daniela Sofía', apellidos: 'Navarro Gutiérrez', grado: 'Grado 2', curso: '2-03', jornada: 'Tarde', enlace: 'matriculas_vista.html' }
    ];
    

    function updateTable() {
        const gradoSelect = document.getElementById("gradoSelect").value;
        const jornadaSelect = document.getElementById("jornadaSelect").value;
    
        const tbody = document.querySelector("#dataTable tbody");
        tbody.innerHTML = "";
    
        const filteredData = datos.filter(item => 
            item.grado === gradoSelect && item.jornada === jornadaSelect
        );
    
        filteredData.forEach(item => {
            const row = document.createElement("tr");
    
            const cellnombres = document.createElement("td");
            const cellapellidos = document.createElement("td");
            const cellGrado = document.createElement("td");
            const cellCurso = document.createElement("td");
            const cellJornada = document.createElement("td");
    
            cellnombres.textContent = item.nombres;
            cellapellidos.textContent = item.apellidos;
            cellGrado.textContent = item.grado;
            cellCurso.textContent = item.curso;
            cellJornada.textContent = item.jornada;
    
            row.appendChild(cellnombres);
            row.appendChild(cellapellidos);
            row.appendChild(cellGrado);
            row.appendChild(cellCurso);
            row.appendChild(cellJornada);
    
            tbody.appendChild(row);
        });
    }
    