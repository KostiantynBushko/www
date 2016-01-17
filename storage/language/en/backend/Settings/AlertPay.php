<?php $languageDefs = array (
  'AlertPay_help' => '<h2>Additional Setup Instructions</h2><ol><li>Login to your AlertPay account</li><li>Go to <a href="https://www.alertpay.com/ManageIPN.aspx">Business Tools &gt; Manage IPN</a> section</li><li>Enter your account <strong>PIN</strong> to activate IPN</li><li>Change <em>IPN Status</em> to <em><strong>Enabled</strong></em></li><li>Change <em>Alert URL </em> to <em><strong>{link controller=checkout action=notify id=AlertPay url=true}</strong></em></li><li>Enter the generated <em>Security Code</em> in LiveCart options below</li></ul>',
  'AlertPay_EMAIL' => 'Business account e-mail',
  'AlertPay_ITEM_NAME' => 'Item name to show at AlertPay',
  'AlertPay_SECURITY_CODE' => 'Security code',
); ?>