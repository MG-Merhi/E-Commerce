<?php
$categories = [
    'Electronics' => 'product_list.php?category=electronics',
    'Clothing' => 'product_list.php?category=clothing',
    'Accessories' => 'product_list.php?category=accessories',
    'Beauty & Personal Care' => 'product_list.php?category=beauty',
    'Home & Garden' => 'product_list.php?category=home',
    'Books & Media' => 'product_list.php?category=books',
    'Health & Wellness' => 'product_list.php?category=health',
    'Toys & Games' => 'product_list.php?category=toys'
];
?>

<div class="left-navigation">
    <h3>Products</h3>
    <ul>
        <?php foreach ($categories as $category => $url): ?>
            <li><a href="<?php echo htmlspecialchars($url); ?>"><?php echo htmlspecialchars($category); ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>