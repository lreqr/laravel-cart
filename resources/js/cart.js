import $ from 'jquery';

window.$ = window.jQuery = $;

$(document).ready(function () {
    const locale = $('html').attr('lang') || 'ru';

    const translations = {
        en: {
            price: 'Price',
            quantity: 'Quantity',
            total: 'Total',
            goToCart: 'Go to cart',
            remove: 'Remove'
        },
        ru: {
            price: 'Цена',
            quantity: 'Количество',
            total: 'Итого',
            goToCart: 'Перейти в корзину',
            remove: 'Удалить'
        }
    };

    function showAlert(message, isError = false) {
        if (isError) {
            alert(`Ошибка: ${message}`);
        } else {
            alert(message);
        }
    }

    function updateCart() {
        $.ajax({
            url: `/${locale}/cart/data`,
            method: 'GET',
            success: function (response) {
                let cartHtml = '';
                let total = 0;

                response.forEach(item => {
                    const itemTotal = item.product.price * item.quantity;
                    total += itemTotal;

                    cartHtml += `
                    <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                        <img src="${item.product.image || 'https://via.placeholder.com/60x60.png'}" alt="${item.product.name}" class="me-3" width="60" height="60">
                        <div>
                            <p class="mb-1">${item.product.name}</p>
                            <small class="text-muted">${translations[locale].price}: $${item.product.price}</small>
                            <p>${translations[locale].quantity}: ${item.quantity}</p>
                            <p>${translations[locale].total}: $${itemTotal.toFixed(2)}</p>
                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="${item.id}">
                                ${translations[locale].remove}
                            </button>
                            <input type="number" class="update-quantity" data-id="${item.id}" value="${item.quantity}" min="1">
                        </div>
                    </div>
                `;
                });

                cartHtml += `
                <div class="d-flex justify-content-between pt-2">
                    <strong>${translations[locale].total}:</strong>
                    <span>$${total.toFixed(2)}</span>
                </div>
                <a href="/${locale}/cart" class="btn btn-primary w-100">${translations[locale].goToCart}</a>
            `;
                $('#cart').html(cartHtml);
            }
        });
    }

    $('.add-to-cart').on('click', function (e) {
        e.preventDefault();
        const productId = $(this).data('id');
        const quantity = $('#quantity-' + productId).val();

        $.ajax({
            url: `/${locale}/cart/store`,
            type: 'POST',
            data: {
                product_id: $(this).data('id'),
                quantity: quantity,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                updateCart();
                showAlert(response.message);
            },
            error: function (xhr, status, error) {
                showAlert(xhr.responseJSON.error);
            }
        });
    });

    $('#cart').on('click', '.remove-from-cart', function () {
        const itemId = $(this).data('id');

        $.ajax({
            url: `/${locale}/cart/delete`,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: itemId
            },
            success: function (response) {
                updateCart();
                console.log(response);
                showAlert(response.message);
            },
            error: function (xhr) {
                showAlert(xhr.error);
                alert(xhr.message);
            }
        });
    });

    $(document).on('change', '.update-quantity', function () {
        const cartItemId = $(this).data('id');
        const newQuantity = $(this).val();
        $.ajax({
            url: `/${locale}/cart/update`,
            type: 'PATCH',
            data: {
                id: cartItemId,
                quantity: newQuantity,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    updateCart();
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr) {
                console.error('Ошибка:', xhr.responseJSON.message);
                alert('Не удалось обновить количество.');
            }
        });
    });

    updateCart();

});
