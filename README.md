# c4media-test

![Budget account page](https://raw.githubusercontent.com/simondubois/c4media-test/master/screenshot.png  "Budget account page")

E-commerce work sample for [C4Media](http://www.c4media.se)

## Features

### Functional features
- products list in ``/`` :
    - show product name, code, VAT, price (incl. VAT), quantity input & order button.
    - click on add to cart button add the quantity of product to the cart through ajax.
- cart content in ``/cart`` :
    - show product name, code, unit price (incl. VAT), quantity input, total price (incl. VAT) & order button.
    - click on upodate cart button update the quantity of product in the cart through ajax.
- cart widget on any page :
    - load cart information from server through ajax.
    - cart update generate notification (both for success & failure).

### Frontend features
- design :
    - theme from [Light Bootstrap Dashboard](http://www.creative-tim.com/product/light-bootstrap-dashboard).
    - icons from [Font Awesome](http://fontawesome.io/).
- dynamic components :
    - build with VueJS & webpack.
    - REST ajax requests.

### Backend features
- products:
    - stored in database, imported from json file with ``php artisan db:seed``.
    - linked to ``carts`` through ``cart_product`` table (with quantity in pivot table).
- carts:
    - stored in database.
    - linked to ``products`` through ``cart_product`` table (with quantity in pivot table).
    - user's cart primary key is stored in session.
    - a REST API is served on ``/api/cart``.

### Missing frontend features

- a "Remove product" button on product row in cart page (trigger a DELETE action on API).
- move all Ajax call to a distinct component, for better scalability.
- include all assets in ```front.js``` file and minimize it.
- buttons '+' and '-' on quantity input in cart page.

### Missing backend features

- API parameters validation. Actually, parameters are not validated. It is not a security issue, but adding validation would provide relevant status code on failure (like incorrect quantity format).
- import command for new products.
- cleaning routine for old carts (when carts are too old for relevant statistics).

## For production

### Requirements

- a web server (tested with Apache).
- PHP >= 5.5.9
- MySQL > 5.5
- [composer](https://getcomposer.org/)

### Deployment
- Get code base
```bash
cd /var/www/
git clone https://github.com/simondubois/c4media-test.git
cd c4media-test
composer install
```
- Set up database
```bash
	cp .env.example .env
	php artisan key:generate
	# Then set values to the following keys in .env file :
	# DB_DATABASE (database name)
	# DB_USERNAME (mysql username)
	# DB_PASSWORD (mysql password)
	php artisan migrate --seed
```
- Configure your web server to point to ``/var/www/c4media-test/public``

## Development

- production requirements
- nodejs >= 5.6.0
- npm >= 3.6.0

### Deployment

- Follow production deployment

- Install node packages
```bash
	npm install
```

- Run webpack in watch mode for faster compilation
```bash
	./node_modules/.bin/webpack --watch
```
