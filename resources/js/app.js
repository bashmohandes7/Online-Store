import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

var channel = Echo.private(`App.Models.User.${userID}`);
channel.notification(function(data) {
    console.log(data);
    alert(data.body);
});
// var channel = Echo.private(`App.Models.User.${userId}`); // Template litrals
//     channel.notification(function(data) {
//         $('#notificationsList').prepend(`
//         <a href="${data.url}?notification_id=${data.id}"
//             class="dropdown-item text-wrap">
//             <i class="${data.icon} mr-2"></i> ${data.body}
//         </a>
//         <div class="dropdown-divider"></div>
//         ` );

//         let count = Number($('.newNotifications').text())
//         count++;
//         if (count > 99) {
//             count = '99+';
//         }
//         $('.newNotifications').text(count)
//     })
