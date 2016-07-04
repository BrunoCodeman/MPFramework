Feature: Standard Checkout
	In order to buy a product using MercadoPago Standard Checkout, I add products  to the cart on the website 
	I'm accessing, go to checkout, fill my personal data and the shipment data. After that, I must see a MercadoPago 
	screen, where I will fill the payment data and confirm the order. After the payment is processes, 
	I must be redirected to a "order confirmed" screen and see a message confirming the operation. 
	If there's any errors with the data I filled, I must be warned during the checkout process.


Scenario: Missing form data
	Given a payment form
	And the credit card data isn't complete
	When I try to pay
	Then I must see an error

Scenario: Invalid credit card data
	Given some user data
	And the credit card data isn't complete
	When I try to pay
	Then I must see an error