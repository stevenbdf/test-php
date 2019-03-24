//Constante para establecer la ruta y parámetros de comunicación con la API
const apiUsuarios = './core/api/usuarios.php?site=dashboard&action=';

//Función para llenar tabla con los datos de los registros
function getUser()
{
    $.ajax({
        url: apiUsuarios + 'read',
        type: 'post',
        data: null,
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (!result.status) {
                console.log('error')
            }
            $("#codigo").val(result.dataset[0].idUsuario)
            $("#correo").val(result.dataset[0].correo)
            $("#contrasena").val(result.dataset[0].contraseña)
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

function addUser()
{
    $.ajax({
        url: apiUsuarios + 'create',
        type: 'post',
        data: {
            correo: $("#correo").val(),
            contraseña: $("#contrasena").val() 
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                alert('Exito, usuario guardado')
            } else {
                console.log(result.exception)
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

function updateUser()
{
    $.ajax({
        url: apiUsuarios + 'update',
        type: 'post',
        data: {
            id: 1,
            correo: $("#correo").val(),
            contraseña: $("#contrasena").val() 
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                alert('Exito, usuario modificado')
            } else {
                console.log(result.exception)
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}


