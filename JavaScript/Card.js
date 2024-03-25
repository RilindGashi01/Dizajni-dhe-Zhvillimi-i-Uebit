function submit(productID) {
    event.preventDefault();
    const newValue = document.getElementById(`${productID}`).value;
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'Card.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log('Quantity updated successfully');
            } else {
                console.error('Failed to update quantity');
            }
        }
    };
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
function handleOrder(){
    let productId = [];
    let sasia = [];
    let qmimiTotal = document.querySelector('.totalValue').textContent;

    document.querySelectorAll('.card-elem').forEach(function(cardElem) {
        sasia.push(cardElem.querySelector('.quantityCard').value);
        productId.push(cardElem.querySelector('.producID').value);
    });

    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'CheckOut.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    const data = `productId=${JSON.stringify(productId)}&sasia=${JSON.stringify(sasia)}&qmimiTotal=${qmimiTotal}`;
    xhr.send(data);
    window.location.reload();
}
 