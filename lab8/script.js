$(document).ready(function() {
    const apiKey = 'e9f4519781b56edbd1142824c2d2ff9f';

    function loadCities() {
        $.ajax({
            url: 'https://api.novaposhta.ua/v2.0/json/',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                "apiKey": apiKey,
                "modelName": "Address",
                "calledMethod": "getCities",
                "methodProperties": {}
            }),
            success: function(response) {
                if (response.success) {
                    const cities = response.data;
                    $('#city').empty();
                    cities.forEach(city => {
                        $('#city').append(`<option value="${city.Ref}">${city.Description}</option>`);
                    });
                } else {
                    console.error('Помилка завантаження міст:', response.errors);
                }
            },
            error: function(xhr, status, error) {
                console.error('Помилка запиту до API:', error);
            }
        });
    }

    loadCities();

    $('#weight, #city').change(function() {
        const weight = parseFloat($('#weight').val());
        const deliveryType = $('#delivery-type');

        if (weight > 30) {
            deliveryType.val('branch');
            deliveryType.find('option[value="locker"]').hide();
        } else {
            deliveryType.find('option[value="locker"]').show();
        }

        loadBranchesAndLockers();
    });

    function loadBranchesAndLockers() {
        const cityRef = $('#city').val();
        const deliveryType = $('#delivery-type').val();

        if (!cityRef) return;

        const calledMethod = deliveryType === 'branch' ? 'getWarehouses' : 'getPostomats';

        $.ajax({
            url: 'https://api.novaposhta.ua/v2.0/json/',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                "apiKey": apiKey,
                "modelName": 'Address',
                "calledMethod": calledMethod,
                "methodProperties": { "CityRef": cityRef }
            }),
            success: function(response) {
                console.log("Response from loadBranchesAndLockers:", response);
                if (response.success) {
                    $('#branch-locker').empty();
                    response.data.forEach(item => {
                        $('#branch-locker').append(`<option value="${item.Ref}">${item.Description}</option>`);
                    });
                } else {
                    console.error('Помилка завантаження відділень/поштоматів:', response.errors);
                }
            },
            error: function(xhr, status, error) {
                console.error('Помилка запиту до API:', error);
            }
        });
    }

    $('#order-form').submit(function(event) {
        event.preventDefault();

        const formData = {
            order_number: $('#order-number').val(),
            weight: $('#weight').val(),
            city: $('#city').val(),
            delivery_type: $('#delivery-type').val(),
            branch_locker: $('#branch-locker').val()
        };

        $.ajax({
            url: 'process_order.php',
            method: 'POST',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            success: function(response) {
                if (response.success) {
                    $('#response').html('<p>Замовлення успішно оформлене!</p>');
                } else {
                    $('#response').html(`<p>Помилка: ${response.error}</p>`);
                }
            },
            error: function() {
                $('#response').html('<p>Виникла помилка під час оформлення замовлення.</p>');
            }
        });
    });
});