/*!
    * Start Bootstrap - SB Admin v7.0.3 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});









$(document).ready(function(){ 
   
 
   
    
    
});




//************************FUNCIONES PARA EL SISTEMA*****************************************************
//*************usados solo en este sistema**********************************************************




//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<


//************************FUNCIONES UNIVERSALES*****************************************************
//*************usados en cualquier sistema**********************************************************

//INICIO ==========IDIOMA DE DATATABLED=============================================================

var base_url = window.location.origin + '/' +window.location.pathname.split('/')[1]; 

var dt_Idioma={		
    "sProcessing":     '<div class="row" style="display: block; z-index: 10000; background-color: rgb(222; 31; 41; 0); opacity: 1; border: none; color: #ECECEC;"><div class="col-md-12 py-3"><img src="'+ window.AppMain.url +'/public/images/carga_7.svg" > </br><h4>Procesando, espere por favor...</b></h4></div></div>',
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    //"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfo":           "Registros del _START_ al _END_ de un total de _TOTAL_ registros",
   // "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoEmpty":      "Registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}

//FIN ==========IDIOMA DE DATATABLED=============================================================




//INICIO ==========MENSAJE PROCESANDO =============================================================

//https://loading.io/  =>>>>> icono de carga
var blockUIMensaje={ 
    message : '<div class="row"><div class="col-md-12 py-3"><img src="'+ window.AppMain.url + '/public/images/carga_7.svg" > </br><h4>Procesando, espere por favor...</b></h4></div></div>',
    //message: '<h4><b><i class="fas fa-spinner fa-spin fa-2x"></i></br> Procesando, espere por favor...</b></h4>',
    css: {
        border: 'none', 
        width:	'35%',
       // padding: '15px 0px 15px 0px',    
        //backgroundColor: '#DE1F29', 
        
        backgroundColor: 'rgb(222, 31, 41, 0)', 
        '-webkit-border-radius': '10px', 
        '-moz-border-radius': '10px', 
        opacity: 1, 
        color: '#fff'  								
    }		              
}
//FIN ==========MENSAJE PROCESANDO=============================================================

var obtenerURL=function(key){ 
    key = key.replace(/[\[]/, '\\[');  
    key = key.replace(/[\]]/, '\\]');  
    var pattern = "[\\?&]" + key + "=([^&#]*)";  
    var regex = new RegExp(pattern);  
    var url = unescape(window.location.href);  
    var results = regex.exec(url);  
    if (results === null) {  
        return null;  
    } else {  
        return results[1];  
    }  
} 

//=============================INICIO ----- funciones para que solo acepte letras====================================
function soloLetras(e) {  // onkeypress="return soloLetras(event)"
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = [8, 9, 37, 39, 46];

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }
    if (letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}


//<input type="text" onkeypress="return soloLetras(e)" onblur="limpia()" id="miInput">  // <----como usarlo..

//============================= FIN ----- funciones para que solo acepte letras====================================

//=============================INICIO ----- funciones para que solo acepte numeros====================================
function soloNumeros(e) { // onkeypress="return soloNumeros(event)"
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    especiales = [8, 9, 37, 39, 46];

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }
    if (letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}

//============================= FIN ----- funciones para que solo acepte números====================================

//=============================INICIO ----- funciones para limpiar si lo ingresado no son letras====================================
function limpiaLetras(e) {  // 
    var val = e.value;
    var tam = val.length; 
    if (!val.match(/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]+$/)){
       e.value = '';
      // ToastError.fire({title: 'Solo ingresar letras.'}); 
    }    
}
//=============================FIN ----- funciones para que solo acepte numeros====================================

//=============================INICIO ----- funciones para limpiar si lo ingresado no son numeros ====================================
function limpiaNumeros(e) {  // 
    var val = e.value;
    var tam = val.length;
    for (i = 0; i < tam; i++) {
        if (isNaN(val[i]))
            e.value = '';
           // ToastError.fire({title: 'Solo ingresar números.'});
    }
}

//=============================FIN ----- funciones para que solo acepte numeros====================================


function mayus(e) { // convertir a mayuscula
    e.value = e.value.toUpperCase(); // con  onkeyup="mayus(this);"
}


function minus(e) { // convertir a mayuscula
    e.value = e.value.toLowerCase(); // con  onkeyup="mayus(this);"
}

//=============================INICIO ----- funcion datapicker fechas ====================================
var dp_fechas=function(frm){ 
    //$(frm).datepicker('reset',true);
    $(frm).datepicker({			
        format: "yyyy-mm-dd",
        clearBtn: true,
        language: "es",
        orientation: "buton auto",
        daysOfWeekHighlighted: "0,6",
        todayHighlight: true,
        showYearNavigation:false			
        //startDate: $inicio,
        //endDate: $fin		
    });
}

//=============================FIN ----- funcion datapicker fechas====================================

var limpirValidacion= function (frm){
   var validator = $(frm).validate();       
    validator.destroy();
    //validator.resetForm();  
    $(frm)[0].reset();// limpia el formulario 
    $(".error").removeClass("error");
    $(".valid").removeClass("valid");
}

//=============================INICIO ----- funciones para bloquear pantalla cuando se ejecuta un ajax ====================================
function removeWindows() {   
    // eliminamos el div que bloquea pantalla
    $("#WindowLoad").remove();
}

function showWindows(mensaje) {
    //eliminamos si existe un div ya bloqueando
    removeWindows();
   
    //si no enviamos mensaje se pondra este por defecto
    if (mensaje === undefined) mensaje = "Procesando la información<br>Espere por favor";
   
    //centrar imagen gif
    height = 20;//El div del titulo, para que se vea mas arriba (H)
    var ancho = 0;
    var alto = 0;
    
    //obtenemos el ancho y alto de la ventana de nuestro navegador, compatible con todos los navegadores
    if (window.innerWidth == undefined) ancho = window.screen.width;
    else ancho = window.innerWidth;
    if (window.innerHeight == undefined) alto = window.screen.height;
    else alto = window.innerHeight;
    
    //operación necesaria para centrar el div que muestra el mensaje
    var heightdivsito = alto/2 - parseInt(height)/2;//Se utiliza en el margen superior, para centrar
    
   //imagen que aparece mientras nuestro div es mostrado y da apariencia de cargando
    imgCentro = "<div style='text-align:center;height:" + alto + "px;'><div  style='color:#000;margin-top:" + heightdivsito + "px; font-size:20px;font-weight:bold'>" + mensaje + "</div><i class='fa fa-spinner fa-spin fa-3x fa-fw'></i></div>";

        //creamos el div que bloquea grande------------------------------------------
        div = document.createElement("div");
        div.id = "WindowLoad"
        div.style.width = ancho + "px";
        div.style.height = alto + "px";
        $("body").append(div);

        //creamos un input text para que el foco se plasme en este y el usuario no pueda escribir en nada de atras
        input = document.createElement("input");
        input.id = "focusInput";
        input.type = "text"

        //asignamos el div que bloquea
        $("#WindowLoad").append(input);
        
        //asignamos el foco y ocultamos el input text 
        $("#focusInput").focus();
        $("#focusInput").hide();
        
        //centramos el div del texto
        $("#WindowLoad").html(imgCentro);

}

//=============================FIN ----- funciones para bloquear cuando se ejecuta un ajax ====================================


//=============================INICIO ----- funciones para contar carateres en text area ====================================

function cuentaCaracteres(idtextarea, idcontador,max)
{
    $("#"+idtextarea).keyup(function()
            {
                updateContadorCaracteres(idtextarea, idcontador,max);
            });
    
    $("#"+idtextarea).change(function()
    {
            updateContadorCaracteres(idtextarea, idcontador,max);
    });
    
}

function updateContadorCaracteres(idtextarea, idcontador,max)
{
    var contador = $("#"+idcontador);
    var ta =     $("#"+idtextarea);
    contador.html("0/"+max);
    
    contador.html(ta.val().length+"/"+max);
    if(parseInt(ta.val().length)>max)
    {
        ta.val(ta.val().substring(0,max-1));
        contador.html(max+"/"+max);
    }

}

//=============================FIN ----- funciones para contar carateres en text area ====================================


//=============================INICIO ----- ALERTAS sweetalert2 ====================================

const ToastSuccess = Swal.mixin({
    toast: true,
    icon: 'success',
    background :  '#37BC9B',
    color : '#F8F8F8',
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 4000,
    timerProgressBar: true,
    showClass: {
        popup: 'animate__animated animate__bounceInRight'
    },	
    hideClass: {
        popup: 'animate__animated animate__fadeOutUp'
    },		
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

const ToastError = Swal.mixin({
    toast: true,
    icon: 'error',
    background :  '#DA4453',
    color : '#F8F8F8',
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 4000,
    timerProgressBar: true,
    showClass: {
        popup: 'animate__animated animate__bounceInRight'
    },	
    hideClass: {
        popup: 'animate__animated animate__fadeOutUp'
    },		
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})


const SwalConfirmacionCenter= Swal.mixin({
    title: 'Confirmar',
    //html: "¿Seguro(a) que desea <b class='text-primary h4'>registrar</b> esta información?",
    icon: 'question',
    position : 'center',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: '<b><i class="fa-solid fa-circle-check fa-lg"></i> Aceptar</b>',
    cancelButtonText: '<b><i class="fa-solid fa-circle-xmark fa-lg"></i> Cancelar</b>',
    allowOutsideClick : false,
    allowEscapeKey : false
})

const SwalConfirmacionTop= Swal.mixin({
    title: 'Confirmar',
    //html: "¿Seguro(a) que desea <b class='text-primary h4'>registrar</b> esta información?",
    icon: 'question',
    position : 'top',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: '<b><i class="fa-solid fa-circle-check fa-lg"></i> Aceptar</b>',
    cancelButtonText: '<b><i class="fa-solid fa-circle-xmark fa-lg"></i> Cancelar</b>',
    allowOutsideClick : false,
    allowEscapeKey : false
})

const SwalErrorCenter = Swal.mixin({
    title: 'Error...',
    //html: "<b class='h4'>"+data.error+"</b>",
    icon: 'error',    
    position : 'center',			
    confirmButtonColor: '#3085d6',				
    confirmButtonText: '<b><i class="fa-solid fa-circle-check fa-lg"></i> Aceptar</b>',					
    allowOutsideClick : false,
    allowEscapeKey : false
})

const SwalErrorTop = Swal.mixin({
    title: 'Error...',
    //html: "<b class='h4'>"+data.error+"</b>",
    icon: 'error',    
    position : 'top',					
    confirmButtonColor: '#3085d6',				
    confirmButtonText: '<b><i class="fa-solid fa-circle-check fa-lg"></i> Aceptar</b>',					
    allowOutsideClick : false,
    allowEscapeKey : false
})

const SwalSuccessCenter = Swal.mixin({
    title: 'Éxito...',
    //html: "<b class='h4'>"+data.success+"</b>",
    position : 'center',
    icon: 'success',
    confirmButtonColor: '#3085d6',
    confirmButtonText: '<b><i class="fa-solid fa-circle-check fa-lg"></i> Aceptar</b>',	
    allowOutsideClick : false,
    allowEscapeKey : false
})

const SwalSuccessTop= Swal.mixin({
    title: 'Éxito...',
    //html: "<b class='h4'>"+data.success+"</b>",
    position : 'top',
    icon: 'success',
    confirmButtonColor: '#3085d6',
    confirmButtonText: '<b><i class="fa-solid fa-circle-check fa-lg"></i> Aceptar</b>',	
    allowOutsideClick : false,
    allowEscapeKey : false
})



const SwalErrorServidor = Swal.mixin({
    title: 'Error...',
    html: "<b class='h4'>Error de Servidor, si el error persiste comunicarse con el administrador del sistema.</b>",
    icon: 'error',    
    position : 'center',			
    confirmButtonColor: '#3085d6',				
    confirmButtonText: '<b><i class="fa-solid fa-circle-check fa-lg"></i> Aceptar</b>',					
    allowOutsideClick : false,
    allowEscapeKey : false
})









//http://justindomingue.github.io/ohSnap/                 ->>>>>>>>>>>> colores

//=============================FIN ----- ALERTAS sweetalert2  ====================================



