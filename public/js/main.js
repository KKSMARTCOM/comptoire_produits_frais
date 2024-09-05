AOS.init({
    duration: 800,
    easing: "slide",
    once: true,
});

jQuery(document).ready(function ($) {
    "use strict";

    var slider = function () {
        $(".nonloop-block-3").owlCarousel({
            center: false,
            items: 1,
            loop: false,
            stagePadding: 15,
            margin: 20,
            nav: true,
            navText: [
                '<span class="icon-arrow_back">',
                '<span class="icon-arrow_forward">',
            ],
            responsive: {
                600: {
                    margin: 20,
                    items: 2,
                },
                1000: {
                    margin: 20,
                    items: 3,
                },
                1200: {
                    margin: 20,
                    items: 3,
                },
            },
        });
    };
    slider();

    var sitePlusMinus = function () {
        $(".js-btn-minus").on("click", function (e) {
            e.preventDefault();
            if (
                $(this).closest(".input-group").find(".form-control").val() != 0
            ) {
                $(this)
                    .closest(".input-group")
                    .find(".form-control")
                    .val(
                        parseInt(
                            $(this)
                                .closest(".input-group")
                                .find(".form-control")
                                .val()
                        ) - 1
                    );
            } else {
                $(this)
                    .closest(".input-group")
                    .find(".form-control")
                    .val(parseInt(0));
            }
        });
        $(".js-btn-plus").on("click", function (e) {
            e.preventDefault();
            $(this)
                .closest(".input-group")
                .find(".form-control")
                .val(
                    parseInt(
                        $(this)
                            .closest(".input-group")
                            .find(".form-control")
                            .val()
                    ) + 1
                );
        });
    };
    sitePlusMinus();

    var siteSliderRange = function () {
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 1000,
            values: [0, 1000],
            slide: function (event, ui) {
                $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                $("#priceBetween").val(ui.values[0] + " - " + ui.values[1]);
            },
        });
        $("#amount").val(
            "$" +
            $("#slider-range").slider("values", 0) +
            " - $" +
            $("#slider-range").slider("values", 1)
        );
        $("#priceBetween").val(
            $("#slider-range").slider("values", 0) +
            " - " +
            $("#slider-range").slider("values", 1)
        );
    };
    siteSliderRange();

    var siteMagnificPopup = function () {
        $(".image-popup").magnificPopup({
            type: "image",
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
            mainClass: "mfp-no-margins mfp-with-zoom", // class to remove default margin from left and right side
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1], // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                verticalFit: true,
            },
            zoom: {
                enabled: true,
                duration: 300, // don't foget to change the duration also in CSS
            },
        });

        $(".popup-youtube, .popup-vimeo, .popup-gmaps").magnificPopup({
            disableOn: 700,
            type: "iframe",
            mainClass: "mfp-fade",
            removalDelay: 160,
            preloader: false,

            fixedContentPos: false,
        });
    };
    siteMagnificPopup();
});

$(document).ready(function () {
    // Afficher les catégories
    $('.has-children').click(function () {
        var dropdownContent = $('.site-category-dropdown');
        // Toggle pour afficher ou cacher
        if (dropdownContent.is(':visible')) {
            dropdownContent.stop(true, true).slideUp(300).animate({ opacity: 0 }, { queue: false, duration: 300 });
        } else {
            dropdownContent.stop(true, true).slideDown(300).animate({ opacity: 1 }, { queue: false, duration: 300 });
        }
    });

    //Barre de menu
    $(".js-menu-toggle").on("click", function () {
        $('.site-mobile').css({ 'visibility': 'visible' })
        $('.site-mobile-menu').css({ 'right': '0' })

    });

    $('.site-mobile-menu-close').on('click', function () {
        $('.site-mobile-menu').css({ 'right': '-300px' })
        $('.site-mobile').css({ 'visibility': 'hidden' })
    })

    $('.site-mobile-menu-bg').on('click', function () {
        $('.site-mobile-menu').css({ 'right': '-300px' })
        $('.site-mobile').css({ 'visibility': 'hidden' })
    })

    $('.site-section-box-more-button').on('click', function (e) {
        e.preventDefault()
        $('.more-coffret').css({ 'display': 'flex' })
        $('.site-section-box-more-button').css({ 'visibility': 'hidden' })
    })
});



/* document.addEventListener('DOMContentLoaded', function () {
    // Gérer le clic sur le bouton "Passer commande"
    /* document.querySelectorAll('.showOrderForm').forEach(function (button) {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            // Récupérer l'ID du produit à partir de l'attribut data-product-id
            var productId = button.getAttribute('data-product-id');

            // Mettre à jour le champ caché du formulaire dans le modal avec l'ID du produit
            document.getElementById('modalProductId').value = productId;

            // Afficher le modal
            var orderModal = new bootstrap.Modal(document.getElementById('orderModal'));
            orderModal.show();
        });
    });

    // Gérer la fermeture du modal après la soumission du formulaire
    document.getElementById('orderForm').addEventListener('submit', function (e) {
        e.preventDefault();

        // Logique pour valider et soumettre le formulaire via Ajax ou autre méthode
        // Après soumission réussie, fermer le modal
        var orderModal = bootstrap.Modal.getInstance(document.getElementById('orderModal'));
        orderModal.hide();

        // Optionnel: Vous pouvez ajouter du code pour afficher un message de confirmation ou rediriger l'utilisateur
    });
}); */



