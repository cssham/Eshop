<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

	<title>Eshop | invoice</title>

	<link rel='stylesheet' type='text/css' href='{{ asset('public/invoice/css/style.css') }}' />
	<link rel='stylesheet' type='text/css' href='{{ asset('public/invoice/css/print.css') }}' media="print" />
	<script type='text/javascript' src='{{ asset('public/invoice/js/jquery-1.3.2.min.js') }}'></script>
	<script type='text/javascript' src='{{ asset('public/invoice/js/example.js') }}'></script>

</head>

<body>

	<div id="page-wrap">

		<textarea id="header" style="margin: 5%">INVOICE</textarea>

		<div id="identity" style="margin-left:10px;margin-right:10px;">
            <h3>Customer Info:</h3>
            <textarea id="address">
{{ $order->customer->first_name.' '.$order->customer->last_name }}
{{ $order->customer->phone }}
{{ $order->customer->email }}
{{ $order->customer->address}}
</textarea>

            <div id="logo">

              <div id="logoctr">
                <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
                <a href="javascript:;" id="save-logo" title="Save changes">Save</a>
                |
                <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
                <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
              </div>

              <div id="logohelp">
                <input id="imageloc" type="text" size="50" value="" /><br />
                (max width: 540px, max height: 100px)
              </div>
              <img id="image" src="{{ asset('public/invoice/images/logo.png') }}" alt="Eshop Corp." />
            </div>

		</div>

		<div style="clear:both"></div>

		<div id="customer">

            <textarea id="customer-title">Eshop Corp.
c/o Chanchal Sarker</textarea>

            <table id="meta" style="margin-right: 10px;">
                <tr>
                    <td class="meta-head">Invoice No</td>
                    <td>{{ $order->id }}</td>
                </tr>
                <tr>
                    <td class="meta-head">Date</td>
                    <td><textarea id="date"></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Shipping Address</td>
                    <td><textarea id="date">{{ $shipping->address }}</textarea></td>
                </tr>
            </table>

		</div >

		<table id="items" style="margin-left:10px;margin-right:10px;">

		  <tr>
              <th>SN</th>
		      <th>Item</th>
		      <th>Unit Cost</th>
		      <th>Quantity</th>
		      <th>Price</th>
		  </tr>

		  @foreach ($orderProducts as $key=>$product)
          <tr class="item-row" style="text-align: center;">
              <td>{{ $key+1 }}</td>
		      <td class="item-name"><textarea>{{ $product->product_name }}</textarea></td>
		      <td><textarea class="cost">TK {{ $product->product_price }}</textarea></td>
		      <td><textarea class="qty">{{ $product->product_quantity }}</textarea></td>
		      <td><span class="price">TK {{ $product->product_price*$product->product_quantity }}</span></td>
		  </tr>
          @endforeach

		  <tr id="hiderow">
		    <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row">More Row</a></td>
		  </tr>
		  <tr style="text-align: right">
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Subtotal</td>
		      <td class="total-value"><div id="subtotal">TK {{ $order->total_price }}</div></td>
		  </tr>
		  <tr style="text-align: right">
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Total</td>
		      <td class="total-value"><div id="total">TK {{ $order->total_price }}</div></td>
		  </tr>
		  <tr style="text-align: right">
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Amount Paid</td>

		      <td class="total-value"><div id="paid">{{ $order->payment_type =='Cash'? 'TK 0.00':$order->total_price }}</div></td>
		  </tr>
		  <tr style="text-align: right">
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due</td>
		      <td class="total-value balance"><div class="due">TK {{ $order->payment_type =='Cash'? $order->total_price:'0.00' }}</div></td>
		  </tr>

		</table>

		<div id="terms">
		  <h5>Terms</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>

	</div>

</body>

</html>
