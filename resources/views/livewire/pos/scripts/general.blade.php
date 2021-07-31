<script>
    $('.tblscroll').nicescroll({
        cursorcolor: "#7B0000",
        cursorwidth: "30px", 
        background: "rgb(90, 11, 10)",
        cursorborder: "0px", 
        cursorborderradius: 3
    })



    function Confirm(id, eventName, text) {
        swal({
            title: 'CONFIRMAR',
            text: text,
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonColor: '#ff0000',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('eventName', id)
                swal.close()
            }
        })
</script>