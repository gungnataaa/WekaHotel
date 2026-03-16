document.addEventListener("DOMContentLoaded", () => {
    // JSON data
    const roomsData = {
      rooms: [
        {
          name: "Regular Room",
          price_per_night: "1jt/night",
          image: "../img/Reguler.jpg",
          booking_link: "../html/halamanpemesanan.php"
        },
        {
          name: "VIP Room",
          price_per_night: "2jt/night",
          image: "../img/VIP.JPG",
          booking_link: "../html/halamanpemesanan.php"
        },
        {
          name: "Executive Room",
          price_per_night: "3jt/night",
          image: "../img/Executive.jpg",
          booking_link: "../html/halamanpemesanan.php"
        }
      ]
    };
  
    // Populate room list
    const roomListContainer = document.querySelector('.room-list');
    roomListContainer.innerHTML = roomsData.rooms.map(room => `
      <div class="room">
        <img src="${room.image}" alt="${room.name}">
        <h3>${room.name}</h3>
        <p>${room.price_per_night}</p>
        <a class="btn-room" href="${room.booking_link}">Pesan</a>
      </div>
    `).join('');
  });
  