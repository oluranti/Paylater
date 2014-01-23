    <?php $this->load->module('template'); ?>
    <?php $this->load->module('users'); ?>
    <?php $this->load->module('companies'); ?>
    <link href="<?php echo $this->template->get_asset(); ?>/js/datepicker/lib/themes/default.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->template->get_asset(); ?>/js/datepicker/lib/themes/default.date.css" rel="stylesheet" type="text/css" />
    <section>
        <button type="button" class="btn btn-warning btn-lg register" data-toggle="modal" data-target="#myModal">CLICK HERE TO REGISTER</button>
    </section>
    
    <?php
    
    $firstname = $this->uri->segment(3);
    $lastname = $this->uri->segment(4);
    $email = $this->uri->segment(5);
    $verificationcode = $this->uri->segment(6);
    //$phonenumber = $this->uri->segment(7);
    if(!empty($firstname)){ 
    $verify = $this->users->makeHash(urldecode($firstname).'-'.urldecode($lastname).'-'.urldecode($email));
    
    if($verificationcode == $verify){
        $verification = true;
    }else{
        $verification = false;
    }
    }
     ?>
    
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Paylater is a credit account offered by One Credit.</h4>
            <p>Please complete the form and accept terms and conditions to apply for your credit limit.</p>
          </div>
          <div class="modal-body">
          <form role="form" id="formregister" method="post" action="<?php if(!empty($verificationcode) && $verification){ ?><?php echo base_url('users/updateuser'); ?><?php }else{ ?> <?php echo base_url('users/adduser'); ?> <?php } ?>">
          <div class="form-group">
            <label for="title">Title</label>
            <select name="title" class="form-control" id="title" required >
            <option value="">Select...</option>
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Miss">Miss</option>
            <option value="Master">Master</option>
            </select>
          </div>
          <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" name="firstname" id="firstname" <?php if(!empty($firstname)){ ?> value="<?php echo urldecode($firstname); ?>" disabled <?php } ?> placeholder="First Name" required />
          </div>
          <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" <?php if(!empty($lastname)){ ?> value="<?php echo urldecode($lastname); ?>"  <?php } ?> required />
          </div>
          <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control" id="gender" required>
            <option value="">Select...</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            </select>
          </div>
          <div class="form-group">
            <label for="maritalstatus">Marital Status</label>
            <select name="maritalstatus" class="form-control" id="maritalstatus" required>
                <option value="">Select...</option>
            	<option value="Married">Married</option>
            	<option value="Single">Single</option>
            	<option value="Divorced">Divorced</option>
            	<option value="Widowed">Widowed</option>
            	<option value="Separated">Separated</option>
            </select>
          </div>
          <div class="form-group">
            <label for="dateofbirth">Date of Birth</label>
            <input type="text" class="form-control" name="dateofbirth" id="dateofbirth" placeholder="Date of Birth" style="cursor: pointer !important;" title="Click to Input Date of Birth" required />
          </div>
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="name@email.com" <?php if(!empty($email)){ ?> value="<?php echo urldecode($email); ?>" disabled <?php } ?> required />
          </div>
          <div class="form-group">
            <label for="homeaddress">Home Address</label>
            <textarea class="form-control" name="homeaddress" id="homeaddress" placeholder="Home Address" <?php if(!empty($homeaddress)){ ?> required  disabled <?php } ?>><?php if(!empty($homeaddress)){ ?> <?php echo urldecode($homeaddress); ?><?php } ?></textarea>
          </div>
          <div class="form-group">
            <label for="residentialstatus">Residential status</label>
            <select name="residentialstatus" class="form-control" id="residentialstatus" required>
            <option value="">Select...</option>
            <option value="House Owner">House Owner</option>
            <option value="Rented">Rented</option>
            <option value="Family House">Family House</option>
            <option value="Living With Friend(s)">Living With Friend(s)</option>
            <option value="Temporary Accommodation">Temporary Accommodation</option>
            </select>
          </div>
          <div class="form-group">
            <label for="howlonglived">How Long Have You Lived Here?</label>
            <select name="howlonglived" class="form-control" id="howlonglived" required>
            <option value="">Select...</option>
            <option value="Less Than 1 Year">Less Than 1 Year</option>
            <option value="1 - 3 Years">1 - 3 Years</option>
            <option value="3 - 5 Years">3 - 5 Years</option>
            <option value="More Than 5 Years">More Than 5 Years</option>
            </select>
          </div>
          <div class="form-group">
            <label for="telephonenumber">Telephone Number</label>
            <input type="text" class="form-control" name="telephonenumber" id="telephonenumber" <?php if(!empty($phonenumber)){ ?> value="<?php echo urldecode($phonenumber); ?>" disabled <?php } ?> placeholder="07000000000" required />
          </div>
          <div class="form-group">
            <label for="alternativecontactnumber">Alternative Contact Number</label>
            <input type="text" class="form-control" name="alternativecontactnumber" id="alternativecontactnumber" placeholder="08000000000" class="required number" required />
          </div>
          <div class="form-group">
            <label for="employmenttype">Employment Type</label>
            <select name="employmenttype" class="form-control" id="employmenttype" required>
            <option value="">Select...</option>
            <option value="Self-Employed">Self-Employed</option>
            <option value="Salary Employee">Salary Employee</option>
            <option value="Student">Student</option>
            <option value="Unemployed">Unemployed</option>
            </select>
          </div>
          <div class="form-group">
            <label for="employmentlength">Length of Employment</label>
            <select name="employmentlength" class="form-control" id="employmentlength">
            <option value="">Select...</option>
            <option value="Less Than 1 Year">Less Than 1 Year</option>
            <option value="1 - 2 Years">1 - 2 Years</option>
            <option value="2 - 5 Years">2 - 5 Years</option>
            <option value="More Than 5 Years">More Than 5 Years</option>
            </select>
          </div>
          <div class="form-group">
            <label for="nameofemployer">Name of Employer/Business</label>
            <?php 
            $rawcompanies = $this->companies->read(); 
            $foo = 0;
            $comma = ",";
            ?>
            <input type="text" class="form-control" name="nameofemployer" id="nameofemployer" placeholder="Name of Employer/Business"  data-provide="typeahead" data-source="[<?php foreach($rawcompanies->result() as $company){ $foo++; if($foo > 1){ echo $comma; }?>&quot;<?php echo $company->company; ?>&quot;<?php } ?>]" required />
          </div>
          <div class="form-group">
            <label for="officeaddress">Office/Business Address</label>
            <textarea class="form-control" name="officeaddress" id="officeaddress" placeholder="Office/Business Address" required></textarea>
          </div>
          <div class="form-group">
            <label for="monthlyincome">Monthly Income</label>
            <input type="text" class="form-control" name="monthlyincome" id="monthlyincome" placeholder="Monthly Income" autocomplete="off" required /> 
          </div>
          <div class="form-group">
            <label for="noofdependants">Number of Dependants</label>
            <select name="noofdependants" class="form-control" id="noofdependants" required>
            <option value="">Select...</option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="More Than 10">More Than 10</option>
            </select>
          </div>
          <div class="form-group">
            <label for="bankaccounttype">What type of account do you use?</label>
            <select name="bankaccounttype" class="form-control" id="bankaccounttype" required >
            <option value="">Select...</option>
            <option value="Current">Current</option>
            <option value="Savings">Savings</option>
            <option value="None">None</option>
            </select> 
          </div>
          <div class="form-group">
            <label for="bank">Select Your Bank</label>
            <select name="bank" class="form-control" id="bank">
            <option value="">Select...</option>
            <option value="Access Bank">Access Bank</option>
            <option value="Citibank">Citibank</option>
            <option value="Diamond Bank">Diamond Bank</option>
            <option value="Ecobank Nigeria">Ecobank Nigeria</option>
            <option value="Enterprise Bank Limited">Enterprise Bank Limited</option>
            <option value="Fidelity Bank Nigeria">Fidelity Bank Nigeria</option>
            <option value="First Bank of Nigeria">First Bank of Nigeria</option>
            <option value="First City Monument Bank">First City Monument Bank</option>
            <option value="Guaranty Trust Bank">Guaranty Trust Bank</option>
            <option value="Heritage Bank Plc">Heritage Bank Plc</option>
            <option value="Jaiz Bank Plc">Jaiz Bank Plc</option>
            <option value="Keystone Bank Limited">Keystone Bank Limited</option>
            <option value="Mainstreet Bank Limited">Mainstreet Bank Limited</option>
            <option value="Savannah Bank">Savannah Bank</option>
            <option value="Skye Bank">Skye Bank</option>
            <option value="Stanbic IBTC Bank Nigeria Limited">Stanbic IBTC Bank Nigeria Limited</option>
            <option value="Standard Chartered Bank">Standard Chartered Bank</option>
            <option value="Sterling Bank">Sterling Bank</option>
            <option value="Union Bank of Nigeria">Union Bank of Nigeria</option>
            <option value="United Bank for Africa">United Bank for Africa</option>
            <option value="Unity Bank Plc">Unity Bank Plc</option>
            <option value="Wema Bank">Wema Bank</option>
            <option value="Zenith Bank">Zenith Bank</option>
            </select> 
          </div>
          <div class="form-group">
            <label for="doyouhaveloans">Do You Currently Have Loan(s) With Any Other Bank or Financial Institution?</label>
            <select name="doyouhaveloans" class="form-control" id="doyouhaveloans" required>
            <option value="">Select...</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            </select> 
          </div>
          <div class="form-group">
            <label for="loanvalue">If Yes, Please Input Total Value of Loan(s)</label>
            <input type="text" class="form-control" name="loanvalue" id="loanvalue" placeholder="Please Input Total Value of Loan(s)" autocomplete="off" /> 
          </div>
          <div class="form-group">
            <label for="contacttime">When Can We Contact You on Phone?</label>
            <select name="contacttime" class="form-control" id="contacttime" required>
            <option value="">Select...</option>
            <option value="Weekdays 9 am - 12 noon">Weekdays 9 am - 12 noon</option>
            <option value="Weekdays 12 noon - 3 pm">Weekdays 12 noon - 3 pm</option>
            <option value="Weekdays 3 pm - 6 pm">Weekdays 3 pm - 6 pm</option>
            </select> 
          </div>
          
          <div class="checkbox">
            <label>
              <input type="checkbox" value="I Agree" name="agree" id="agree" required /> I agree to the <a href="#" data-toggle="modal" data-target="#TC">terms and conditions.</a>
            </label>
          </div>
          <?php if(!empty($verificationcode) && $verification){ ?>
          
            <input type="hidden" name="status" value="Active"/>
            <input type="hidden" name="id" value="<?php echo $this->users->getuserid(urldecode($email)); ?>"/>
            <input type="hidden" name="firstname" value="<?php echo urldecode($firstname); ?>"/>
            <input type="hidden" name="lastname" value="<?php echo urldecode($lastname); ?>"/>
            <input type="hidden" name="email" value="<?php echo urldecode($email); ?>"/>
            <?php }else{ ?> 
            <?php if(isset($firstname,$lastname,$email)){ ?>
            <input type="hidden" name="firstname" value="<?php echo urldecode($firstname); ?>"/>
            <input type="hidden" name="lastname" value="<?php echo urldecode($lastname); ?>"/>
            <input type="hidden" name="email" value="<?php echo urldecode($email); ?>"/>
            <?php } ?>
            <?php if(!empty($verificationcode)){ ?>
             <input type="hidden" name="status" value="<?php echo $verificationcode; ?>"/>
            <?php }else{ ?>
            <input type="hidden" name="status" value="Direct"/>
            <?php } ?>
            <?php } ?>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button></form>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <!-- Modal -->
