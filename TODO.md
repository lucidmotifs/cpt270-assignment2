#TODO

SESSION DATA

- Create Session Object for Guest user -
- Define guest properties and create sessions variables -
- Add a check to see if user is logged on and set session variable to reflect. -
- Create log-on function. -
- Load user data in from file. -
- Add UI element at the top of every page that reflects the current auth state. -
- Add cart element to the user auth UI element at top of page. -
- Log-out function. -

USER MANAGEMENT

- Add log-in form pop-up window. -
- Create login.php handler. -
- Add AJAX script to do login in-line on page. -
- Add log-out section to script/AJAX handler.
- Change AJAX handler to take user details as result (return session varibles).
- Only update the user details section of the page.

PRODUCTS PAGE

- Convert product element to template. -
- Create Array of products via PHP include (src). -
- Apply icon / discount to first 3 products. -
- Show single product page when product ID is set. -
- Convert single product display to template. -
- Move products array to external file and include in products page.
- Change single product form to do AJAX submission to cart for storage. -
- Add variable price output to JS quantity change function. -
- Add different description to each product.
- Change product order form to a pop-up where the template is filled via an AJAX
return.
- Apply discount to product purchase page. -

CART PAGE

- Create cart.php source file to handle cart actions.
- Add Cart Session variable
- Create table of products in cart with price / quantity
