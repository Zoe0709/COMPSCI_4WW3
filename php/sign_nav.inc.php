<header>
    <!-- navigation bar -->
    <nav>
        <!-- 5 buttons in the navigation menue, which all use google icons -->
        <ul>

            <!-- the Home anchor element -->
            <li>
                <a class='default-nav pulse-grow-on-hover' href='./index.php'><i class='material-icons sm-18'>home</i>Home</a>
            </li>

            <!-- the Search anchor element -->
            <li>
                <a class='default-nav pulse-grow-on-hover' href='./search.php'><i class='material-icons sm-18'>search</i>Search</a>
            </li>

            <!-- the Submit anchor element -->
            <li>
                <a class='default-nav pulse-grow-on-hover' href='./submission.php'><i class='material-icons sm-18'>add</i>Submit</a>
            </li>

            <!-- the Sign Up anchor element -->
            <li>
                <a class='account default-nav pulse-grow-on-hover' href='php/sign_out.php'><i class='material-icons sm-18'>logout</i>Log Out</a>
            </li>

            <!-- the Sign In anchor element -->
            <li>
                <a class='account default-nav pulse-grow-on-hover' href='./profile.php'><i class='material-icons sm-18'>account_circle</i>Profile</a>
            </li>
        </ul>
    </nav>

    <!-- navigation bar for smaller sizes -->
    <div style="background-color: #B68973; position: relative; text-align: center;">

        <ul class="phone-menue">

            <!-- the Search anchor element -->
            <li>
                <a class='phone-navl pulse-grow-on-hover' href='./search.php'><i class='material-icons sm-18'>search</i>Search</a>
            </li>

            <!-- the Home anchor element -->
            <li>
                <a class='phone-navr pulse-grow-on-hover' href='./index.php'><i class='material-icons sm-18'>home</i>Home</a>
            </li>

        </ul>

        <!-- break (New line) -->
        <br>

        <ul class="phone-menue">

            <!-- the Submit anchor element -->
            <li>
                <a class='phone-navl pulse-grow-on-hover' href='./submission.php'><i class='material-icons sm-18'>add</i>Submit</a>
            </li>

            <!-- the User anchor element -->
            <li>
                <!-- A dropbox shows up by clicking -->
                <a class='phone-navr dropdown dropbtn pulse-grow-on-hover' onclick="dropthebox()">
                    <i class='material-icons sm-18'>account_circle</i>Account
                    <div class="dropdown-content" id="userdropdown">
                        <!-- Two options that jumps to sign in and sign up pages respectively -->
                        <a class="pulse-grow-on-hover" href='php/sign_out.php'><i class='material-icons sm-18'>logout</i>Log Out</a>
                        <a class="pulse-grow-on-hover" href='./profile.php'><i class='material-icons sm-18'>account_circle</i>Profile</a>
                    </div>
                </a>
                <!-- break (New line) -->
                <br>
            </li>

        </ul>

    </div>

</header>