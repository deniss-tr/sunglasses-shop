

///////////// DELIVERY /////////////
let selectDelivery = document.querySelector('.select-delivery');

selectDelivery.addEventListener('change', () => {
    let omniva = document.querySelector('#omniva_container1');
    let info = document.querySelector('.delivery-info');
    let office = document.querySelector('.delivery-office');
    let selected = selectDelivery.value;
    if(selected == 'Omniva') {
        omniva.style.display = 'block';
        info.style.display = 'none';
        office.style.display = 'none';
        let deliveryLocation = document.querySelector('#omniva_select1');
//        console.log(deliveryLocation.value);
    } else if(selected == 'Office') {
        omniva.style.display = 'none';
        info.style.display = 'none';
        office.style.display = 'block';
    } else {
        omniva.style.display = 'none';
        info.style.display = 'block';
        office.style.display = 'none';       
    }

});