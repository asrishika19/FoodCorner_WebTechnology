
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Corner | Delicious Moments</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <header class="navbar">
        <a href="index.php" class="logo">Food<span>Corner.</span></a>

        <nav>
            <a href="index.php">Home</a>
            <a href="#menu">Our Menu</a>
            <a href="#about">About Us</a>
            <a href="history.php">Order History</a>
        </nav>

        <a href="#menu" class="nav-btn">Explore Menu →</a>
    </header>

    <main>

        <!-- HERO SECTION -->
        <section class="hero">
            <div class="hero-content">
                <p class="eyebrow">GOOD FOOD. GOOD MOOD.</p>

                <h1>Made with love.<br>
                    Served with <span>flavour.</span>
                </h1>

                <p class="hero-description">
                    Discover delicious food, freshly prepared with the
                    finest ingredients. Your favourite meals are just
                    a click away.
                </p>

                <a href="#menu" class="primary-btn">Discover Our Menu →</a>

                <div class="hero-note">
                    <span>✦</span> Fresh ingredients · Amazing taste · Happy moments
                </div>
            </div>

            <div class="hero-image">
                <img src="https://images.unsplash.com/photo-1547592180-85f173990554?auto=format&fit=crop&w=1000&q=85"
                     alt="Delicious freshly prepared food">

                <div class="image-label">
                    <strong>Freshly prepared</strong>
                    <span>Just for you ♡</span>
                </div>
            </div>
        </section>

        <!-- FEATURES SECTION -->
        <section class="features">

            <div>
                <span>✦</span>
                <h3>Fresh Ingredients</h3>
                <p>Quality ingredients in every bite.</p>
            </div>

            <div>
                <span>♡</span>
                <h3>Made with Love</h3>
                <p>Every meal made to make you smile.</p>
            </div>

            <div>
                <span>✧</span>
                <h3>Great Taste</h3>
                <p>Flavours you'll keep coming back for.</p>
            </div>

        </section>

        <!-- MENU SECTION -->
        <section class="menu-section" id="menu">

            <div class="section-heading">
                <div>
                    <p class="eyebrow">MADE FRESH, SERVED WITH LOVE</p>
                    <h2>Explore Our Menu</h2>
                </div>

                <p>Choose your favourites and create<br>
                   your perfect meal.</p>
            </div>

            <form action="billing.php" method="POST">
<div class="customer-input">
    <label for="customer">Your Name</label>
    <input type="text" id="customer" name="customer"
           placeholder="Enter your name" required>
</div>
                <div class="food-grid">

                    <div class="food-card">
                        <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=700&q=85"
                             alt="Burger">

                        <div class="food-info">
                            <h3>Classic Burger</h3>
                            <p>Juicy burger with fresh vegetables and cheese.</p>

                            <div class="food-bottom">
                                <strong>₹120</strong>
                                <label>Qty:
                                    <input type="number" name="burger" min="0" max="20" value="0">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="food-card">
                        <img src="https://images.unsplash.com/photo-1579751626657-72bc17010498?auto=format&fit=crop&w=700&q=85"
                             alt="Pizza">

                        <div class="food-info">
                            <h3>Italian Pizza</h3>
                            <p>Cheesy pizza with delicious toppings.</p>

                            <div class="food-bottom">
                                <strong>₹250</strong>
                                <label>Qty:
                                    <input type="number" name="pizza" min="0" max="20" value="0">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="food-card">
                        <img src="https://images.unsplash.com/photo-1528735602780-2552fd46c7af?auto=format&fit=crop&w=700&q=85"
                             alt="Sandwich">

                        <div class="food-info">
                            <h3>Sandwich</h3>
                            <p>Freshly made sandwich with tasty fillings.</p>

                            <div class="food-bottom">
                                <strong>₹100</strong>
                                <label>Qty:
                                    <input type="number" name="sandwich" min="0" max="20" value="0">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="food-card">
                        <img src="https://images.unsplash.com/photo-1573080496219-bb080dd4f877?auto=format&fit=crop&w=700&q=85"
                             alt="French Fries">

                        <div class="food-info">
                            <h3>French Fries</h3>
                            <p>Golden, crispy and perfectly salted.</p>

                            <div class="food-bottom">
                                <strong>₹80</strong>
                                <label>Qty:
                                    <input type="number" name="fries" min="0" max="20" value="0">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="food-card">
                        <img src="https://images.unsplash.com/photo-1473093295043-cdd812d0e601?auto=format&fit=crop&w=700&q=85"
                             alt="Pasta">

                        <div class="food-info">
                            <h3>Creamy Pasta</h3>
                            <p>Rich and creamy pasta full of flavour.</p>

                            <div class="food-bottom">
                                <strong>₹180</strong>
                                <label>Qty:
                                    <input type="number" name="pasta" min="0" max="20" value="0">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="food-card">
                        <img src="https://images.unsplash.com/photo-1461023058943-07fcbe16d735?auto=format&fit=crop&w=700&q=85"
                             alt="Cold Coffee">

                        <div class="food-info">
                            <h3>Cold Coffee</h3>
                            <p>Chilled, creamy and refreshing coffee.</p>

                            <div class="food-bottom">
                                <strong>₹90</strong>
                                <label>Qty:
                                    <input type="number" name="coffee" min="0" max="20" value="0">
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="menu-submit">
                    <button type="submit" class="primary-btn">
                        Proceed to Billing →
                    </button>
                </div>

            </form>

        </section>

        <!-- ABOUT SECTION -->
        <section class="about-section" id="about">

            <p class="eyebrow">MORE THAN JUST FOOD</p>

            <h2>Good food brings people together.</h2>

            <p>
                At Food Corner, we believe every meal deserves to be
                special. Come hungry, leave happy!
            </p>

            <a href="#menu" class="primary-btn">Find Your Favourite →</a>

        </section>

    </main>

    <!-- FOOTER -->
    <footer>
        <a href="index.php" class="logo">Food<span>Corner.</span></a>

        <p>Made with love. Served with flavour.</p>

        <p class="copyright">
            © 2026 Food Corner. All rights reserved.
        </p>
    </footer>

</body>
</html>
