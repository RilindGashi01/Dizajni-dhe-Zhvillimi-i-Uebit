function adminOrder(ID){
    document.getElementById(`${ID}`).style.display = 'block';
}
function adminOrder1(ID){
    document.getElementById(`${ID}`).style.display = 'none';
}
function confirmDelete(deleteID) {
    const deleteElem = document.getElementById(deleteID);
    const cardElem = deleteElem.closest('.detilPro');
    console.log(cardElem)
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'AdminProducts.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            if (cardElem) {
                cardElem.parentNode.removeChild(cardElem);
            }
        }
    };
    xhr.send(`delete_id=${deleteID}`);
}