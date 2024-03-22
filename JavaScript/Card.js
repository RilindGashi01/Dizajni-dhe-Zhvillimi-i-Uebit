function submit(productID){
   const newValue= document.getElementById(`${productID}`).value;
   const xhr = new XMLHttpRequest();
        xhr.open('POST', 'Card.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(`product_id=${productID}&quantity=${newValue}`);
}
function confirmDelete(deleteID) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'Card.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            const cardElem = document.getElementById(deleteID).closest('.card-elem');
            if (cardElem) {
                cardElem.parentNode.removeChild(cardElem);
            }
        }
    };
    xhr.send(`delete_id=${deleteID}`);
}
function handleOrder() {
    const allproductNames = [];
    const allquantities = [];
    const allprices = [];
    const alltotalPrices = [];

    document.querySelectorAll('.card-elem').forEach(function(cardElem) {
        allproductNames.push(cardElem.querySelector('.emriPro').textContent);
        allquantities.push(cardElem.querySelector('.quantityCard').value);
        allprices.push(cardElem.querySelector('.qmimi1').textContent);
        alltotalPrices.push(cardElem.querySelector('.qmimi2').textContent);
    });
    const totalOfOrder = document.querySelector('.totalValue').textContent;
    
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'Card.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
   
    const data = `allproductNames=${JSON.stringify(allproductNames)}&allquantities=${JSON.stringify(allquantities)}&prices=${JSON.stringify(allprices)}&alltotalPrices=${JSON.stringify(alltotalPrices)}&totalOfOrder=${totalOfOrder}`;
    xhr.send(data);
} 