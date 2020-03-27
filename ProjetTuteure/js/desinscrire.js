$(document).ready(function() {
    let bouton = document.querySelector('#desinscrire');
    bouton.addEventListener('click', function () {
        if (confirm("Etes vous-sur de vouloir vous désinscrire ?")){
            document.location.href="index.php?page=31";
        }
    });
});
