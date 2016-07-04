<!DOCTYPE html>
<html>
<head>
    <title>MP Checkout Tools</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
</head>
<body>
    <!-- fazer a tela com Angular 2, material bootstrap, flexbox e a paradinha de flip do cartão em CSS-->

    <div class="row">
        <form class="col s12">
          <div class="row">
           <div class="input-field col s12">
            <input id="email" [(ngModel)]="buyer.email" name="email" class="validate" type="email"/>
            <label for="email">Email</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">

        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
            <input type="text" [(ngModel)]="hero.name" id="cardNumber" class="validate" data-checkout="cardNumber" />
            <label for="cardNumber">Client Id</label>
        </div>
        <div class="input-field col s6">
           <input type="text" id="cardExpirationMonth" class="datepicker" data-checkout="cardExpirationMonth"/>
           <label for="cardExpirationMonth">Client Secred</label>
       </div>
   </div>
<div class="row">
    <div class="input-field col s6">
    <select multiple id="select_payments">
    </select>
    <label for="select_payments">Select Accepted Payment Methods</label>
    </div>
    <div class="input-field col s6">
   <input type="text" class="validate" id="docNumber" data-checkout="docNumber" />
   <label for="docNumber">Document number</label>
    </div>
</div>
<div class="row">
    <div class="fixed-action-btn">
        <buton type="submit" value="Pay!" class="btn-floating btn-large blue" >
            <i class="material-icons">add</i>
        </buton>
    </div>
</div>
</form>
</div>
<style type="text/css">
  .picker__table th:nth-child(6), .picker__table th:nth-child(7),
.picker__table td:nth-child(6), .picker__table td:nth-child(7) {
    display: none;
    visibility: hidden;
}
</style>
</body>
<footer>
<script type="text/javascript" src="//code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
  <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
  <script type="text/javascript" src="../assets/js/admin.js"></script>
  <!--<script type="text/javascript" src="./MPTools/assets/js/MPTools.js"></script>-->
</footer>
</html>