const swal2 =  Object.freeze({
    show: function (args) {
        Swal.close(); let onOk = args.onOk, onCancel = args.onCancel, onCallback = args.onCallback; delete args['onOk']; delete args['onCancel']; delete args['onCallback']; args.allowEscapeKey = false; args.allowOutsideClick = false;
        return  new Promise((resolve, reject) => {
                    Swal.fire(args).then((result) => { if (result.isConfirmed) { if (onOk) onOk(); } else { if (onCancel) onCancel();} })
                    resolve();
                }).then(function () { if (onCallback) { onCallback(); } });
    },
    loading: function (hide = true) {
        if (hide === false) { return Swal.close(); } else { return Swal.fire({ text: 'Cargando ...', allowEscapeKey: false, allowOutsideClick: false, didOpen: () => { Swal.showLoading() } }); }
    }
});
window.swal2 = swal2;
