<script type="text/javascript"><!--
<?php 
	global $translate, $goceane; 
	$vars = ($_POST) ? $_POST : $_GET;
	$login = isset($vars["login"]) ? trim($vars["login"]) : null;
?>

var myMenu =
[
    [null, '<?php echo ucwords($translate["user"]); ?>', null, null, 'description',   // a folder item
        [null, '<?php echo ucwords($translate["recherche"]); ?>', '<?php echo $goceane->get_url()."/skeleton/admin.skton.php?login={$login}&do=user_search&skton=admin"; ?>', 'target', 'description'],  // a menu item
        _cmSplit,
        [null, '<?php echo ucwords($translate["nouveau"]); ?>', 'url', 'target', 'description'],  // a menu item
    ],
    [null, '<?php echo ucwords($translate["groupe"]); ?>', null, null, 'description',   // a folder item
        [null, '<?php echo ucwords($translate["recherche"]); ?>', '<?php echo $goceane->get_url()."/skeleton/admin.skton.php?login={$login}&do=group_search&skton=admin"; ?>', null, null],  // a menu item
        _cmSplit,
        [null, '<?php echo ucwords($translate["nouveau"]); ?>', 'url', 'target', 'description'],  // a menu item
    ]
];
--></script>