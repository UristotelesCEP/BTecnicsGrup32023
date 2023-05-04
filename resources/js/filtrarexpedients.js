const estatInput = document.getElementById('estat-filter');
const codiInput = document.getElementById('codi-filter');
let tablita = document.getElementById('tablita');

estatInput.addEventListener('input', filtrarTabla);
codiInput.addEventListener('input', filtrarTabla);

function filtrarTabla() {
    const estatFiltro = estatInput.value.toUpperCase();
    const codiFiltro = codiInput.value.toUpperCase();

    for (let i = 1; i < document.getElementById('tablita').rows.length; i++) {

        const estat = document.getElementById('tablita').rows[i].cells[0].textContent.toUpperCase();
        const codi = document.getElementById('tablita').rows[i].cells[1].textContent.toUpperCase();

        if (estat.includes(estatFiltro) && codi.includes(codiFiltro)) {
            document.getElementById('tablita').rows[i].style.display = '';
        } else {
            document.getElementById('tablita').rows[i].style.display = 'none';
        }
    }
}
