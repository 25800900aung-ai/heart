<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heart Loading</title>
    <style>
        body {
            margin: 0;
            background-color: #fafafa;
            font-family: sans-serif;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .heart-container {
            position: relative;
            width: 150px;
            height: 150px;
        }

        .heart-svg {
            width: 150px;
            fill: #eee; /* အောက်ခံ မီးခိုးရောင် */
            position: absolute;
        }

        #fill-path {
            fill: #ff4d4d; /* ပြည့်လာမယ့် အနီရောင် */
            clip-path: inset(100% 0 0 0); /* အောက်ကနေ စပြည့်ဖို */
            transition: clip-path 0.1s linear;
        }

        #percentage {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-weight: bold;
            font-size: 1.2rem;
            color: #333;
        }

        #hold-btn {
            margin-top: 40px;
            padding: 12px 24px;
            border-radius: 30px;
            border: none;
            background-color: #ff4d4d;
            color: white;
            font-size: 16px;
            cursor: pointer;
            user-select: none;
            -webkit-tap-highlight-color: transparent; /* ဖုန်းမှာနှိပ်ရင် highlight မပြအောင် */
            box-shadow: 0 4px 15px rgba(255, 77, 77, 0.3);
        }

        #hold-btn:active {
            transform: scale(0.95);
        }

        #final-message {
            margin-top: 20px;
            font-size: 1.5rem;
            color: #ff4d4d;
            font-weight: bold;
            text-align: center;
            animation: fadeIn 0.5s ease-in;
        }

        .hidden {
            display: none;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="heart-container">
        <svg class="heart-svg" viewBox="0 0 32 29.6">
            <path d="M23.6,0c-3.4,0-6.3,2.7-7.6,5.6C14.7,2.7,11.8,0,8.4,0C3.8,0,0,3.8,0,8.4c0,9.4,16,21.2,16,21.2s16-11.8,16-21.2C32,3.8,28.2,0,23.6,0z"/>
            <path id="fill-path" d="M23.6,0c-3.4,0-6.3,2.7-7.6,5.6C14.7,2.7,11.8,0,8.4,0C3.8,0,0,3.8,0,8.4c0,9.4,16,21.2,16,21.2s16-11.8,16-21.2C32,3.8,28.2,0,23.6,0z"/>
        </svg>
        <div id="percentage">0%</div>
    </div>

    <button id="hold-btn">လက်ချောင်းလေးနဲ့ ဖိထားပေးပါ</button>
    <div id="final-message" class="hidden">မင်းကိုအရမ်းချစ်တယ်နော် ❤️</div>
</div>

<script>
    let progress = 0;
    let interval;
    const fillPath = document.getElementById('fill-path');
    const percentageText = document.getElementById('percentage');
    const holdBtn = document.getElementById('hold-btn');
    const message = document.getElementById('final-message');

    function startLoading(e) {
        e.preventDefault(); // Default touch behaviors တွေကို ပိတ်ဖို
        interval = setInterval(() => {
            if (progress < 100) {
                progress++;
                percentageText.innerText = progress + "%";
                // ပြင်လိုက်တဲ့အပိုင်း: backticks () ကို သုံးထားပါတယ်
                fillPath.style.clipPath = `inset(${100 - progress}% 0 0 0)`;
            } else {
                clearInterval(interval);
                message.classList.remove('hidden');
                holdBtn.style.display = 'none';
            }
        }, 50); 
    }

    function stopLoading() {
        clearInterval(interval);
    }

    // Mouse events
    holdBtn.addEventListener('mousedown', startLoading);
    holdBtn.addEventListener('mouseup', stopLoading);
    holdBtn.addEventListener('mouseleave', stopLoading); // ခလုတ်ပေါ်ကနေ mouse ထွက်သွားရင် ရပ်ဖို
    // Touch events
    holdBtn.addEventListener('touchstart', startLoading);
    holdBtn.addEventListener('touchend', stopLoading);
</script>

</body>
</html>