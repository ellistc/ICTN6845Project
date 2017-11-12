<!-- Base code http://www.ineedtutorials.com/code/php/creating-a-simple-login-script-with-php-and-mysql -->
<!-- ICTN 6845 Final Project>

Copyright © <years> <Tim Ellis>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. -->
<form name="login-form" id="login-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
  <fieldset> 
  <legend>Please login:</legend> 
  <dl> 
    <dt> 
      <label title="Username">Username:
      <input tabindex="1" accesskey="u" name="username" type="text" maxlength="50" id="username" /> 
      </label> 
    </dt> 
  </dl> 
  <dl> 
    <dt> 
      <label title="Password">Password:
      <input tabindex="2" accesskey="p" name="password" type="password" maxlength="15" id="password" /> 
      </label> 
    </dt> 
  </dl> 
  <dl> 
    <dt> 
      <label title="Submit"> 
      <input tabindex="3" accesskey="l" type="submit" name="cmdlogin" value="Login" /> 
      </label> 
    </dt> 
  </dl> 
  </fieldset> 
</form>