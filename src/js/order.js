document.addEventListener("DOMContentLoaded", function () {
  const orderButtons = document.querySelectorAll(".order-btn");

  orderButtons.forEach(button => {
    button.addEventListener("click", function (e) {
      const confirmOrder = confirm("Anda akan diarahkan ke WhatsApp untuk memesan. Lanjutkan?");
      if (!confirmOrder) {
        e.preventDefault();
      }
    });
  });
});
<script src="/src/js/order.js"></script>
