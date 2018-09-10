let form = document.getElementById("form");


const accessElemById = elId => document.getElementById(elId).value;

const formIsEmpty = arrFields => {
    return arrFields.some(field => field === "");
}


const formError = () => {
    let msg = "Formulário Incompleto "
}


form.addEventListener('submit', event => {

    let nome = accessElemById('first-name');
    let sobrenome = accessElemById('last-name');
    let ticket = accessElemById("ticket");
    let qtde = accessElemById("amount");

    let campos = [nome,sobrenome,ticket,qtde];

    if(formIsEmpty(campos)){
        event.preventDefault();
    }
})