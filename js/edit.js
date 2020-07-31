let addColor = document.querySelector("#add-color");
addColor.addEventListener('click', (e) => {
    e.preventDefault();
    let elem = document.createElement("input");
    elem.type="text";
    elem.name="colors[]";
    e.target.parentNode.prepend(elem);
    
});