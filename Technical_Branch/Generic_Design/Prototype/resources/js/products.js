$(document).ready(function () {
    $(document).on("click", "#showCreateForm", function (e) {
        e.preventDefault();
        const url = createProductUrl;

        // Show a loading spinner in a modal (using Bootbox)
        bootbox.dialog({
            title: "Create Product",
            message: `<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</div>`,
            size: "large",
            onEscape: true,
            backdrop: true,
        });

        // AJAX request to load the product creation form
        $.ajax({
            type: "GET",
            url: url,
            success: function (response) {
                if (response.view) {
                    // Replace the loading spinner with the actual form inside the modal
                    bootbox.dialog({
                        title: "Create Product",
                        message: response.view,
                        size: "large",
                        onEscape: true,
                        backdrop: true,
                    });
                } else {
                    bootbox.alert("Error loading form.");
                }
            },
            error: function () {
                bootbox.alert("Failed to load the form. Please try again.");
            },
        });
    });

    $(document).on("submit", "#product-form", function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        let submitButton = $("button[type='submit']");
        submitButton.prop("disabled", true).text("Submitting...");

        // AJAX request to submit the form data
        $.ajax({
            type: "POST",
            url: storeProductUrl,
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                submitButton.prop("disabled", false).text("Submit");
                if (res.status === 200) {
                    // Append the new product row to the table
                    $("table tbody").append(`
                            <tr id="product-${res.product.id}">
                                <td>${res.product.id}</td>
                                <td>${res.product.name}</td>
                                <td>${res.product.description}</td>
                                <td>${res.product.price}€</td>
                                <td class="d-flex justify-content-around align-items-center">
                                    <a href="/products/${res.product.id}"><i class="far fa-eye"></i></a>
                                    <form action="/products/${res.product.id}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" >
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">            
                                        <button class="btn btn-danger delete-product" data-id="{{ $product->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        `);

                    // Hide the Bootbox modal after successful submission
                    bootbox.hideAll();
                }
            },
            error: function (xhr) {
                submitButton.prop("disabled", false).text("Submit");
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $(".error-message").remove();
                    $.each(errors, function (key, value) {
                        $(`[name=${key}]`).after(
                            `<div class="text-danger error-message">${value[0]}</div>`
                        );
                    });
                } else {
                    bootbox.alert("An unexpected error occurred.");
                }
            },
        });
    });

    $(document).on("click", ".btn-danger", function (e) {
        e.preventDefault();
        let productId = $(this)
            .closest("tr")
            .attr("id")
            .replace("product-", "");

        if (!confirm("Are you sure you want to delete this product?")) return;

        $.ajax({
            type: "DELETE",
            url: `/products/${productId}`, // Adjust URL if necessary
            data: {
                _token: $("meta[name='csrf-token']").attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    $(`#product-${productId}`).fadeOut(500, function () {
                        $(this).remove();
                    });
                } else {
                    bootbox.alert(response.message);
                }
            },
            error: function (xhr) {
                bootbox.alert("Error deleting product.");
            },
        });
    });
});