<div class="modal fade" id="TC" tabindex="-1" role="dialog" aria-labelledby="TCLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="TCLabel">Terms and Conditions</h4>
      </div>
      <div class="modal-body">
      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p><strong>TERMS AND CONDITIONS</strong><br />
  These Terms and Conditions apply to and regulate the provision of  credit facilities advanced by One Credit Limited (&ldquo;The Lender&rdquo;) to the Borrower  herein. These Terms and Conditions constitute the Lender's offer and sets out  the terms governing this Agreement.</p>
<p><strong>PayLater&reg;</strong> is an open-end  credit plan offered by One Credit Limited (&quot;the Lender&quot;). BY  ACCEPTING THIS ONLINE OFFER, A PAYLATER ACCOUNT IS SET UP WITH ONE CREDIT and  you agree that you have read the Terms and Conditions, you authorize the Lender  to review your credit report and you understand that this account is subject to  transaction fees and default Fees and is governed by the Laws of the Federal  Republic of Nigeria. You authorize the Merchant to share your personal  information, including email address, with the Lender, and authorize the Lender  to use that information for all lawful purposes, including sharing or receiving  data with the Merchants (our Partners) in connection with the account. </p>
<p>You may be asked to provide information (such as your date of birth  and your bank account number), each time you use PayLater&reg;. This information is  used solely for verification purposes.</p>
<p><strong>HOW TO USE PayLater ACCOUNT</strong><br />
  This is an open-end credit account. When you make online purchase(s),  using PayLater Credit Limit made available through any of our Partners  purchases will be added to the balance of your Account, provided such purchases  do not exceed your credit limit. We will then charge you transaction fee on  each purchase made using this Account, beginning on each transaction date. </p><p><strong>1. DEFINITION</strong></p>
