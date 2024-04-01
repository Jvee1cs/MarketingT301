<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notifications</title>
  <!-- Link to Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
    }
    header {
      background-color: #1e40af; /* Dark blue color */
      padding: 15px;
      color: #fff;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .search-container {
      display: flex;
      align-items: center;
    }
    .search-bar {
      padding: 10px;
      border: none;
      border-radius: 20px;
      margin-right: 10px;
      width: 250px;
      background-color: rgba(255, 255, 255, 0.8);
    }
    .search-bar:focus {
      outline: none;
      background-color: #fff;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .search-btn {
      padding: 10px 20px;
      background-color: #1e40af; /* Dark blue color */
      border: none;
      border-radius: 20px;
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .search-btn:hover {
      background-color: #1a365d; /* Darker blue on hover */
    }
    .notifications {
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      margin: 20px;
      animation: slideIn 0.5s ease;
    }
    .notification {
      margin-bottom: 15px;
      padding-bottom: 15px; /* Add padding to create space between each notification */
      border-bottom: 1px solid #ddd; /* Add a border to create lines between notifications */
      position: relative;
    }
    .notification::after {
      content: attr(data-date);
      position: absolute;
      top: 50%;
      right: 0;
      transform: translateY(-50%);
      color: #888;
    }
    .fa-cog {
      color: white; /* Set the color of the cog icon to white */
    }
    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>
<header>
    <h1>Notifications</h1>
    <div class="search-container">
      <input type="text" class="search-bar" placeholder="Search...">
      <button class="search-btn">Search</button>
    </div>
    <div>
      <!-- Anchor tag for the cog icon -->
      <a href="{{ route('notifications.settings') }}">
        <!-- Font Awesome icon inside the anchor tag -->
        <i class="fas fa-cog fa-lg"></i>
      </a>
    </div>
</header>

  <div class="notifications">
    <div class="notification" data-date="2024-03-30 10:00 AM">
      <p>Alert : A new user named "Lyan Joseph Tubillara" has been made at 2024-03-30 at 10:00 AM</p>
    </div>
    <div class="notification" data-date="2024-03-30 12:30 PM">
      <p>Reminder : A student named "Ralph E. Eco" has not been active in over a year, Do you still wish to keep his data or not?</p>
    </div>
    <div class="notification" data-date="2024-03-31 09:00 AM">
      <p>Reminder : A student named "Jake Baloran" has not been active in over a year, Do you still wish to keep his data or not?</p>
    </div>
  </div>
</body>
</html>
