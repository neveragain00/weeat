<!-- Sign up Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(111, 202, 203);">
        <h5 class="modal-title" id="signupModal">SignUp Here</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="signupForm" action="partials/_handleSignup.php" method="post" novalidate>
          <div class="form-group">
            <b><label for="username">Username</label></b>
            <input 
              class="form-control" 
              id="username" 
              name="username" 
              placeholder="Choose a unique Username" 
              type="text" 
              required 
              minlength="2" 
              maxlength="11" 
              pattern="[A-Za-z]+" 
              title="Username must contain only letters.">
            <small class="text-danger" id="usernameError"></small>
          </div>
          
          <div class="form-row">
            <div class="form-group col-md-6">
              <b><label for="firstName">First Name:</label></b>
              <input 
                type="text" 
                class="form-control" 
                id="firstName" 
                name="firstName" 
                placeholder="First Name" 
                pattern="^[A-Za-z]+$" 
                title="First name must contain letters only" 
                required>
              <small class="text-danger" id="firstNameError"></small>
            </div>
            <div class="form-group col-md-6">
              <b><label for="lastName">Last Name:</label></b>
              <input 
                type="text" 
                class="form-control" 
                id="lastName" 
                name="lastName" 
                placeholder="Last name" 
                pattern="^[A-Za-z]+$" 
                title="Last name must contain letters only" 
                required>
              <small class="text-danger" id="lastNameError"></small>
            </div>
          </div>
          
          <div class="form-group">
            <b><label for="email">Email:</label></b>
            <input 
              type="email" 
              class="form-control" 
              id="email" 
              name="email" 
              placeholder="Enter Your Email" 
              pattern="[a-zA-Z0-9._%+-]+@gmail\\.com" 
              required>
            <small class="text-danger" id="emailError"></small>
          </div>
          
          <div class="form-group">
            <b><label for="phone">Phone No:</label></b>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon">+639</span>
              </div>
              <input 
                type="tel" 
                class="form-control" 
                id="phone" 
                name="phone" 
                placeholder="Enter Your Phone Number" 
                required 
                pattern="[0-9]{9}" 
                maxlength="9">
              <small class="text-danger" id="phoneError"></small>
            </div>
          </div>
          
          <div class="text-left my-2">
            <b><label for="password">Password:</label></b>
            <input 
              class="form-control" 
              id="password" 
              name="password" 
              placeholder="Enter Password" 
              type="password" 
              required 
              minlength="4" 
              maxlength="21" 
              pattern=".*[A-Z].*"
              autocomplete="off"
              title="Password must contain at least one uppercase letter.">
            <small class="text-danger" id="passwordError"></small>
          </div>
          
          <div class="text-left my-2">
            <b><label for="cpassword">Renter Password:</label></b>
            <input 
              class="form-control" 
              id="cpassword" 
              name="cpassword" 
              placeholder="Renter Password" 
              type="password" 
              required>
            <small class="text-danger" id="cpasswordError"></small>
          </div>
          
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
        <p class="mb-0 mt-1">Already have an account? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Login here</a>.</p>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('signupForm').addEventListener('submit', function (e) {
    let isValid = true;
    
    // Clear previous errors
    document.querySelectorAll('.text-danger').forEach(el => el.innerText = '');
    
    // Username validation
    const username = document.getElementById('username');
    if (!username.checkValidity()) {
      document.getElementById('usernameError').innerText = username.title;
      isValid = false;
    }
    
    // First name validation
    const firstName = document.getElementById('firstName');
    if (!firstName.checkValidity()) {
      document.getElementById('firstNameError').innerText = firstName.title;
      isValid = false;
    }
    
    // Last name validation
    const lastName = document.getElementById('lastName');
    if (!lastName.checkValidity()) {
      document.getElementById('lastNameError').innerText = lastName.title;
      isValid = false;
    }
    
    // Email validation
    const email = document.getElementById('email');
    if (!email.checkValidity()) {
      document.getElementById('emailError').innerText = 'Please enter a valid Gmail address.';
      isValid = false;
    }
    
    // Phone validation
    const phone = document.getElementById('phone');
    if (!phone.checkValidity()) {
      document.getElementById('phoneError').innerText = 'Phone number must be 9 digits.';
      isValid = false;
    }
    
    // Password validation
    const password = document.getElementById('password');
    if (!password.checkValidity()) {
      document.getElementById('passwordError').innerText = password.title;
      isValid = false;
    }
    
    // Confirm password validation
    const cpassword = document.getElementById('cpassword');
    if (password.value !== cpassword.value) {
      document.getElementById('cpasswordError').innerText = 'Passwords do not match.';
      isValid = false;
    }
    
    if (!isValid) {
      e.preventDefault(); // Prevent form submission
    }
  });
</script>