<p>&ldquo;<em>Parties</em>&rdquo;  to this agreement are: &quot;<em>You</em>&quot;,  &quot;<em>your</em>&quot; and &quot;<em>Borrower</em>&quot; mean the person who  applied for this <br />
  Account and agrees to this Agreement.</p>
<p><em>&quot;We&quot;, &quot;us&quot; and  &quot;our&quot; mean &ldquo;Lender&rdquo;</em>, and following an assignment, any person,  company or bank to whom the rights and/or obligations of the Lender have been  assigned</p>
<p>&ldquo;<em>Merchant&rdquo; &ldquo;our Partner</em>&rdquo; means any  person/company/organization who is duly accredited, acknowledged and authorizes  as participatory in the PayLater payment option.</p>
<p>&ldquo;<em>Account</em>&rdquo;  means the Borrower&rsquo;s account with the Lender </p>
<p>&ldquo;<em>Disbursement Date</em>&rdquo; means the date the  Lender made payment for the purchase on behalf of the Borrower </p>
<p>&ldquo;<em>Payment Due  Date</em>&rdquo; means 30 days after the purchase was made</p>
<p>&ldquo;<em>Credit Limit</em>&rdquo; means the maximum credit  available to the Borrower on opening the account with the Lender</p>
<p><em>&ldquo;Loan&rdquo;</em> means the amount utilized by the  customer to purchase on the Merchant&rsquo;s site </p>
<p><strong>2. CUSTOMER CONSENT</strong>:<br />
  By ticking the <em>&quot;I agree to the Terms and Conditions&quot;</em>, on the application form, which you  hereby adopt as your electronic signature, you consent and agree that: </p>
