- mkdir Statistics
- cd Statistics
- mkdir templates static static/css static/js static/img DB
- touch templates/main.html templates/product_detail.html static/css/custom.css static/js/custom.js statistics.py const.py conn.py queries.py DB/statistics.sql
- python3 -m venv venv

-   Linux
    - source venv/bin/activate
    - pip install flask mysql-connector-python

-   Windows (powershell)
    - .\venv\Scripts\activate
    - pip install flask mysql-connector-python

- nano DB/statistics.sql

        -- phpMyAdmin SQL Dump
        -- version 5.2.1
        -- https://www.phpmyadmin.net/
        --
        -- Host: 127.0.0.1
        -- Generation Time: Oct 21, 2025 at 09:57 AM
        -- Server version: 10.4.32-MariaDB
        -- PHP Version: 8.2.12

        SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
        START TRANSACTION;
        SET time_zone = "+00:00";


        /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
        /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
        /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
        /*!40101 SET NAMES utf8mb4 */;

        --
        -- Database: `statistics`
        --
        CREATE DATABASE IF NOT EXISTS `statistics` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
        USE `statistics`;

        -- --------------------------------------------------------

        --
        -- Table structure for table `products`
        --

        DROP TABLE IF EXISTS `products`;
        CREATE TABLE `products` (
        `product_id` int(11) NOT NULL,
        `product_name` varchar(100) NOT NULL,
        `product_img` varchar(100) NOT NULL,
        `category` varchar(50) DEFAULT NULL,
        `old_price` decimal(10,2) DEFAULT 0.00,
        `new_price` decimal(10,2) DEFAULT 0.00,
        `stock_quantity` int(11) DEFAULT 0,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp()
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        --
        -- Dumping data for table `products`
        --

        INSERT INTO `products` (`product_id`, `product_name`, `product_img`, `category`, `old_price`, `new_price`, `stock_quantity`, `created_at`) VALUES
        (1, 'Wireless Mouse', 'wireless_mouse.png', 'Electronics', 25.99, 19.99, 150, '2025-10-21 03:05:44'),
        (2, 'Bluetooth Headphones', 'bluetooth_headphones.png', 'Electronics', 59.99, 49.99, 80, '2025-10-21 03:05:44'),
        (3, 'Yoga Mat', 'yoga_mat.png', 'Fitness', 20.00, 15.00, 200, '2025-10-21 03:05:44'),
        (4, 'Stainless Steel Water Bottle', 'water_bottle.png', 'Outdoors', 18.50, 14.50, 120, '2025-10-21 03:05:44'),
        (5, 'LED Desk Lamp', 'desk_lamp.png', 'Home & Office', 35.00, 29.99, 60, '2025-10-21 03:05:44');

        --
        -- Indexes for dumped tables
        --

        --
        -- Indexes for table `products`
        --
        ALTER TABLE `products`
        ADD PRIMARY KEY (`product_id`);

        --
        -- AUTO_INCREMENT for dumped tables
        --

        --
        -- AUTO_INCREMENT for table `products`
        --
        ALTER TABLE `products`
        MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
        COMMIT;

        /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
        /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
        /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



- nano const.py

        app_title = "Statistics Manager"

- nano conn.py

        db_config = {
            'host': 'localhost',
            'user': 'root',
            'password': '',
            'database': 'statistics'
        }

- nano queries.py

        import mysql.connector
        from conn import db_config


        def conn_open():
            conn = mysql.connector.connect(**db_config)
            return conn


        def cursor_open(conn):
            cursor = conn.cursor(dictionary=True)
            return cursor


        def conn_close(cursor, conn):
            cursor.close()
            conn.close()


        def search_products(tableName, product_id=None):
            conn = conn_open()
            cursor = cursor_open(conn)

            query = "SELECT * FROM " + tableName
            
            if product_id is not None:
                query += " WHERE product_id = %s"
                cursor.execute(query, (product_id,))
            else:
                cursor.execute(query)
            
            tableContent = cursor.fetchall()

            conn_close(cursor, conn)
            return tableContent


        def statistics_calculation(old_price, new_price, quantity):

            price_change_stat = new_price - old_price
            price_change_percentage_stat = (
                (price_change_stat / old_price * 100) if old_price != 0 else 0
            )

            response = {
                "old_price": old_price,
                "new_price": new_price,
                "quantity": quantity,
                "price_change_stat": price_change_stat,
                "price_change_percentage_stat": price_change_percentage_stat,
            }
            return response


- nano statistics.py

        from flask import Flask, render_template
        from const import app_title
        from queries import search_products, statistics_calculation

        app = Flask(__name__)

        @app.route('/')
        def index():
            products_list = search_products('products')

            stats = {}
            for product in products_list:
                stats[product['product_id']] = statistics_calculation(product['old_price'], product['new_price'], product['stock_quantity'])

            return render_template('main.html', 
                                  app_title=app_title
                                  , products_list=products_list
                                  , stats=stats)

        @app.route('/product/<int:product_id>')
        def product_detail(product_id):
            products_list = search_products('products', product_id=product_id)
            if not products_list:
                return "Product not found", 404

            product = products_list[0]
            stats = statistics_calculation(product['old_price'], product['new_price'], product['stock_quantity'])

            return render_template('product_detail.html', 
                                  app_title=app_title
                                  , product=product
                                  , stats=stats)

        if __name__ == '__main__':
            app.run(debug=True)

- nano templates/main.html

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <title>{{ app_title }}</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

            <link rel="icon" type="image/x-icon" href="{{ url_for('static', filename='img/Euro_symbol.svg') }}">
            <link rel="stylesheet" href="{{ url_for('static', filename='css/custom.css') }}">
        </head>

        <body>
            <section class="header-section" id="header-section">
                <h1>{{ app_title }}</h1>
            </section>

            <section class="content-section" id="products-list-section">

                <div class="content-title" id="products-list-title">
                    <h2>Products List</h2>
                </div>

                <div class="section-content" id="products-list-container">
                    <div class="product-section-container" id="product-section-container">
                        <div class="product-block-container" id="product-block-container">
                            {% for product in products_list %}
                            <div class="product-section" id="product-section-{{ loop.index }}">
                                <div class="product-block" id="product-card">
                                    <h3 class="product-name">{{ product.product_name }}</h3>
                                    <p class="product-category"><strong>Category:</strong> {{ product.category }}</p>
                                    <p class="product-old-price"><strong>Old Price:</strong> €{{ product.old_price }}</p>
                                    <p class="product-new-price"><strong>New Price:</strong> €{{ product.new_price }}</p>
                                    <p class="product-stock-quantity"><strong>Stock Quantity:</strong> {{ product.stock_quantity }}</p>
                                    <p class="product-created-at"><strong>Created At:</strong> {{ product.created_at }}</p>
                                </div>
                                <div class="product-block" id="product-card-img-div">
                                    <img class="product-card-img" id="product-card-img-{{ loop.index }}" ref="{{ product.product_id }}" src="{{ url_for('static', filename='img/' + product.product_img) }}" alt="Image of {{ product.product_name }}" title="Click to see details for {{ product.product_name }}">
                                </div>
                                <div class="product-block product-card-stats" id="product-card-stats-div-{{ loop.index }}">
                                    
                                    <p class="product-id"><strong>Product ID:</strong> {{ products_list[loop.index0]['product_id'] }}</p>
                                    <!-- statistics data calculated in template -->
                                    {% set price_change = product.new_price - product.old_price %}
                                    {% set price_change_percentage = (price_change / product.old_price * 100) if product.old_price != 0 else 0 %}
                                    <span class="legend-text">--- statistics data calculated in template ---</span>
                                    <p class="product-price-change"><strong>Price Change:</strong> €{{ price_change | round(2) }}</p>
                                    <p class="product-price-change-percentage"><strong>Price Change Percentage:</strong> {{ price_change_percentage | round(2) }}%</p>
                                    <!-- statistics data calculated in python -->
                                    <span class="legend-text">--- statistics data calculated in python ---</span>
                                    <p class="product-price-change"><strong>Price Change:</strong> € {{ stats[loop.index]["price_change_stat"] }}</p>
                                    <p class="product-price-change-percentage"><strong>Price Change Percentage:</strong> {{ stats[loop.index]["price_change_percentage_stat"] | round(2) }}%</p>
                                    <!---->

                                </div>
                            </div>
                            {% endfor %}
                        </div>
                    </div>
                </div>
            </section>

        </body>
        </html>

        <script src="{{ url_for('static', filename='js/custom.js') }}"></script>

- nano templates/product_detail.html

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <title>{{ app_title }}</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

            <link rel="icon" type="image/x-icon" href="{{ url_for('static', filename='img/Euro_symbol.svg') }}">
            <link rel="stylesheet" href="{{ url_for('static', filename='css/custom.css') }}">
        </head>

        <body>
            <section class="header-section" id="header-section">
                <h1>{{ app_title }}</h1>
            </section>

            <section class="content-section" id="products-list-section">

                <div class="content-title" id="products-list-title">
                    <h2>Product Detail</h2>
                </div>

                <div class="section-content" id="products-list-container">
                    <div class="product-section-container" id="product-section-container">
                        <div class="product-block-container" id="product-block-container">
                            <div class="product-section-detail" id="product-section-detail">
                                <div class="product-section-title" id="product-section-title"><h2><a href="/">&lt; Back</a></h2></div>
                                <div class="product-block-detail" id="product-card">
                                    <div class="product-card-detail" id="product-card">
                                        <p class="product-category"><strong>ID:</strong> {{ product.product_id }}</p>
                                        <p class="product-category"><strong>Category:</strong> {{ product.category }}</p>
                                        <p class="product-old-price"><strong>Old Price:</strong> €{{ product.old_price }}</p>
                                        <p class="product-new-price"><strong>New Price:</strong> €{{ product.new_price }}</p>
                                        <p class="product-stock-quantity"><strong>Stock Quantity:</strong> {{ product.stock_quantity }}</p>
                                        <p class="product-created-at"><strong>Created At:</strong> {{ product.created_at }}</p>
                                        <p class="product-created-at"><strong>Price Change:</strong> {{ stats["price_change_stat"] }}</p>
                                        <p class="product-created-at"><strong>Price Change Percentage:</strong> {{ stats["price_change_percentage_stat"] | round(2) }}%</p>
                                    </div>
                                    <div class="product-block-caed-img" id="product-card-img-div">
                                        <img class="product-card-detail-img" id="product-card-img" ref="{{ product.product_id }}" src="{{ url_for('static', filename='img/' + product.product_img) }}" alt="Image of {{ product.product_name }}" title="Click to see details for {{ product.product_name }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </body>
        </html>

        <script src="{{ url_for('static', filename='js/custom.js') }}"></script>

- nano static/css/custom.css

        body {
          margin: 0;
          padding: 0;
          background-color: antiquewhite;
          background: url("../img/desk_lamp.png") no-repeat center center fixed;
          background-size: cover;
          overflow: hidden;
        }

        .clearDiv {
          clear: both;
        }

        .header-section {
          border: 0px solid red;
          padding: 1%;
          font-family: Cambria, Cochin, Georgia, Times, "Times New Roman", serif;

          &#header-section h1 {
            font-size: 300%;
            font-weight: bold;
            font-style: oblique;
            text-decoration: underline;
          }
        }

        .content-section {
          .content-title {
            background-color: antiquewhite;
            opacity: 0.7;
            text-align: center;
            font-size: 150%;
            font-weight: normal;
            font-style: normal;
            text-decoration: none;
          }

          .section-content {
            border: 0px solid blue;
            /* padding: 2%; */

            .legend-text {
              color: brown;
            }

            .product-section-container {
              border: 0px solid red;
              height: 1100px;
              margin-top: 30px;
              width: 101%;
              overflow: auto;

              .product-block-container {
                border: 0px solid red;

                .product-section {
                  box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.2);
                  background-color: antiquewhite;
                  border: 0px solid red;
                  display: flex;
                  width: 50%;
                  margin: 0 auto;

                  .product-block {
                    border-bottom: 1px dashed grey;
                    padding: 2%;

                    &#product-card {
                      width: 400px;
                    }

                    &#product-card-img-div {
                      width: 400px;
                      text-align: center;
                    }

                    .product-card-img {
                      width: 70%;
                      box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.2);
                      cursor: pointer;
                      height: auto;
                    }
                  }
                }

                .product-section-detail{
                  box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.2);
                  background-color: antiquewhite;
                  border: 0px solid red;
                  display: column;
                  width: 50%;
                  height: 1100px;
                  padding: 1%;
                  margin: 0 auto;

                  .product-section-title {
                    border: 0px solid brown;
                    text-align: center;
                    h2 {
                      font-size: medium;
                    }
                    a {
                      color: brown;
                      text-decoration: none;
                    }
                    a:hover{
                      color: burlywood;
                    }
                  }
                }

                .product-block-detail{
                  display: flex;
                  margin-top: 50px;

                  .product-card-detail{
                    width: 500px;
                  }

                  .product-block-caed-img{
                    border: 0px solid red;
                    width: 500px;

                    .product-card-detail-img{
                      width: 100%;
                      box-shadow: 0px 0px 5px 5px black;
                    }
                  }
                }
              }
            }
          }
        }

- nano static/js/custom.js

        $('.product-card-img').on('click', function(){
            document.location.href = '/product/' + $(this).attr('ref');
        });

-   Linux
    - python3 statistics.py

-   Windows (powershell)
    - python .\statistics.py


