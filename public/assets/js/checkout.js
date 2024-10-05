document.addEventListener('DOMContentLoaded', function () {
const paymentForm = document.getElementById('payment-form');

paymentForm.addEventListener('submit', function (e) {
e.preventDefault();

const amount = document.getElementById('amount').value;

// Make an AJAX request to your Laravel route for processing the payment
fetch('/process-payment', {
method: 'POST',
headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
},
body: JSON.stringify({ amount: amount })
})
.then(response => response.json())
.then(data => {
if (data.success) {
    window.location.href = '/payment-success';
} else {
    window.location.href = '/payment-failure';
}
})
.catch(error => {
console.error(error);
});
});
});