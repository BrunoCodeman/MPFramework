import { IMPTools } from "./IMPTools";
var Mercadopago = require("mercadopago");

class MPTools implements IMPTools {

	public_key:string;
	acceptable_status:Array<Number> = [200,201];
	constructor(public_key:string) {
		this.public_key = public_key;
	}
	setPublishableKey(){
		Mercadopago.setPublishableKey(this.public_key);
	};
	getInstallments(bin:string, amount:Number, issuer:string){
        var config:any = {"bin": bin,"amount": amount};
		var installments:Array<any>
        if (issuer)
        {
            config.issuer_id = issuer.value;
        }

        this.setPublishableKey();

        Mercadopago.getInstallments(config, function(httpStatus, data){
            if (this.acceptable_status.indexOf(httpStatus) > -1)
            {
                let payer_costs = data[0].payer_costs;
            	var i = payer_costs.length;
				while(i--)
				{
					installments.push({text: installments[i].recommended_message, value:installments[i].installments});
				}
				
			}    
        });

		return installments;
    };

    getDocTypes(){
		var docTypes:Array<any>;
		 this.setPublishableKey();
		 Mercadopago.getIdentificationTypes(function (httpStatus, dt) {
			 if(this.acceptable_status.indexOf(httpStatus) > -1)
			 {
				var i = dt.length;
                if (i > 1)
                {
                	while(i--)
                    {
						docTypes.push({name: dt[i].name, id: dt[i].id})
                    }    
				} 
			 }
    	});
		return docTypes;  
	};
  getIssuers(paymentMethodId:string){
   this.setPublishableKey();
	var issuers:Array<any>;
   Mercadopago.getIssuers(paymentMethodId, function(httpStatus, dt)
   {
	   	if(this.acceptable_status.indexOf(httpStatus) > -1)
		{
			var i = dt.length;
			while(i--)
			{
				
				if (dt[i].name != "default") 
            	{
					issuers.push({name: dt[i].name, id: dt[i].id, thumbnail: dt[i].secure_thumbnail});
				} 
				else 
				{
					issuers.push({name: "Otro", id: dt[i].id});
				}
    		}
		}
   });
  return issuers; 
  
}
    getPaymentMethods(cardNumber:string, paymentType:string){
	 	this.setPublishableKey();
		var paymentMethods:Array<any>;
        Mercadopago.getPaymentMethod({"bin": cardNumber}, 
		function (httpStatus, response) {
			 	if(this.acceptable_status.indexOf(httpStatus) > -1)
				 {
				     var i = response.length;
					 while(i--)
					{
						paymentMethods
					}
			
				 }
                           var paymentType = document.getElementById('paymentType')
                           paymentType.value = response[0].id;
                           var bg = 'url("' + response[0].secure_thumbnail + '") 98% 50% no-repeat';
                           card_number.style.background = bg;
                           if (paymentType.value == 'amex' )
                           {
                            $("#credit").mask("9999-999999-99999", {clearIfNotMatch: true});
                        }
                        else 
                        { 
                            $("#credit").mask("9999-9999-9999-9999", {clearIfNotMatch: true}); 
                        }
                        if (response[0].additional_info_needed.indexOf('issuer_id') > -1)
                        {
                            getCardIssuers();
                        }
                        getInstallments();
                    });   

  
	};
    startStandardCheckout(){

	};
    generateTicket(){

	};
}