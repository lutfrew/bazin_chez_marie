// JavaScript code (scripts.js)
const cart = [];
const cartItemsElement = document.getElementById('cart-items');
const cartButton = document.getElementById('cart-button');
const cartElement = document.getElementById('cart');

document.querySelectorAll('.add-to-cart').forEach(button => {
  button.addEventListener('click', (e) => {
    const productElement = e.target.parentElement;
    const imgSrc = productElement.querySelector('img').src;
    const name = productElement.querySelector('p').textContent;

    cart.push({ imgSrc, name });
    updateCart();
  });
});

function updateCart() {
  cartItemsElement.innerHTML = '';
  cart.forEach((item, index1) => {
    cartItemsElement.innerHTML += `
      <div class="cart-item">
        <img src="${item.imgSrc}" alt="${item.name}">
        <button class="remove-from-cart" data-index1="${index1}">✖</button>
      </div>
    `;
  });

  cartElement.classList.remove('hidden');
  setupRemoveButtons();
}

function setupRemoveButtons() {
  document.querySelectorAll('.remove-from-cart').forEach(button => {
    button.addEventListener('click', (e) => {
      const index1 = e.target.dataset.index1;
      cart.splice(index1, 1);
      updateCart();
    });
  });
}

document.getElementById('submit-order').addEventListener('click', () => {
  const name = document.getElementById('name').value;
  const surname = document.getElementById('surname').value;
  const email = document.getElementById('email').value;
  const phone = document.getElementById('phone').value;
  const address = document.getElementById('address').value;

  if (!email || !phone) {
    alert('Email or phone is missing');
    return;
  }

  // Send data to the server
  fetch('submit_order.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ cart, name, surname, email, phone, address })
  })
  .then(response => response.json())
  .then(data => {
    alert(data.message);
  })
  .catch(error => console.error('Error:', error));
});
