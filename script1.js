document.addEventListener('DOMContentLoaded', function() {
    const contenedorPublicaciones = document.getElementById('contenedor-publicaciones');

    contenedorPublicaciones.addEventListener('click', function(event) {
        if (event.target.classList.contains('eliminar-btn')) {
            const idPublicacion = event.target.dataset.id;

            if (confirm('¿Estás seguro de que deseas eliminar esta publicación?')) {
                fetch('eliminar_publicacion.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + encodeURIComponent(idPublicacion),
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                     
                        event.target.parentNode.remove();
                    } else {
                        alert('Error al eliminar la publicación.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ocurrió un error al intentar eliminar la publicación.');
                });
            }
        }
    });
});