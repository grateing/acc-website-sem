<?php
session_start();

// Prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Check if user is logged in
if (!isset($_SESSION['name'])) {
    header("Location: myACC.php");
    exit();
}

$name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Open Sans', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
            background-image: url('myACCbg.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-color: #08345c;
            overflow: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            z-index: 1;
        }

        .greeting-container {
            text-align: center;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 10;
            position: relative;
        }

        .greeting-container img {
            max-width: 150px;
            height: auto;
            margin-bottom: 2rem;
            opacity: 0.8;
        }

        .greeting-text {
            font-size: 3rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        }

        .user-name {
            font-size: 5rem;
            font-weight: 700;
            color: #dfc983;
            margin-bottom: 3rem;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        }

        @keyframes slideUp {
            from {
                transform: translateY(0);
                opacity: 1;
            }
            to {
                transform: translateY(-100vh);
                opacity: 0;
            }
        }

        body.slide-out {
            animation: slideUp 0.6s ease-in forwards;
        }

        .arrow-up {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 2rem;
            color: white;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
            animation: bobbing 2.5s ease-in-out infinite;
            z-index: 10;
            cursor: pointer;
        }

        @keyframes bobbing {
            0%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            50% {
                transform: translateX(-50%) translateY(-10px);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes blink {
            0%, 60%, 100% {
                opacity: 0.3;
            }
            30% {
                opacity: 1;
            }
        }

        body.slide-out .arrow-up {
            animation: none;
            opacity: 0;
        }
    </style>
</head>
<body>
    <div class="arrow-up">⮝</div>
    <div class="greeting-container">
        <img src="myACC.png" alt="Welcome Logo">
        <p class="greeting-text" id="greetingText">Loading...</p>
        <p class="user-name" id="userName"><?php echo htmlspecialchars($name); ?></p>
    </div>

    <script>
        // Get the current hour and minutes from the user's browser (local time)
        const now = new Date();
        const hour = now.getHours();
        const minutes = now.getMinutes();
        let greeting;
        const userName = '<?php echo htmlspecialchars($name); ?>';

        // Random greeting variations
        const greetingVariations = [
            `Hey there!`,
            `Hello!`,
            `Welcome back!`,
            `What's up?`
        ];

        // Night owl: 0:00 to 3:59
        if (hour >= 0 && hour < 4) {
            greeting = `Hello, night owl`;
        }
        // Golden hour morning: 6:00 to 6:20
        else if (hour === 6 && minutes < 21) {
            greeting = `It's golden hour time!`;
        }
        // Good morning: 4:00 to 5:59
        else if (hour >= 4 && hour < 6) {
            greeting = `Good morning`;
        }
        // Good morning: 6:21 to 11:59
        else if (hour > 6 && hour < 12) {
            greeting = `Good morning`;
        }
        // Good afternoon: 12:00 to 17:39
        else if (hour >= 12 && hour < 17) {
            greeting = `Good afternoon`;
        }
        else if (hour === 17 && minutes < 40) {
            greeting = `Good afternoon`;
        }
        // Golden hour evening: 17:40 to 18:00
        else if ((hour === 17 && minutes >= 40) || (hour === 18 && minutes === 0)) {
            greeting = `It's golden hour time!`;
        }
        // Good evening: 18:01 to 23:59
        else {
            greeting = `Good evening`;
        }

        // Use random greeting variation and combine with time-based greeting
        const randomGreeting = greetingVariations[Math.floor(Math.random() * greetingVariations.length)];
        
        // 50% chance to use time-based greeting, 50% chance to use random greeting
        const finalGreeting = Math.random() < 0.5 ? greeting : randomGreeting;
        
        document.getElementById('greetingText').textContent = finalGreeting;
        document.getElementById('userName').textContent = userName + '!';

        // Add click handler to slide up and redirect
        document.body.addEventListener('click', function() {
            document.body.classList.add('slide-out');
            setTimeout(function() {
                window.location.href = 'studentdashboard.html';
            }, 600); // Match the animation duration
        });
    </script>
</body>
</html>
