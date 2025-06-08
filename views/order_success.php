<?php require_once './views/layouts/layout_top.php'; ?>

<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f0f2f5;
    margin: 0;
    padding: 0;
  }

  .success-container {
    max-width: 600px;
    margin: 80px auto;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    padding: 40px 30px;
    text-align: center;
    animation: fadeIn 0.6s ease-in-out;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .icon-countdown-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 25px;
    margin-bottom: 30px;
  }

  .checkmark-circle {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: #4CAF50;
    position: relative;
    box-shadow: 0 4px 12px rgba(0, 128, 0, 0.3);
    animation: popIn 0.4s ease;
  }

  @keyframes popIn {
    from { transform: scale(0.7); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
  }

  .checkmark-circle::after {
    content: '✓';
    color: white;
    font-size: 60px;
    font-weight: bold;
    line-height: 100px;
    text-align: center;
    position: absolute;
    width: 100%;
    top: 0;
    left: 0;
  }

  .countdown-inline {
    font-size: 28px;
    font-weight: 600;
    color: #333;
  }

  h2 {
    font-size: 30px;
    color: #2e7d32;
    margin-bottom: 10px;
  }

  .message {
    font-size: 18px;
    color: #555;
  }

  @media (max-width: 480px) {
    .icon-countdown-wrapper {
      flex-direction: column;
      gap: 15px;
    }

    .countdown-inline {
      font-size: 24px;
    }
  }
</style>

<div class="success-container">
  <div class="icon-countdown-wrapper">
    <div class="checkmark-circle"></div>
    <div class="countdown-inline">
      <span id="counter">5</span> giây
    </div>
  </div>
  <h2>🎉 Đặt hàng thành công!</h2>
  <p class="message">Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi. Bạn sẽ được chuyển về trang chủ sau vài giây...</p>
</div>

<script>
  let seconds = 5;
  const counterSpan = document.getElementById('counter');

  const countdown = setInterval(() => {
    seconds--;
    counterSpan.textContent = seconds;

    if (seconds <= 0) {
      clearInterval(countdown);
      window.location.href = 'index.php';
    }
  }, 1000);
</script>

<?php require_once './views/layouts/layout_bottom.php'; ?>
