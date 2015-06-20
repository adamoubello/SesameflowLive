<script type="text/javascript"><!--
<?php global $translate, $goceane; ?>

var myMenu =
[
    [null, '<?php echo ucwords($translate["administration"]); ?>', '<?php echo $goceane->get_url(); ?>/page.php?login=$login&do=admin_accueil&univ=admin', 'target', '<?php echo ucwords($translate["administration"]); ?>'],  // a menu item
    [null, '<?php echo ucwords($translate["suivi"]); ?>', 'url', 'target', '<?php echo ucwords($translate["suivi"]); ?>'],  // a menu item
    _cmSplit,
    ['icon', 'title', 'url', 'target', 'description',   // a folder item
        ['icon', 'title', 'url', 'target', 'description'],  // a menu item
        _cmSplit,
        ['icon', 'title', 'url', 'target', 'description'],  // a menu item
        ['icon', 'title', 'url', 'target', 'description',   // a folder item
            ['icon', 'title', 'url', 'target', 'description'],  // a menu item
            ['icon', 'title', 'url', 'target', '<?php echo ucwords($translate["suivi"]); ?>']  // a menu item
        ]
    ]
];
--></script>