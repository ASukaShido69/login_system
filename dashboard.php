<?php
session_start();

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'] ?? 'ผู้ใช้';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ยินดีต้อนรับ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Poppins:wght@400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            color: white;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            text-align: center;
        }

        .welcome-container {
            padding: 40px 30px;
            max-width: 800px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeIn 1.5s ease-in-out;
        }

        /* แอนิเมชันตัวอักษรแบบเฟี้ยว ๆ */
        .welcome-text {
            font-family: 'Orbitron', sans-serif;
            font-size: 3.5em;
            font-weight: 700;
            color: #00d4ff;
            text-shadow: 0 0 10px rgba(0, 212, 255, 0.6),
                         0 0 30px rgba(0, 212, 255, 0.4),
                         0 0 50px rgba(0, 212, 255, 0.2);
            letter-spacing: 3px;
            margin-bottom: 20px;
            opacity: 0;
            transform: translateY(20px);
            animation: floatText 2s ease-in-out forwards;
        }

        .sub-text {
            font-size: 1.3em;
            color: #e0e0e0;
            margin-bottom: 30px;
            opacity: 0;
            animation: slideUp 1.5s ease-in-out 0.5s forwards;
        }

        .logout-btn {
            display: inline-block;
            padding: 14px 30px;
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            color: white;
            font-weight: 600;
            font-size: 1.1em;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(255, 65, 108, 0.4);
            transition: transform 0.3s, box-shadow 0.3s;
            opacity: 0;
            animation: popIn 1s ease-in-out 1s forwards;
        }

        .logout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 65, 108, 0.6);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes floatText {
            0% {
                opacity: 0;
                transform: translateY(30px);
                filter: blur(10px);
            }
            50% {
                opacity: 1;
                transform: translateY(-10px);
                filter: blur(0);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes popIn {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }
            70% {
                transform: scale(1.1);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Floating particles effect (optional) */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: rgba(0, 212, 255, 0.3);
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.5;
            animation: drift linear infinite;
        }

        @keyframes drift {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>
<body>

<!-- Background Particles -->
<div class="particles" id="particles"></div>

<!-- Welcome Content -->
<div class="welcome-container">
    <div class="welcome-text">
        ยินดีต้อนรับ <br><span style="color:#00f0ff; text-shadow: 0 0 15px rgba(0, 240, 255, 0.8);"><?php echo htmlspecialchars($username); ?></span>
    </div>
    <p class="sub-text">
        คุณได้เข้าสู่ระบบเรียบร้อยแล้ว<br>
        ขอให้วันนี้เป็นวันที่ยอดเยี่ยม!
    </p>
    <a href="logout.php" class="logout-btn">ออกจากระบบ</a>
</div>

<script>
    // สร้างอนุภาคลอยขึ้น (particles)
    const particles = document.getElementById('particles');
    const colors = ['#00d4ff', '#00f0ff', '#00aaff', '#ff00aa', '#ff416c'];
    
    for (let i = 0; i < 20; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');
        
        const size = Math.random() * 10 + 5;
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.left = `${Math.random() * 100}vw`;
        particle.style.bottom = `${-10 - Math.random() * 20}vh`;
        particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        particle.style.opacity = Math.random() * 0.5 + 0.3;
        
        // ความเร็วการลอย
        const duration = Math.random() * 30 + 20;
        particle.style.animationDuration = `${duration}s`;
        
        particles.appendChild(particle);
    }
</script>

</body>
</html>