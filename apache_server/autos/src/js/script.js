
document.onsubmit = () => {
    const makeInput = document.getElementById("make");

    let cleanInput = makeInput.value + "";
    console.log(cleanInput);
    cleanInput = cleanInput.replace(/[\(\);\"]/g, "");
    console.log(cleanInput);

    makeInput.value = cleanInput;
}