<ul>
  <li>We can provide materials and other information  about your legal rights and duties to you electronically.</li>
</ul>
<ul>
  <li>We are authorized to share, receive and use  data/information collected from your transaction/purchases with the Merchants  (our partners) while assessing your credit limit.</li>
</ul>
<ul>
  <li>Your electronic signature on agreements and  documents has the same effect as if you signed them using ink on paper or any  other physical means.</li>
</ul>
<ul>
  <li>We can send all important communications,  billing statements and demand notes and reminders (collectively referred to as  &ldquo;Disclosures&rdquo;) to you electronically via our website or to the email address  that you have provided to the Merchant in this transaction or to another email  address that you provide to us for that purpose rather than in paper form.</li>
</ul>
<ul>
  <li>We will alert you when the Disclosures are  available, by sending you an electronic communication.</li>
</ul>
<ul>
  <li>Our email will tell you how you can view the  Disclosures.</li>
</ul>
<ul>
  <li>We will make the Disclosures available to you  from the date it first became available to you, or the date we sent you the  email to alert you that it was available.</li>
</ul>
<ul>
  <li>You will be able to print a copy of the  Disclosure or download the information for your records.</li>
</ul>
<ul>
  <li>This consent applies to this transaction, to all  future Disclosures on this Account, to all future transactions in which you use  the PayLater Payment option with us, at any time, and to other Disclosures that  we provide to you by email, unless you have, prior to such transaction,  withdrawn your consent by the procedure mentioned below.</li>
