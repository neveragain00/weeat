<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: rgb(111 202 203);">
            <h5 class="modal-title" id="loginModal">Login Here</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="partials/_handleLogin.php" method="post">
              <div class="text-left my-2">
                  <b><label for="username">Username</label></b>
                  <input class="form-control" id="loginusername" name="loginusername" placeholder="Enter Your Username" type="text" required>
              </div>
              <div class="text-left my-2">
                  <b><label for="password">Password</label></b>
                  <input class="form-control" id="loginpassword" name="loginpassword" placeholder="Enter Your Password" type="password" required data-toggle="password">
              </div>

              <div class="form-group">
    <b><label for="address">Address:</label></b>
    <input 
        type="text" 
        class="form-control" 
        id="address" 
        name="address" 
        value="<?php echo isset($_SESSION['address']) ? htmlspecialchars($_SESSION['address']) : ''; ?>" 
        required>
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
            value="<?php echo isset($_SESSION['phone']) ? htmlspecialchars(substr($_SESSION['phone'], 3)) : ''; ?>" 
            required>
    </div>
</div>


              <button type="submit" class="btn btn-success">Submit</button>
            </form>
            <p class="mb-0 mt-1">Don't have an account? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#signupModal">Sign up now</a>.</p>
          </div>
        </div>
      </div>
    </div>

