Thank you for shopping at {'STORE_NAME'|config}!
{if !$html}
Hello,

Thank you for shopping at Illuminata Eyewear!

We are excited to deliver the best eyeglasses for your vision needs. When you shop here, you receive not just a great pair of eyeglasses or sunglasses, you
also receive our promise to service your purchase beyond manufacturer warranty. Should you need any adjustments or repair, we will do our best to fix your eyeglasses free of charge for a lifetime of your eyeglasses.

We operate in a high fashion industry and carry most of world's best eyeglasses brands. Prada, Bvlgari, Tom Ford, Tiffany, Gucci and Dior plus 40 more famous and niche brands.
We will be sharing with you the interesting news and trends as they are happening in the fashion world. We promise to e-mail you only when there is something exciting to share!

To make things more interesting, we some times have limited time offers, promotions and coupons.

We would like to invite you to join our Facebook page and would appreciate your share to help us grow our business:
https://www.facebook.com/IlluminataEyewear

Also, please leave a Google Map review, if you like our store! Google cares very much for these reviews and gives us a credit for every review posted.
Google review page is here: https://www.google.ca/maps/place/Illuminata+Eyewear/@43.6149794,-79.5574089,17z/data=!3m1!4b1!4m2!3m1!1s0x882b4806b6f0c44b:0x1fea61f58404502a?hl=en

Thank you a ton.

We are looking forward to seeing you soon at our store!

{include file="email/en/signature.tpl"}

-----------------------------------------------
If you do not want to receive any more newsletter messages from us, please visit the link below to remove yourself from our mailing list:
<a href="{link controller=newsletter action=unsubscribe query="email=`$email`" url=true}">Unsubscribe</a>
{/if}{*html*}
{if $html}
Hello,

Thank you for shopping at <a href="http://www.illuminataeyewear.com">Illuminata Eyewear!</a>

We are excited to deliver the best eyeglasses for your vision needs. When you shop here, you receive not just a great pair of eyeglasses or sunglasses, you
also receive our promise to service your purchase beyond manufacturer warranty. Should you need any adjustments or repair, we will do our best to fix your eyeglasses free of charge for a lifetime of your eyeglasses.

We operate in a high fashion industry and carry most of world's best eyeglasses brands. Prada, Bvlgari, Tom Ford, Tiffany, Gucci, Dior plus 40 more famous and niche brands.
We will be sharing with you the interesting news and trends as they are happening in the fashion world. We promise to e-mail you only when there is something exciting to share!

To make things more interesting, we some times have limited time offers, promotions and coupons.

We would like to invite you to join our Facebook page and would appreciate your share to help us grow our business:
<a href="https://www.facebook.com/IlluminataEyewear">https://www.facebook.com/IlluminataEyewear</a>.

Also, please leave a <a href="https://www.google.ca/maps/place/Illuminata+Eyewear/@43.6149794,-79.5574089,17z/data=!3m1!4b1!4m2!3m1!1s0x882b4806b6f0c44b:0x1fea61f58404502a?hl=en">Google Map review</a>, if you like our store! Google cares very much for these reviews and gives us a credit for every review posted.

We are looking forward to seeing you soon at our store!


{include file="email/en/signature.tpl"}

-----------------------------------------------
If you do not want to receive any more newsletter messages from us, please visit the link below to remove yourself from our mailing list:
<a href="{link controller=newsletter action=unsubscribe query="email=`$email`" url=true}">Unsubscribe</a>
{/if}{*html*}