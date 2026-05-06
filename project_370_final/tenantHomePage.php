<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tenantHomePage.css">
    <title>Tenant HomePage</title>
</head>
<body>

<div class="main">


    <div class="navigationBar">

        <div class="icon">
            <h2 class="web_title">SeismoSafe</h2>
        </div>

        <div class="menuBar">

            <ul>
                <li><a href="tenantHomePage.php">HOME</a></li>
                <li><a href="complain.html">COMPLAIN</a></li>
                <div class="assignBox">
                 <form action="assignedBuilding.php" method="POST">
                    <input type="number" name="building_id" placeholder="Building ID" required>
                    <button type="submit">Building</button>
                 </form>
                </div>
                <li><a href="myComplains.php">My Complains</a></li>
                <li class="riskMenu">
                    <a href="risk.php" target="_blank">RiskScore</a>
                </li>
                <li><a href="vacancy.php">Vacancy</a></li>
                <li><a href="tenantRequests.php">MyRequest</a></li>

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

        <h1>“Be self-aware and<br>make others aware.”</h1>

        <p class="description">

An earthquake is one of the most powerful and destructive natural phenomena on Earth. It occurs when there is a sudden release of energy stored within the Earth’s crust, usually caused by the movement of tectonic plates. These plates are constantly shifting, and when they get stuck due to friction, stress builds up over time. When this stress is suddenly released, seismic waves are generated, causing the ground to shake violently.

The point inside the Earth where the earthquake begins is called the **focus (hypocenter)**, and the point directly above it on the Earth’s surface is known as the **epicenter**. The intensity of an earthquake depends on the amount of energy released and its depth below the surface. Earthquakes are measured using instruments called **seismographs**, and their strength is expressed in terms of magnitude on scales such as the **Richter scale** or the **Moment Magnitude scale**.

Earthquakes can cause severe damage to buildings, roads, bridges, and other infrastructure. In heavily populated areas, they can lead to loss of life, injuries, fires, landslides, and even tsunamis when they occur under the ocean.
        </p>

    </div>

</div>

</body>
</html>