</ul>
<ul>
  <li>By consenting, you agree that electronic  Disclosures have the same meaning and effect as if we provided paper  Disclosures to you as we are required to do so. When we send you an email  alerting you that the Disclosures are available electronically and make it  available online, that shall have the same meaning and effect as if we provided  paper Disclosures to you, whether or not you choose to view the Disclosures,  unless you had previously withdrawn your consent to receive Disclosures  electronically.</li>
</ul>
<p><strong>3. TRANSACTION FEE</strong></p>
<ul>
  <li>The transaction Fee for the use of the PayLater  payment system shall be a flat 10% fixed for the term of this loan.</li>
</ul>
<ul>
  <li>The transaction fee does not preclude The Lender  from charging default fees, penalty fee and in the event of any dispute arising  from this terms and Condition - the cost of Litigation/Solicitors&rsquo; fees.</li>
</ul>
<ul>
  <li>The Transaction fee may be increases or  decreases from time to time by the Lender. Such change in Transaction fee will  take effect on the Borrower&rsquo;s account following a minimum of 15 days written  notice.</li>
</ul>
<ul>
  <li>Total transaction fee of the term of the loan  will still be due in the event of the Borrower liquidating the loan before  expiration.</li>
</ul>
<p><strong>4. BORROWER&rsquo;S OBLIGATIONS</strong>:</p>
<ul>
  <li>To pay to us, the balance on this Account,  including all Purchases and Cash Advances, extensions of credit and other  amounts Borrower has authorized us to charge to this Account. Borrower promises  to pay these amounts as agreed in this Agreement, including the promise to make  the Minimum Payment Due on each purchase on or before the Payment Due Date.</li>
</ul>
<ul>
  <li>To pay for all Purchases made by you and by  anyone you authorized to use this Account. The Lender reserves the right to  presume that the Borrower has authorized any Purchase made in the name of the  Borrower using this Account. The Borrower will not be responsible for any  unauthorized Purchases using this Account only if the Borrower returns the  purchases goods to the merchant within 24 hours of purchase or alerts the  Merchant or Borrower of imminent fraud by another person on his account within  24 hours of such fraud.</li>
</ul>
<ul>
  <li>To pay for all Cash Advances made by you and by  someone you authorized to use this Account. We will not be responsible for any  unauthorized Cash Advances using this Account.</li>
</ul>
<ul>
  <li>To give us authentic and up-to-date personal  financial information about you that we may reasonably request, from time to  time.</li>
</ul>
<ul>
  <li>To pay all costs of collection if we take any  action to collect this Account or take any action in a bankruptcy proceeding  filed by or against you. This shall include, unless prohibited by applicable  law, reasonable attorneys' fees and expenses incurred while collection lasts.</li>
</ul>
<ul>
  <li>Not to give us false information or signatures,  electronic or otherwise, at any time.</li>
</ul>
<ul>
  <li>To pay a Late Fee and Return Cheque Fee, as  provided in this terms and conditions.</li>
