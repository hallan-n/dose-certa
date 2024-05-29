/**
 * Valida o valor do input e ajusta para estar entre 0 e 23.
 * @param {HTMLInputElement} element - Elemento HTML.
 * @param {String} maxTime - Valor máximo.
*/
function setMaxTime(element, maxTime){
    const [maxHours, maxMinutes] = maxTime.split(':').map(Number);
    const [hours, minutes] = element.value.split(':').map(Number);

    if (hours > maxHours || (hours === maxHours && minutes > maxMinutes)) {
        element.value = maxTime; 
    }
}