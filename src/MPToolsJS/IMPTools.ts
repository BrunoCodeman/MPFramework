//import * as mp from "./mercadopago.js";

export interface IMPTools
{
	public_key?:string;
	access_token?:string;
	client_id?:string;
	client_secret?:string

	getInstallments(bin:string, amount:Number, issuer:string):Array<Object>;
	getDocTypes():Array<Object>;
	getIssuers(paymentMethodId:string):Array<Object>;
	getPaymentMethods(cardNumber:string, paymentType:string):Array<Object>;
	startStandardCheckout();
	generateTicket():string;
}