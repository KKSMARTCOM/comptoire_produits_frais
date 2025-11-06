<?php

/**
 * @see https://github.com/artesaos/seotools
 */

return [

    'inertia' => env('SEO_TOOLS_INERTIA', false),

    'meta' => [
        /*
         * Configurations par défaut pour les métadonnées HTML.
         */
        'defaults'       => [
            'title'        => 'Comptoir des Produits Frais',
            'titleBefore'  => false, // Si true, affichera "Comptoir des Produits Frais - Page"
            'description'  => 'Découvrez le Comptoir des Produits Frais : une sélection gourmande de produits artisanaux, épicerie fine et cave à vin.',
            'separator'    => ' - ',
            'keywords'     => [
                'produits frais',
                'épicerie fine',
                'cave à vin',
                'produits artisanaux',
                'gourmet',
                'comptoir des produits frais'
            ],
            'canonical'    => 'full', // Utilise l’URL complète de la page courante
            'robots'       => 'index, follow',
        ],

        'webmaster_tags' => [
            'google'    => null, // colle ici ton code de validation GSC si tu en as un
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],

    'opengraph' => [
        /*
         * Configurations Open Graph (Facebook, LinkedIn, etc.)
         */
        'defaults' => [
            'title'       => 'Comptoir des Produits Frais',
            'description' => 'Produits frais, épicerie fine et cave à vin : savourez le meilleur du terroir.',
            'url'         => null, // Utilisera automatiquement l’URL courante
            'type'        => 'website',
            'site_name'   => 'Comptoir des Produits Frais',
            'images'      => [
                '/images/og-default.png', // image par défaut pour les partages
            ],
        ],
    ],

    'twitter' => [
        /*
         * Configurations pour Twitter Cards.
         */
        'defaults' => [
            'card' => 'summary_large_image',
            'site' => '@comptoirproduitsfrais', // ton handle Twitter si tu en as un
        ],
    ],

    'json-ld' => [
        /*
         * Configurations pour les données structurées JSON-LD.
         */
        'defaults' => [
            'title'       => 'Comptoir des Produits Frais',
            'description' => 'Découvrez nos produits frais, notre cave à vin et notre épicerie fine artisanale.',
            'url'         => null, // Utilisera automatiquement l’URL courante
            'type'        => 'WebSite',
            'images'      => [
                '/images/svg/KKSMARTDESIGN_CPF_LOGO_prop9.svg',
            ],
        ],
    ],

];