</ul>
<ul>
  <li>To make all payments by cheques, money order,  electronic funds transfer or by direct credit into the Lender&rsquo;s designated  account, in a form that will be processed and honored by any financial  institution approved by the Lender.</li>
</ul>
<ul>
  <li>To promptly notify us if you change your name,  your mailing address, your e-mail address or your telephone number.</li>
</ul>
<ul>
  <li>To honor any other promises that you make in  this Agreement.</li>
</ul>
<ul>
  <li>That you will not accept this Account unless you  are of legal age and have the capacity to enter into a valid contract.</li>
</ul>
<ul>
  <li>If you are dissatisfied with goods or services  you purchased from a merchant, you will try in good faith to resolve the  dispute and correct the problem directly with the Merchant. You agree to allow  a reasonable period of time for the Merchant to resolve the dispute. This shall  in no way limit or reduce your rights in case of a billing error.</li>
</ul>
<ul>
  <li>To use PayLater only for personal, family or  household purposes.</li>
</ul>
<p><strong>5. LENDER&rsquo;S OBLIGATIONS</strong></p>
<ul>
  <li>To advance payment to the merchant on behalf of  the Borrower when the Borrower uses the PayLater option for transacting a  purchase</li>
</ul>
<ul>
  <li>To perform a) above upon confirmation of the  purchase and request by the Merchant</li>
</ul>
<ul>
  <li>To demand repayment for the Borrower as and when  due</li>
</ul>
<ul>
  <li>To conduct investigations on the Borrower prior  to opening an account for the Borrower</li>
</ul>
<ul>
  <li>To require the Borrower to prove the  authenticity of documents and any information provided while applying for the  account</li>
</ul>
<ul>
  <li>To use all reasonable and legitimate means to  collect the amount expended on the purchases of the Borrower and the  transaction fees on such purchase.</li>
</ul>
<p><strong>6. CREDIT REFERENCE</strong></p>
<ul>
  <li>The Lender or its duly authorized  representatives/agents will utilize a dedicated Credit Agency for a credit  report on the Borrower in considering any application for credit.</li>
</ul>
<ul>
  <li>The Borrower authorizes The Lender to access any  information available to The Lender as provided by the Credit Agency.</li>
</ul>
<ul>
  <li>The Borrower also agrees that the Borrower&rsquo;s  details and the loan application decision may be registered with the Credit  Agency.</li>
</ul>
<p><strong>7. NOTICES</strong><br />
  The Borrower agrees  that The Lender may communicate with them by sending notices, messages, alerts  and statements in relation to this Agreement in the following manner:</p>
<ul>
  <li>To the most recent physical address The Lender  holds for the Borrower on file</li>
</ul>
<ul>
  <li>By delivery to any email address provided during  the application process.</li>
</ul>
<ul>
  <li>By delivery of an SMS to any mobile telephone  number the Borrower has provided to The Lender.</li>
</ul>
<p><strong>8.1. EVENT OF DEFAULT</strong><br />
Default in terms of this Agreement will occur if:</p>
<ul>
  <li>The Borrower fails to make any scheduled  repayment in full on or before the payment due date in accordance with the  repayment plan given to the Borrower;</li>
</ul>
<ul>
  <li>Any representation/information, warranty or  assurance made or given by the Borrower in connection with the application for  this loan or any information or documentation supplied by the Borrower is later  discovered to be materially incorrect; or</li>
</ul>
<ul>
  <li>The Borrower does or omits to do anything which  may prejudice The Lender&rsquo;s rights in terms of this Agreement or causes The  Lender to suffer any loss or damage.</li>
</ul>
<p>In the event of any default by the Borrower subject  to clause 8.1 above -</p>
<ul>
  <li>The Lender reserves the right to assign its  right, title and interest under the Agreement to an external Collections Agency  who will take all reasonable steps to collect the outstanding loan amount.</li>
</ul>
<ul>
  <li>The Lender also reserves the right to institute  legal proceedings against the defaulting Borrower and is under no obligation to  inform the Borrower before such proceedings commence.</li>
