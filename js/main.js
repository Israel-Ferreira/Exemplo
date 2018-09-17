let form = document.getElementById("form");

const accessElemById = elId => document.getElementById(elId).value;

const formIsEmpty = arrF => arrF.some(field => field === "");

const accessInputs = arr => arr.map(id => accessElemById(id));


const formError = () => {
    let errorMsg = document.getElementById("err-msg");
    errorMsg.style.display = "block";
    errorMsg.textContent = "Campos Vazios!!";
}

const priceTrip =  opt => {
    if(opt === "Expresso da Meia Noite"){
        return 500;
    }else if(opt === "Passeio Panorâmico"){
        return 350;
    }else if(opt === "Passeio Normal"){
        return 250;
    }else{
        return 0;
    }
}


form.addEventListener('submit', event => {
    let ids = ["first-name","last-name","ticket","amount"];

    let campos = accessInputs(ids);

    if(formIsEmpty(campos)){
        event.preventDefault();
        formError();
    }
});





