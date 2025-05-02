<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Service Home</title>
    <link rel="stylesheet" href="home_style__.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <style>
        /* Your inline styles can remain here or be moved to the CSS file */
    </style>
</head>
<body>
    <header>
        <h1>Home_page</h1>
        <div class="header-right">
            <div class="header-search-container">
                <div class="header-search">
                    <form action="home_page_logic.php" method="GET">
                        <input type="text" id="search-term" name="search_term" placeholder="Search products..." value="<?php echo htmlspecialchars($data['searchTerm']); ?>">
                        <?php if ($data['selectedCategory']): ?>
                            <input type="hidden" name="category" value="<?php echo htmlspecialchars($data['selectedCategory']); ?>">
                        <?php endif; ?>
                        <button class="search-button" type="submit">Search</button>
                    </form>
                </div>
            </div>
            <nav>
                <ul>
                    <li><a href="home_page_logic.php">Home</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li id="login-link-li"><a href="#" id="show-login-form">Login</a></li>
                    <li><a href="http://localhost/user_registration/api/register.php">Sign Up</a></li>
                    <li id="logout-link-li" style="display: none;"><a href="#" id="logout-link">Logout</a></li>
                </ul>
            </nav>
            <div id="user-info">
                <?php echo $data['loggedIn'] ? '<span class="welcome">Welcome, ' . htmlspecialchars($data['email']) . '!</span>' : '<span></span>'; ?>
            </div>
        </div>
    </header>

    <nav class="home-category-menu">
        <ul>
            <li><a href="home_page_logic.php" class="<?php if (!$data['selectedCategory'] && !$data['searchTerm']) echo 'active'; ?>">All Products</a></li>
            <?php foreach ($data['categories'] as $category): ?>
                <li>
                    <a href="home_page_logic.php?category=<?php echo htmlspecialchars($category['category_id']); ?>"
                       class="<?php if ($data['selectedCategory'] === $category['category_id']) echo 'active'; ?>">
                        <?php echo htmlspecialchars(ucfirst($category['category_name'])); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <div class="container">
        <main class="product-navigation">
            <div id="signup-section" style="display: none;">
                <h2>Sign Up</h2>
                <div id="signup-error-message" class="error" style="display:none;"></div>
                <form id="signupForm">
                    <div class="form-group">
                        <label for="signup-email">Email:</label>
                        <input type="email" id="signup-email" name="email" required>
                        <div id="signup-email-error" class="error-message" style="display:none;"></div>
                    </div>
                    <div class="form-group">
                        <label for="signup-password">Password:</label>
                        <input type="password" id="signup-password" name="password" required>
                        <div id="signup-password-error" class="error-message" style="display:none;"></div>
                    </div>
                    <button type="submit">Register</button>
                </form>
                <p class="login-link">Already have an account? <a href="#" id="show-login-form-from-signup">Login</a></p>
            </div>

            <div class="slider-container" style="max-width: 100%; margin: 20px auto; text-align: center;">
                <?php foreach ($data['sliderImages'] as $slide): ?>
                    <div class="slide" style="display: block;">
                        <a href="home_page_logic.php" style="display: inline-block;">
                            <img src="<?php echo htmlspecialchars($slide['image']); ?>"
                                 alt="<?php echo htmlspecialchars($slide['alt']); ?>"
                                 style="width: 100px; height: 100px; border-radius: 70%; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="product-grid-container">
                <h2>Products</h2>
                <?php if (empty($data['products'])): ?>
                    <p>No products found <?php if ($data['selectedCategory']) echo 'in this category'; ?>
                        <?php if ($data['searchTerm']) echo 'matching your search term.'; ?></p>
                <?php else: ?>
                    <div class="product-grid">
                        <?php foreach ($data['products'] as $product): ?>
                            <div class="product-item" data-category-id="<?php echo htmlspecialchars($product['category_id']); ?>" data-product-name="<?php echo htmlspecialchars(strtolower($product['product_name'])); ?>">
                                <img src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                                <h4><?php echo htmlspecialchars($product['product_name']); ?></h4>
                                <p class="price">$<?php echo number_format($product['price'], 2); ?>
                                    <?php if ($product['discount_price']): ?>
                                        <span class="discount-price">$<?php echo number_format($product['discount_price'], 2); ?></span>
                                    <?php endif; ?>
                                </p>
                                <div class="button-container">
                                    <button class="add-to-cart-btn" onclick="handleAddToCart(<?php echo htmlspecialchars($product['product_id']); ?>, 1)">Add to Cart</button>
                                    <button class="buy-now-btn" onclick="handleBuyNow(<?php echo htmlspecialchars($product['product_id']); ?>, 1)">Buy Now</button>
                                </div>
                                <a href="product_details.php?id=<?php echo htmlspecialchars($product['product_id']); ?>">View Details</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
        const pageData = <?php echo json_encode($data); ?>;
    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="home_script.js"></script>
    <?php
    include 'footer.php';
    ?>
</body>
</html>