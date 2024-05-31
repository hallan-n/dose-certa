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

function verifyPassword(){
    const password = document.getElementById("password");
    const confirm_pass = document.getElementById("password_confirm");
    const message = document.getElementById("message");

    if (password.value === confirm_pass.value) {
        return true
    }
    message.textContent = "Senhas divergentes!";
    return false
}

/**
 * Valida o valor do input e ajusta para a mascara de telefone.
 * @param {HTMLInputElement} element - Elemento HTML.
*/
function phoneMask(element){
    let start="", end="", state=""
    element.value = element.value.replace(/\(|\)| |-/g,"")
    if(element.value.length == 8){
        start = element.value.slice(0,4)
        end = element.value.slice(4)
    }else if(element.value.length == 9){
        start = element.value.slice(0,5)
        end = element.value.slice(5)
    }else if(element.value.length == 10){
        start = element.value.slice(2,6)
        end = element.value.slice(6)
        state = element.value.slice(0,2)
    }else if(element.value.length == 11){
        start = element.value.slice(2,7)
        end = element.value.slice(7)
        state = `(${element.value.slice(0,2)})`
    }if(element.value.length >= 8){
        element.value = `${state}${start}-${end}`
    }
}