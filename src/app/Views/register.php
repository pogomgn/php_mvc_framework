<main class="form-signin w-100 m-auto text-center">
    <form method="post">
        <img class="mb-4" src="/assets/images/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Register</h1>

        <div class="form-floating">
            <input type="text" class="form-control" id="floatingName" placeholder="Name" name="name">
            <label for="floatingName">Name</label>
        </div>
        <div class="form-floating">
            <input type="email" class="form-control" id="floatingEmail" placeholder="Email address" name="email">
            <label for="floatingEmail">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control cpassword" id="floatingPassword" placeholder="Password" name="password">
            <label for="floatingPassword">Password</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control confirmpassword" id="floatingConfirmPassword" placeholder="Confirm password" name="passConfirm">
            <label for="floatingConfirmPassword">Confirm password</label>
        </div>
        <div class="error">
            {{errors}}
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
        <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
    </form>
</main>