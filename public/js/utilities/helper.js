var helper = {
    post: function (url, data, headers) {
        return new Promise(function (resolve, reject) {
            fetch(url, {method: "POST", body: data, headers: headers})
            .then(function(res){ return res.json(); })
            .then(function(rsp){
                if (rsp.status !== undefined) {
                    const status = [ 401, 404 ];
                    if (status.includes(rsp.status)) {
                        sweet2.loading({text:rsp.message});
                        setTimeout(() => {
                            window.location.reload();  
                        }, 3000);
                        return;
                    }
                }
                resolve(rsp);
            })
            .catch(function (err) {
                reject(err);
            });
        });
    },
    get: (url) => {
        return new Promise(function (resolve, reject) {
            fetch(url, {method: "GET"})
            .then(function(res){ return res.json(); })
            .then(function(rsp){
                resolve(rsp);
            })
            .catch(function (err) {
                reject(err);
            });
        });
    },
    datatable: {
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
               "sFirst": "Primero",
               "sLast": "Último",
               "sNext": "Siguiente",
               "sPrevious": "Anterior"
            },
            "oAria": {
               "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
               "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    },
    formSerialize: formElement => {
        const values = {};
        const inputs = formElement.elements;
        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].name) {
                values[inputs[i].name] = inputs[i].value;
            }
        }
        return values;
    },
    date: {
        getDayText: (key) => {
            switch (Number(key)) {
                case 1:  return 'Lunes';
                case 2:  return 'Martes';
                case 3:  return 'Miercoles';
                case 4:  return 'Jueves';
                case 5:  return 'Viernes';
                case 6:  return 'Sábado';
                case 7:  return 'Domingo';
            } 
            return 'Error';
        },
        getMounthText: (key) => {
            switch (Number(key)) {
                case 1: return 'Enero';
                case 2: return 'Febrero';
                case 3: return 'Marzo';
                case 4: return 'Abril';
                case 5: return 'Mayo';
                case 6: return 'Junio';
                case 7: return 'Julio';
                case 8: return 'Agosto';
                case 9: return 'Septiembre';
                case 10: return 'Octubre';
                case 11: return 'Noviembre';
                case 12: return 'Diciembre';
            }
            return 'Error';
        },
        getDateText: (date) => {
            let datetext = 'error';
            let parts = date.match(/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/);
            if (parts) {
                datetext = parts[3] + ' de ' + this.helper.date.getMounthText(parts[2]) + ' del ' + parts[1];
            }
            return datetext;
        }
    },
    loadingtext: function (args) { // bootstrap
        args.show = args?.show ? true : false;
        const element = document.getElementById(args?.scope);
        if (element) {
            element.style.cssText = `height: 60px;position: absolute;width: 70%;background-color: #fff;z-index: 25; left:0px; right: 0px;  box-shadow: 0 0 2px #A1A5B7; border-radius: 5px; margin: auto;`;
        }
        const myId = 'myprogress';
        if (args?.show && element) {
            let myparent = document.getElementById(myId);
            if (myparent) {
                myparent.remove();
            }
            const parent = document.createElement("div");
            parent.style.cssText = 'text-align: center; display:block; padding-top: 20px;';
            parent.id = myId;
            parent.innerHTML = `<h3>Cargando...</h3>`;
            element.append(parent);
        } else {
            if (element) {
                setTimeout(() => {
                    element.style.cssText = '';
                    element.removeChild(element.firstChild);                        
                }, 100);
            }
        }
    },
    addZero : (i) => {
        if (i < 10) {
          i = "0" + i;
        }
        return i;
    },
    uniqid: () => {
        return Math.floor(Math.random() * (new Date).getTime());
    },
    onlyNumberKey(evt) {
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    },
    onlyLetter: (event) => {
        console.log('>>>', event.key,/[a-z]/i.test(event.key));
        return /[a-z]/i.test(event.key);
    }

}