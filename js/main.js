let form = document.getElementById("form");
let tckSel = document.getElementById("ticket");

const accessElemById = elId => document.getElementById(elId).value;

const formIsEmpty = arrF => arrF.some(field => field === "");

const checkIsEmpty = arrCheck => arrCheck.every(cb => !cb.checked);

const accessInputs = arr => arr.map(id => accessElemById(id));

const priceSel = val => {
    if(val === "Passeio Normal"){
        return 250;
    }else if(val === "Passeio Panorâmico"){
        return 350;
    }else if(val === "Expresso da Meia Noite"){
        return 500;
    }else{
        return 0;
    }
}



tckSel.addEventListener('change',event => {
    let sel = event.target.value;
    priceChanged(sel)
});




const priceChanged = (eVal) => {
    let price = priceSel(eVal);
    document.getElementById("price").innerHTML = price.toFixed(2).toString();
}



const formError = () => {
    let msg = "Campos Vazios!!";
    let errorMsg = document.getElementById("err-msg");
    errorMsg.style.display = "block";
    errorMsg.textContent = msg;
}

tckSel.addEventListener('change',event => {
    let sel = event.target.value;
    priceChanged(sel)
});


form.addEventListener('submit', event => {
    let ids = ["first-name","last-name","ticket","amount"];

    let campos = accessInputs(ids);

    if(formIsEmpty(campos)){
        event.preventDefault();
        formError();
    }
});





