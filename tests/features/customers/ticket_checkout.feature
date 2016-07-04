Feature: Ticket Checkout
In order to buy a product using MercadoPago Ticket Checkout, I must add products to the cart on the website
I'm accessing, then go to checkout, fill my personal data (name, email and any other information needed to register 
or login) and the shipment data (Adress, number, Zip Code, City and any other information needed to deliver the product).
After that, I must see one or more ticket payment options, select one of them and click on the "pay" button. A new tab must 
be opened showing me the ticket to pay and on the store website I must be redirected to an "order confirmed" screen and should 
I see a message confirming the operation. If there's any errors with the ticket I'm trying to generate, it must	 be suggested to 
use other payment method.


Scenario: Error loading ticket payment methods
	Given an order
	When I go to the checkout screen
	And any errors happen until the screen shows me one or more payment methods
	Then I must see an error message warning me about this error
	And I must see a link with a suggestion to select another payment type

Scenario: Error loading selected ticket payment method
	Given an ordera
	And a selected ticket payment method
	When I click the "pay" button
	And any errors happen until the screen shows me the link to the payment
	Then I must see an error message warning me about this error
	And I must see a link with a suggestion to select another payment type

Scenario: Correct loading
	Given an order
	When I go to the checkout screen
	And I see all the available payment methods
	And I select one of them
	And I see a link to the ticket
	And I click in this link
	Then a new tab must be opened with this url
	And the store must redirect me to the "order confirmed" screen
