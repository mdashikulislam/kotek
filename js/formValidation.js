function validate(form)
{

	var firstname = trim(form.firstname.value);
	var phone=form.phone.value
	var email=trim(form.email.value);

	var msg_msg = trim (form.msg_msg.value);
	
	var firstnameRegex = /^[a-zA-Z]+(([\'\,\.\- ][a-zA-Z ])?[a-zA-Z]*)*$/;
	var phoneRegex = /^\D?(\d{3})\D?\D?(\d{3})\D?(\d{4})$/;
	var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
	


	if(firstname == "")
	{
		inlineMsg('firstname','Please Enter Name.',3);
		return false;
	}
	
	if((firstname.length < 3 ) || (firstname.length >70))
	{
		inlineMsg('firstname','Name Should have atleast 3 Characters and less then 70 Characters.',3);
		return false;
	}
   
	if(!firstname.match(firstnameRegex)) 
	{
		inlineMsg('firstname','Please Enter Characters Only.',3);
		return false;
	} 
	
	
	

	
	if((phone == "") || (phone == "___-___-____"))
	{
		inlineMsg('phone','Please Enter Phone.',3);
		return false;
	}
	
	if(phone.indexOf('___')!=-1){
		inlineMsg('phone','Please Enter Valid Phone.',3);
		return false;
	}
	
	if(!phone.match(phoneRegex)){
		inlineMsg('phone','Please Enter Valid Phone.',3);
		return false;
	}
	
	if(email == "")
	{
		inlineMsg('email','Please Enter Email.',3);
		return false;
	}
	
	if(!email.match(emailRegex)) 
	{
		inlineMsg('email','Please Enter Valid Email Address.',3);
		return false;
	} 
	
	if(msg_msg == "")
	{
		inlineMsg('msg_msg','Please Type Your Message.',3);
		return false;
	}
	
	
	

	return true;
}

function validateShipping()
{
	
	var customer_last_name = trim(document.getElementById('customer_last_name').value);
	var customer_first_name = trim(document.getElementById('customer_first_name').value);
	var address = trim(document.getElementById('address').value);
	var post_code = trim(document.getElementById('post_code').value);
	var state = trim(document.getElementById('state').value);
	var city = trim(document.getElementById('city').value);
	var country = trim(document.getElementById('country').value);	
	var checkType = trim(document.getElementById('checkType').value);
	var phone_number=document.getElementById('phone_number').value
	var email=trim(document.getElementById('email').value);

	//var msg_msg = trim (document.getElementById('email').value);
	
	var firstnameRegex = /^[a-zA-Z]+(([\'\,\.\- ][a-zA-Z ])?[a-zA-Z]*)*$/;
	var phoneRegex = /^\D?(\d{3})\D?\D?(\d{3})\D?(\d{4})$/;
	var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
	var numonly = /^[0-9\-\ \+]+$/;
		if(customer_first_name == "")
	{
		inlineMsg('customer_first_name','Please Enter First Name.',3);
		return false;
	}
	
	if((customer_first_name.length < 3 ) || (customer_first_name.length >70))
	{
		inlineMsg('customer_first_name','Name Should have atleast 3 Characters and less then 70 Characters.',3);
		return false;
	}
   
	if(!customer_first_name.match(firstnameRegex)) 
	{
		inlineMsg('customer_first_name','Please Enter Characters Only.',3);
		return false;
	}
	
	
	if(customer_last_name == "")
	{
		inlineMsg('customer_last_name','Please Enter Last Name.',3);
		return false;
	}
	
	if((customer_last_name.length < 3 ) || (customer_last_name.length >70))
	{
		inlineMsg('customer_last_name','Name Should have atleast 3 Characters and less then 70 Characters.',3);
		return false;
	}
   
	if(!customer_last_name.match(firstnameRegex)) 
	{
		inlineMsg('customer_last_name','Please Enter Characters Only.',3);
		return false;
	} 
	
	if(checkType == '1')
	{
	var upassword = trim(document.getElementById('upassword').value);
	if(upassword == "")
	{
		inlineMsg('upassword','Please Enter Password.',3);
		return false;
	}
	
	if((upassword.length < 6 ) || (upassword.length >10))
	{
		inlineMsg('upassword','Password Should have atleast 6 Characters and less then 10 Characters.',3);
		return false;
	}
   
	var cpassword = trim(document.getElementById('cpassword').value);
		if(upassword == "")
	{
		inlineMsg('cpassword','Please Enter Confirm Password.',3);
		return false;
	}
	
	if(cpassword != upassword)
	{
		inlineMsg('cpassword','Please enter same password',3);
		return false;
	}
	}
	
	
	if(email == "")
	{
		inlineMsg('email','Please Enter Email.',3);
		return false;
	}
	
	if(!email.match(emailRegex)) 
	{
		inlineMsg('email','Please Enter Valid Email Address.',3);
		return false;
	} 
	
	if(address == "")
	{
		inlineMsg('address','Please Enter Address.',3);
		return false;
	}
	
	if((address.length < 3 ) || (address.length >100))
	{
		inlineMsg('address','Address Should have atleast 3 Characters and less then 100 Characters.',3);
		return false;
	}
	if(post_code == "")
	{
		inlineMsg('post_code','Please Enter post code.',3);
		return false;
	}
	
	if((post_code.length < 3 ) || (post_code.length >10))
	{
		inlineMsg('post_code','Post code Should have atleast 6 Characters and less then 10 Characters.',3);
		return false;
	}
	if(city == "")
	{
		inlineMsg('city','Please Enter city.',3);
		return false;
	}
	
	if((city.length < 3 ) || (city.length >70))
	{
		inlineMsg('city','City Should have atleast 3 Characters and less then 70 Characters.',3);
		return false;
	}
	
		if(!city.match(firstnameRegex)) 
	{
		inlineMsg('city','Please Enter Characters Only.',3);
		return false;
	} 
	
		if(state == "")
	{
		inlineMsg('state','Please Enter state.',3);
		return false;
	}
	
	if((state.length < 2 ) || (state.length >70))
	{
		inlineMsg('state','State Should have atleast 2 Characters and less then 70 Characters.',3);
		return false;
	}

	if(!state.match(firstnameRegex)) 
	{
		inlineMsg('state','Please Enter Characters Only.',3);
		return false;
	} 
	if(phone_number == "")
	{
		inlineMsg('phone_number','Please Enter Phone.',3);
		return false;
	}
	if((phone_number.length < 3 ))
	{
		inlineMsg('phone_number','Phone number Should have atleast 3.',3);
		return false;
	}
	if(!phone_number.match(phoneRegex)){
		inlineMsg('phone_number','Please Enter Valid Phone. eg. 555-555-5555',3);
		return false;
	}
	if(!phone_number.match(numonly)){
		inlineMsg('phone_number','Please Enter Valid Phone. eg. 555-555-5555',3);
		return false;
	}
	if(country == "")
	{
		inlineMsg('country','Please Enter Country.',3);
		return false;
	}
	
	if((country.length < 2 ) || (country.length >2))
	{
		inlineMsg('country','Please enter country ISO code eg. US ',3);
		return false;
	}
	if(!country.match(firstnameRegex)) 
	{
		inlineMsg('country','Please Enter Characters Only.',3);
		return false;
	} 
	
	return true;
}


function validateDelivery()
{
	
	var customer_last_name = trim(document.getElementById('customer_last_nameS').value);
	var customer_first_name = trim(document.getElementById('customer_first_nameS').value);
	var address = trim(document.getElementById('addressS').value);
	var post_code = trim(document.getElementById('post_codeS').value);
	var city = trim(document.getElementById('cityS').value);
	var state = trim(document.getElementById('stateS').value);
	var country = trim(document.getElementById('countryS').value);	
	
	var phone_number=document.getElementById('phone_numberS').value
	var email=trim(document.getElementById('emailS').value);

	//var msg_msg = trim (document.getElementById('email').value);
	
	var firstnameRegex = /^[a-zA-Z]+(([\'\,\.\- ][a-zA-Z ])?[a-zA-Z]*)*$/;
	var phoneRegex = /^\D?(\d{3})\D?\D?(\d{3})\D?(\d{4})$/;
	var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
	
		if(customer_first_name == "")
	{
		inlineMsg('customer_first_nameS','Please Enter First Name.',3);
		return false;
	}
	
	if((customer_first_name.length < 3 ) || (customer_first_name.length >70))
	{
		inlineMsg('customer_first_nameS','Name Should have atleast 3 Characters and less then 70 Characters.',3);
		return false;
	}
   
	if(!customer_first_name.match(firstnameRegex)) 
	{
		inlineMsg('customer_first_nameS','Please Enter Characters Only.',3);
		return false;
	}
	
	
		if(customer_last_name == "")
	{
		inlineMsg('customer_last_nameS','Please Enter Last Name.',3);
		return false;
	}
	
	if((customer_last_name.length < 3 ) || (customer_last_name.length >70))
	{
		inlineMsg('customer_last_nameS','Name Should have atleast 3 Characters and less then 70 Characters.',3);
		return false;
	}
   
	if(!customer_last_name.match(firstnameRegex)) 
	{
		inlineMsg('customer_last_nameS','Please Enter Characters Only.',3);
		return false;
	} 
	
	if(email == "")
	{
		inlineMsg('emailS','Please Enter Email.',3);
		return false;
	}
	
	if(!email.match(emailRegex)) 
	{
		inlineMsg('emailS','Please Enter Valid Email Address.',3);
		return false;
	} 
	
	if(address == "")
	{
		inlineMsg('addressS','Please Enter Address.',3);
		return false;
	}
	
	if((address.length < 3 ) || (address.length >100))
	{
		inlineMsg('addressS','Address Should have atleast 3 Characters and less then 100 Characters.',3);
		return false;
	}
	
		if(post_code == "")
	{
		inlineMsg('post_codeS','Please Enter post code.',3);
		return false;
	}
	
	if((post_code.length < 3 ) || (post_code.length >10))
	{
		inlineMsg('post_codeS','Post code Should have atleast 6 Characters and less then 10 Characters.',3);
		return false;
	}
		if(city == "")
	{
		inlineMsg('cityS','Please Enter city.',3);
		return false;
	}
	
	if((city.length < 3 ) || (city.length >70))
	{
		inlineMsg('cityS','City Should have atleast 3 Characters and less then 70 Characters.',3);
		return false;
	}
	
	if(!city.match(firstnameRegex)) 
	{
		inlineMsg('cityS','Please Enter Characters Only.',3);
		return false;
	}
	
		if(state == "")
	{
		inlineMsg('stateS','Please Enter state.',3);
		return false;
	}
	
	if((state.length < 2 ) || (state.length >70))
	{
		inlineMsg('stateS','State Should have atleast 2 Characters and less then 70 Characters.',3);
		return false;
	}
	
	if(!state.match(firstnameRegex)) 
	{
		inlineMsg('stateS','Please Enter Characters Only.',3);
		return false;
	}
	
	if(phone_number == "")
	{
		inlineMsg('phone_numberS','Please Enter Phone.',3);
		return false;
	}
	if((phone_number.length < 3 ))
	{
		inlineMsg('phone_numberS','Phone number Should have atleast 3.',3);
		return false;
	}
	if(!phone_number.match(phoneRegex)){
		inlineMsg('phone_numberS','Please Enter Valid Phone. eg. 555-555-5555',3);
		return false;
	}
	
	if(country == "")
	{
		inlineMsg('countryS','Please Enter Country.',3);
		return false;
	}
	
	if((country.length < 2 ) || (country.length >2))
	{
		inlineMsg('countryS','Please enter country ISO code eg. US',3);
		return false;
	}
	
	if(!country.match(firstnameRegex)) 
	{
		inlineMsg('countryS','Please Enter Characters Only.',3);
		return false;
	}
	return true;
}




function validateCheck(nextDiv,methd)
{
	

	if(methd == 'shipping'){
var  test = validateShipping();	
	}
	if(methd == 'delivery'){
var  test = validateDelivery();	
	}
	if(methd == 'cardCheck'){
var  test = CheckCardNumber(this.form);	
	}
if(test){
	$("."+nextDiv).show('slow');
}
return false;
}




var Cards = new makeArray(8);
Cards[0] = new CardType("MasterCard", "51,52,53,54,55", "16");
var MasterCard = Cards[0];
Cards[1] = new CardType("Visa", "4", "13,16");
var VisaCard = Cards[1];
Cards[2] = new CardType("Amex", "34,37", "15");
var AmExCard = Cards[2];
Cards[3] = new CardType("DinersClubCard", "30,36,38", "14");
var DinersClubCard = Cards[3];
Cards[4] = new CardType("Discover", "6011", "16");
var DiscoverCard = Cards[4];
Cards[5] = new CardType("enRouteCard", "2014,2149", "15");
var enRouteCard = Cards[5];
Cards[6] = new CardType("JCBCard", "3088,3096,3112,3158,3337,3528", "16");
var JCBCard = Cards[6];
var LuhnCheckSum = Cards[7] = new CardType();


// credit card validation 

function CheckCardNumber(form) {

// select card

var form = document.shipNow;
if (form.CardType.value.length == 0) {
//alert("Please enter a Card Number.");
inlineMsg('CardType','Please choose card type',3);
form.cardNo.focus();
return;
}



var tmpyear;
var form = document.shipNow;
if (form.cardNo.value.length == 0) {
//alert("Please enter a Card Number.");
inlineMsg('cardNo','Please Enter a Card Number.',3);
form.cardNo.focus();
return;
}
if (form.year.value.length == 0) {
//alert("Please enter the Expiration Year.");
inlineMsg('year','Please enter the Expiration Year.',3);
form.year.focus();
return;
}
if (form.year.value > 96)
tmpyear = "19" + form.year.value;
else if (form.year.value < 21)
tmpyear = "20" + form.year.value;
else {
inlineMsg('year','The Expiration Year is not valid.',3);
//alert("The Expiration Year is not valid.");
return false;
}
tmpmonth = form.month.options[form.month.selectedIndex].value;
// The following line doesn't work in IE3, you need to change it
// to something like "(new CardType())...".
// if (!CardType().isExpiryDate(tmpyear, tmpmonth)) {
if (!(new CardType()).isExpiryDate(tmpyear, tmpmonth)) {
inlineMsg('cardNo','This card has already expired.',3);
//alert("This card has already expired.");
return false; 
}
card = form.CardType.options[form.CardType.selectedIndex].value;
var retval = eval("checkCardNumber(\"" + form.cardNo.value +
"\", " + tmpyear + ", " + tmpmonth + ");");
cardname = "";
if (retval)
{


// comment this out if used on an order form
//alert("This card number appears to be valid.");
//$("#cardSt").html("This card number appears to be valid.");

}else {
// The cardnumber has the valid luhn checksum, but we want to know which
// cardtype it belongs to.
for (var n = 0; n < Cards.size; n++) {
if (Cards[n].checkCardNumber(form.cardNo.value, tmpyear, tmpmonth)) {
cardname = Cards[n].getCardType();
break;
   }
}
if (cardname.length > 0) {
alert("This looks like a " + cardname + " number, not a " + card + " number.");
}
else {
alert("This card number is not valid.");
return false;
      }
   }
   
if (form.ccv.value.length == 0) {
alert("Please enter a ccv number.");
form.ccv.focus();
return;
}
   return true;
}
/*************************************************************************\
Object CardType([String cardtype, String rules, String len, int year, 
                                        int month])
cardtype    : type of card, eg: MasterCard, Visa, etc.
rules       : rules of the cardnumber, eg: "4", "6011", "34,37".
len         : valid length of cardnumber, eg: "16,19", "13,16".
year        : year of expiry date.
month       : month of expiry date.
eg:
var VisaCard = new CardType("Visa", "4", "16");
var AmExCard = new CardType("AmEx", "34,37", "15");
\*************************************************************************/
function CardType() {
var n;
var argv = CardType.arguments;
var argc = CardType.arguments.length;

this.objname = "object CardType";

var tmpcardtype = (argc > 0) ? argv[0] : "CardObject";
var tmprules = (argc > 1) ? argv[1] : "0,1,2,3,4,5,6,7,8,9";
var tmplen = (argc > 2) ? argv[2] : "13,14,15,16,19";

this.setCardNumber = setCardNumber;  // set CardNumber method.
this.setCardType = setCardType;  // setCardType method.
this.setLen = setLen;  // setLen method.
this.setRules = setRules;  // setRules method.
this.setExpiryDate = setExpiryDate;  // setExpiryDate method.

this.setCardType(tmpcardtype);
this.setLen(tmplen);
this.setRules(tmprules);
if (argc > 4)
this.setExpiryDate(argv[3], argv[4]);

this.checkCardNumber = checkCardNumber;  // checkCardNumber method.
this.getExpiryDate = getExpiryDate;  // getExpiryDate method.
this.getCardType = getCardType;  // getCardType method.
this.isCardNumber = isCardNumber;  // isCardNumber method.
this.isExpiryDate = isExpiryDate;  // isExpiryDate method.
this.luhnCheck = luhnCheck;// luhnCheck method.
return this;
}

/*************************************************************************\
boolean checkCardNumber([String cardnumber, int year, int month])
return true if cardnumber pass the luhncheck and the expiry date is
valid, else return false.
\*************************************************************************/
function checkCardNumber() {
var argv = checkCardNumber.arguments;
var argc = checkCardNumber.arguments.length;
var cardnumber = (argc > 0) ? argv[0] : this.cardnumber;
var year = (argc > 1) ? argv[1] : this.year;
var month = (argc > 2) ? argv[2] : this.month;

this.setCardNumber(cardnumber);
this.setExpiryDate(year, month);

if (!this.isCardNumber())
return false;
if (!this.isExpiryDate())
return false;

return true;
}
/*************************************************************************\
String getCardType()
return the cardtype.
\*************************************************************************/
function getCardType() {
return this.cardtype;
}
/*************************************************************************\
String getExpiryDate()
return the expiry date.
\*************************************************************************/
function getExpiryDate() {
return this.month + "/" + this.year;
}
/*************************************************************************\
boolean isCardNumber([String cardnumber])
return true if cardnumber pass the luhncheck and the rules, else return
false.
\*************************************************************************/
function isCardNumber() {
var argv = isCardNumber.arguments;
var argc = isCardNumber.arguments.length;
var cardnumber = (argc > 0) ? argv[0] : this.cardnumber;
if (!this.luhnCheck())
return false;

/* for (var n = 0; n < this.len.size; n++)
if (cardnumber.toString().length == this.len[n]) {
for (var m = 0; m < this.rules.size; m++) {
var headdigit = cardnumber.substring(0, this.rules[m].toString().length);
if (headdigit == this.rules[m])
return true;
}
return false;
} */
return true;
}

/*************************************************************************\
boolean isExpiryDate([int year, int month])
return true if the date is a valid expiry date,
else return false.
\*************************************************************************/
function isExpiryDate() {
var argv = isExpiryDate.arguments;
var argc = isExpiryDate.arguments.length;

year = argc > 0 ? argv[0] : this.year;
month = argc > 1 ? argv[1] : this.month;

if (!isNum(year+""))
return false;
if (!isNum(month+""))
return false;
today = new Date();
expiry = new Date(year, month);
if (today.getTime() > expiry.getTime())
return false;
else
return true;
}

/*************************************************************************\
boolean isNum(String argvalue)
return true if argvalue contains only numeric characters,
else return false.
\*************************************************************************/
function isNum(argvalue) {
argvalue = argvalue.toString();

if (argvalue.length == 0)
return false;

for (var n = 0; n < argvalue.length; n++)
if (argvalue.substring(n, n+1) < "0" || argvalue.substring(n, n+1) > "9")
return false;

return true;
}

/*************************************************************************\
boolean luhnCheck([String CardNumber])
return true if CardNumber pass the luhn check else return false.
Reference: http://www.ling.nwu.edu/~sburke/pub/luhn_lib.pl
\*************************************************************************/
function luhnCheck() {
var argv = luhnCheck.arguments;
var argc = luhnCheck.arguments.length;

var CardNumber = argc > 0 ? argv[0] : this.cardnumber;

if (! isNum(CardNumber)) {
return false;
  }

var no_digit = CardNumber.length;
var oddoeven = no_digit & 1;
var sum = 0;

for (var count = 0; count < no_digit; count++) {
var digit = parseInt(CardNumber.charAt(count));
if (!((count & 1) ^ oddoeven)) {
digit *= 2;
if (digit > 9)
digit -= 9;
}
sum += digit;
}
if (sum % 10 == 0)
return true;
else
return false;
}

/*************************************************************************\
ArrayObject makeArray(int size)
return the array object in the size specified.
\*************************************************************************/
function makeArray(size) {
this.size = size;
return this;
}

/*************************************************************************\
CardType setCardNumber(cardnumber)
return the CardType object.
\*************************************************************************/
function setCardNumber(cardnumber) {
this.cardnumber = cardnumber;
return this;
}

/*************************************************************************\
CardType setCardType(cardtype)
return the CardType object.
\*************************************************************************/
function setCardType(cardtype) {
this.cardtype = cardtype;
return this;
}

/*************************************************************************\
CardType setExpiryDate(year, month)
return the CardType object.
\*************************************************************************/
function setExpiryDate(year, month) {
this.year = year;
this.month = month;
return this;
}

/*************************************************************************\
CardType setLen(len)
return the CardType object.
\*************************************************************************/
function setLen(len) {
// Create the len array.
if (len.length == 0 || len == null)
len = "13,14,15,16,19";

var tmplen = len;
n = 1;
while (tmplen.indexOf(",") != -1) {
tmplen = tmplen.substring(tmplen.indexOf(",") + 1, tmplen.length);
n++;
}
this.len = new makeArray(n);
n = 0;
while (len.indexOf(",") != -1) {
var tmpstr = len.substring(0, len.indexOf(","));
this.len[n] = tmpstr;
len = len.substring(len.indexOf(",") + 1, len.length);
n++;
}
this.len[n] = len;
return this;
}

/*************************************************************************\
CardType setRules()
return the CardType object.
\*************************************************************************/
function setRules(rules) {
// Create the rules array.
if (rules.length == 0 || rules == null)
rules = "0,1,2,3,4,5,6,7,8,9";
  
var tmprules = rules;
n = 1;
while (tmprules.indexOf(",") != -1) {
tmprules = tmprules.substring(tmprules.indexOf(",") + 1, tmprules.length);
n++;
}
this.rules = new makeArray(n);
n = 0;
while (rules.indexOf(",") != -1) {
var tmpstr = rules.substring(0, rules.indexOf(","));
this.rules[n] = tmpstr;
rules = rules.substring(rules.indexOf(",") + 1, rules.length);
n++;
}
this.rules[n] = rules;
return this;
}
//  End -->











