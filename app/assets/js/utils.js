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

function visibilityPass(){
    const visibilityPass = document.getElementById("visibility-pass")
    const password = document.getElementById("password")

    if (password.type == "password") {
        visibilityPass.textContent = "visibility"
        password.type = "text"
    }else{
        visibilityPass.textContent = "visibility_off"
        password.type = "password"
    }
}