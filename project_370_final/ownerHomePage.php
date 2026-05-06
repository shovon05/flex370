<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ownerHomePage.css">
    <title>Owner HomePage</title>
</head>

<body>
    <div class="main">
        <div class="navigationBar">
            <div class="icon">
                <h2 class="web_title">SeismoSafe</h2>
            </div>

            <div class="menuBar">
                <ul>
                    <li><a href="ownerHomePage.php">HOME</a></li>
                    <li><a href="registration.html">REGISTRATION</a></li>
                    <li><a href=myBuildings.php target='_blank'>My BUILDINGS</a></li>
                    <li class="riskMenu">
                        <a href="risk.php" target="_blank">RiskScore</a>
                    </li>
                    <li><a href="ownerPostToLet.php">Post To-Let</a></li>
                    <li><a href="ownerGetRequests.php">REQUESTS</a></li>


                    <li><a href="logout.php" style="color:red; font-weight:bold;">LOGOUT</a></li>
                </ul>
            </div>
            <div class="profile">
                <a href="profile.php">
                    <?php session_start(); ?>
                    <span class="profile-name">
                        <?php echo $_SESSION['user_name'] ?? "User"; ?>
                    </span>
                </a>
            </div>
        </div>

        <div class="content">
            <br>
            <br>
            <br>
            <h1>“Be self-aware and<br>make others aware.”<br><br></h1>

            <p class="description">
                An earthquake is the sudden shaking of the Earth’s surface caused by the release of energy from inside
                the Earth’s crust. It mainly occurs due to the movement of tectonic plates along faults. The point where
                it starts is called the focus, and the point directly above it on the surface is the epicenter.
                Earthquakes are measured using a seismograph and expressed in magnitude. They can cause serious damage
                such as building collapse, landslides, and sometimes tsunamis. Although earthquakes cannot be prevented,
                proper preparedness, strong construction, and awareness can reduce damage and save lives during such
                natural disasters.
            </p>
        </div>
    </div>

</body>

</html>