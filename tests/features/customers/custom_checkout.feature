Feature: Custom Checkout
	In order to buy a product using MercadoPago Standard Checkout, I must add products to the cart on the website 
	I'm accessing, then go to checkout, fill my personal data (name, email and any other information needed to register
	or login) and the shipment data(Adress, number, Zip Code, City and any other information needed to deliver the product). 
	After that, I must see a payment form, then fill the fields with my card data and confirm the order. After the payment 
	is processed, I must be redirected to an "order confirmed" screen and I should see a message confirming the operation,
	the ID of my payment and the ID of my order. If there's any errors with the data I filled in any form, I must be warned 
	during the checkout process.


Scenario: Invalid card number
	Given an order
	When I go to the checkout screen
	And I fill the card data form with an invalid card number
	Then I must see an error message warning me about this error

Scenario: Invalid CVV
	Given an order
	When I go to the checkout screen
	And I fill the card data form with an invalid CVV
	Then I must see an error message warning me about this error

Scenario: Invalid expiring month
	Given an order
	When I go to the checkout screen
	And I fill the card data form with an invalid expiring month
	Then I must see an error message warning me about this error

Scenario: Invalid expiring year
	Given an order
	When I go to the checkout screen
	And I fill the card data form with an invalid expiring year
	Then I must see an error message warning me about this error

Scenario: Invalid document number
	Given an order
	When I go to the checkout screen
	And I fill the card data form with an invalid document number
	Then I must see an error message warning me about this error

Scenario: Invalid installments number
	Given an order
	When I go to the checkout screen
	And I fill the card data form with an invalid installments number
	Then I must see an error message warning me about this error

Scenario: Valid card data
	Given an order
	When I go to the checkout screen
	And I fill the card data form with valid card data
	Then I must see be redirected to an "order confirmed" screen
	And I should see a message confirming the operation
	And I should see the ID of my payment 
	And I should see the ID of my order