</ul>
<ul>
  <li>The Borrower shall be responsible for all legal  costs and expenses incurred by The Lender in attempting to obtain repayment of  any outstanding loan balance owed by the Borrower. Interest on any amount which  becomes due and payable shall be charged.</li>
</ul>
<p><strong>9. TERMINATION OF THE ACCOUNT</strong></p>
<ul>
  <li>In addition to Termination by default, we may  terminate this Agreement at any time and for any reason subject to the  requirements of applicable law.</li>
</ul>
<ul>
  <li>We can terminate your Account by sending written  notice to the address on the billing statement.</li>
</ul>
<ul>
  <li>If there is no debit or credit on this Account  for twelve (12) consecutive months, we may terminate this Account without  notice to you. </li>
</ul>
<ul>
  <li>After Termination, you will not be able to make  new Purchases on this Account. Termination will not affect any Purchase which  complies with this Agreement and which was made before the date of the  Termination notice. If we choose, at our sole option, to allow Purchases after  we have terminated this Account (whether or not you have given us notice to  terminate this Account), you agree that we may charge those Purchases to this  Account.</li>
</ul>
<p><strong>10. GENERAL</strong></p>
<ul>
  <li>This Agreement represents the entire  understanding between The Lender and the Borrower. </li>
</ul>
<ul>
  <li>Amendment shall be made by the Lender from time  to time and communicated to the Borrower in writing.</li>
</ul>
<ul>
  <li>The Borrower agrees and undertakes that for the  period of this Agreement, the Borrower will not close the Borrower&rsquo;s specified  bank account.</li>
</ul>
<ul>
  <li>This Agreement shall be governed by the laws of  the Federal Republic of Nigeria and shall be subject to the jurisdiction of the  courts of the Federal Republic of Nigeria.</li>
</ul>
<ul>
  <li>If The Lender does not strictly enforce its  rights under this Agreement (including its right to insist on the repayment of  all sums due on the Repayment Due Date) or grant the Borrower an indulgence,  The Lender will not be deemed to have lost those rights and will not be  prevented from insisting upon its strict rights at a later date.</li>
</ul>
<ul>
  <li>The Lender reserves the right to transfer or  assign its rights and obligations under this Agreement (including its  obligation to lend money to the Borrower or the amount owed under this  Agreement) to another person. The Lender will only inform the Borrower if such  a transfer causes the arrangements for the administration of this Agreement to  change.</li>
</ul>
<ul>
  <li>The Borrower authorizes and consents to all  lawful access, use or disclosure of the Borrower&rsquo;s particulars in the  application by The Lender which may include but shall not be limited to  purposes necessary to promote or sustain the business of The Lender; and the  Borrower waives any claims the Borrower may have against The Lender arising  from any such access, use or disclosure.</li>
</ul>
</body>
</html>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
$(document).ready(function(){
    $('#formregister').validate({ 
        rules: { 
            telephonenumber: { 
                required: true, 
                number: true, 
                maxlength: 11,
                minlength: 11
                },
            monthlyincome: { 
                required: true, 
                number: true
                },
            loanvalue: {
                number: true
                },
            alternativecontactnumber: { 
                required: true, 
                number: true, 
                maxlength: 11,
                minlength: 11
                }, 
                agree: { 
                    required: true 
                    } 
                    } 
                    });
                    
  <?php if(!empty($firstname)){ ?> $('#myModal').modal('show');  <?php } ?>
  $('#dateofbirth').pickadate({
    today: '',
    clear: 'Clear selection',
     selectYears: 100,
     selectMonths: true
})
  
}

);
</script>
<script src="<?php echo $this->template->get_asset(); ?>/js/datepicker/lib/picker.js"></script>
<script src="<?php echo $this->template->get_asset(); ?>/js/datepicker/lib/picker.date.js"></script>
<script src="<?php echo $this->template->get_asset(); ?>/js/datepicker/lib/legacy.js"></script>